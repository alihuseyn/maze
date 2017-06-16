<?php

namespace Task;

class Robot
{
    private $initialPoint;
    private $finalPoint;
    private $maze;

    private $step = 0;
    private $success = false;

    private $wasHere;
    private $correctPath;

    public function __construct(array $initialPoint, array $finalPoint, Maze $maze)
    {
        $this->initialPoint = $initialPoint;
        $this->finalPoint = $finalPoint;
        $this->maze = $maze;
        $this->wasHere = array_fill(0, $this->maze->getRow(), (array_fill(0, $this->maze->getColumn(), false)));
        $this->correctPath = array_fill(0, $this->maze->getRow(), (array_fill(0, $this->maze->getColumn(), false)));
    }

    public function start()
    {
        $this->process($this->initialPoint[0], $this->initialPoint[1]);
        if ($this->success) {
            echo "-\nSuccessfully Finished!\n-".PHP_EOL;
            $this->maze->toString(32);
        } else {
            echo "-\nFailed :(!\n-".PHP_EOL;
            $this->maze->toString(31);
        }
    }

    protected function process($x, $y)
    {
        if ($x == $this->finalPoint[0] && $y == $this->finalPoint[1]) {
            $this->success = true;

            return true;
        }
        if ($this->maze->get($x, $y) == '#' || $this->maze->get($x, $y) == 'x' || $this->wasHere[$y][$x]) {
            return false;
        }
        $this->wasHere[$y][$x] = true;
        if ($this->maze->get($x, $y) != 'S' && $this->maze->get($x, $y) != 'F') {
            $this->maze->set('+', $x, $y);
        }

        $this->printOut();

        if ($x != 0 && $this->process($x - 1, $y)) {
            $this->correctPath[$y][$x] = true;
            $this->maze->set('+', $x, $y);

            return true;
        }
        if ($x != $this->maze->getColumn() - 1 && $this->process($x + 1, $y)) {
            $this->correctPath[$y][$x] = true;
            $this->maze->set('+', $x, $y);

            return true;
        }
        if ($y != 0 && $this->process($x, $y - 1)) {
            $this->correctPath[$y][$x] = true;
            $this->maze->set('+', $x, $y);

            return true;
        }
        if ($y != $this->maze->getRow() - 1 && $this->process($x, $y + 1)) {
            $this->correctPath[$y][$x] = true;
            $this->maze->set('+', $x, $y);

            return true;
        }

        $this->maze->set('x', $x, $y);

        return false;
    }

    protected function printOut()
    {
        $this->step += 1;
        echo PHP_EOL;
        echo "\033[33m==================================\033[0m".PHP_EOL;
        echo "\033[33m=\033[0m".PHP_EOL;
        echo "\033[33m=        STEP: ".$this->step."\033[0m".PHP_EOL;
        echo "\033[33m=\033[0m".PHP_EOL;
        echo "\033[33m===================================\033[0m".PHP_EOL;
        $this->maze->toString();
        echo PHP_EOL;
    }
}
