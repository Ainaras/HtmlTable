<?php

namespace Ainars\HtmlTable;

class Cell
{

    const IS_EMPTY = null;

	/**
	 * @var int
	 */
    protected $_colspan = 1;

	/**
	 * @var int
	 */
    protected $_rowspan = 1;

	/**
	 * @var bool
	 */
    protected $_isHeading = false;

	/**
	 * @var string
	 */
    protected $_content = self::IS_EMPTY;

	/**
	 * @var string
	 */
    protected $_class = '';

	/**
	 * @param string $class
	 * @return Cell
	 */
    public function setClass($class)
    {
        $this->_class = $class;
        return $this;
    }

	/**
	 * @return bool
	 */
    public function isEmpty()
    {
        return $this->_content === self::IS_EMPTY;
    }

	/**
	 * @param string $content
	 * @return Cell
	 */
    public function setContent($content)
    {
        $this->_content = $content;
        return $this;
    }

	/**
	 * @param int $colspan
	 * @return Cell
	 */
    public function setColspan($colspan)
    {
        $this->_colspan = (int)$colspan;
        return $this;
    }

	/**
	 * @param int $rowspan
	 * @return Cell
	 */
    public function setRowspan($rowspan)
    {
        $this->_rowspan = (int)$rowspan;
        return $this;
    }

	/**
	 * @param bool $isHeading
	 * @return Cell
	 */
    public function setIsHeading($isHeading)
    {
        $this->_isHeading = (bool)$isHeading;
        return $this;
    }

	/**
	 * @return string
	 */
    public function getContent()
    {
        return $this->_content;
    }

	/**
	 * @return string
	 */
    public function getContentAsPlainText()
    {
        return html_entity_decode(trim(strip_tags($this->_content)));
    }

	/**
	 * @return bool
	 */
    public function isHeading()
    {
        return $this->_isHeading;
    }

	/**
	 * @return int
	 */
    public function getColspan()
    {
        return $this->_colspan;
    }

	/**
	 * @return int
	 */
    public function getRowspan()
    {
        return $this->_rowspan;
    }

}
