<?php

namespace core\libs\logger;

abstract class BaseLogger
{

    protected array $delimiter = [';', ':', '@', '-', '_', ',', '.', '/', '\\'];

    protected array $errorsType = [
        E_ERROR => "error", //'E_ERROR'
        E_WARNING => "warning", //'E_WARNING'
        E_PARSE => "parce", //'E_PARSE'
        E_NOTICE => "notice", //'E_NOTICE'
        E_CORE_ERROR => "error", //'E_CORE_ERROR'
        E_CORE_WARNING => "warning", //'E_CORE_WARNING'
        E_COMPILE_ERROR => "error", //'E_COMPILE_ERROR'
        E_COMPILE_WARNING => "warning", //'E_COMPILE_WARNING'
        E_USER_ERROR => "error", //'E_USER_ERROR'
        E_USER_WARNING => "warning", //'E_USER_WARNING'
        E_USER_NOTICE => "notice", //'E_USER_NOTICE'
        E_STRICT => "error", //'E_STRICT'
        E_RECOVERABLE_ERROR => "error", //'E_RECOVERABLE_ERROR'
        E_DEPRECATED => "warning", //'E_DEPRECATED'
        E_USER_DEPRECATED => "warning", //'E_USER_DEPRECATED'
    ];

    abstract public function write($errorMessage, $errorLevel, $errorFile, $errorLine): void;

    abstract public function writeCustomError($errorMessage): void;

    abstract protected function explodeFormat($string): array;

    abstract protected function createMessage($errorMessage, $errorLevel = null, $errorFile = null, $errorLine = null): string;

    abstract public function getSettingsAll(): array;

    abstract public function isTrackedError($errorLevel): bool;

    abstract public function warning();

    abstract public function trace();

    abstract public function error();

    abstract public function notice();

    abstract public function debug();

    abstract public function info();

    abstract public function fatal();

}