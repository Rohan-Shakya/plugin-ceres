<?php

namespace Ceres\Widgets\Presets;

use Ceres\Config\CeresConfig;
use Ceres\Widgets\Helper\PresetHelper;
use IO\Extensions\Filters\PatternFilter;
use IO\Services\CategoryService;
use Plenty\Modules\ShopBuilder\Contracts\ContentPreset;
use Plenty\Modules\Category\Models\Category;
use Plenty\Plugin\Translation\Translator;

/**
 * Class DefaultFooterPreset
 *
 * This is a preset for ShopBuilder contents. Presets can be applied during content creation to generate a default content with predefined and configured widgets.
 * This particular preset generates a default footer. It contains:
 * - ThreeColumnWidget / TwoColumnWidget
 * - BackgroundWidget
 * - SeparatorWidget
 * - ListWidget
 * - LinkListWidget
 * - FourColumnWidget
 * - LegalInformationWidget
 * - CodeWidget
 * - CookieBarWidget
 *
 * @package Ceres\Widgets\Presets
 */
class DefaultFooterPreset implements ContentPreset
{
    /** @var PresetHelper $preset */
    private $preset;

    /** @var CeresConfig $config */
    private $config;

    /** @var PatternFilter $patternFilter */
    private $patternFilter;

    /** @var CategoryService $categoryService */
    private $categoryService;

    /** @var Translator $translator */
    private $translator;

    private $gridDropzoneNames = [
        1 => 'first',
        2 => 'second',
        3 => 'third',
        4 => 'fourth'
    ];

    /**
     * @inheritDoc
     */
    public function getWidgets()
    {
        $this->config = pluginApp(CeresConfig::class);
        $this->preset = pluginApp(PresetHelper::class);
        $this->patternFilter = pluginApp(PatternFilter::class);
        $this->categoryService = pluginApp(CategoryService::class);
        $this->translator = pluginApp(Translator::class);


        $row = $this->preset->createWidget('Ceres::TwoColumnWidget')
            ->withSetting('customClass', 'mb-3 d-flex text-center')
            ->withSetting('layout', 'stacked')
            ->withSetting('layoutTablet', 'stackedTablet')
            ->withSetting('layoutMobile', 'stackedMobile');

        $this->createLinkListWidget($row);
        $this->createTextWidget($row);
        $this->createCookieBar();

        return $this->preset->toArray();
    }

    private function createLinkListWidget($row)
    {
        $numberOfCols = $this->config->footer->numberOfCols;

        $configuredCategories = [
            1 => $this->config->footer->col1Categories,
            2 => $this->config->footer->col2Categories,
            3 => $this->config->footer->col3Categories
        ];

        $linkListGridPreset = $row->createChild('first', 'Ceres::FourColumnWidget');

        for ($i = 1; $i <= $numberOfCols && $i <= 3; $i++) {
            $columnTitleTranslation = $this->translator->trans('Ceres::Template.footerColumnTitle' . $i);
            $linkListPreset = $linkListGridPreset->createChild($this->gridDropzoneNames[$i], 'Ceres::LinkListWidget')
                ->withSetting('customClass', 'd-block d-lg-inline-block text-left')
                ->withSetting('title', $columnTitleTranslation)
                ->withSetting('icon', 'none');

            $categoryIds = $this->patternFilter->findPattern($configuredCategories[$i], '[0-9]+');
            $entries = [];
            foreach ($categoryIds as $key => $categoryId) {
                $category = $this->categoryService->get($categoryId);

                if ($category instanceof Category && $category->details[0] !== null) {
                    $categoryName = $category->details[0]->name;
                    $categoryUrl = $this->categoryService->getURL($category);

                    $entries[] = [
                        'text' => $categoryName,
                        'url' => $categoryUrl
                    ];
                }
            }

            $linkListPreset->withSetting('entries', $entries);
            $linkListPreset->withSetting('centered', false);
        }
    }

    private function createTextWidget($row)
    {
        $defaultText = '
            <div class="text-center align-self-center mb-2">
                <a href="https://www.instagram.com/plentysystems" target="_blank" class="fa fa-lg fa-instagram pl-2 px-1"></a>
                <a href="https://www.facebook.com/plentymarkets/" target="_blank" class="fa fa-lg fa-facebook-f pl-2 px-1"></a>
                <a href="https://twitter.com/plentymarkets" target="_blank" class="fa fa-lg fa-twitter pl-2 px-1"></a>
            </div>
            <div class="copyright text-center">
                <!--<a class="d-inline-block mb-2" rel="nofollow" href="https://www.plentymarkets.eu">
                    <img alt="Plentymarkets GmbH Logo" class="svg plenty-brand" src="{{ plugin_path("Ceres") }}/images/plentymarkets-logo.svg" rel="nofollow">
                </a>-->
                <small class="d-block">&copy; Copyright {{ "now" | date("Y") }} | {{ trans("Ceres::Template.footerAllRightsReserved") }}</small>
            </div>
        ';

        $row->createChild('second', 'Ceres::CodeWidget')
            ->withSetting('appearance', 'none')
            ->withSetting('text', $defaultText);
    }

    private function createCookieBar()
    {
        $this->preset->createWidget('Ceres::CookieBarWidget')
            ->withSetting('customClass', 'widget-dark')
            ->withSetting('appearance', 'primary')
            ->withSetting('buttonOrder', '1-2-3')
            ->withSetting('showRejectAll', false);
    }
}
