<?php
namespace MageSpices\Mage2Dark\Plugin\Model\View;

use Magento\Framework\App\Area;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class Design
{
    const BASE_CONFIG_PATH = "mage2dark/settings/";

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
     * @param string|null $area
     * @param $result
     * @return string
     */
    public function afterGetConfigurationDesignTheme(
        \Magento\Theme\Model\View\Design $subject,
        $result,
        $area = null
    ) {
        if (!$area) {
            $area = $subject->getArea();
        }
        if ($area == Area::AREA_ADMINHTML && $this->getThemeSelectionConfig() == "dark") {
            return "MageSpices/Mage2Dark";
        }
        return $result;
    }

    protected function getThemeSelectionConfig()
    {
        if (!$this->themeSelectionConfig) {
            $this->themeSelectionConfig = $this->getConfig('theme_selection');
            if ($this->themeSelectionConfig == "auto") {
                $currentDate = $this->timeZone->date();
                $currentTime = ($currentDate->format("H")*60)+$currentDate->format("i");
                $lightThemeStartTime = $this->getConfig("light_theme_time_from");
                $lightThemeEndTime = $this->getConfig("light_theme_time_to");
                if ($currentTime >= $lightThemeStartTime && $currentTime <= $lightThemeEndTime) {
                    $this->themeSelectionConfig = "light";
                } else {
                    $this->themeSelectionConfig = "dark";
                }
            }
        }
        return $this->themeSelectionConfig;
    }

    protected function getConfig($path)
    {
        return $this->scopeConfig->getValue(self::BASE_CONFIG_PATH.$path);
    }
}