<?php

namespace Ceres\Widgets\Presets;

use Ceres\Config\CeresConfig;
use Ceres\Widgets\Helper\Factories\PresetWidgetFactory;
use Ceres\Widgets\Helper\PresetHelper;
use Ceres\Widgets\Presets\Helper\HasWhiteBackground;
use Plenty\Modules\ShopBuilder\Contracts\ContentPreset;

/**
 * Class DefaultCheckoutPreset
 *
 * This is a preset for ShopBuilder contents. Presets can be applied during content creation to generate a default content with predefined and configured widgets.
 * This particular preset generates a page for viewing and interacting with the checkout. It contains:
 * - TwoColumnWidget
 * - BackgroundWidget
 * - AddressWidget
 * - ShippingProfileWidget
 * - PaymentProviderWidget
 * - ContactWishWidget
 * - ShippingPrivacyCheckWidget
 * - GtcCheckWidget
 * - BasketWidget
 * - BasketTotalsWidget
 * - CouponWidget
 * - PlaceOrderWidget
 * - CancelPaymentWidget
 *
 * @package Ceres\Widgets\Presets
 */
class DefaultCheckoutPreset implements ContentPreset
{
    use HasWhiteBackground;

    /** @var PresetHelper */
    private $preset;

    /** @var CeresConfig */
    private $ceresConfig;
    
    /**
     * @inheritDoc
     */
    public function getWidgets()
    {
        $this->preset = pluginApp(PresetHelper::class);
        $this->ceresConfig = pluginApp(CeresConfig::class);

        $this->createHeadline();

        $twoColumnWidget = $this->preset->createWidget('Ceres::TwoColumnWidget')
            ->withSetting('layout', 'sevenToFive');

        $this->createLeftSide($twoColumnWidget);
        $this->createRightSide($twoColumnWidget);

        $this->createAsterisk();

        return $this->preset->toArray();
    }

    //======================================
    // LEFT SIDE
    //======================================

    /**
     * @param PresetWidgetFactory $twoColumnWidget
     */
    private function createLeftSide($twoColumnWidget)
    {
        $bgContainer = $twoColumnWidget->createChild('first', 'Ceres::BackgroundWidget');
        $bgContainer->withSetting("customClass", "pr-0 pr-lg-3");

        $this->createAddressWidget('1', $bgContainer);
        $this->createAddressWidget('2', $bgContainer);
        $this->createShippingProfileWidget($bgContainer);
        $this->createPaymentProviderWidget($bgContainer);
        $this->createContactWishWidget($bgContainer);
        $this->createShippingPrivacyCheckWidget($bgContainer);
        $this->createGtcCheckWidget($bgContainer);
    }

    /**
     * @param string $type
     * @param PresetWidgetFactory $bgContainer
     */
    private function createAddressWidget($type, $bgContainer)
    {
        $addressWidget = $bgContainer->createChild('background', 'Ceres::AddressWidget');
        
        $addressWidget
        ->withSetting('addressType', $type)
        ->withSetting('customClass', 'widget-transparent');

        if ($type == '1') {
            $addressWidget
                ->withSetting('addressFieldsInvoiceDE', $this->ceresConfig->addresses->billingAddressShow)
                ->withSetting('addressRequiredFieldsInvoiceDE', $this->ceresConfig->addresses->billingAddressRequire)
                ->withSetting('addressFieldsInvoiceGB', $this->ceresConfig->addresses->billingAddressShow_en)
                ->withSetting(
                    'addressRequiredFieldsInvoiceGB',
                    $this->ceresConfig->addresses->billingAddressRequire_en
                );
        } elseif ($type == '2') {
            $addressWidget
                ->withSetting('addressFieldsShippingDE', $this->ceresConfig->addresses->deliveryAddressShow)
                ->withSetting('addressRequiredFieldsShippingDE', $this->ceresConfig->addresses->deliveryAddressRequire)
                ->withSetting('addressFieldsShippingGB', $this->ceresConfig->addresses->deliveryAddressShow_en)
                ->withSetting(
                    'addressRequiredFieldsShippingGB',
                    $this->ceresConfig->addresses->deliveryAddressRequire_en
                );
        }
    }

    /**
     * @param PresetWidgetFactory $bgContainer
     */
    private function createShippingProfileWidget($bgContainer)
    {
        $bgContainer->createChild('background', 'Ceres::ShippingProfileWidget')
            ->withSetting('hintText', '');
    }

    /**
     * @param PresetWidgetFactory $bgContainer
     */
    private function createPaymentProviderWidget($bgContainer)
    {
        $bgContainer->createChild('background', 'Ceres::PaymentProviderWidget')
            ->withSetting('hintText', '');
    }

    /**
     * @param PresetWidgetFactory $bgContainer
     */
    private function createContactWishWidget($bgContainer)
    {
        $bgContainer->createChild('background', 'Ceres::ContactWishWidget')
            ->withSetting('hintText', '');
    }

    /**
     * @param PresetWidgetFactory $bgContainer
     */
    private function createShippingPrivacyCheckWidget($bgContainer)
    {
        $bgContainer->createChild('background', 'Ceres::ShippingPrivacyCheckWidget');
    }

    /**
     * @param PresetWidgetFactory $bgContainer
     */
    private function createGtcCheckWidget($bgContainer)
    {
        $bgContainer->createChild('background', 'Ceres::GtcCheckWidget')
            ->withSetting('isPreselected', false)
            ->withSetting('isRequired', true);
    }

    //======================================
    // RIGHT SIDE
    //======================================

    /**
     * @param PresetWidgetFactory $twoColumnWidget
     */
    private function createRightSide($twoColumnWidget)
    {
        $bgContainer = $twoColumnWidget->createChild('second', 'Ceres::BackgroundWidget');
        $bgContainer->withSetting('customClass', 'pl-0 pl-lg-3 h-100 bg-white');

        $this->createBasketWidget($bgContainer);

        $stickyContainer = $bgContainer->createChild('background', 'Ceres::StickyContainerWidget');
        $this->createBasketTotalsWidget($stickyContainer);
        $this->createCouponWidget($stickyContainer);
        $this->createPlaceOrderWidget($stickyContainer);
        $this->createCancelPaymentWidget($stickyContainer);
    }

    /**
     * @param PresetWidgetFactory $bgContainer
     */
    private function createBasketWidget($bgContainer)
    {
        $bgContainer->createChild('background', 'Ceres::InlineTextWidget')
            ->withSetting('text', '<h3>{{ trans("Ceres::Template.checkoutBasket") }}</h3>')
            ->withSetting("appearance", "none")
            ->withSetting("spacing.customPadding", true)
            ->withSetting("spacing.padding.top.value", 0)
            ->withSetting("spacing.padding.top.unit", null)
            ->withSetting("spacing.padding.bottom.value", 0)
            ->withSetting("spacing.padding.bottom.unit", null)
            ->withSetting("spacing.padding.left.value", 0)
            ->withSetting("spacing.padding.left.unit", null)
            ->withSetting("spacing.padding.right.value", 0)
            ->withSetting("spacing.padding.right.unit", null);

        $bgContainer->createChild('background', 'Ceres::BasketWidget')
            ->withSetting('appearance', 'primary')
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.bottom.value", 3)
            ->withSetting("spacing.margin.bottom.unit", null)
            ->withSetting('basketDetailsData', ['']);

    }

    /**
     * @param PresetWidgetFactory $bgContainer
     */
    private function createCouponWidget($bgContainer)
    {
        $bgContainer->createChild('background', 'Ceres::CouponWidget')
            ->withSetting('customClass', 'widget-dark')
            ->withSetting('appearance', 'primary');
    }

    /**
     * @param PresetWidgetFactory $stickyContainer
     */
    private function createBasketTotalsWidget($stickyContainer)
    {
        $stickyContainer->createChild('sticky', 'Ceres::BasketTotalsWidget')
            ->withSetting(
                'visibleFields',
                [
                    "basketValueNet",
                    "basketValueGross",
                    "rebate",
                    "shippingCostsNet",
                    "shippingCostsGross",
                    "promotionCoupon",
                    "totalSumNet",
                    "vats",
                    "additionalCosts",
                    "totalSumGross",
                    "salesCoupon",
                    "openAmount"
                ]
            );
    }


    /**
     * @param PresetWidgetFactory $stickyContainer
     */
    private function createPlaceOrderWidget($stickyContainer)
    {
        $stickyContainer->createChild('sticky', 'Ceres::PlaceOrderWidget');
    }

    /**
     * @param PresetWidgetFactory $stickyContainer
     */
    private function createCancelPaymentWidget($stickyContainer)
    {
        $stickyContainer->createChild('sticky', 'Ceres::CancelPaymentWidget')
            ->withSetting('appearance', 'primary');
    }

    /**
     * @param PresetWidgetFactory $bgContainer
     */
    private function createAsterisk()
    {
        $text = '*)&nbsp;{{ trans("Ceres::Template.contactRequiredField") }}';
        $this->preset->createWidget('Ceres::InlineTextWidget')
            ->withSetting("text", $text)
            ->withSetting("appearance", "none")
            ->withSetting("customPadding", true)
            ->withSetting("padding.top.value", 2)
            ->withSetting("padding.top.unit", null)
            ->withSetting("padding.bottom.value", 2)
            ->withSetting("padding.bottom.unit", null)
            ->withSetting("customMargin", true)
            ->withSetting("margin.bottom.value", 0)
            ->withSetting("margin.bottom.unit", null);
    }

    private function createHeadline()
    {
        $text = '';
        $text .= '{% set overrideCheckoutHeadline = LayoutContainer.show("Ceres::Checkout.Headline") %}';
        $text .= '{% if overrideCheckoutHeadline | trim is empty %}';
        $text .= '<h1 class="h2">';
        $text .= '{% if not checkout.readOnly %}';
        $text .= '{{ trans("Ceres::Template.checkout") }}';
        $text .= '{% else %}';
        $text .= '{{ trans("Ceres::Template.checkoutCheckOrder") }}';
        $text .= '{% endif %}';
        $text .= '</h1>';
        $text .= '{% else %}';
        $text .= '{{ overrideCheckoutHeadline }}';
        $text .= '{% endif %}';

        $this->preset->createWidget('Ceres::InlineTextWidget')
            ->withSetting("text", $text)
            ->withSetting("appearance", "none")
            ->withSetting("spacing.customPadding", true)
            ->withSetting("spacing.padding.right.value", 0)
            ->withSetting("spacing.padding.right.unit", null)
            ->withSetting("spacing.padding.left.value", 0)
            ->withSetting("spacing.padding.left.unit", null)
            ->withSetting("spacing.customMargin", true)
            ->withSetting("spacing.margin.top.value", 5)
            ->withSetting("spacing.margin.top.unit", null);
    }
}
