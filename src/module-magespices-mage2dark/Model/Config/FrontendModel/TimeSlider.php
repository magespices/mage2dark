<?php
namespace MageSpices\Mage2Dark\Model\Config\FrontendModel;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Exception\LocalizedException;

class TimeSlider extends Field
{

    /**
     * Retrieve element HTML markup
     *
     * @param AbstractElement $element
     * @return string
     * @throws LocalizedException
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $renderer = $this->getLayout()->createBlock(
            \MageSpices\Mage2Dark\Block\Adminhtml\Config\TimeSlider::class
        );
        $renderer->setElement($element);

        return $renderer->toHtml();
    }
}