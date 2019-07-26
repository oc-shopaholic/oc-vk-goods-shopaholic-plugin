<?php namespace Lovata\VkGoodsShopaholic\Classes\Helper;

use Event;
use Queue;
use System\Models\File;

use Lovata\Shopaholic\Models\Product;
use Lovata\Shopaholic\Classes\Collection\ProductCollection;

use Lovata\VkGoodsShopaholic\Models\VkGoodsSettings;
use Lovata\VkGoodsShopaholic\Classes\Queue\VkApiQueue;

/**
 * Class ExportCatalogHelper
 *
 * @package Lovata\VkGoodsShopaholic\Classes\Helper
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class ExportCatalogHelper
{
    const EVENT_VKGOODS_PRODUCT_DATA = 'shopaholic.vkgoods.market.offer.data';

    /**
     * @var array
     */
    protected $arConfig = [];

    /**
     * Generate
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function run()
    {
        $this->initDeleteProductListData();
        $this->initCreateOrUpdateProductListData();
    }

    /**
     * Send
     * @param array  $arData
     * @param string $sMethod
     * @throws
     */
    protected function send($arData, $sMethod)
    {
        if (empty($arData) || empty($sMethod)) {
            return;
        }

        $bQueueOn = VkGoodsSettings::getValue('queue_on', false);
        $sQueueName = VkGoodsSettings::getValue('queue_name', '');

        if ($bQueueOn) {
            $arQueueData = [
                'data'   => $arData,
                'method' => $sMethod,
            ];

            if (!empty($sQueueName)) {
                Queue::pushOn($sQueueName, VkApiQueue::class, $arQueueData);
            } else {
                Queue::push(VkApiQueue::class, $arQueueData);
            }
        } else {
            $obRequestToApi = new RequestToApi();
            $obRequestToApi->generate($arData, $sMethod);
        }
    }

    /**
     * Init create or update product list data
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function initCreateOrUpdateProductListData()
    {
        $arActiveVKProductList = (array) Product::activeVK()->lists('id');
        $obProductList = ProductCollection::make()->active()->intersect($arActiveVKProductList);
        if ($obProductList->isEmpty()) {
            return;
        }

        foreach ($obProductList as $obProductItem) {
            $this->initProductData($obProductItem);
        }
    }

    /**
     * Init delete product list data
     * @throws
     */
    protected function initDeleteProductListData()
    {
        $obProductList = Product::select(['id', 'external_vk_id'])->notActiveVK()->isNotEmptyExternalVkId()->get();
        if ($obProductList->isEmpty()) {
            return;
        }

        /** @var Product $obProduct */
        foreach ($obProductList as $obProduct) {
            $arProduct = [
                'id'             => $obProduct->id,
                'external_vk_id' => $obProduct->external_vk_id,
            ];

            $this->send($arProduct, RequestToApi::METHOD_DELETE);
        }
    }

    /**
     * Init product data
     *
     * @param \Lovata\Shopaholic\Classes\Item\ProductItem $obProductItem
     * @throws
     */
    protected function initProductData($obProductItem)
    {
        if ($obProductItem->category->isEmpty() || $obProductItem->offer->isEmpty()) {
            return;
        }

        /** @var \Lovata\Shopaholic\Classes\Item\OfferItem $obOfferItem */
        $obOfferItem = $obProductItem->offer->first();

        $arProductData = [
            'id'            => $obProductItem->id,
            'name'          => $obProductItem->name,
            'description'   => $obProductItem->preview_text,
            'price'         => $obOfferItem->price_value,
            'url'           => $obProductItem->getPageUrl(),
            'preview_image' => $this->getProductPreviewImagePath($obOfferItem, $obProductItem),
            'images'        => $this->getProductImagesPath($obOfferItem, $obProductItem),
            'category_id'   => $obProductItem->category->category_vk_id,
            'item_id'       => $obProductItem->external_vk_id,
            'deleted'       => $obOfferItem->quantity == 0,
        ];

        $arEventData = Event::fire(self::EVENT_VKGOODS_PRODUCT_DATA, [$arProductData]);
        if (!empty($arEventData)) {
            foreach ($arEventData as $arEventProductData) {
                if (empty($arEventProductData) || !is_array($arEventProductData)) {
                    continue;
                }

                $arProductData = array_merge($arProductData, $arEventProductData);
            }
        }

        $this->send($arProductData, RequestToApi::METHOD_CREATE_OR_UPDATE);
    }

    /**
     * Get product preview image path
     *
     * @param \Lovata\Shopaholic\Classes\Item\OfferItem   $obOfferItem
     * @param \Lovata\Shopaholic\Classes\Item\ProductItem $obProductItem
     *
     * @return File|null
     */
    protected function getProductPreviewImagePath($obOfferItem, $obProductItem)
    {
        $sCodeModelForImages = VkGoodsSettings::getValue('code_model_for_images');
        if (empty($sCodeModelForImages)) {
            return null;
        }

        if (VkGoodsSettings::CODE_PRODUCT == $sCodeModelForImages) {
            $obItem = $obProductItem;
        } else {
            $obItem = $obOfferItem;
        }

        if (empty($obItem->preview_image_vk_goods)) {
            return null;
        }

        return $obItem->preview_image_vk_goods->getLocalPath();
    }

    /**
     * Get product images path
     *
     * @param \Lovata\Shopaholic\Classes\Item\OfferItem   $obOfferItem
     * @param \Lovata\Shopaholic\Classes\Item\ProductItem $obProductItem
     *
     * @return array
     */
    protected function getProductImagesPath($obOfferItem, $obProductItem)
    {
        $arResult = [];
        $sCodeModelForImages = VkGoodsSettings::getValue('code_model_for_images');
        if (empty($sCodeModelForImages)) {
            return $arResult;
        }

        if (VkGoodsSettings::CODE_PRODUCT == $sCodeModelForImages) {
            $obItem = $obProductItem;
        } else {
            $obItem = $obOfferItem;
        }

        if (empty($obItem->images_vk_goods)) {
            return $arResult;
        }

        /** @var File $obImage */
        foreach ($obItem->images_vk_goods as $obImage) {
            $arResult[] = $obImage->getLocalPath();
        }

        return $arResult;
    }
}
