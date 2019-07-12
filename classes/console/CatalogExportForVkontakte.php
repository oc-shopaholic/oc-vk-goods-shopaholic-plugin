<?php namespace Lovata\VKontakteShopaholic\Classes\Console;

use Illuminate\Console\Command;
use Lovata\VKontakteShopaholic\Classes\Helper\DataCollection;

/**
 * Class CatalogExportForVkontakte
 *
 * @package Lovata\VKontakteShopaholic\Classes\Console
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class CatalogExportForVkontakte extends Command
{
    /**
     * @var string command name.
     */
    protected $name = 'shopaholic:catalog_export_to_vkontakte';

    /**
     * @var string The console command description.
     */
    protected $description = 'Run catalog export to Vkontakte';

    /**
     * Execute the console command.
     * @throws \Throwable
     */
    public function handle()
    {
        $obDataCollection = new DataCollection();
        $obDataCollection->generate();
    }
}
