<?php

namespace Ainars\HtmlTable;

class Cell
{

    const IS_EMPTY = null;

    protected $_colspan = 1;
    protected $_rowspan = 1;
    protected $_isHeading = false;
    protected $_content = self::IS_EMPTY;
    protected $_class = '';

    public function setClass($class)
    {
        $this->_class = $class;
        return $this;
    }

    public function isEmpty()
    {
        return $this->_content === self::IS_EMPTY;
    }

    public function setContent($content)
    {
        $this->_content = $content;
        return $this;
    }

    public function setColspan($colspan)
    {
        $this->_colspan = $colspan;
        return $this;
    }

    public function setRowspan($rowspan)
    {
        $this->_rowspan = $rowspan;
        return $this;
    }

    public function setIsHeading($isHeading)
    {
        $this->_isHeading = $isHeading;
        return $this;
    }

    public function getContent()
    {
        return $this->_content;
    }

    public function getContentAsPlainText()
    {
        return html_entity_decode(trim(strip_tags($this->_content)));
    }

    public function isHeading()
    {
        return $this->_isHeading;
    }

    public function getColspan()
    {
        return $this->_colspan;
    }

    public function getRowspan()
    {
        return $this->_rowspan;
    }

}
