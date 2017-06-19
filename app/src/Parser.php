<?php

namespace Task;

/**
 * Class Parser: Parse given input and convert given array to maze grid
 * @package Task
 * @author Alihuseyn Gulmammadov <alihuseyn13@gmail.com>
 * @date 19.06.2017 11:31
 */
class Parser
{
    private $container;
    private $maze;

    /**
     * @var array - initial point of start point or start point coordinates. In form of [x,y]
     */
    private $initialPoint;
    /**
     * @var array - final point of goal point or goal point coordinates. In form of [x,y]
     */
    private $finalPoint;

    /**
     * Parser constructor.
     * @param array $container
     */
    public function __construct(array $container)
    {
        $this->container = $container;
        $this->maze = new Maze();
        // Initially set to x : 0  & y : 0
        $this->initialPoint = [0, 0];
        // Initially set to x : 0  & y : 0
        $this->finalPoint = [0, 0];
    }

    /**
     * Convert $container (From input) to Maze class (Look src/Maze.php)
     */
    public function parse()
    {
        if (!is_null($this->container) && !empty($this->container)) {

            // calculate row of given input $container
            $row = count($this->container);
            // calculate column of given input $container from first string set
            $column = strlen($this->container[0]);
            // set row and column for maze which is initialized inside of constructor.
            $this->maze->setColumn($column)->setRow($row);

            for ($i = 0; $i < $row; $i += 1) {
                for ($j = 0; $j < $column; $j += 1) {
                    // get object from given input $container
                    $object = $this->container[$i][$j];
                    if (!is_null($object) || !empty($object)) {
                        // check whether start point
                        if ($object == 'S') {
                            // set initial point
                            $this->initialPoint = [$j, $i];
                        }
                        // check whether goal point
                        if ($object == 'G') {
                            // set final point
                            $this->finalPoint = [$j, $i];
                        }
                        // set parsed input on the maze with the coordinates x : $j & y : $i
                        $this->maze->set($object, $j, $i);
                    }
                }
            }
            // Update Maze Row and Column and also check whether given input content form a rectangle shape or not
            // If the objects count in each row not equal then the error will be thrown.
            $this->maze->update();
        }
    }

    /**
     * Return parsed input in Maze class format
     * @return Maze
     */
    public function getMaze()
    {
        return $this->maze;
    }

    /**
     * Return initial point or start points
     * @return array
     */
    public function getInitialPoint()
    {
        return $this->initialPoint;
    }

    /**
     * Return final point or goal points
     * @return array
     */
    public function getFinalPoint()
    {
        return $this->finalPoint;
    }
}
