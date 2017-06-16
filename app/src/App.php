<?php

namespace Task;

class App
{
    /**
     * @var Parser
     */
    private $parser;
    private $robot;

    public function read()
    {
        return Input::read();
    }

    public function parse($input)
    {
        $this->parser = new Parser($input);
        $this->parser->parse();

        return $this;
    }

    public function solution()
    {
        $this->robot = new Robot($this->parser->getInitialPoint(), $this->parser->getFinalPoint(), $this->parser->getMaze());
        $this->robot->start();
    }
}
