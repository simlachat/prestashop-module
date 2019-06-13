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

class SimlachatUtils
{
    /**
     * @return string
     */
    public static function getLogDir()
    {
        if (!defined(_PS_ROOT_DIR_)) {
            return 'simlachat.log';
        }

        if (is_dir(_PS_ROOT_DIR_ . '/log')) {
            return _PS_ROOT_DIR_ . '/log/simlachat.log';
        }

        if (is_dir(_PS_ROOT_DIR_ . '/var/log')) {
            return _PS_ROOT_DIR_ . '/var/log/simlachat.log';
        }
    }

    /**
     * Split a string to id
     *
     * @param string $ids string with id
     *
     * @return array
     */
    public static function partitionId($ids)
    {
        $ids = explode(',', $ids);

        $ranges = [];

        foreach ($ids as $idx => $uid) {
            if (strpos($uid, '-')) {
                $range = explode('-', $uid);
                $ranges = array_merge($ranges, range($range[0], $range[1]));
                unset($ids[$idx]);
            }
        }

        $ids = implode(',', array_merge($ids, $ranges));
        $ids = explode(',', $ids);

        return $ids;
    }
}
