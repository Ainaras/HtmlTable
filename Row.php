<?php

namespace Ainars\HtmlTable;

class Row
{

    /**
     * @var Cell[]
     */
    protected $_cells = [];

    public function addCell(Cell $cell)
    {
        $this->_cells[] = $cell;
        return $this;
    }

    public function countCols()
    {
        return count($this->_cells);
    }

    public function isHeadingRow()
    {
        $hasHeading = true;
        foreach ($this->_cells as $col) {
            if (!$col->isHeading()) {
                $hasHeading = false;
                break;
            }
        }

        return $hasHeading;
    }

    public function getCols()
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

    public function makeHeading()
    {
        foreach ($this->_cells as $col) {
            $col->setIsHeading(true);
        }
        return $this;
    }


	/**
	 * @param string $searchPhrase
	 * @return array of cells with given search phrase
	 */
	public function searchExact($searchPhrase) {

		$found = [];
		foreach ($this->getCols() as $col) {
			if ($searchPhrase === $col->getContent()) {
				$found[] = $col;
			}
		}
		return $found;
	}

}
