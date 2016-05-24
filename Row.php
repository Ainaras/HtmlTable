<?php

namespace Ainars\HtmlTable;

class Row
{

    /**
     * @var Cell[]
     */
    protected $_cols = [];

    public function addCell(Cell $cell)
    {
        $this->_cols[] = $cell;
        return $this;
    }

    public function countCols()
    {
        return count($this->_cols);
    }

    public function isHeadingRow()
    {
        $hasHeading = true;
        foreach ($this->_cols as $col) {
            if (!$col->isHeading()) {
                $hasHeading = false;
                break;
            }
        }

        return $hasHeading;
    }

    public function getCols()
    {
        return $this->_cols;
    }

    /**
     * @param int $nr
     * @return Cell
     */
    public function getCell($nr = 0)
    {
        if (isset($this->_cols[$nr])) {
            return $this->_cols[$nr];
        }
    }

    public function makeHeading()
    {
        foreach ($this->_cols as $col) {
            $col->setIsHeading(true);
        }
        return $this;
    }

}
