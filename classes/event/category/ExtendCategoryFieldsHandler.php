<?php namespace Lovata\VkGoodsShopaholic\Classes\Event\Category;

use Lovata\Toolbox\Classes\Event\AbstractBackendFieldHandler;

use Lovata\Shopaholic\Models\Category;
use Lovata\Shopaholic\Controllers\Categories;
use Lovata\VkGoodsShopaholic\Classes\Helper\VkApi;

/**
 * Class ExtendCategoryFieldsHandler
 *
 * @package Lovata\VkGoodsShopaholic\Classes\Event\Category
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class ExtendCategoryFieldsHandler extends AbstractBackendFieldHandler
{
    /**
     * Extend fields model
     * @param \Backend\Widgets\Form $obWidget
     */
    protected function extendFields($obWidget)
    {
        $obWidget->addTabFields([
            'category_vk_id' => [
                'label'       => 'lovata.vkgoodsshopaholic::lang.field.category_vk_id',
                'type'        => 'dropdown',
                'span'        => 'left',
                'required'    => '0',
                'showSearch'  => 'true',
                'options'     => array_merge([0 => 'lovata.toolbox::lang.field.empty'], $this->getVkCategoryIdListOptions()),
                'tab'         => 'lovata.toolbox::lang.tab.settings',
            ],
        ]);
    }

    /**
     * Get categories frim VK API
     */
    protected function getVkCategoryIdListOptions()
    {
        $obVkApi = new VkApi();
        $arResponseData = $obVkApi->marketGetCategories();

        $arCategoryList = array_get($arResponseData, 'response.items', []);

        if (empty($arCategoryList) || !is_array($arCategoryList)) {
            return [];
        }

        $arCategoryList = array_column($arCategoryList, 'name', 'id');

        return $arCategoryList;
    }

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
}
