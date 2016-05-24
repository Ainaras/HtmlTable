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
            foreach ($row->getCols() as $colNo => $cell) {

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
     */
    public function print2Console(Table $table)
    {
        $cellLength = 15;

        echo "Table: " . $table->countCols() . 'x' . $table->countRows() . PHP_EOL;

        foreach ($table->getRows() as $row) {
            if ($row->isHeadingRow()) {
                echo str_repeat('-', $cellLength * $row->countCols()) . PHP_EOL;
            }

            foreach ($row->getCols() as $no => $col) {
                if ($no) {
                    echo "\t";
                }
                echo str_pad(substr($col->getContentAsPlainText(), 0, $cellLength - 1), $cellLength);
            }

            echo PHP_EOL;
            if ($row->isHeadingRow()) {
                echo str_repeat('-', $cellLength * $row->countCols()) . PHP_EOL;
            }
        }

        echo PHP_EOL;
        echo PHP_EOL;
    }

}
