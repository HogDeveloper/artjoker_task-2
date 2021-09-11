<?php

namespace testLogger;

class GeneratorErrors
{
    public static function runGenerateError($methodName)
    {
        $scope = [self::class, $methodName];
        if(is_callable($scope, false, $callableName)){
            return $callableName();
        }
        echo (new \Exception("Method" . $methodName . " not found"));
    }
    // Notice
    private static function test_1()
    {
        echo $undefinedVar;
    }
    // Warning
    private static function test_2()
    {
        include_once 'not-exists.php';
    }
    // Warning
    private static function test_3()
    {
        join('string', 'string');
    }
    // Notice
    private static function test_4()
    {
        echo UNKNOWN_CONSTANT;
    }
    // Deprecated
    private static function test_5()
    {
        split(',', 'a,b');
    }

}