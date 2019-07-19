<?php
/*
 * PHP version 7.1
 *
 * @category Integration
 * @author   RetailCRM <integration@retailcrm.ru>
 * @license  http://retailcrm.ru Proprietary
 * @link     http://retailcrm.ru
 * @see      http://help.retailcrm.ru
 */

/**
 * Class SimlachatSettingsTemplate
 */
class SimlachatSettingsTemplate extends SimlachatAbstractTemplate
{
    protected $url;
    protected $key;

    /**
     * SimlachatSettingsTemplate constructor.
     *
     * @param $module
     * @param $smarty
     * @param $assets
     * @param $url
     * @param $key
     */
    public function __construct(Module $module, $smarty, $assets, $url, $key)
    {
        parent::__construct($module, $smarty, $assets);

        $this->url = $url;
        $this->key = $key;
    }

    /**
     * Set template data
     */
    protected function setTemplate()
    {
        $this->template = "settings.tpl";
        $this->data = array(
            'assets' => $this->assets,
            'apiUrlName' => Simlachat::URL,
            'apiKeyName' => Simlachat::API_KEY,
            'apiUrl' => $this->url,
            'apiKey' => $this->key,
        );
    }
}
