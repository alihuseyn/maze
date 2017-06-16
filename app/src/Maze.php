<?php

namespace Task;

class Maze
{
    private $grid;
    private $row;
    private $column;

    public function __construct($row = 3, $column = 3)
    {
        $this->row = $row;
        $this->column = $column;
    }

    public function update()
    {
        $this->updateColumnRow();
        $this->checkColumnSizeSame();
    }

    protected function updateColumnRow()
    {
        $this->setRow(count($this->grid))->setColumn(count($this->grid[0]));
    }

    protected function checkColumnSizeSame()
    {
        foreach ($this->grid as $column) {
            if (count($column) != $this->column) {
                throw new \Exception('The columns for each row is not same');
            }
        }
    }

    public function setRow($row)
    {
        $this->row = $row;

        return $this;
    }

    public function setColumn($column)
    {
        $this->column = $column;

        return $this;
    }

    public function getRow()
    {
        return $this->row;
    }

    public function getColumn()
    {
        return $this->column;
    }

    public function set($type, $x, $y)
    {
        $this->grid[$y][$x] = $type;
    }

    public function get($x, $y)
    {
        return $this->grid[$y][$x];
    }

    public function toString($color = null)
    {
        if (!is_null($color)) {
            echo "\033[{$color}m";
        }
        for ($i = 0; $i < $this->row; $i += 1) {
            for ($j = 0; $j < $this->column; $j += 1) {
                $object = $this->grid[$i][$j];
                $object = !is_null($object) ? $object : '';
                echo "{$object} ";
            }
            echo PHP_EOL;
        }
        if (!is_null($color)) {
            echo "\033[0m";
        }
    }
}
