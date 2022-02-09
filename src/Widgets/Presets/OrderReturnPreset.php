<?php

namespace Ceres\Widgets\Presets;

use Ceres\Widgets\Helper\PresetHelper;
use Ceres\Widgets\Presets\Helper\HasWhiteBackground;
use Plenty\Modules\ShopBuilder\Contracts\ContentPreset;

/**
 * Class OrderReturnPreset
 *
 * This is a preset for ShopBuilder contents. Presets can be applied during content creation to generate a default content with predefined and configured widgets.
 * This particular preset generates a page for viewing the order return form. It contains:
 * - InlineTextWidget
 * - OrderReturnWidget
 *
 * @package Ceres\Widgets\Presets
 */
class OrderReturnPreset implements ContentPreset
{
    /** @var PresetHelper */
    private $preset;

    use HasWhiteBackground;

    /**
     * @inheritDoc
     */
    public function getWidgets()
    {
        $this->preset = pluginApp(PresetHelper::class);

        $this->createBackground($this->preset);

        $this->createWidget("Ceres::InlineTextWidget")
            ->withSetting("text", '<h1>{{ trans("Ceres::Template.return") }}</h1>')
            ->withSetting("appearance", "none")
            ->withSetting("customClass", "container")
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.top.value", 5)
            ->withSetting("spacing.margin.top.unit", null)
            ->withSetting("spacing.margin.bottom.value", 4)
            ->withSetting("spacing.margin.bottom.unit", null);

        $this->createWidget("Ceres::OrderReturnWidget")
            ->withSetting("appearance", "primary")
            ->withSetting("customClass", "widget-dark")
            ->withSetting("itemDetailsData", ["availability"])
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.bottom.value", 5)
            ->withSetting("spacing.margin.bottom.unit", null);

        return $this->preset->toArray();
    }
}
