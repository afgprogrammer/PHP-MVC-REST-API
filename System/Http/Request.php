<?php

/**
 *
 * This file is part of mvc-rest-api for PHP.
 *
 */
namespace Http;

/**
 * Class Request an http request
 *
 * @author Mohammad Rahmani <rto1680@gmail.com>
 *
 * @package Http
 */
class Request {

    /**
     *  Get COOKIE Super Global
     * @var
     */
    public $cookie;

    /**
     *  Get REQUEST Super Global
     * @var
     */
    public $request;

    /**
     *  Get FILES Super Global
     * @var
     */
    public $files;

    /**
     * Request constructor.
     */
    public function __construct() {
        $this->request = ($_REQUEST);
        $this->cookie = $this->clean($_COOKIE);
        $this->files = $this->clean($_FILES);
    }

    /**
     *  Get $_GET parameter
     *
     * @param String $key
     * @return string
     */
    public function get(String $key = '') {
        if ($key != '')
            return isset($_GET[$key]) ? $this->clean($_GET[$key]) : null;

        return  $this->clean($_GET);
    }

    /**
     *  Get $_POST parameter
     *
     * @param String $key
     * @return string
     */
    public function post(String $key = '') {
        if ($key != '')
            return isset($_POST[$key]) ? $this->clean($_POST[$key]) : null;

        return  $this->clean($_POST);
    }

    /**
     *  Get POST parameter
     *
     * @param String $key
     * @return string
     */
    public function input(String $key = '') {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);

        if ($key != '') {
            return isset($request[$key]) ? $this->clean($request[$key]) : null;
        } 

        return ($request);
    }

    /**
     *  Get value for server super global var
     *
     * @param String $key
     * @return string
     */
    public function server(String $key = '') {
        return isset($_SERVER[strtoupper($key)]) ? $this->clean($_SERVER[strtoupper($key)]) : $this->clean($_SERVER);
    }

    /**
     *  Get Method
     *
     * @return string
     */
    public function getMethod() {
        return strtoupper($this->server('REQUEST_METHOD'));
    }

    /**
     *  Returns the client IP addresses.
     *
     * @return string
     */
    public function getClientIp() {
        return $this->server('REMOTE_ADDR');
    }

    /**
     *  Script Name
     *
     * @return string
     */
    public function getUrl() {
        return $this->server('QUERY_STRING');
    }

    /**
     * Clean Data
     *
     * @param $data
     * @return string
     */
    private function clean($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {

                // Delete key
                unset($data[$key]);

                // Set new clean key
                $data[$this->clean($key)] = $this->clean($value);
            }
        } else {
            $data = htmlspecialchars($data, ENT_COMPAT, 'UTF-8');
        }

        return $data;
    }
}
