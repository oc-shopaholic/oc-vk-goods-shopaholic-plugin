<?php namespace Lovata\VkGoodsShopaholic\Classes\Console;

use Illuminate\Console\Command;
use Lovata\VkGoodsShopaholic\Classes\Helper\ExportCatalogHelper;

/**
 * Class CatalogExportForVKGoods
 *
 * @package Lovata\VkGoodsShopaholic\Classes\Console
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class CatalogExportForVKGoods extends Command
{
    /**
     * @var string command name.
     */
    protected $name = 'shopaholic:catalog_export.vk_goods';

    /**
     * @var string The console command description.
     */
    protected $description = 'Run catalog export to VK Goods';

    /**
     * Execute the console command.
     * @throws
     */
    public function handle()
    {
        $obDataCollection = new ExportCatalogHelper();
        $obDataCollection->run();
    }
}
