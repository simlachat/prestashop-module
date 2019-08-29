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
class SimlachatProxy
{
    private $api;
    private $log;

    public function __construct($url, $key, $log, $version = '5')
    {
        switch ($version) {
            case '5':
                $this->api = new SimlachatApiClientV5($url, $key);
                break;
            case '4':
                $this->api = new SimlachatApiClientV4($url, $key);
                break;
        }

        $this->log = $log;
    }

    public function __call($method, $arguments)
    {
        $date = date('Y-m-d H:i:s');
        try {
            $response = call_user_func_array(array($this->api, $method), $arguments);

            if (!$response->isSuccessful()) {
                error_log("[$date] @ [$method] " . $response->getErrorMsg() . "\n", 3, $this->log);
                if (isset($response['errors'])) {
                    SimlachatApiErrors::set($response['errors'], $response->getStatusCode());
                    $error = implode("\n", $response['errors']);
                    error_log($error . "\n", 3, $this->log);
                }
                $response = false;
            }

            return $response;
        } catch (CurlException $e) {
            error_log("[$date] @ [$method] " . $e->getMessage() . "\n", 3, $this->log);
            return false;
        } catch (InvalidJsonException $e) {
            error_log("[$date] @ [$method] " . $e->getMessage() . "\n", 3, $this->log);
            return false;
        }
    }

}
