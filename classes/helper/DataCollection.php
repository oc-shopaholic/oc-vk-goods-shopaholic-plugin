<?php namespace Lovata\VkontakteShopaholic\Classes\Helper;

use Event;
use Lovata\Shopaholic\Models\Offer;
use Queue;
use Lovata\Shopaholic\Classes\Item\ProductItem;
use Lovata\Shopaholic\Models\Product;
use Lovata\VkontakteShopaholic\Models\VkontakteSettings as Config;
use Lovata\VkontakteShopaholic\Classes\Queue\VkApiQueue;
use System\Models\File;

/**
 * Class DataCollection
 *
 * @package Lovata\VkontakteShopaholic\Classes\Helper
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class DataCollection
{
    const EVENT_VKONTAKTE_PRODUCT_DATA = 'shopaholic.vkontakte.market.offer.data';

    /**
     * @var array
     */
    protected $arConfig = [];

    /**
     * Generate
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function generate()
    {
        $this->initDeleteProductListData();
        $this->initCreateOrUpdateProductListData();
    }

    /**
     * Send
     * @param array $arData
     * @param string $sMethod
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function send($arData, $sMethod)
    {
        if (empty($arData) || empty($sMethod)) {
            return;
        }

        $bQueueOn   = Config::getValue('queue_on', false);
        $sQueueName = Config::getValue('queue_name', '');

        if ($bQueueOn && !empty($sQueueName)) {
            $arQueueData = [
                'data'   => $arData,
                'method' => $sMethod,
            ];

            Queue::pushOn($sQueueName, VkApiQueue::class, $arQueueData);
        } else {
            $obGenerate = new Generate();
            $obGenerate->generate($arData, $sMethod);
        }
    }

    /**
     * Init create or update product list data
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function initCreateOrUpdateProductListData()
    {
        $obProductList = Product::active()->activeVK()->get();

        if ($obProductList->isEmpty()) {
            return;
        }

        /** @var Product $obProduct */
        foreach ($obProductList as $obProduct) {
            $this->initProductData($obProduct);
        }
    }

    /**
     * Init delete product list data
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function initDeleteProductListData()
    {
        $obProductList = Product::notActiveVK()->isNotEmptyExternalVkId()->get();


        if ($obProductList->isEmpty()) {
            return;
        }

        /** @var Product $obProduct */
        foreach ($obProductList as $obProduct) {
            $arProduct = [
                'id'             => $obProduct->id,
                'external_vk_id' => $obProduct->external_vk_id,
            ];

            $this->send($arProduct, Generate::METHOD_DELETE);
        }
    }

    /**
     * Init product data
     *
     * @param Product $obProduct
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function initProductData($obProduct)
    {
        if (empty($obProduct) || empty($obProduct->category) || empty($obProduct->offer)) {
            return;
        }

        /**
         * @var Offer $obOffer
         */
        $obOffer        = $obProduct->offer->first();
        $obProductItem = ProductItem::make($obProduct->id);

        $arProduct = [
            'id'            => $obProduct->id,
            'name'          => $obProduct->name,
            'description'   => $obProduct->preview_text,
            'price'         => $obOffer->price_value,
            'url'           => $obProductItem->getPageUrl(),
            'preview_image' => $this->getProductPreviewImagePath($obOffer, $obProduct),
            'images'        => $this->getProductImagesPath($obOffer, $obProduct),
            'category_id'   => $obProduct->category->category_vk_id,
            'item_id'       => $obProduct->external_vk_id,
            'deleted'       => $obOffer->quantity == 0,
        ];

        $arEventProductData = Event::fire(self::EVENT_VKONTAKTE_PRODUCT_DATA, [$arProduct], true);

        if (!empty($arEventProductData) && is_array($arEventProductData)) {
            $arProduct = $arEventProductData;
        }

        $this->send($arProduct, Generate::METHOD_CREATE_OR_UPDATE);
    }

    /**
     * Get product preview image path
     *
     * @param Offer $obOffer
     * @param Product $obProduct
     *
     * @return File|null
     */
    protected function getProductPreviewImagePath($obOffer, $obProduct)
    {
        $sCodeModelForImages = Config::getValue('code_model_for_images');

        if (empty($sCodeModelForImages) || Config::CODE_PRODUCT == $sCodeModelForImages) {
            $obModel = $obProduct;
        } else {
            $obModel = $obOffer;
        }

        if ((!$obModel instanceof Offer && !$obModel instanceof Product) || empty($obModel)) {
            return null;
        }

        if (empty($obModel->preview_image_vkontakte)) {
            return null;
        }

        return $obModel->preview_image_vkontakte->getLocalPath();
    }

    /**
     * Get product images path
     *
     * @param Offer $obOffer
     * @param Product $obProduct
     *
     * @return array
     */
    protected function getProductImagesPath($obOffer, $obProduct)
    {
        $arResult = [];

        $sCodeModelForImages = Config::getValue('code_model_for_images');

        if (empty($sCodeModelForImages) || Config::CODE_PRODUCT == $sCodeModelForImages) {
            $obModel = $obProduct;
        } else {
            $obModel = $obOffer;
        }

        if ((!$obModel instanceof Offer && !$obModel instanceof Product) || empty($obModel)) {
            return $arResult;
        }

        if (empty($obModel->images_vkontakte)) {
            return $arResult;
        }

        /**
         * @var File $obImage
         */
        foreach ($obModel->images_vkontakte as $obImage) {
            $arResult[] = $obImage->getLocalPath();
        }

        return $arResult;
    }
}
