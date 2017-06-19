<?php

namespace Task;

/**
 * Class Maze: Maze is the class which keeps all coordinates for each objects
 * @package Task
 * @author Alihuseyn Gulmammadov <alihuseyn13@gmail.com>
 * @date 19.06.2017 11:30
 */
class Maze
{
    /**
     * @var array : keep parsed input as multiple array
     */
    private $grid;
    private $row;
    private $column;


    /**
     * Maze constructor.
     * @param int $row : default = 3
     * @param int $column : default = 3
     */
    public function __construct($row = 3, $column = 3)
    {
        $this->row = $row;
        $this->column = $column;
    }

    /**
     * Update function always should be called to check whether the generated multiple $grid array
     * is in the required format or not and also update $row and $column again for parsed content.
     * fgets read with whitespace and can cause wrong $column and $row size. Due to that calling this function
     * after parse operation finished (Look srs/Parse.php)
     */
    public function update()
    {
        $this->updateColumnRow();
        $this->checkColumnSizeSame();
    }

    /**
     * Update $row and $column according to size of grid
     */
    protected function updateColumnRow()
    {
        $this->setRow(count($this->grid))->setColumn(count($this->grid[0]));
    }

    /**
     * Check whether the given input or grid in rectangle form. And if the difference
     * seen then the error will be thrown.
     * @throws \Exception
     */
    protected function checkColumnSizeSame()
    {
        foreach ($this->grid as $column) {
            if (count($column) != $this->column) {
                throw new \Exception('The columns for each row is not same');
            }
        }
    }

    /**
     * Set row and return class itself.
     * @param $row
     * @return $this
     */
    public function setRow($row)
    {
        $this->row = $row;

        return $this;
    }

    /**
     * Set column and return class itself
     * @param $column
     * @return $this
     */
    public function setColumn($column)
    {
        $this->column = $column;

        return $this;
    }

    /**
     * Return row
     * @return int
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * Return column
     * @return int
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * Set object on the grid for given x and y coordinates
     * @param $type - type of the object can be [+,x,#,G,S,.]
     * @param $x
     * @param $y
     */
    public function set($type, $x, $y)
    {
        $this->grid[$y][$x] = $type;
    }

    /**
     * Return the object type for given coordinates from grid 2D array.
     * @param $x
     * @param $y
     * @return string
     */
    public function get($x, $y)
    {
        return $this->grid[$y][$x];
    }

    /**
     * Print out grid. If the color code is given then show colored in command line
     * @param null $color
     */
    public function toString($color = null)
    {
        // check for color exists or not
        // If the color exists then start color code
        if (!is_null($color)) {
            echo "\033[{$color}m";
        }
        // Walk over grid and print object type
        for ($i = 0; $i < $this->row; $i += 1) {
            for ($j = 0; $j < $this->column; $j += 1) {
                $object = $this->grid[$i][$j];
                $object = !is_null($object) ? $object : '';
                echo "{$object} ";
            }
            echo PHP_EOL;
        }
        // check for color exists or not
        // If the color exists then end color code for this print-out
        if (!is_null($color)) {
            echo "\033[0m";
        }
    }
}
