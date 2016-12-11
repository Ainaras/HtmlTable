<?php

namespace Ainars\HtmlTable;

class Manager
{

    /**
     * Removes rowspan and colspan
     *
     * @param Table $table
     * @return Table normalized Table
     */
    public function normalize(Table $table)
    {
        $maxCountCells = $table->countCols();
        $normalizedTable = $this->buildEmptyTable($table->countRows(), $maxCountCells);

        foreach ($table->getRows() as $rowNo => $row) {
            foreach ($row->getCells() as $colNo => $cell) {

                for ($i = $colNo; $i < $maxCountCells; $i++) {

                    if (!$normalizedTable->getRow($rowNo)->getCell($i)->isEmpty()) {
                        continue;
                    }

                    $normalizedTable
                            ->getRow($rowNo)
                            ->getCell($i)
                            ->setContent($cell->getContent());
                    if ($cell->getRowspan() > 1) {
                        for ($u = 1; $u < $cell->getRowspan(); $u++) {
                            $normalizedTable
                                    ->getRow($rowNo + $u)
                                    ->getCell($i)
                                    ->setContent($cell->getContent());
                        }
                    }
                    if ($cell->getColspan() > 1) {
                        for ($u = 1; $u < $cell->getColspan(); $u++) {
                            $normalizedTable
                                    ->getRow($rowNo)
                                    ->getCell($i + $u)
                                    ->setContent($cell->getContent());
                        }
                    }
                    break;
                }
            }
        }

        return $normalizedTable;
    }

    /**
     * @param int $rows
     * @param int $cols
     * @return \Ainars\HtmlTable\Table
     */
    public function buildEmptyTable($rows = 1, $cols = 1)
    {
        $table = new Table();
        for ($i = 0; $i < $rows; $i++) {
            $table->addRow(new Row);
            for ($j = 0; $j < $cols; $j++) {
                $table->getRow($i)->addCell(new Cell);
            }
        }

        return $table;
    }

    /**
     * @todo make print colspan and rowspan
     * @param \Ainars\HtmlTable\Table $table
     * @param int $cellLength
     */
    public function print2Console(Table $table, $cellLength = 15)
    {
        $cellLength = (int)$cellLength;
        $caption = $table->getCaption();
		if ($caption) {
			echo '<<' . $caption . '>>' . PHP_EOL;
		}

        echo 'Table: ' . $table->countCols() . 'x' . $table->countRows() . PHP_EOL;

        foreach ($table->getRows() as $row) {
            if ($row->isHeadingRow()) {
                echo str_repeat('-', $cellLength * $row->countCells()) . PHP_EOL;
            }

            foreach ($row->getCells() as $no => $col) {
                if ($no) {
                    echo "\t";
                }
                echo str_pad(substr($col->getContentAsPlainText(), 0, $cellLength - 1), $cellLength);
            }

            echo PHP_EOL;
            if ($row->isHeadingRow()) {
                echo str_repeat('-', $cellLength * $row->countCells()) . PHP_EOL;
            }
        }

        echo PHP_EOL;
        echo PHP_EOL;
    }

	/**
	 * @param \Ainars\HtmlTable\Table $table
	 * @return array
	 */
	public function toAssocArray(Table $table) {

		$normalizedTable = $this->normalize($table);

		$assocArray = [];

		$firstRow = $normalizedTable->getRow();

		if ($firstRow) {
			$i = 1;
			while ($row = $normalizedTable->getRow($i++)) {
				$assocArray[] = $this->_rowToAssocArray($row, $firstRow);
			}
		}

		return $assocArray;
	}

	/**
	 * @param \Ainars\HtmlTable\Row $row
	 * @param \Ainars\HtmlTable\Row $headingRow
	 * @return array
	 */
	protected function _rowToAssocArray(Row $row, Row $headingRow) {
		$assocItem = [];
		foreach ($row->getCells() as $key => $cell) {
			$assocKey = $headingRow->getCell($key)->getContentAsPlainText();
			$assocItem[$assocKey] = $cell->getContent();
		}
		return $assocItem;
	}

}
