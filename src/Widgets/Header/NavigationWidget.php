<?php

namespace Ceres\Widgets\Header;

use Ceres\Widgets\Helper\BaseWidget;
use Ceres\Widgets\Helper\Factories\Settings\ValueListFactory;
use Ceres\Widgets\Helper\Factories\WidgetSettingsFactory;
use Ceres\Widgets\Helper\WidgetCategories;
use Ceres\Widgets\Helper\Factories\WidgetDataFactory;
use Ceres\Widgets\Helper\WidgetTypes;

class NavigationWidget extends BaseWidget
{
    protected $template = "Ceres::Widgets.Header.NavigationWidget";

    public function getData()
    {
        return WidgetDataFactory::make("Ceres::NavigationWidget")
            ->withLabel("Widget.navigationLabel")
            ->withPreviewImageUrl("/images/widgets/navigation.svg")
            ->withType(WidgetTypes::HEADER)
            ->withCategory(WidgetCategories::HEADER)
            ->withPosition(0)
            ->toArray();
    }

    public function getSettings()
    {
        /** @var WidgetSettingsFactory $settingsFactory */
        $settingsFactory = pluginApp(WidgetSettingsFactory::class);

        $settingsFactory->createCustomClass();

        $settingsFactory->createCheckbox("isFixed")
            ->withName("Widget.navigationIsFixedLabel")
            ->withDefaultValue(true);

        $settingsFactory->createSelect("navigationStyle")
            ->withName("Widget.navigationNavigationStyleLabel")
            ->withTooltip("Widget.navigationNavigationStyleTooltip")
            ->withDefaultValue("normal")
            ->withListBoxValues(
                ValueListFactory::make()
                    ->addEntry("normal", "Widget.navigationNavigationStyleNormal")
                    ->addEntry("megaMenu", "Widget.navigationNavigationStyleMegaMenu")
                    ->toArray()
            );

        $settingsFactory->createSelect("megaMenuLevels")
            ->withName("Widget.navigationMegaMenuLevelsLabel")
            ->withTooltip("Widget.navigationMegaMenuLevelsTooltip")
            ->withDefaultValue(2)
            ->withCondition("navigationStyle === 'megaMenu'")
            ->withListBoxValues(
                ValueListFactory::make()
                    ->addEntry(2, "Widget.navigationMegaMenuLevels2")
                    ->addEntry(3, "Widget.navigationMegaMenuLevels3")
                    ->addEntry(4, "Widget.navigationMegaMenuLevels4")
                    ->toArray()
            );

        $maxItemsContainer = $settingsFactory->createVerticalContainer("megaMenuMaxItems")
            ->withName("Widget.navigationMegaMenuMaxItemsLabel")
            ->withCondition("navigationStyle === 'megaMenu'")
            ->children;

        $maxItemsContainer->createNumber("stage1")
            ->withName("Widget.navigationMegaMenuMaxItemsStage1Label")
            ->withTooltip("Widget.navigationMegaMenuMaxItemsStage1Tooltip")
            ->withDefaultValue(30)
            ->withCondition("megaMenuLevels >= 2");

        $maxItemsContainer->createNumber("stage2")
            ->withName("Widget.navigationMegaMenuMaxItemsStage2Label")
            ->withTooltip("Widget.navigationMegaMenuMaxItemsStage2Tooltip")
            ->withDefaultValue(3)
            ->withCondition("megaMenuLevels >= 3");

        $maxItemsContainer->createNumber("stage3")
            ->withName("Widget.navigationMegaMenuMaxItemsStage3Label")
            ->withTooltip("Widget.navigationMegaMenuMaxItemsStage3Tooltip")
            ->withDefaultValue(2)
            ->withCondition("megaMenuLevels >= 4");

        $settingsFactory->createFile("companyLogoUrl")
            ->withName("Widget.navigationCompanyLogoUrlLabel")
            ->withTooltip("Widget.navigationCompanyLogoUrlTooltip")
            ->withDefaultValue("");

        $settingsFactory->createSpacing();

        return $settingsFactory->toArray();
    }
}
