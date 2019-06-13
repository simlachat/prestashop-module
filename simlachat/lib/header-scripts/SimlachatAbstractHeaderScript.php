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

abstract class SimlachatAbstractHeaderScript
{
    protected $js;

    /**
     * @return string
     */
    public function getJs()
    {
        $this->buildScript();

        return $this->js;
    }

    /**
     * @return void
     */
    abstract protected function buildScript();
}
