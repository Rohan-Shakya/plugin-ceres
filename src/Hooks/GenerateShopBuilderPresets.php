<?php

namespace Ceres\Hooks;

use Plenty\Plugin\Log\Loggable;

/**
 * Class UploadFavicon
 *
 * Upload the favicon from the plugin configuration to the internal webstore.
 * This is required to make the favicon available at the frontend domain instead of the cdn domain.
 *
 * @package Ceres\Hooks
 */
class GenerateShopBuilderPresets
{
    use Loggable;
    public function handle()
    {
        $this->getLogger(__CLASS__)->error(
            'Ceres::Wizard.tableUpdated',
            'test'
        );
    }

}
