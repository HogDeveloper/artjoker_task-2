<?php

namespace core\libs\logger;

use core\libs\logger\BaseLogger;

class Logger extends BaseLogger
{
    private array $settings = [];
    private static $instance = null;
    private string $logFileName = "";

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function init(array $settings = [])
    {
        if (!empty($settings)){
            $this->settings = array_merge($this->settings, $settings);
            $this->logFileName = ("log" . "_" . Date("Y-m-d") . ".txt");

            if(!$this->dirExists($this->settings['pathToSave'])){
                $this->createDir($this->settings['pathToSave']);
            }
        } else {
            new \Exception('Error: initialize ' . self::class . ' complete with error. Settings is empty!');
            exit();
        }
    }

    private function dirExists($pathToSearchDir)
    {
        return is_dir($pathToSearchDir);
    }

    private function createDir($pathToNeedleDir)
    {
        mkdir($pathToNeedleDir, 0777, true);
    }

    public function isTrackedError($errorLevel): bool
    {
        return isset($this->settings['trackedErrors'][$errorLevel]);
    }

    public function getSettingsAll(): array
    {
        return $this->settings;
    }

    protected function explodeFormat($string = ""): array
    {
        $template = $this->settings['format'];
        foreach ($this->delimiter as $delimiter){
            if(strripos($template, $delimiter)){
                $arrayStr = explode($delimiter, trim($template));
                $template = implode(" ", $arrayStr);
            }
        }
        $keywords = [];
        $template = explode(" ", $template);
        foreach ($template as $keyword){
            if(strlen(trim($keyword, " ")) > 0){
                $keywords[] = $keyword;
            }
        }
        return $keywords;
    }

    protected function createMessage($errorMessage, $errorLevel = null, $errorFile = null, $errorLine = null): string
    {
        $template = $this->settings["format"];
        $keywords = $this->explodeFormat($template);
        $data = [];
        $data['%date'] = date("Y-m-d H:i:s");
        $data['%message'] = $errorMessage;
        $data['%level'] = $this->errorsType[$errorLevel];
        $data['%file'] = $errorFile;
        $data['%line'] = $errorLine;

        foreach ($keywords as $keyword) {
            if(isset($data[$keyword])){
                $template = str_replace($keyword, (isset($data[$keyword]) ? $data[$keyword] : ''), $template);
            }
        }
        return $template;
    }

    public function write($errorMessage = null, $errorLevel = null, $errorFile = null, $errorLine = null): void
    {
        $date = date("Y-m-d");
        $logDir = $this->settings["pathToSave"] . "/" . $date;
        $logFile = $this->settings["pathToSave"] . "/" . $date . "/" . $this->logFileName;
        $error = $this->createMessage($errorMessage, $errorLevel, $errorFile, $errorLine);
        if(!$this->dirExists($logDir)){
            $this->createDir($logDir);
        }
        file_put_contents($logFile, $error."\n", FILE_APPEND);
    }

    public function writeCustomError($errorMessage): void
    {
        $date = date("Y-m-d");
        $logDir = $this->settings["pathToSave"] . "/" . $date;
        $logFile = $this->settings["pathToSave"] . "/" . $date . "/" . $this->logFileName;
        if(!$this->dirExists($logDir)){
            $this->createDir($logDir);
        }
        file_put_contents($logFile, $errorMessage."\n", FILE_APPEND);
    }

}