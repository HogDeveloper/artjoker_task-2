<?php


namespace core\engine;


class Response
{
    private $headers = array();
    private $output;
    private static $instance = null;

    public function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function addHeader($header)
    {
        $this->headers[] = $header;
    }

    public function redirect($url, $status = 302)
    {
        header('Location: ' . str_replace(array('&amp;', "\n", "\r"), array('&', '', ''), $url), true, $status);
        exit();
    }

    public function setOutput(View $view)
    {
        $this->output = $view::$output;
    }

    public function test($html)
    {
        $this->output = $html;
    }

    public function output()
    {
        if ($this->output) {
            if (!headers_sent()) {
                foreach ($this->headers as $header) {
                    header($header, true);
                }
            }

            echo $this->output;
        }
    }
}