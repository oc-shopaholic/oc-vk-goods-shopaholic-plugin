<?php namespace Lovata\VkGoodsShopaholic\Widgets;

use Flash;
use Artisan;
use Backend\Classes\ReportWidgetBase;

/**
 * Class ExportToXML
 * @package Lovata\VkGoodsShopaholic\Widgets
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class ExportToXML extends ReportWidgetBase
{
    /**
     * Render method
     * @return mixed|string
     * @throws \SystemException
     */
    public function render()
    {
        return $this->makePartial('widget');
    }

    /**
     * Generate xml for vk goods
     */
    public function onGenerateXMLForVKGoods()
    {
        Artisan::call('shopaholic:catalog_export.vk_goods');

        Flash::info(trans('lovata.vkgoodsshopaholic::lang.message.export_is_completed'));
    }
}
