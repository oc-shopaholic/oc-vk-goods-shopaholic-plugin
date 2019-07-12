<?php namespace Lovata\VKontakteShopaholic\Classes\Event\Category;

use Lovata\Shopaholic\Models\Category;
use Lovata\VkontakteShopaholic\Classes\Helper\VkApi;

/**
 * Class CategoryModelHandler
 *
 * @package Lovata\VKontakteShopaholic\Classes\Event\Category
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class CategoryModelHandler
{
    /**
     * @param \Illuminate\Events\Dispatcher $obEvent
     */
    public function subscribe($obEvent)
    {
        $this->extendModel();
    }

    /**
     * Extend Model object
     */
    protected function extendModel()
    {
        Category::extend(function ($obCategory) {
            /** @var Category $obCategory */
            $obCategory->addDynamicMethod('getVkCategoryIdListOptions', function () {

                $obVkApi = new VkApi();
                $arResponseData = $obVkApi->marketGetCategories();

                $arCategoryList = array_get($arResponseData, 'response.items', []);

                if (empty($arCategoryList) || !is_array($arCategoryList)) {
                    return [];
                }

                $arCategoryList = array_column($arCategoryList, 'name', 'id');

                return $arCategoryList;
            });
        });
    }
}
