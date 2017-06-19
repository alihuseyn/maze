<?php

namespace Task;

/**
 * Class App
 * @package Task
 * @author Alihuseyn Gulmammadov <alihuseyn13@gmail.com>
 * @date 19.06.2017 11:30
 */
class App
{
    /**
     * @var Parser
     */
    private $parser;
    /**
     * @var Robot
     */
    private $robot;

    /**
     * Trigger Input read function and return input
     * @return array
     */
    public function read()
    {
        return Input::read();
    }

    /**
     * Parse input and return class itself
     * @param $input
     * @return $this
     */
    public function parse($input)
    {
        $this->parser = new Parser($input);
        $this->parser->parse();

        return $this;
    }

    /**
     * Start calculation for correct path selection
     */
    public function solution()
    {
        $this->robot = new Robot($this->parser->getInitialPoint(), $this->parser->getFinalPoint(), $this->parser->getMaze());
        $this->robot->start();
    }
}
