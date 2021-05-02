<?php namespace Lovata\VkGoodsShopaholic\Classes\Event\Product;

use Lovata\Shopaholic\Classes\Item\ProductItem;
use Lovata\Shopaholic\Models\Product;

/**
 * Class ProductModelHandler
 *
 * @package Lovata\VkGoodsShopaholic\Classes\Event\Product
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class ProductModelHandler
{
    /**
     * Extend Product model
     */
    public function subscribe()
    {
        Product::extend(function ($obProduct) {
            /** @var Product $obProduct */
            $obProduct->fillable[] = 'preview_image_vk_goods';
            $obProduct->fillable[] = 'images_vk_goods';
            $obProduct->fillable[] = 'active_vk';
            $obProduct->fillable[] = 'external_vk_id';

            $obProduct->attachOne['preview_image_vk_goods'] = 'System\Models\File';
            $obProduct->attachMany['images_vk_goods'] = 'System\Models\File';

            $obProduct->addDynamicMethod('scopeActiveVK', function ($obQuery) {
                return $obQuery->where('active_vk', true);
            });

            $obProduct->addDynamicMethod('scopeNotActiveVK', function ($obQuery) {
                return $obQuery->where('active_vk', false);
            });

            $obProduct->addDynamicMethod('scopeIsNotEmptyExternalVkId', function ($obQuery) {
                return $obQuery->whereNotNull('external_vk_id');
            });

            $obProduct->addCachedField(['preview_image_vk_goods', 'images_vk_goods', 'active_vk', 'external_vk_id']);
        });

        ProductItem::$arQueryWith[] = 'preview_image_vk_goods';
        ProductItem::$arQueryWith[] = 'images_vk_goods';
        ProductItem::$arQueryWith[] = 'offer.preview_image_vk_goods';
        ProductItem::$arQueryWith[] = 'offer.images_vk_goods';
    }
}
