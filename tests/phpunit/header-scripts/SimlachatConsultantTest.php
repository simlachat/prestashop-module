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

class SimlachatConsultantTest extends SimlachatTestCase
{
    public function testBuildJs()
    {
        $this->setConfig();

        $consultant = new SimlachatConsultant();

        $js = $consultant->getJs();

        $this->assertContains('<script', $js);
        $this->assertContains('</script>', $js);
        $this->assertContains('111111', $js);
    }
}

