<?php namespace Lovata\VKontakteShopaholic\Classes\Event\Category;

use Lovata\Toolbox\Classes\Event\AbstractBackendFieldHandler;

use Lovata\Shopaholic\Models\Category;
use Lovata\Shopaholic\Controllers\Categories;

/**
 * Class ExtendCategoryFieldsHandler
 *
 * @package Lovata\VKontakteShopaholic\Classes\Event\Category
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class ExtendCategoryFieldsHandler extends AbstractBackendFieldHandler
{
    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass() : string
    {
        return Category::class;
    }

    /**
     * Get controller class name
     * @return string
     */
    protected function getControllerClass() : string
    {
        return Categories::class;
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
        $obWidget->addTabFields([
            'category_vk_id' => [
                'label' => 'lovata.vkontakteshopaholic::lang.field.category_vk_id',
                'type' => 'dropdown',
                'span' => 'left',
                'required' => '0',
                'showSearch' => 'true',
                'emptyOption' => 'lovata.toolbox::lang.field.empty',
                'options' => 'getVkCategoryIdListOptions',
                'tab' => 'lovata.toolbox::lang.tab.settings',
            ],
        ]);
    }
}
