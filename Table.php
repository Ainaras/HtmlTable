<?php

namespace Ainars\HtmlTable;

class Table
{

    protected string $_caption = '';

    protected string $_class = '';

    /**
     * @var Row[]
     */
    protected array $_rows = [];

    public function setCaption(string $caption): Table
    {
        $this->_caption = $caption;
        return $this;
    }

    public function setClass(string $class): Table
    {
        $this->_class = $class;
        return $this;
    }

    public function addRow(Row $row): void
    {
        $this->_rows[] = $row;
    }

    public function countRows(): int
    {
        return count($this->_rows);
    }

    public function countCols(): int
    {
        $cols = 0;

        foreach ($this->_rows as $row) {
            $cols = max($cols, $row->countCells());
        }
        return $cols;
    }

    public function getRow(int $nr = 0): Row
    {
        if (isset($this->_rows[$nr])) {
            return $this->_rows[$nr];
        }
    }

    /**
     * @return Row[]
     */
    public function getRows(): array
    {
        return $this->_rows;
    }

    public function getCaption(): string
    {
        return $this->_caption;
    }

    /**
     * @param string $searchPhrase
     * @return Cell[] of cells with given search phrase
     */
    public function searchExact(string $searchPhrase): array
    {
        $found = [];
        foreach ($this->getRows() as $r) {
            $found = array_merge($found, $r->searchExact($searchPhrase));
        }
        return $found;
    }

}
