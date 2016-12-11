<?php

namespace Ainars\HtmlTable;

class Row
{

    /**
     * @var Cell[]
     */
    protected $_cells = [];

	/**
	 * @param Cell $cell
	 * @return Row
	 */
    public function addCell(Cell $cell)
    {
        $this->_cells[] = $cell;
        return $this;
    }

	/**
	 * @return int
	 */
    public function countCells()
    {
        return count($this->_cells);
    }

	/**
	 * @return boolean
	 */
    public function isHeadingRow()
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
    public function getCells()
    {
        return $this->_cells;
    }

    /**
     * @param int $nr
     * @return Cell
     */
    public function getCell($nr = 0)
    {
        if (isset($this->_cells[$nr])) {
            return $this->_cells[$nr];
        }
    }

	/**
	 * @return Row
	 */
    public function makeHeading()
    {
        foreach ($this->_cells as $cell) {
            $cell->setIsHeading(true);
        }
        return $this;
    }

	/**
	 * @param string $searchPhrase
	 * @return array of cells with given search phrase
	 */
	public function searchExact($searchPhrase)
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
