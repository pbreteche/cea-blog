<?php

namespace Pierre\service;


use Monolog\Handler\StreamHandler;
use Monolog\Logger as MonoLogger;
use Psr\Log\LoggerInterface;

class Logger
{

    private static $serviceInstance;

    public static function get(): LoggerInterface
    {
        if (is_null(self::$serviceInstance)) {
            self::createService();
        }

        return self::$serviceInstance;
    }

    private static function createService()
    {

        self::$serviceInstance = new MonoLogger('Main');

        $fileHandler = new StreamHandler(APP_ROOT . '/var/main.log',
            MonoLogger::NOTICE);

        self::$serviceInstance->pushHandler($fileHandler);

        self::$serviceInstance->error('Logger service instanciated');
    }
}