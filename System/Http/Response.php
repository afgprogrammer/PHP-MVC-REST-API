<?php

/**
 *
 * This file is part of mvc-rest-api for PHP.
 *
 */
namespace Http;

/**
 * Class Response an Http response
 *
 * @author Mohammad Rahmani <rto1680@gmail.com>
 *
 * @package Http
 */
class Response {

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var array
     */
    protected $statusTexts = [
        // INFORMATIONAL CODES
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        // SUCCESS CODES
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-status',
        208 => 'Already Reported',
        // REDIRECTION CODES
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Switch Proxy', // Deprecated
        307 => 'Temporary Redirect',
        // CLIENT ERROR
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Time-out',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested range not satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Unordered Collection',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        // SERVER ERROR
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Time-out',
        505 => 'HTTP Version not supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        511 => 'Network Authentication Required',
    ];

    /**
     * @var
     */
    protected $version;

    /**
     * @var
     */
    protected $content;

    /**
     * Response constructor.
     */
    public function __construct () {
        $this->setVersion('1.1');
    }

    /**
     *  Set the Http protocol version
     *
     * @param string $version
     */
    public function setVersion(string $version) {
        $this->version = $version;
    }

    /**
     *  Get the Http protocol version
     *
     * @return string
     */
    public function getVersion() : string {
        return $this->version;
    }

    /**
     *  Get the status code text.
     *
     * @param int $code
     * @return string
     */
    public function getStatusCodeText(int $code) : string {
        return (string) isset($this->statusTexts[$code]) ? $this->statusTexts[$code] : 'unknown status';
    }

    /**
     *  Set the response Headers.
     *
     * @param $header
     */
    public function setHeader(String $header) {
        $this->headers[] = $header;
    }

    /**
     *  Get the response Headers.
     *
     * @return array
     */
    public function getHeader() {
        return $this->headers;
    }

    /**
     *  Set content response.
     *
     * @param $content
     */
    public function setContent($content) {
        $this->content = json_encode($content);
    }

    /**
     *  Get content response.
     *
     * @return mixed
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * @param $url
     */
    public function redirect($url) {
        if (empty($url)) {
            trigger_error('Cannot redirect to an empty URL.');
            exit;
        }

        header('Location: ' . str_replace(array('&amp;', "\n", "\r"), array('&','', ''), $url), true, 302);
        exit();
    }

    /**
     *  check status code is invalid
     *
     * @return bool
     */
    public function isInvalid(int $statusCode) : bool {
        return $statusCode < 100 || $statusCode >= 600;
    }

    public function sendStatus($code) {
        if (!$this->isInvalid($code)) {
            $this->setHeader(sprintf('HTTP/1.1 ' . $code . ' %s' , $this->getStatusCodeText($code)));
        }
    }

    /**
     *  Render Output
     */
    public function render() {
        if ($this->content) {
            $output = $this->content;

            // Headers
            if (!headers_sent()) {
                foreach ($this->headers as $header) {
                    header($header, true);
                }
            }
            
            echo $output;
        }
    }
}
