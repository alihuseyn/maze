<?php

namespace Task;

/**
 * Class Input: This Class helps to get input from command line.
 * @package Task
 * @author Alihuseyn Gulmammadov <alihuseyn13@gmail.com>
 * @date 19.06.2017 11:30
 */
class Input
{
    /**
     * Read input from command line and push them array
     * @example
     *             php index.php < maze/maze1.php
     *
     *             #maze1.php
     *                  # . S
     *                  # # .
     *                  # # G
     *
     *            #return
     *            $container => ['#.S','##.','##G']
     *
     * @return array $container
     */
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
