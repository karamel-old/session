<?php

namespace Karamel\Session\Facade;
/**
 * Class Session
 * @package Karamel\Session\Facade
 */
class Session
{
    /**
     * @var
     */
    private static $instance;
    /**
     * @var
     */
    private static $filename;

    /**
     * @param $filename
     */
    public static function setFileName($filename)
    {
        self::$filename = $filename;
    }

    /**
     * @param $key
     * @param $value
     * @throws \Exception
     */
    public static function set($key, $value)
    {
        self::getInstance()->set($key, $value);
    }

    /**
     * @return \Karamel\Session\Session
     * @throws \Exception
     */
    public static function getInstance()
    {
        if (self::$filename == null)
            throw new \Exception("Session filename must be set");

        if (self::$instance == null)
            self::$instance = new \Karamel\Session\Session(self::$filename);

        return self::$instance;
    }

    /**
     * @param $key
     * @param null $default
     * @throws \Exception
     */
    public static function get($key, $default = null)
    {
        self::getInstance()->get($key, $default);
    }

    /**
     * @param $key
     * @throws \Exception
     */
    public static function delete($key)
    {
        self::getInstance()->delete($key);
    }

    /**
     * @throws \Exception
     */
    public static function destroy()
    {
        self::getInstance()->destroy();
    }
}