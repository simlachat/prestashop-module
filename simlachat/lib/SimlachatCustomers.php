<?php
/*
 * PHP version 5.3
 *
 * @category Integration
 * @author   RetailCRM <integration@retailcrm.ru>
 * @license  http://retailcrm.ru Proprietary
 * @link     http://retailcrm.ru
 * @see      http://help.retailcrm.ru
 */

class SimlachatCustomers
{
    /**
     * @param SimlachatApiClientV5 $api
     * @param $customers
     */
    public static function uploadCustomers($api, $customers)
    {
        $customers = array_chunk($customers, 50);

        foreach ($customers as $chunk) {
            $api->customersUpload($chunk);
            time_nanosleep(0, 200000000);
        }
    }

    /**
     * Builds SimlaChat customer data from PrestaShop customer data
     *
     * @param Customer $object
     * @param array $address
     *
     * @return array
     */
    public static function buildCrmCustomer(Customer $object, $address = array())
    {
        $customer = array(
            'externalId' => $object->id,
            'firstName' => $object->firstname,
            'lastName' => $object->lastname,
            'email' => $object->email,
            'createdAt' => $object->date_add
        );

        if ($object->birthday != '0000-00-00') {
            $customer['birthday'] = $object->birthday;
        }

        return array_merge(
            $customer,
            $address
        );
    }

    /**
     * @param $address
     *
     * @return array
     */
    public static function addressParse($address)
    {
        $postcode = $address->postcode;
        $city = $address->city;
        $addres_line = sprintf("%s %s", $address->address1, $address->address2);
        $countryIso = CountryCore::getIsoById($address->id_country);

        if (!empty($postcode)) {
            $customer['address']['index'] = $postcode;
        }

        if (!empty($city)) {
            $customer['address']['city'] = $city;
        }

        if (!empty($addres_line)) {
            $customer['address']['text'] = $addres_line;
        }

        if (!empty($countryIso)) {
            $customer['address']['countryIso'] = $countryIso;
        }

        $phones = static::getPhone($address);
        $customer = array_merge($customer, $phones);

        return $customer;
    }

    /**
     * @param $address
     *
     * @return array
     */
    private static function getPhone($address)
    {
        $customer['phones'] = array();

        if (!empty($address->phone_mobile)){
            $customer['phones'][] = array('number'=> $address->phone_mobile);
        }

        if (!empty($address->phone)){
            $customer['phones'][] = array('number'=> $address->phone);
        }

        return $customer;
    }
}
