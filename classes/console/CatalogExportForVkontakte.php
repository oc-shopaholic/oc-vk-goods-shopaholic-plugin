<?php namespace Lovata\VkGoodsShopaholic\Classes\Console;

use Illuminate\Console\Command;
use Lovata\VkGoodsShopaholic\Classes\Helper\ExportCatalogHelper;

/**
 * Class CatalogExportForVkontakte
 *
 * @package Lovata\VkGoodsShopaholic\Classes\Console
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class CatalogExportForVkontakte extends Command
{
    /**
     * @var string command name.
     */
    protected $name = 'shopaholic:catalog_export.vkontakte';

    /**
     * @var string The console command description.
     */
    protected $description = 'Run catalog export to Vkontakte';

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
