<?php

namespace MyDotenv;

class MyDotenv
{
    public static function createImmutable($dir, $file = '.env')
    {
        return \Dotenv\Dotenv::createImmutable($dir, $file);
    }
}
