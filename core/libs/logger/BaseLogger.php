<?php

namespace core\libs\logger;

abstract class BaseLogger
{

    protected array $delimiter = [';', ':', '@', '-', '_', ',', '.', '/', '\\'];

    protected array $errorsType = [
        E_ERROR => "FATAL ERROR",
        E_WARNING => "E_WARNING",
        E_PARSE => "E_PARSE",
        E_NOTICE => "E_NOTICE",
        E_CORE_ERROR => "E_CORE_ERROR",
        E_CORE_WARNING => "E_CORE_WARNING",
        E_COMPILE_ERROR => "E_COMPILE_ERROR",
        E_COMPILE_WARNING => "E_COMPILE_WARNING",
        E_USER_ERROR => "E_USER_ERROR",
        E_USER_WARNING => "E_USER_WARNING",
        E_USER_NOTICE => "E_USER_NOTICE",
        E_STRICT => "E_STRICT",
        E_RECOVERABLE_ERROR => "E_RECOVERABLE_ERROR",
        E_DEPRECATED => "E_DEPRECATED",
        E_USER_DEPRECATED => "E_USER_DEPRECATED"
    ];

    abstract public function write($errorMessage, $errorLevel, $errorFile, $errorLine): void;

    abstract public function writeCustomError($errorMessage): void;

    abstract protected function explodeFormat($string): array;

    abstract protected function createMessage($errorMessage, $errorLevel = null, $errorFile = null, $errorLine = null): string;

    abstract public function getSettingsAll(): array;

    abstract public function isTrackedError($errorLevel): bool;

}