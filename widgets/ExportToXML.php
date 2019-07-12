<?php namespace Lovata\VKontakteShopaholic\Widgets;

use Flash;
use Artisan;
use Backend\Classes\ReportWidgetBase;

/**
 * Class ExportToXML
 * @package Lovata\VKontakteShopaholic\Widgets
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
     * Generate xml for vkontakte
     */
    public function onGenerateXMLForVkontakte()
    {
        Artisan::call('shopaholic:catalog_export_to_vkontakte');
        Flash::info(trans('lovata.vkontakteshopaholic::lang.message.export_is_complete'));
    }
}
