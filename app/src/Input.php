<?php

namespace Task;

class Input
{
    public static function read()
    {
        $input = fopen('php://stdin', 'r');
        $container = [];
        while (($content = fgets($input)) !== false) {
            array_push($container, $content);
        }
        
        return $container;
    }
}
