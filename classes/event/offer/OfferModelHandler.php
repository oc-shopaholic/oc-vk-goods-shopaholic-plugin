<?php namespace Lovata\VkGoodsShopaholic\Classes\Event\Offer;

use Lovata\Shopaholic\Classes\Item\OfferItem;
use Lovata\Shopaholic\Models\Offer;

/**
 * Class OfferModelHandler
 *
 * @package Lovata\VkGoodsShopaholic\Classes\Event\Offer
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class OfferModelHandler
{
    /**
     * Added event listeners
     */
    public function subscribe()
    {
        Offer::extend(function ($obOffer) {
            /** @var Offer $obOffer */
            $obOffer->fillable[] = 'preview_image_vk_goods';
            $obOffer->fillable[] = 'images_vk_goods';

            $obOffer->attachOne['preview_image_vk_goods'] = 'System\Models\File';
            $obOffer->attachMany['images_vk_goods']       = 'System\Models\File';

            $obOffer->addCachedField(['preview_image_vk_goods', 'images_vk_goods']);
        });

        OfferItem::$arQueryWith[] = 'preview_image_vk_goods';
        OfferItem::$arQueryWith[] = 'images_vk_goods';
    }
}
