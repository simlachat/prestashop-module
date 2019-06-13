<?php
/**
 * PHP version 5.3
 *
 * API client class
 *
 * @category SimlaChat
 * @package  SimlaChat
 * @author   SimlaChat <integration@simlachat.ru>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.SimlaChat.ru/docs/Developers/ApiVersion5
 */
class SimlachatApiClientV5
{
    const VERSION = 'v5';

    protected $client;

    /**
     * Site code
     */
    protected $siteCode;

    /**
     * Client creating
     *
     * @param string $url    api url
     * @param string $apiKey api key
     * @param string $site   site code
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    public function __construct($url, $apiKey, $site = null)
    {
        if ('/' !== $url[strlen($url) - 1]) {
            $url .= '/';
        }

        $url = $url . 'api/' . self::VERSION;

        $this->client = new SimlachatHttpClient($url, array('apiKey' => $apiKey));
        $this->siteCode = $site;
    }

    /**
     * @return SimlachatApiResponse
     * @throws CurlException
     * @throws InvalidArgumentException
     * @throws InvalidJsonException
     */
    public function apiVersions()
    {
        return $this->client->makeRequest('/api-versions', SimlachatHttpClient::METHOD_GET);
    }

    /**
     * Returns users list
     *
     * @param array $filter
     * @param null  $page
     * @param null  $limit
     *
     * @throws InvalidJsonException
     * @throws CurlException
     * @throws \InvalidArgumentException
     *
     * @return SimlachatApiResponse
     */
    public function usersList(array $filter = array(), $page = null, $limit = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/users',
            SimlachatHttpClient::METHOD_GET,
            $parameters
        );
    }

    /**
     * Returns user data
     *
     * @param integer $id user ID
     *
     * @throws \InvalidJsonException
     * @throws CurlException
     * @throws \InvalidArgumentException
     *
     * @return SimlachatApiResponse
     */
    public function usersGet($id)
    {
        return $this->client->makeRequest("/users/$id", SimlachatHttpClient::METHOD_GET);
    }

    /**
     * Change user status
     *
     * @param integer $id     user ID
     * @param string  $status user status
     *
     * @return SimlachatApiResponse
     */
    public function usersStatus($id, $status)
    {
        $statuses = array("free", "busy", "dinner", "break");

        if (empty($status) || !in_array($status, $statuses)) {
            throw new \InvalidArgumentException(
                'Parameter `status` must be not empty & must be equal one of these values: free|busy|dinner|break'
            );
        }

        return $this->client->makeRequest(
            "/users/$id/status",
            SimlachatHttpClient::METHOD_POST,
            array('status' => $status)
        );
    }

    /**
     * Get segments list
     *
     * @param array $filter
     * @param null  $limit
     * @param null  $page
     *
     * @return SimlachatApiResponse
     */
    public function segmentsList(array $filter = array(), $limit = null, $page = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/segments',
            SimlachatHttpClient::METHOD_GET,
            $parameters
        );
    }

    /**
     * Get custom fields list
     *
     * @param array $filter
     * @param null  $limit
     * @param null  $page
     *
     * @return SimlachatApiResponse
     */
    public function customFieldsList(array $filter = array(), $limit = null, $page = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/custom-fields',
            SimlachatHttpClient::METHOD_GET,
            $parameters
        );
    }

    /**
     * Create custom field
     *
     * @param $entity
     * @param $customField
     *
     * @return SimlachatApiResponse
     */
    public function customFieldsCreate($entity, $customField)
    {
        if (!count($customField) ||
            empty($customField['code']) ||
            empty($customField['name']) ||
            empty($customField['type'])
        ) {
            throw new \InvalidArgumentException(
                'Parameter `customField` must contain a data & fields `code`, `name` & `type` must be set'
            );
        }

        if (empty($entity) || $entity != 'customer' || $entity != 'order') {
            throw new \InvalidArgumentException(
                'Parameter `entity` must contain a data & value must be `order` or `customer`'
            );
        }

        return $this->client->makeRequest(
            "/custom-fields/$entity/create",
            SimlachatHttpClient::METHOD_POST,
            array('customField' => json_encode($customField))
        );
    }

    /**
     * Edit custom field
     *
     * @param $entity
     * @param $customField
     *
     * @return SimlachatApiResponse
     */
    public function customFieldsEdit($entity, $customField)
    {
        if (!count($customField) || empty($customField['code'])) {
            throw new \InvalidArgumentException(
                'Parameter `customField` must contain a data & fields `code` must be set'
            );
        }

        if (empty($entity) || $entity != 'customer' || $entity != 'order') {
            throw new \InvalidArgumentException(
                'Parameter `entity` must contain a data & value must be `order` or `customer`'
            );
        }

        return $this->client->makeRequest(
            "/custom-fields/$entity/edit/{$customField['code']}",
            SimlachatHttpClient::METHOD_POST,
            array('customField' => json_encode($customField))
        );
    }

    /**
     * Get custom field
     *
     * @param $entity
     * @param $code
     *
     * @return SimlachatApiResponse
     */
    public function customFieldsGet($entity, $code)
    {
        if (empty($code)) {
            throw new \InvalidArgumentException(
                'Parameter `code` must be not empty'
            );
        }

        if (empty($entity) || $entity != 'customer' || $entity != 'order') {
            throw new \InvalidArgumentException(
                'Parameter `entity` must contain a data & value must be `order` or `customer`'
            );
        }

        return $this->client->makeRequest(
            "/custom-fields/$entity/$code",
            SimlachatHttpClient::METHOD_GET
        );
    }

    /**
     * Get custom dictionaries list
     *
     * @param array $filter
     * @param null  $limit
     * @param null  $page
     *
     * @return SimlachatApiResponse
     */
    public function customDictionariesList(array $filter = [], $limit = null, $page = null)
    {
        $parameters = [];

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/custom-fields/dictionaries',
            SimlachatHttpClient::METHOD_GET,
            $parameters
        );
    }

    /**
     * Create custom dictionary
     *
     * @param $customDictionary
     *
     * @return SimlachatApiResponse
     */
    public function customDictionariesCreate($customDictionary)
    {
        if (!count($customDictionary) ||
            empty($customDictionary['code']) ||
            empty($customDictionary['elements'])
        ) {
            throw new \InvalidArgumentException(
                'Parameter `dictionary` must contain a data & fields `code` & `elemets` must be set'
            );
        }

        return $this->client->makeRequest(
            "/custom-fields/dictionaries/{$customDictionary['code']}/create",
            SimlachatHttpClient::METHOD_POST,
            array('customDictionary' => json_encode($customDictionary))
        );
    }

    /**
     * Edit custom dictionary
     *
     * @param $customDictionary
     *
     * @return SimlachatApiResponse
     */
    public function customDictionariesEdit($customDictionary)
    {
        if (!count($customDictionary) ||
            empty($customDictionary['code']) ||
            empty($customDictionary['elements'])
        ) {
            throw new \InvalidArgumentException(
                'Parameter `dictionary` must contain a data & fields `code` & `elemets` must be set'
            );
        }

        return $this->client->makeRequest(
            "/custom-fields/dictionaries/{$customDictionary['code']}/edit",
            SimlachatHttpClient::METHOD_POST,
            array('customDictionary' => json_encode($customDictionary))
        );
    }

    /**
     * Get custom dictionary
     *
     * @param $code
     *
     * @return SimlachatApiResponse
     */
    public function customDictionariesGet($code)
    {
        if (empty($code)) {
            throw new \InvalidArgumentException(
                'Parameter `code` must be not empty'
            );
        }

        return $this->client->makeRequest(
            "/custom-fields/dictionaries/$code",
            SimlachatHttpClient::METHOD_GET
        );
    }

    /**
     * Returns filtered customers list
     *
     * @param array $filter (default: array())
     * @param int   $page   (default: null)
     * @param int   $limit  (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws CurlException
     * @throws \InvalidJsonException
     *
     * @return SimlachatApiResponse
     */
    public function customersList(array $filter = array(), $page = null, $limit = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/customers',
            SimlachatHttpClient::METHOD_GET,
            $parameters
        );
    }

    /**
     * Create a customer
     *
     * @param array  $customer customer data
     * @param string $site     (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws CurlException
     * @throws \InvalidJsonException
     *
     * @return SimlachatApiResponse
     */
    public function customersCreate(array $customer, $site = null)
    {
        if (! count($customer)) {
            throw new \InvalidArgumentException(
                'Parameter `customer` must contains a data'
            );
        }

        return $this->client->makeRequest(
            '/customers/create',
            SimlachatHttpClient::METHOD_POST,
            $this->fillSite($site, array('customer' => json_encode($customer)))
        );
    }

    /**
     * Save customer IDs' (id and externalId) association in the CRM
     *
     * @param array $ids ids mapping
     *
     * @throws \InvalidArgumentException
     * @throws CurlException
     * @throws \InvalidJsonException
     *
     * @return SimlachatApiResponse
     */
    public function customersFixExternalIds(array $ids)
    {
        if (! count($ids)) {
            throw new \InvalidArgumentException(
                'Method parameter must contains at least one IDs pair'
            );
        }

        return $this->client->makeRequest(
            '/customers/fix-external-ids',
            SimlachatHttpClient::METHOD_POST,
            array('customers' => json_encode($ids))
        );
    }

    /**
     * Upload array of the customers
     *
     * @param array  $customers array of customers
     * @param string $site      (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws CurlException
     * @throws \InvalidJsonException
     *
     * @return SimlachatApiResponse
     */
    public function customersUpload(array $customers, $site = null)
    {
        if (! count($customers)) {
            throw new \InvalidArgumentException(
                'Parameter `customers` must contains array of the customers'
            );
        }

        return $this->client->makeRequest(
            '/customers/upload',
            SimlachatHttpClient::METHOD_POST,
            $this->fillSite($site, array('customers' => json_encode($customers)))
        );
    }

    /**
     * Get customer by id or externalId
     *
     * @param string $id   customer identificator
     * @param string $by   (default: 'externalId')
     * @param string $site (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws CurlException
     * @throws \InvalidJsonException
     *
     * @return SimlachatApiResponse
     */
    public function customersGet($id, $by = 'externalId', $site = null)
    {
        $this->checkIdParameter($by);

        return $this->client->makeRequest(
            "/customers/$id",
            SimlachatHttpClient::METHOD_GET,
            $this->fillSite($site, array('by' => $by))
        );
    }

    /**
     * Edit a customer
     *
     * @param array  $customer customer data
     * @param string $by       (default: 'externalId')
     * @param string $site     (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws CurlException
     * @throws \InvalidJsonException
     *
     * @return SimlachatApiResponse
     */
    public function customersEdit(array $customer, $by = 'externalId', $site = null)
    {
        if (!count($customer)) {
            throw new \InvalidArgumentException(
                'Parameter `customer` must contains a data'
            );
        }

        $this->checkIdParameter($by);

        if (!array_key_exists($by, $customer)) {
            throw new \InvalidArgumentException(
                sprintf('Customer array must contain the "%s" parameter.', $by)
            );
        }

        return $this->client->makeRequest(
            sprintf('/customers/%s/edit', $customer[$by]),
            SimlachatHttpClient::METHOD_POST,
            $this->fillSite(
                $site,
                array('customer' => json_encode($customer), 'by' => $by)
            )
        );
    }

    /**
     * Get customers history
     * @param array $filter
     * @param null $page
     * @param null $limit
     *
     * @throws \InvalidArgumentException
     * @throws CurlException
     * @throws \InvalidJsonException
     *
     * @return SimlachatApiResponse
     */
    public function customersHistory(array $filter = array(), $page = null, $limit = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/customers/history',
            SimlachatHttpClient::METHOD_GET,
            $parameters
        );
    }

    /**
     * Combine customers
     *
     * @param array $customers
     * @param array $resultCustomer
     *
     * @return SimlachatApiResponse
     */
    public function customersCombine(array $customers, $resultCustomer)
    {

        if (!count($customers) || !count($resultCustomer)) {
            throw new \InvalidArgumentException(
                'Parameters `customers` & `resultCustomer` must contains a data'
            );
        }

        return $this->client->makeRequest(
            '/customers/combine',
            SimlachatHttpClient::METHOD_POST,
            array(
                'customers' => json_encode($customers),
                'resultCustomer' => json_encode($resultCustomer)
            )
        );
    }

    /**
     * Returns filtered customers notes list
     *
     * @param array $filter (default: array())
     * @param int   $page   (default: null)
     * @param int   $limit  (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws CurlException
     * @throws \InvalidJsonException
     *
     * @return SimlachatApiResponse
     */
    public function customersNotesList(array $filter = array(), $page = null, $limit = null)
    {
        $parameters = array();
        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }
        return $this->client->makeRequest(
            '/customers/notes',
            SimlachatHttpClient::METHOD_GET,
            $parameters
        );
    }

    /**
     * Create customer note
     *
     * @param array $note (default: array())
     * @param string $site     (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws CurlException
     * @throws \InvalidJsonException
     *
     * @return SimlachatApiResponse
     */
    public function customersNotesCreate($note, $site = null)
    {
        if (empty($note['customer']['id']) && empty($note['customer']['externalId'])) {
            throw new \InvalidArgumentException(
                'Customer identifier must be set'
            );
        }
        return $this->client->makeRequest(
            '/customers/notes/create',
            SimlachatHttpClient::METHOD_POST,
            $this->fillSite($site, array('note' => json_encode($note)))
        );
    }

    /**
     * Delete customer note
     *
     * @param integer $id
     *
     * @throws \InvalidArgumentException
     * @throws CurlException
     * @throws \InvalidJsonException
     *
     * @return SimlachatApiResponse
     */
    public function customersNotesDelete($id)
    {
        if (empty($id)) {
            throw new \InvalidArgumentException(
                'Note id must be set'
            );
        }
        return $this->client->makeRequest(
            "/customers/notes/$id/delete",
            SimlachatHttpClient::METHOD_POST
        );
    }

    /**
     * Get tasks list
     *
     * @param array $filter
     * @param null  $limit
     * @param null  $page
     *
     * @return SimlachatApiResponse
     */
    public function tasksList(array $filter = array(), $limit = null, $page = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/tasks',
            SimlachatHttpClient::METHOD_GET,
            $parameters
        );
    }

    /**
     * Create task
     *
     * @param array $task
     * @param null  $site
     *
     * @return SimlachatApiResponse
     *
     */
    public function tasksCreate($task, $site = null)
    {
        if (!count($task)) {
            throw new \InvalidArgumentException(
                'Parameter `task` must contain a data'
            );
        }

        return $this->client->makeRequest(
            "/tasks/create",
            SimlachatHttpClient::METHOD_POST,
            $this->fillSite(
                $site,
                array('task' => json_encode($task))
            )
        );
    }

    /**
     * Edit task
     *
     * @param array $task
     * @param null  $site
     *
     * @return SimlachatApiResponse
     *
     */
    public function tasksEdit($task, $site = null)
    {
        if (!count($task)) {
            throw new \InvalidArgumentException(
                'Parameter `task` must contain a data'
            );
        }

        return $this->client->makeRequest(
            "/tasks/{$task['id']}/edit",
            SimlachatHttpClient::METHOD_POST,
            $this->fillSite(
                $site,
                array('task' => json_encode($task))
            )
        );
    }

    /**
     * Get custom dictionary
     *
     * @param $id
     *
     * @return SimlachatApiResponse
     */
    public function tasksGet($id)
    {
        if (empty($id)) {
            throw new \InvalidArgumentException(
                'Parameter `id` must be not empty'
            );
        }

        return $this->client->makeRequest(
            "/tasks/$id",
            SimlachatHttpClient::METHOD_GET
        );
    }

    /**
     * Returns available county list
     *
     * @throws \InvalidArgumentException
     * @throws CurlException
     * @throws \InvalidJsonException
     *
     * @return SimlachatApiResponse
     */
    public function countriesList()
    {
        return $this->client->makeRequest(
            '/reference/countries',
            SimlachatHttpClient::METHOD_GET
        );
    }

    /**
     * Returns sites list
     *
     * @throws \InvalidArgumentException
     * @throws CurlException
     * @throws \InvalidJsonException
     *
     * @return SimlachatApiResponse
     */
    public function sitesList()
    {
        return $this->client->makeRequest(
            '/reference/sites',
            SimlachatHttpClient::METHOD_GET
        );
    }

    /**
     * Edit site
     *
     * @param array $data site data
     *
     * @throws \InvalidArgumentException
     * @throws CurlException
     * @throws \InvalidJsonException
     *
     * @return SimlachatApiResponse
     */
    public function sitesEdit(array $data)
    {
        if (!array_key_exists('code', $data)) {
            throw new \InvalidArgumentException(
                'Data must contain "code" parameter.'
            );
        }

        return $this->client->makeRequest(
            sprintf('/reference/sites/%s/edit', $data['code']),
            SimlachatHttpClient::METHOD_POST,
            array('site' => json_encode($data))
        );
    }

    /**
     * Returns stores list
     *
     * @throws \InvalidArgumentException
     * @throws CurlException
     * @throws \InvalidJsonException
     *
     * @return SimlachatApiResponse
     */
    public function storesList()
    {
        return $this->client->makeRequest(
            '/reference/stores',
            SimlachatHttpClient::METHOD_GET
        );
    }

    /**
     * Edit store
     *
     * @param array $data site data
     *
     * @throws \InvalidArgumentException
     * @throws CurlException
     * @throws \InvalidJsonException
     *
     * @return SimlachatApiResponse
     */
    public function storesEdit(array $data)
    {
        if (!array_key_exists('code', $data)) {
            throw new \InvalidArgumentException(
                'Data must contain "code" parameter.'
            );
        }

        if (!array_key_exists('name', $data)) {
            throw new \InvalidArgumentException(
                'Data must contain "name" parameter.'
            );
        }

        return $this->client->makeRequest(
            sprintf('/reference/stores/%s/edit', $data['code']),
            SimlachatHttpClient::METHOD_POST,
            array('store' => json_encode($data))
        );
    }

    /**
     * Get telephony settings
     *
     * @param string $code
     *
     * @throws \InvalidJsonException
     * @throws CurlException
     * @throws \InvalidArgumentException
     *
     * @return SimlachatApiResponse
     */
    public function telephonySettingsGet($code)
    {
        if (empty($code)) {
            throw new \InvalidArgumentException('Parameter `code` must be set');
        }

        return $this->client->makeRequest(
            "/telephony/setting/$code",
            SimlachatHttpClient::METHOD_GET
        );
    }

    /**
     * Edit telephony settings
     *
     * @param string  $code        symbolic code
     * @param string  $clientId    client id
     * @param boolean $active      telephony activity
     * @param mixed   $name        service name
     * @param mixed   $makeCallUrl service init url
     * @param mixed   $image       service logo url(svg file)
     *
     * @param array   $additionalCodes
     * @param array   $externalPhones
     * @param bool    $allowEdit
     * @param bool    $inputEventSupported
     * @param bool    $outputEventSupported
     * @param bool    $hangupEventSupported
     * @param bool    $changeUserStatusUrl
     *
     * @return SimlachatApiResponse
     */
    public function telephonySettingsEdit(
        $code,
        $clientId,
        $active = false,
        $name = false,
        $makeCallUrl = false,
        $image = false,
        $additionalCodes = array(),
        $externalPhones = array(),
        $allowEdit = false,
        $inputEventSupported = false,
        $outputEventSupported = false,
        $hangupEventSupported = false,
        $changeUserStatusUrl = false
    )
    {
        if (!isset($code)) {
            throw new \InvalidArgumentException('Code must be set');
        }

        $parameters['code'] = $code;

        if (!isset($clientId)) {
            throw new \InvalidArgumentException('client id must be set');
        }

        $parameters['clientId'] = $clientId;

        if (!isset($active)) {
            $parameters['active'] = false;
        } else {
            $parameters['active'] = $active;
        }

        if (!isset($name)) {
            throw new \InvalidArgumentException('name must be set');
        }

        if (isset($name)) {
            $parameters['name'] = $name;
        }

        if (isset($makeCallUrl)) {
            $parameters['makeCallUrl'] = $makeCallUrl;
        }

        if (isset($image)) {
            $parameters['image'] = $image;
        }

        if (isset($additionalCodes)) {
            $parameters['additionalCodes'] = $additionalCodes;
        }

        if (isset($externalPhones)) {
            $parameters['externalPhones'] = $externalPhones;
        }

        if (isset($allowEdit)) {
            $parameters['allowEdit'] = $allowEdit;
        }

        if (isset($inputEventSupported)) {
            $parameters['inputEventSupported'] = $inputEventSupported;
        }

        if (isset($outputEventSupported)) {
            $parameters['outputEventSupported'] = $outputEventSupported;
        }

        if (isset($hangupEventSupported)) {
            $parameters['hangupEventSupported'] = $hangupEventSupported;
        }

        if (isset($changeUserStatusUrl)) {
            $parameters['changeUserStatusUrl'] = $changeUserStatusUrl;
        }

        return $this->client->makeRequest(
            "/telephony/setting/$code/edit",
            SimlachatHttpClient::METHOD_POST,
            array('configuration' => json_encode($parameters))
        );
    }

    /**
     * Call event
     *
     * @param string $phone phone number
     * @param string $type  call type
     * @param array  $codes
     * @param string $hangupStatus
     * @param string $externalPhone
     * @param array  $webAnalyticsData
     *
     * @return SimlachatApiResponse
     * @internal param string $code additional phone code
     * @internal param string $status call status
     *
     */
    public function telephonyCallEvent(
        $phone,
        $type,
        $codes,
        $hangupStatus,
        $externalPhone = null,
        $webAnalyticsData = array()
    )
    {
        if (!isset($phone)) {
            throw new \InvalidArgumentException('Phone number must be set');
        }

        if (!isset($type)) {
            throw new \InvalidArgumentException('Type must be set (in|out|hangup)');
        }

        if (empty($codes)) {
            throw new \InvalidArgumentException('Codes array must be set');
        }

        $parameters['phone'] = $phone;
        $parameters['type'] = $type;
        $parameters['codes'] = $codes;
        $parameters['hangupStatus'] = $hangupStatus;
        $parameters['callExternalId'] = $externalPhone;
        $parameters['webAnalyticsData'] = $webAnalyticsData;


        return $this->client->makeRequest(
            '/telephony/call/event',
            SimlachatHttpClient::METHOD_POST,
            array('event' => json_encode($parameters))
        );
    }

    /**
     * Upload calls
     *
     * @param array $calls calls data
     *
     * @throws \InvalidArgumentException
     * @throws CurlException
     * @throws \InvalidJsonException
     *
     * @return SimlachatApiResponse
     */
    public function telephonyCallsUpload(array $calls)
    {
        if (!count($calls)) {
            throw new \InvalidArgumentException(
                'Parameter `calls` must contains array of the calls'
            );
        }

        return $this->client->makeRequest(
            '/telephony/calls/upload',
            SimlachatHttpClient::METHOD_POST,
            array('calls' => json_encode($calls))
        );
    }

    /**
     * Get call manager
     *
     * @param string $phone   phone number
     * @param bool   $details detailed information
     *
     * @throws \InvalidArgumentException
     * @throws CurlException
     * @throws \InvalidJsonException
     *
     * @return SimlachatApiResponse
     */
    public function telephonyCallManager($phone, $details)
    {
        if (!isset($phone)) {
            throw new \InvalidArgumentException('Phone number must be set');
        }

        $parameters['phone'] = $phone;
        $parameters['details'] = isset($details) ? $details : 0;

        return $this->client->makeRequest(
            '/telephony/manager',
            SimlachatHttpClient::METHOD_GET,
            $parameters
        );
    }

    /**
     * Update CRM basic statistic
     *
     * @throws \InvalidArgumentException
     * @throws CurlException
     * @throws \InvalidJsonException
     *
     * @return SimlachatApiResponse
     */
    public function statisticUpdate()
    {
        return $this->client->makeRequest(
            '/statistic/update',
            SimlachatHttpClient::METHOD_GET
        );
    }

    /**
     * Edit module configuration
     *
     * @param array $configuration
     *
     * @throws \InvalidJsonException
     * @throws CurlException
     * @throws \InvalidArgumentException
     *
     * @return SimlachatApiResponse
     */
    public function integrationModulesEdit(array $configuration)
    {
        if (!count($configuration) || empty($configuration['code'])) {
            throw new \InvalidArgumentException(
                'Parameter `configuration` must contains a data & configuration `code` must be set'
            );
        }

        $code = $configuration['code'];

        return $this->client->makeRequest(
            "/integration-modules/$code/edit",
            SimlachatHttpClient::METHOD_POST,
            array('integrationModule' => json_encode($configuration))
        );
    }

    /**
     * Return current site
     *
     * @return string
     */
    public function getSite()
    {
        return $this->siteCode;
    }

    /**
     * Set site
     *
     * @param string $site site code
     *
     * @return void
     */
    public function setSite($site)
    {
        $this->siteCode = $site;
    }

    /**
     * Check ID parameter
     *
     * @param string $by identify by
     *
     * @throws \InvalidArgumentException
     *
     * @return bool
     */
    protected function checkIdParameter($by)
    {
        $allowedForBy = array(
            'externalId',
            'id'
        );

        if (!in_array($by, $allowedForBy, false)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Value "%s" for "by" param is not valid. Allowed values are %s.',
                    $by,
                    implode(', ', $allowedForBy)
                )
            );
        }

        return true;
    }

    /**
     * Fill params by site value
     *
     * @param string $site   site code
     * @param array  $params input parameters
     *
     * @return array
     */
    protected function fillSite($site, array $params)
    {
        if ($site) {
            $params['site'] = $site;
        } elseif ($this->siteCode) {
            $params['site'] = $this->siteCode;
        }

        return $params;
    }
}
