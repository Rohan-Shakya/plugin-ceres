export const exceptionMap = new Map(
    [
        ["0", "errorActionIsNotExecuted"],
        ["1", "notificationsItemNotAdded"],
        ["2", "notificationsNotEnoughStockItem"],
        ["3", "notificationsInvalidResetPasswordUrl"],
        ["4", "notificationsCheckPassword"],
        ["5", "notificationsItemBundleSplitted"],
        ["6", "notificationsItemOutOfStock"],
        ["7", "newsletterOptOutSuccessMessage"],
        ["8", "newsletterOptInMessage"],
        ["9", "notificationsBasketItemsRemoved"],
        ["10", "notificationsBasketItemsRemovedForLanguage"],
        ["11", "notificationsNoEmailEntered"],
        ["12", "notificationsWarningOverselling"],
        ["13", "consentReCaptchaCookieNotSet"],
        ["14", "notificationsBasketItemsRemovedForCurrency"],
        ["15", "notificationsBasketItemsRemovedForShippingCountry"],
        ["110", "errorBasketItemVariationNotFound"],
        ["111", "errorBasketItemNotEnoughStockForVariation"],
        ["112", "errorBasketItemMaximumQuantityReachedForItem"],
        ["113", "errorBasketItemMaximumQuantityReachedForVariation"],
        ["114", "errorBasketItemMinimumQuantityNotReachedForVariation"],
        ["115", "errorCreateOrderRetryTimeNotReached"],
        ["210", "errorVatService"],
        ["211", "errorVatNumberValidation"],
        ["212", "errorVatServiceFallback"],
        ["301", "notificationRemoveCouponMinimumOrderValueIsNotReached"],
        ["302", "couponNoMatchingItemInBasket"],
        ["401", "notificationsCalculateShippingFailed"],
        ["501", "couponPromotionRequired"],
        ["502", "errorGiftCardReturnQuantity"],
        ["1018", "couponMinOrderValueNotReached"],
        ["1051", "couponnotUsableForSpecialOffer"],
        ["1070", "couponAlreadyUsedOrInvalidCouponCode"],
        ["1078", "couponCampaignExpired"],
        ["1126", "couponNoMatchingItemInBasket"],
        ["1329", "couponOnlySubscription"],
        ["1330", "couponOnlySingleUsage"],
        ["1331", "couponNoOpenAmount"],
        ["1332", "couponExpired"],
        ["1334", "couponOnlyForNewCustomers"],
        ["1335", "couponOnlyForExistingCustomers"],
        ["1336", "couponWrongCustomerGroup"],
        ["1337", "couponWrongCustomerType"],
        ["1338", "couponNoCustomerTypeProvided"],
        ["1339", "couponNoCustomerTypeActivated"],
        ["1340", "couponNoCustomerGroupActivated"],
        ["1341", "couponCampaignNoWebstoreActivated"],
        ["1342", "couponCampaignWrongWebstoreId"],
        ["1343", "couponCampaignNoWebstoreIdGiven"],
        ["1400", "csrfTokenMismatch"],
        ["1401", "accessKeyMailSent"],
        ["1402", "accessKeyMailFailed"]
    ]
);

export default exceptionMap;

