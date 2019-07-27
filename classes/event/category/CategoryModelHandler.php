<?php namespace Lovata\VkGoodsShopaholic\Classes\Event\Category;

use Lovata\Shopaholic\Models\Category;

/**
 * Class CategoryModelHandler
 *
 * @package Lovata\VkGoodsShopaholic\Classes\Event\Category
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class CategoryModelHandler
{
    /**
     * Added event listeners
     */
    public function subscribe()
    {
        Category::extend(function ($obCategory) {
            /** @var Category $obCategory */
            $obCategory->fillable[] = 'category_vk_id';

            $obCategory->addCachedField(['category_vk_id']);
        });
    }
}
