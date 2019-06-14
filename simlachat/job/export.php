<?php
/**
 * @author Retail Driver LCC
 * @copyright RetailCRM
 * @license GPL
 * @version 2.2.0
 * @link https://retailcrm.ru
 *
 */

$_SERVER['HTTPS'] = 1;

require(dirname(__FILE__) . '/../../../config/config.inc.php');
require(dirname(__FILE__) . '/../../../init.php');
require(dirname(__FILE__) . '/../bootstrap.php');

$apiUrl = Configuration::get(Simlachat::URL);
$apiKey = Configuration::get(Simlachat::API_KEY);
$apiVersion = Configuration::get(Simlachat::API_VERSION);

if (!empty($apiUrl) && !empty($apiKey)) {
    $api = new SimlachatProxy($apiUrl, $apiKey, _PS_ROOT_DIR_ . '/simlachat.log', $apiVersion);
} else {
    error_log('Customers export: set api key & url first', 3, _PS_ROOT_DIR_ . '/simlachat.log');
    exit();
}

$customers = array();
$customerRecords = Customer::getCustomers();

foreach ($customerRecords as $record) {
    $customers[$record['id_customer']] = SimlachatCustomers::buildCrmCustomer(
        new Customer($record['id_customer']),
        SimlachatCustomers::addressParse(new Address(Address::getFirstCustomerAddressId($record['id_customer'])))
    );
}

unset($customerRecords);

SimlachatCustomers::uploadCustomers($api, $customers);
