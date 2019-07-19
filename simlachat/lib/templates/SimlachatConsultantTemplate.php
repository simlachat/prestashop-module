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

class SimlachatConsultantTemplate extends SimlachatAbstractTemplate
{
    protected function setTemplate()
    {
        $this->template = "consultant.tpl";
        $this->data = array(
            'assets' => $this->assets,
            'consultantScriptName' => Simlachat::CONSULTANT_SCRIPT,
            'consultantScript' => Configuration::get(Simlachat::CONSULTANT_SCRIPT)
        );
    }
}
