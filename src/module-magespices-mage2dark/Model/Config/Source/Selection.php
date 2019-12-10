<?php
namespace MageSpices\Mage2Dark\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Selection implements  OptionSourceInterface
{
    public function toOptionArray()
    {
        return [
            [
                "value" => "auto",
                "label" => __("Auto")
            ],
            [
                "value" => "dark",
                "label" => __("Dark")
            ],
            [
                "value" => "light",
                "label" => __("Light")
            ]
        ];
    }
}