<?php
namespace MageSpices\Mage2Dark\Plugin\Model\View;

use Magento\Framework\App\Area;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class Design
{
    protected $scopeConfig;

    protected $timeZone;

    protected $themeSelectionConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        TimezoneInterface $timezone
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->timeZone = $timezone;
    }

    /**
     * @param \Magento\Theme\Model\View\Design $subject
     * @param callable $proceed
     * @param string|null $area
     * @param array $params
     * @return
     */
    public function aroundGetConfigurationDesignTheme(
        \Magento\Theme\Model\View\Design $subject,
        callable $proceed,
        $area = null,
        array $params = []
    ) {
        if (!$area) {
            $area = $subject->getArea();
        }
        if ($area == Area::AREA_ADMINHTML && $this->getThemeSelectionConfig() == "dark") {
            return "MageSpices/Mage2Dark";
        }
        return $proceed($area, $params);
    }

    protected function getThemeSelectionConfig()
    {
        if (!$this->themeSelectionConfig) {
            $this->themeSelectionConfig = $this->scopeConfig->getValue('mage2dark/settings/theme_selection');
            if ($this->themeSelectionConfig == "auto") {
                $currentHour = $this->timeZone->date()->format("H");
                if (($currentHour >= 19 || $currentHour < 7)) {
                    $this->themeSelectionConfig = "dark";
                } else {
                    $this->themeSelectionConfig = "light";
                }
            }
        }
        return $this->themeSelectionConfig;
    }
}