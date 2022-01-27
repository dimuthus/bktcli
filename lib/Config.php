<?php
namespace Bktcli;

class Config{

    public static function getApiKey(){
        return $_ENV["API_KEY"];
    }
}