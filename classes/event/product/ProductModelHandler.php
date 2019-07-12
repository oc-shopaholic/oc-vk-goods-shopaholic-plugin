<?php namespace Lovata\VkontakteShopaholic\Classes\Event\Product;

use Lovata\Shopaholic\Models\Product;

/**
 * Class ProductModelHandler
 *
 * @package Lovata\VkontakteShopaholic\Classes\Event\Product
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class ProductModelHandler
{
    /** @var Product */
    protected $obElement;

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
        Product::extend(function ($obProduct) {
            /** @var Product $obProduct */
            $obProduct->attachOne['preview_image_vkontakte'] = 'System\Models\File';
            $obProduct->attachMany['images_vkontakte']       = 'System\Models\File';

            $obProduct->addDynamicMethod('scopeActiveVK', function ($obQuery) {
                return $obQuery->where('active_vk', true);
            });

            $obProduct->addDynamicMethod('scopeNotActiveVK', function ($obQuery) {
                return $obQuery->where('active_vk', false);
            });

            $obProduct->addDynamicMethod('scopeIsNotEmptyExternalVkId', function ($obQuery) {
                return $obQuery->whereNotNull('external_vk_id');
            });
        });
    }
}
