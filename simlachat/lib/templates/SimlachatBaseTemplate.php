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
 * Class SimlachatBaseTemplate
 */
class SimlachatBaseTemplate extends SimlachatAbstractTemplate
{
    /**
     * Set template data
     */
    protected function setTemplate()
    {
        $this->template = "index.tpl";
        $this->data = array(
            'assets' => $this->assets,
            'apiUrl' => Simlachat::URL,
            'apiKey' => Simlachat::API_KEY,
        );
    }
}
