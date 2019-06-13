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

/**
 * Class SimlachatConsultant
 */
class SimlachatConsultant extends SimlachatAbstractHeaderScript
{
    /**
     * @return void
     */
    protected function buildScript()
    {
        $script = Configuration::get(Simlachat::CONSULTANT_SCRIPT);

        if ($script) {
            $this->js = $script;
        }
    }
}
