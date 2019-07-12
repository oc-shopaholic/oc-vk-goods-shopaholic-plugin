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

    /**
     * Extend fields model
     * @param \Backend\Widgets\Form $obWidget
     */
    protected function extendFields($obWidget)
    {
        $this->addField($obWidget);
    }

    /**
     * Remove fields model
     * @param \Backend\Widgets\Form $obWidget
     */
    protected function addField($obWidget)
    {
        $arFields = [
            'section_vkontakte_01' => [
                'label' => 'lovata.vkontakteshopaholic::lang.field.section_vkontakte',
                'type'  => 'section',
                'span'  => 'left',
                'tab'   => 'lovata.toolbox::lang.tab.settings',
            ],
            'active_vk' => [
                'label' => 'lovata.vkontakteshopaholic::lang.field.active_vk',
                'type' => 'checkbox',
                'span' => 'left',
                'required' => false,
                'tab' => 'lovata.toolbox::lang.tab.settings',
            ],
        ];

        $sCodeModelForImages = VkontakteSettings::getValue('code_model_for_images', '');

        if (!empty($sCodeModelForImages) && $sCodeModelForImages == VkontakteSettings::CODE_PRODUCT) {
            $arFields['section_vkontakte_02'] = [
                'label' => 'lovata.vkontakteshopaholic::lang.field.section_vkontakte',
                'type'  => 'section',
                'span'  => 'left',
                'tab'   => 'lovata.toolbox::lang.tab.images',
            ];
            $arFields['preview_image_vkontakte'] = [
                'label'     => 'lovata.toolbox::lang.field.preview_image',
                'type'      => 'fileupload',
                'span'      => 'left',
                'required'  => true,
                'mode'      => 'image',
                'tab'       => 'lovata.toolbox::lang.tab.images',
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
}
