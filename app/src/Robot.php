<?php

namespace Task;

/**
 * Class Robot: The general operation is held inside this class.
 * All operation related with recursive maze algorithm applied to find out the way to goal point
 * @package Task
 * @author Alihuseyn Gulmammadov <alihuseyn13@gmail.com>
 * @date 19.06.2017 11:31
 */
class Robot
{
    /**
     * Start point coordinates
     * @var array - [x,y]
     */
    private $initialPoint;
    /**
     * End point coordinates
     * @var array - [x,y]
     */
    private $finalPoint;

    /**
     * Generated maze object (Look src/Maze.php)
     * @var Maze
     */
    private $maze;

    /**
     * Keep the step id and show each time step count
     * @var int
     */
    private $step = 0;

    /**
     * Determine whether operation is finished with success or failed
     * @var bool
     */
    private $success = false;

    /**
     * Determine for robot whether it passed over this coordinate or not
     * @var array - 2D array
     */
    private $wasHere;

    /**
     * Collect correct path coordinates
     * @var array - 2D array
     */
    private $correctPath;

    /**
     * Robot constructor.
     * @param array $initialPoint
     * @param array $finalPoint
     * @param Maze $maze
     */
    public function __construct(array $initialPoint, array $finalPoint, Maze $maze)
    {
        $this->initialPoint = $initialPoint;
        $this->finalPoint = $finalPoint;
        $this->maze = $maze;

        // Initialize wasHere and correctPath with filling boolean false
        $this->wasHere = array_fill(0, $this->maze->getRow(), (array_fill(0, $this->maze->getColumn(), false)));
        $this->correctPath = array_fill(0, $this->maze->getRow(), (array_fill(0, $this->maze->getColumn(), false)));
    }

    /**
     * Start calculation process for correct path and trigger recursive algorithm
     */
    public function start()
    {
        // trigger recursive function
        $this->process($this->initialPoint[0], $this->initialPoint[1]);
        // if the result success then print out success
        // else print out fail message
        if ($this->success) {
            echo "-\nSuccessfully Finished!\n-".PHP_EOL;
            $this->maze->toString(32);
        } else {
            echo "-\nFailed :(!\n-".PHP_EOL;
            $this->maze->toString(31);
        }
    }

    /**
     * Get initial coordinates and start calculation over maze to
     * find out possible way to goal point
     * @param $x
     * @param $y
     * @return bool
     */
    protected function process($x, $y)
    {
        // If the current given coordinates is final point then means
        // the challenge is finalized and return true and set success true
        if ($x == $this->finalPoint[0] && $y == $this->finalPoint[1]) {
            $this->success = true;

            return true;
        }

        // If the current given coordinates is obstacle or un-correct way  or the current part is visited
        // then return false
        if ($this->maze->get($x, $y) == '#' || $this->maze->get($x, $y) == 'x' || $this->wasHere[$y][$x]) {
            return false;
        }
        // else set wasHere parameter
        $this->wasHere[$y][$x] = true;
        // if the current coordinates not equal to start and final points then set + for correct path choice
        if ($this->maze->get($x, $y) != 'S' && $this->maze->get($x, $y) != 'G') {
            $this->maze->set('+', $x, $y);
        }

        // print out current form of maze with detailed information
        $this->printOut();

        // start search for left side with calling itself recursively
        if ($x != 0 && $this->process($x - 1, $y)) {
            // set correct path for correct choice
            $this->correctPath[$y][$x] = true;
            $this->maze->set('+', $x, $y);

            return true;
        }
        // start search for right side with calling itself recursively
        if ($x != $this->maze->getColumn() - 1 && $this->process($x + 1, $y)) {
            // set correct path for correct choice
            $this->correctPath[$y][$x] = true;
            $this->maze->set('+', $x, $y);

            return true;
        }
        // start search for up side with calling itself recursively
        if ($y != 0 && $this->process($x, $y - 1)) {
            // set correct path for correct choice
            $this->correctPath[$y][$x] = true;
            $this->maze->set('+', $x, $y);

            return true;
        }
        // start search for down side with calling itself recursively
        if ($y != $this->maze->getRow() - 1 && $this->process($x, $y + 1)) {
            // set correct path for correct choice
            $this->correctPath[$y][$x] = true;
            $this->maze->set('+', $x, $y);

            return true;
        }

        $this->maze->set('x', $x, $y);

        return false;
    }

    /**
     * Print out step information and maze current format
     * The color code is used to print out colored output
     */
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
