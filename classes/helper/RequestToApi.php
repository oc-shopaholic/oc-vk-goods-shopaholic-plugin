<?php namespace Lovata\VkGoodsShopaholic\Classes\Helper;

use Lovata\Shopaholic\Models\Product;

/**
 * Class RequestToApi
 * @package Lovata\VkGoodsShopaholic\Classes\Helper
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class RequestToApi
{
    const METHOD_CREATE_OR_UPDATE = 'create_or_update';
    const METHOD_DELETE           = 'delete';

    /**
     * @var VkApi
     */
    protected $obVkApi;

    /**
     * Generate constructor.
     */
    public function __construct()
    {
        $this->obVkApi = new VkApi();
    }

    /**
     * Generate
     *
     * @param array $arData
     * @param string $sMethod
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function generate($arData, $sMethod)
    {
        switch ($sMethod) {
            case self::METHOD_CREATE_OR_UPDATE:
                $this->createOrUpdateMethod($arData);
                break;
            case self::METHOD_DELETE:
                $this->deleteMethod($arData);
                break;
        }
    }

    /**
     * Create or update method
     *
     * @param array $arProduct
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function createOrUpdateMethod($arProduct)
    {
        if (empty($arProduct) || !is_array($arProduct) || empty($this->obVkApi)) {
            return;
        }

        $iExternalVkId     = array_get($arProduct, 'item_id');
        $sPreviewImagePath = array_pull($arProduct, 'preview_image');
        $arImagesPathList  = array_pull($arProduct, 'images', []);
        $iProductId        = array_pull($arProduct, 'id');

        array_set($arProduct, 'main_photo_id', $this->getPhotoIdList([$sPreviewImagePath], true));
        array_set($arProduct, 'photo_ids', $this->getPhotoIdList($arImagesPathList));

        if (empty($iExternalVkId)) {
            // Create product to vkontakte.
            $arResponse = $this->obVkApi->marketAdd($arProduct);

            $iExternalVkId = array_get($arResponse, 'response.market_item_id');
            $this->updateProduct($iProductId, $iExternalVkId);
        } else {
            // Update product to vkontakte.
            $arResponse = $this->obVkApi->marketEdit($arProduct);

            $arError = array_get($arResponse, 'error', []);
            $bStatus = array_get($arResponse, 'response');

            if (!empty($arError) || ($bStatus !== null && !$bStatus)) {
                $this->deleteMethod($arProduct);
            }
        }
    }

    /**
     * Delete method
     *
     * @param array $arProduct
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteMethod($arProduct)
    {
        if (empty($arProduct) || !is_array($arProduct)) {
            return;
        }

        $iProductId    = array_get($arProduct, 'id');
        $iExternalVkId = array_get($arProduct, 'external_vk_id');

        if (empty($iProductId) || empty($iExternalVkId)) {
            return;
        }

        $arResponse = $this->obVkApi->marketDelete($iExternalVkId);

        $bStatus = array_get($arResponse, 'response');

        $obProduct = Product::find($iProductId);

        if (empty($obProduct) || ($bStatus !== null && !$bStatus)) {
            return;
        }

        $this->updateProduct($obProduct->id);
    }

    /**
     * Update product
     *
     * @param integer $iProductId
     * @param integer $iExternalVkId
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function updateProduct($iProductId, $iExternalVkId = null)
    {
        if (empty($iProductId)) {
            return;
        }

        $obProduct = Product::find($iProductId);

        if (empty($obProduct)) {
            return;
        }

        try {
            $obProduct->external_vk_id = $iExternalVkId;
            $obProduct->save();
        } catch (\October\Rain\Database\ModelException $obException) {
            return;
        }
    }

    /**
     * Get photo list
     *
     * @param array $arImagePathList
     * @param bool $bMainPhoto
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function getPhotoIdList($arImagePathList, $bMainPhoto = false)
    {
        if (empty($arImagePathList) || !is_array($arImagePathList)) {
            return '';
        }

        $arResponse = $this->obVkApi->photosGetMarketUploadServer($arImagePathList, $bMainPhoto);

        if (empty($arResponse) || !is_array($arResponse)) {
            return '';
        }

        $arResponse = $this->obVkApi->photosSaveMarketPhoto($arResponse);
        $arResponse = array_get($arResponse, 'response');

        if (empty($arResponse) || !is_array($arResponse)) {
            return '';
        }

        $arImagesIdList = array_column($arResponse, 'id');

        $sImagesIdList = implode(',', $arImagesIdList);

        return $sImagesIdList;
    }
}
