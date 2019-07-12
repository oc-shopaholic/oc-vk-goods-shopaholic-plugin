<?php namespace Lovata\VkontakteShopaholic;

use Event;
use System\Classes\PluginBase;

// Command
use Lovata\VKontakteShopaholic\Classes\Console\CatalogExportForVkontakte;

// Offer event
use Lovata\VKontakteShopaholic\Classes\Event\Offer\ExtendOfferFieldsHandler;
use Lovata\VKontakteShopaholic\Classes\Event\Offer\OfferModelHandler;
// Product event
use Lovata\VKontakteShopaholic\Classes\Event\Product\ExtendProductFieldsHandler;
use Lovata\VKontakteShopaholic\Classes\Event\Product\ProductModelHandler;
// Category event
use Lovata\VKontakteShopaholic\Classes\Event\Category\CategoryModelHandler;
use Lovata\VKontakteShopaholic\Classes\Event\Category\ExtendCategoryFieldsHandler;

/**
 * Class Plugin
 *
 * @package Lovata\VkontakteShopaholic
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
                'label'       => 'lovata.vkontakteshopaholic::lang.menu.vkontaktesettings',
                'description' => '',
                'category'    => 'lovata.shopaholic::lang.tab.settings',
                'icon'        => 'icon-upload',
                'class'       => 'Lovata\VKontakteShopaholic\Models\VkontakteSettings',
                'permissions' => ['shopaholic-menu-vkontakte-export'],
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
        $this->registerConsoleCommand('shopaholic:catalog_export_to_vkontakte', CatalogExportForVkontakte::class);
    }

    /**
     * @return array
     */
    public function registerReportWidgets()
    {
        return [
            'Lovata\VKontakteShopaholic\Widgets\ExportToXML' => [
                'label' => 'lovata.vkontakteshopaholic::lang.widget.export_catalog_to_api_for_vkontakte',
            ],
        ];
    }
}
