<?php

/**
 * Class RequestProxy
 * @package RetailCrm\Component
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
