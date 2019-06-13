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

class SimlachatUtilsTest extends SimlachatTestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testPartitionId($ids)
    {
        $res = SimlachatUtils::partitionId($ids);

        $this->assertEquals(array(1,2), $res);
    }

    public function dataProvider()
    {
        return array(
            array(
                '1,2'
            ),
            array(
                '1-2'
            )
        );
    }
}
