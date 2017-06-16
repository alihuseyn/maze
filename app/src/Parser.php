<?php

namespace Task;

class Parser
{
    private $container;
    private $maze;
    private $initialPoint;
    private $finalPoint;

    public function __construct(array $container)
    {
        $this->container = $container;
        $this->maze = new Maze();
        $this->initialPoint = [0, 0];
        $this->finalPoint = [0, 0];
    }

    public function parse()
    {
        if (!is_null($this->container) && !empty($this->container)) {
            $row = count($this->container);
            $column = strlen($this->container[0]);
            $this->maze->setColumn($column)->setRow($row);
            for ($i = 0; $i < $row; $i += 1) {
                for ($j = 0; $j < $column; $j += 1) {
                    $object = $this->container[$i][$j];
                    if (!is_null($object) || !empty($object)) {
                        if ($object == 'S') {
                            $this->initialPoint = [$j, $i];
                        }
                        if ($object == 'G') {
                            $this->finalPoint = [$j, $i];
                        }
                        $this->maze->set($object, $j, $i);
                    }
                }
            }
            $this->maze->update();
        }
    }

    public function getMaze()
    {
        return $this->maze;
    }

    public function getInitialPoint()
    {
        return $this->initialPoint;
    }

    public function getFinalPoint()
    {
        return $this->finalPoint;
    }
}
