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
 * Class SimlachatTemplateFactory
 */
class SimlachatTemplateFactory
{
    private $assets;
    private $smarty;

    /**
     * SimlachatTemplateFactory constructor.
     *
     * @param $smarty
     * @param $assets
     */
    public function __construct($smarty, $assets)
    {
        $this->smarty = $smarty;
        $this->assets = $assets;
    }

    /**
     * @param Module $module
     *
     * @return SimlachatAbstractTemplate
     */
    public function createTemplate(Module $module)
    {
        $url = Configuration::get(Simlachat::URL);
        $apiKey = Configuration::get(Simlachat::API_KEY);

        if (empty($url) && empty($apiKey)) {
            return new SimlachatBaseTemplate($module, $this->smarty, $this->assets);
        } else {
            if (Tools::getValue('item') === 'consultant') {
                return new SimlachatConsultantTemplate($module, $this->smarty, $this->assets);
            } else {
                return new SimlachatSettingsTemplate($module, $this->smarty, $this->assets, $url, $apiKey);
            }
        }
    }
}
