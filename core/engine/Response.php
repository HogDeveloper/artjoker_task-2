<?php


namespace core\engine;

use core\engine\View;

class Response
{
    private array $headers = [];
    private string $template;
    private static $instance = null;
    private array $data = [];
    private Application $app;

    public function __construct(Application $app, $pathToResources)
    {
        $this->app = $app;
        View::setResourcesDir($pathToResources);
    }

    public static function getInstance(Application $app, $pathToResource)
    {
        if (self::$instance === null) {
            self::$instance = new self($app, $pathToResource);
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

    public function setOutput($template, array $data = [])
    {
        $this->template = $template;
        $this->data = $data;
    }

    public function output()
    {
        if (isset($this->template)) {
            if (!headers_sent()) {
                foreach ($this->headers as $header) {
                    header($header, true);
                }
            }

            echo View::renderTemplate($this->template, $this->data);
        }
    }
}