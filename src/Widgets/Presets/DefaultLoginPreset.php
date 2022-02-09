<?php

namespace Ceres\Widgets\Presets;

use Ceres\Widgets\Helper\PresetHelper;
use IO\Extensions\Constants\ShopUrls;
use IO\Helper\RouteConfig;
use Plenty\Modules\ShopBuilder\Contracts\ContentPreset;
use Plenty\Plugin\Translation\Translator;

/**
 * Class DefaultLoginPreset
 *
 * This is a preset for ShopBuilder contents. Presets can be applied during content creation to generate a default content with predefined and configured widgets.
 * This particular preset generates a page for signing in customers. It contains:
 * - TwoColumnWidget
 * - InlineTextWidget
 * - LoginWidget
 * - GuestLoginWidget
 * - LinkWidget
 *
 * @package Ceres\Widgets\Presets
 */
class DefaultLoginPreset implements ContentPreset
{
    /** @var PresetHelper */
    private $preset;

    /** @var PresetHelper */
    private $twoColumnWidget;

    /** @var ShopUrls */
    private $shopUrls;

    /** @var Translator */
    private $translator;
    
    /**
     * @inheritDoc
     */
    public function getWidgets(): array
    {
        $this->preset = pluginApp(PresetHelper::class);
        $this->translator = pluginApp(Translator::class);
        $this->shopUrls = pluginApp(ShopUrls::class);

        $this->createTwoColumnWidget();

        $this->createTextWidgetLogin();
        $this->createLoginWidget();
        $this->createTextWidgetGuest();
        $this->createGuestLoginWidget();
        $this->createTextWidgetRegister();
        $this->createRegisterLinkWidget();

        return $this->preset->toArray();
    }

    private function createTwoColumnWidget(): void
    {
        $this->twoColumnWidget = $this->preset->createWidget('Ceres::TwoColumnWidget')
            ->withSetting('customClass', 'px-lg-5 mx-xl-5 my-5')
            ->withSetting('layout', 'oneToOne')
            ->withSetting('layoutTablet', 'oneToOne')
            ->withSetting('layoutMobile', 'stackedMobile');
    }

    private function createTextWidgetLogin(): void
    {
        $this->twoColumnWidget->createChild('first', 'Ceres::InlineTextWidget')
            ->withSetting('customClass', 'mr-0 mr-md-3')
            ->withSetting('text', '<h2>{{ trans("Ceres::Template.login") }}</h2>')
            ->withSetting('appearance', 'none')
            ->withSetting('spacing.customPadding', true)
            ->withSetting('spacing.padding.top.value', 0)
            ->withSetting('spacing.padding.top.unit', null)
            ->withSetting('spacing.padding.bottom.value', 0)
            ->withSetting('spacing.padding.bottom.unit', null)
            ->withSetting('spacing.padding.left.value', 0)
            ->withSetting('spacing.padding.left.unit', null)
            ->withSetting('spacing.padding.right.value', 0)
            ->withSetting('spacing.padding.right.unit', null)
            ->withSetting('spacing.customMargin', true)
            ->withSetting('spacing.margin.top.value', 4)
            ->withSetting('spacing.margin.top.unit', null)
            ->withSetting('spacing.margin.bottom.value', 0)
            ->withSetting('spacing.margin.bottom.unit', null);
    }

    private function createLoginWidget(): void
    {
        $this->twoColumnWidget->createChild('first', 'Ceres::LoginWidget')
            ->withSetting('customClass', 'widget-dark mr-0 mr-md-3')
            ->withSetting('spacing.customMargin', true)
            ->withSetting('spacing.margin.top.value', 3)
            ->withSetting('spacing.margin.top.unit', null)
            ->withSetting('spacing.margin.bottom.value', 4)
            ->withSetting('spacing.margin.bottom.unit', null);
    }

    private function createTextWidgetGuest(): void
    {
        $this->twoColumnWidget->createChild('second', 'Ceres::InlineTextWidget')
            ->withSetting('customClass', 'ml-0 ml-md-3')
            ->withSetting('text', '<h2>{{ trans("Ceres::Template.loginOrderAsGuest") }}</h2>')
            ->withSetting('appearance', 'none')
            ->withSetting('spacing.customPadding', true)
            ->withSetting('spacing.padding.top.value', 0)
            ->withSetting('spacing.padding.top.unit', null)
            ->withSetting('spacing.padding.bottom.value', 0)
            ->withSetting('spacing.padding.bottom.unit', null)
            ->withSetting('spacing.padding.left.value', 0)
            ->withSetting('spacing.padding.left.unit', null)
            ->withSetting('spacing.padding.right.value', 0)
            ->withSetting('spacing.padding.right.unit', null)
            ->withSetting('spacing.customMargin', true)
            ->withSetting('spacing.margin.top.value', 4)
            ->withSetting('spacing.margin.top.unit', null)
            ->withSetting('spacing.margin.bottom.value', 0)
            ->withSetting('spacing.margin.bottom.unit', null);
    }

    private function createGuestLoginWidget(): void
    {
        $this->twoColumnWidget->createChild('second', 'Ceres::GuestLoginWidget')
            ->withSetting('customClass', 'widget-dark ml-0 ml-md-3')
            ->withSetting('spacing.customMargin', true)
            ->withSetting('spacing.margin.top.value', 3)
            ->withSetting('spacing.margin.top.unit', null);
    }

    private function createTextWidgetRegister(): void
    {
        $this->twoColumnWidget->createChild('first', 'Ceres::InlineTextWidget')
            ->withSetting('customClass', 'text-right mr-0 mr-md-3')
            ->withSetting('text', '<h5>{{ trans("Ceres::Template.loginCallToAction") }}</h5>')
            ->withSetting('appearance', 'none')
            ->withSetting('spacing.customPadding', true)
            ->withSetting('spacing.padding.top.value', 0)
            ->withSetting('spacing.padding.top.unit', null)
            ->withSetting('spacing.padding.bottom.value', 0)
            ->withSetting('spacing.padding.bottom.unit', null)
            ->withSetting('spacing.padding.left.value', 0)
            ->withSetting('spacing.padding.left.unit', null)
            ->withSetting('spacing.padding.right.value', 0)
            ->withSetting('spacing.padding.right.unit', null)
            ->withSetting('spacing.customMargin', true)
            ->withSetting('spacing.margin.top.value', 3)
            ->withSetting('spacing.margin.top.unit', null)
            ->withSetting('spacing.margin.bottom.value', 0)
            ->withSetting('spacing.margin.bottom.unit', null);
    }

    private function createRegisterLinkWidget(): void
    {
        $registerLinkWidget = $this->twoColumnWidget->createChild('first', 'Ceres::LinkWidget')
            ->withSetting('customClass', 'widget-dark text-right mr-0 mr-md-3')
            ->withSetting('block', 'true')
            ->withSetting('spacing.customMargin', true)
            ->withSetting('spacing.margin.bottom.value', 4)
            ->withSetting('spacing.margin.bottom.unit', null)
            ->withSetting('text', $this->translator->trans('Ceres::Template.loginRegister'));

        if (in_array(RouteConfig::REGISTER, RouteConfig::getEnabledRoutes())
            && RouteConfig::getCategoryId(RouteConfig::REGISTER) > 0
            && !$this->shopUrls->equals($this->shopUrls->registration, '/register')) {
            $registerLinkWidget->withSetting('url.type', 'category')
                ->withSetting('url.value', RouteConfig::getCategoryId(RouteConfig::REGISTER));
        } else {
            $registerLinkWidget->withSetting('url.type', 'external')
                ->withSetting('url.value', $this->shopUrls->registration);
        }
    }
}
