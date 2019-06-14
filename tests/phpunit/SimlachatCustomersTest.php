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

class SimlachatCustomersTest extends SimlachatTestCase
{
    public function testBuildCrmCustomer()
    {
        $customer = new Customer(1);

        $result = SimlachatCustomers::buildCrmCustomer($customer);

        $this->assertNotEmpty($result['externalId']);
        $this->assertNotEmpty($result['firstName']);
        $this->assertNotEmpty($result['lastName']);
        $this->assertNotEmpty($result['email']);
        $this->assertNotEmpty($result['createdAt']);
    }

    public function testBuildCrmCustomerWithAddress()
    {
        $customer = new Customer(1);

        $result = SimlachatCustomers::buildCrmCustomer(
            $customer,
            SimlachatCustomers::addressParse(new Address(Address::getFirstCustomerAddressId($customer->id)))
        );

        $this->assertNotEmpty($result['externalId']);
        $this->assertNotEmpty($result['firstName']);
        $this->assertNotEmpty($result['lastName']);
        $this->assertNotEmpty($result['email']);
        $this->assertNotEmpty($result['createdAt']);
        $this->assertNotEmpty($result['address']);
        $this->assertNotEmpty($result['address']['countryIso']);
        $this->assertNotEmpty($result['address']['city']);
        $this->assertNotEmpty($result['address']['index']);
    }

    public function testAddressParse()
    {
        $result = SimlachatCustomers::addressParse(new Address(1));

        $this->assertNotEmpty($result['address']);
        $this->assertNotEmpty($result['address']['countryIso']);
        $this->assertNotEmpty($result['address']['city']);
        $this->assertNotEmpty($result['address']['index']);
    }
}
