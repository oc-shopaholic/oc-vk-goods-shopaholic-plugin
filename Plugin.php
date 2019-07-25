<?php namespace Lovata\VkGoodsShopaholic;

use Event;
use System\Classes\PluginBase;

// Command
use Lovata\VkGoodsShopaholic\Classes\Console\CatalogExportForVkontakte;

// Offer event
use Lovata\VkGoodsShopaholic\Classes\Event\Offer\ExtendOfferFieldsHandler;
use Lovata\VkGoodsShopaholic\Classes\Event\Offer\OfferModelHandler;
// Product event
use Lovata\VkGoodsShopaholic\Classes\Event\Product\ExtendProductFieldsHandler;
use Lovata\VkGoodsShopaholic\Classes\Event\Product\ProductModelHandler;
// Category event
use Lovata\VkGoodsShopaholic\Classes\Event\Category\CategoryModelHandler;
use Lovata\VkGoodsShopaholic\Classes\Event\Category\ExtendCategoryFieldsHandler;

/**
 * Class Plugin
 *
 * @package Lovata\VkGoodsShopaholic
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class Plugin extends PluginBase
{
    /**
     * Register settings
     * @return array
     */
    public function registerSettings()
    {
        return [
            'config' => [
                'label'       => 'lovata.vkgoodsshopaholic::lang.menu.settings',
                'description' => 'lovata.vkgoodsshopaholic::lang.menu.settings_description',
                'category'    => 'lovata.shopaholic::lang.tab.settings',
                'icon'        => 'icon-upload',
                'class'       => 'Lovata\VkGoodsShopaholic\Models\VkGoodsShopaholic',
                'permissions' => ['shopaholic-menu-vkgoodsshopaholic-export'],
                'order'       => 9000,
            ],
        ];
    }

    /**
     * Plugin boot method
     */
    public function boot()
    {
        // Product event
        Event::subscribe(ExtendProductFieldsHandler::class);
        Event::subscribe(ProductModelHandler::class);
        // Offer event
        Event::subscribe(ExtendOfferFieldsHandler::class);
        Event::subscribe(OfferModelHandler::class);
        // Category event
        Event::subscribe(CategoryModelHandler::class);
        Event::subscribe(ExtendCategoryFieldsHandler::class);
    }

    /**
     * Register artisan command
     */
    public function register()
    {
        $this->registerConsoleCommand('shopaholic:catalog_export.vkontakte', CatalogExportForVkontakte::class);
    }

    /**
     * @return array
     */
    public function registerReportWidgets()
    {
        return [
            'Lovata\VkGoodsShopaholic\Widgets\ExportToXML' => [
                'label' => 'lovata.vkgoodsshopaholic::lang.widget.export_catalog_to_api_for_vkontakte',
            ],
        ];
    }
}
