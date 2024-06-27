<?php

namespace Ainars\HtmlTable;

class Row
{

    /**
     * @var Cell[]
     */
    protected array $_cells = [];

    public function addCell(Cell $cell): Row
    {
        $this->_cells[] = $cell;
        return $this;
    }

    public function countCells(): int
    {
        return count($this->_cells);
    }

    public function isHeadingRow(): bool
    {
        $hasHeading = true;
        foreach ($this->_cells as $cell) {
            if (!$cell->isHeading()) {
                $hasHeading = false;
                break;
            }
        }

        return $hasHeading;
    }

    /**
     * @return Cell[]
     */
    public function getCells(): array
    {
        return $this->_cells;
    }

    public function getCell(int $nr = 0): ?Cell
    {
        if (isset($this->_cells[$nr])) {
            return $this->_cells[$nr];
        }
        return null;
    }

    public function makeHeading(): Row
    {
        foreach ($this->_cells as $cell) {
            $cell->setIsHeading(true);
        }
        return $this;
    }

    /**
     * @param string $searchPhrase
     * @return Cell[] array of cells with given search phrase
     */
    public function searchExact(string $searchPhrase): array
    {
        $found = [];
        foreach ($this->getCells() as $cell) {
            if ($searchPhrase === $cell->getContentAsPlainText()) {
                $found[] = $cell;
            }
        }
        return $found;
    }

}
