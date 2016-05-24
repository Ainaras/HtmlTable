<?php

namespace Ainars\HtmlTable;

class Table
{

    /**
     * @var string
     */
    protected $_caption;

    /**
     * @var string
     */
    protected $_class;

    /**
     * @var Row[]
     */
    protected $_rows = [];

    /**
     * @param string $caption
     * @return \Ainars\HtmlTable\Table
     */
    public function setCaption($caption)
    {
        $this->_caption = $caption;
        return $this;
    }

    public function setClass($class)
    {
        $this->_class = $class;
        return $this;
    }

    public function addRow(Row $row)
    {
        $this->_rows[] = $row;
    }

    public function countRows()
    {
        return count($this->_rows);
    }

    public function countCols()
    {
        $cols = 0;

        foreach ($this->_rows as $row) {
            $cols = max($cols, $row->countCols());
        }
        return $cols;
    }

    /**
     * @param int $nr
     * @return Row
     */
    public function getRow($nr = 0)
    {
        if (isset($this->_rows[$nr])) {
            return $this->_rows[$nr];
        }
    }

    public function getRows()
    {
        return $this->_rows;
    }

}