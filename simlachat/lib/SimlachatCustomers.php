<?php
/**
* MIT License
*
* Copyright (c) 2019 DIGITAL RETAIL TECHNOLOGIES SL
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
* 
* The above copyright notice and this permission notice shall be included in
* all copies or substantial portions of the Software.
* 
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    DIGITAL RETAIL TECHNOLOGIES SL <mail@simlachat.com>
*  @copyright 2007-2019 DIGITAL RETAIL TECHNOLOGIES SL
*  @license   https://opensource.org/licenses/MIT  The MIT License
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/
class SimlachatCustomers
{
    /**
     * @param SimlachatApiClientV5 $api
     * @param $customers
     */
    public static function uploadCustomers($api, $customers)
    {
        $customers = array_chunk($customers, 50);

        foreach ($customers as $chunk) {
            $api->customersUpload($chunk);
            time_nanosleep(0, 200000000);
        }
    }

    /**
     * Builds SimlaChat customer data from PrestaShop customer data
     *
     * @param Customer $object
     * @param array $address
     *
     * @return array
     */
    public static function buildCrmCustomer(Customer $object, $address = array())
    {
        $customer = array(
            'externalId' => $object->id,
            'firstName' => $object->firstname,
            'lastName' => $object->lastname,
            'email' => $object->email,
            'createdAt' => $object->date_add
        );

        if ($object->birthday != '0000-00-00') {
            $customer['birthday'] = $object->birthday;
        }

        return array_merge(
            $customer,
            $address
        );
    }

    /**
     * @param $address
     *
     * @return array
     */
    public static function addressParse($address)
    {
        $postcode = $address->postcode;
        $city = $address->city;
        $addres_line = sprintf("%s %s", $address->address1, $address->address2);
        $countryIso = CountryCore::getIsoById($address->id_country);

        if (!empty($postcode)) {
            $customer['address']['index'] = $postcode;
        }

        if (!empty($city)) {
            $customer['address']['city'] = $city;
        }

        if (!empty($addres_line)) {
            $customer['address']['text'] = $addres_line;
        }

        if (!empty($countryIso)) {
            $customer['address']['countryIso'] = $countryIso;
        }

        $phones = static::getPhone($address);
        $customer = array_merge($customer, $phones);

        return $customer;
    }

    /**
     * @param $address
     *
     * @return array
     */
    private static function getPhone($address)
    {
        $customer['phones'] = array();

        if (!empty($address->phone_mobile)){
            $customer['phones'][] = array('number'=> $address->phone_mobile);
        }

        if (!empty($address->phone)){
            $customer['phones'][] = array('number'=> $address->phone);
        }

        return $customer;
    }
}
