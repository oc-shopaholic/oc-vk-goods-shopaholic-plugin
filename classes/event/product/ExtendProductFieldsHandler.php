<?php namespace Lovata\VKontakteShopaholic\Classes\Event\Product;

use Lovata\Toolbox\Classes\Event\AbstractBackendFieldHandler;

use Lovata\Shopaholic\Models\Product;
use Lovata\Shopaholic\Controllers\Products;
use Lovata\VKontakteShopaholic\Models\VkontakteSettings;

/**
 * Class ExtendProductFieldsHandler
 *
 * @package Lovata\VKontakteShopaholic\Classes\Event\Product
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class ExtendProductFieldsHandler extends AbstractBackendFieldHandler
{
    /**
     * Extend fields model
     * @param \Backend\Widgets\Form $obWidget
     */
    protected function extendFields($obWidget)
    {

        $arFields = [
            'active_vk' => [
                'label' => 'lovata.vkontakteshopaholic::lang.field.active_vk',
                'type' => 'checkbox',
                'span' => 'left',
                'tab' => 'lovata.toolbox::lang.tab.settings',
            ],
        ];

        $sCodeModelForImages = VkontakteSettings::getValue('code_model_for_images', '');
        if ($sCodeModelForImages == VkontakteSettings::CODE_PRODUCT) {
            $arFields['section_vkontakte_02'] = [
                'label' => 'lovata.vkontakteshopaholic::lang.field.section_vkontakte',
                'tab'   => 'lovata.toolbox::lang.tab.images',
                'type'  => 'section',
                'span'  => 'full',
            ];
            $arFields['preview_image_vkontakte'] = [
                'label'     => 'lovata.toolbox::lang.field.preview_image',
                'tab'       => 'lovata.toolbox::lang.tab.images',
                'type'      => 'fileupload',
                'span'      => 'left',
                'required'  => true,
                'mode'      => 'image',
                'fileTypes' => 'jpeg,png',
            ];
            $arFields['images_vkontakte'] = [
                'label'     => 'lovata.toolbox::lang.field.images',
                'type'      => 'fileupload',
                'span'      => 'left',
                'required'  => false,
                'mode'      => 'image',
                'tab'       => 'lovata.toolbox::lang.tab.images',
                'fileTypes' => 'jpeg,png',
            ];
        }

        $obWidget->addTabFields($arFields);
    }

    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass() : string
    {
        return Product::class;
    }

    /**
     * Get controller class name
     * @return string
     */
    protected function getControllerClass() : string
    {
        return Products::class;
    }
}
