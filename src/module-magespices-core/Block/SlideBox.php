<?php

namespace MageSpices\Core\Block;

/**
 * Class SlideBox
 * @package MageSpices\Core\Block
 */
class SlideBox extends \Magento\Framework\View\Element\Template
{
    /** @var string  */
    public const XPATH_IS_ENABLED = 'mage2dark/settings/enabled';

    /**
     * @return int|null
     */
    public function isEnabled(): ?int
    {
        return (int)$this->_scopeConfig->getValue(
            self::XPATH_IS_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}