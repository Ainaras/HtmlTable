<?php

namespace Ainars\HtmlTable;

class Cell
{

    const IS_EMPTY = null;

    protected int $_colspan = 1;

    protected int $_rowspan = 1;

    protected bool $_isHeading = false;

    protected ?string $_content = self::IS_EMPTY;

    protected string $_class = '';

    public function setClass(string $class): Cell
    {
        $this->_class = $class;
        return $this;
    }

    public function isEmpty(): bool
    {
        return $this->_content === self::IS_EMPTY;
    }

    public function setContent(?string $content): Cell
    {
        $this->_content = $content;
        return $this;
    }

    public function setColspan(int $colspan): Cell
    {
        $this->_colspan = (int)$colspan;
        return $this;
    }

    public function setRowspan(int $rowspan): Cell
    {
        $this->_rowspan = (int)$rowspan;
        return $this;
    }

    public function setIsHeading(bool $isHeading): Cell
    {
        $this->_isHeading = (bool)$isHeading;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->_content;
    }

    public function getContentAsPlainText(): string
    {
        return html_entity_decode(trim(strip_tags((string)$this->_content)));
    }

    public function isHeading(): string
    {
        return $this->_isHeading;
    }

    public function getColspan(): int
    {
        return $this->_colspan;
    }

    public function getRowspan(): int
    {
        return $this->_rowspan;
    }

}
