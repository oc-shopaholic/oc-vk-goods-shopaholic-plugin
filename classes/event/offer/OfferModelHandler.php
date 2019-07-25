<?php namespace Lovata\VkGoodsShopaholic\Classes\Event\Offer;

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
            $obOffer->fillable[] = 'preview_image_vkontakte';
            $obOffer->fillable[] = 'images_vkontakte';

            $obOffer->attachOne['preview_image_vkontakte'] = 'System\Models\File';
            $obOffer->attachMany['images_vkontakte']       = 'System\Models\File';

            $obOffer->addCachedField(['preview_image_vkontakte', 'images_vkontakte']);
        });
    }
}
