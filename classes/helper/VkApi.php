<?php namespace Lovata\VkGoodsShopaholic\Classes\Helper;

use Lovata\VkGoodsShopaholic\Models\VkGoodsSettings;
use GuzzleHttp\Client;

/**
 * Class VkApi
 *
 * @package Lovata\VkGoodsShopaholic\Classes\Helper
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class VkApi
{
    const VERSION_API = '5.101';

    const REQUEST_URL_METHOD = 'https://api.vk.com/method/';

    const METHOD_MARKET_GET_CATEGORIES           = 'market.getCategories';
    const METHOD_MARKET_ADD                      = 'market.add';
    const METHOD_MARKET_EDIT                     = 'market.edit';
    const METHOD_MARKET_DELETE                   = 'market.delete';
    const METHOD_PHOTOS_GET_MARKET_UPLOAD_SERVER = 'photos.getMarketUploadServer';
    const METHOD_PHOTOS_SAVE_MARKET_PHOTO        = 'photos.saveMarketPhoto';

    /**
     * @var string
     */
    protected $sAccessTokenUser;

    /**
     * @var int
     */
    protected $iCommunityId;

    /**
     * @var string
     */
    protected $sOwnerId;

    /**
     * VkApi constructor.
     */
    public function __construct()
    {
        $this->initData();
    }

    /**
     * Get community id
     *
     * @return int
     */
    public function getCommunityId()
    {
        return $this->iCommunityId;
    }

    /**
     * Method market.getCategories
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function marketGetCategories()
    {
        array_set($arData, 'count', 1000);

        $sUrl = $this->requestUrl(self::METHOD_MARKET_GET_CATEGORIES);

        return $this->request($sUrl, $arData);
    }

    /**
     * Method market.add
     * @param array $arData
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function marketAdd($arData)
    {
        if (empty($arData) || !is_array($arData) || empty($this->sOwnerId)) {
            return [];
        }

        array_set($arData, 'owner_id', $this->sOwnerId);

        $sUrl = $this->requestUrl(self::METHOD_MARKET_ADD);

        return $this->request($sUrl, $arData);
    }

    /**
     * Method market.edit
     *
     * @param array $arData
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function marketEdit($arData)
    {
        if (empty($arData) || !is_array($arData) || empty($this->sOwnerId)) {
            return [];
        }

        array_set($arData, 'owner_id', $this->sOwnerId);

        $sUrl = $this->requestUrl(self::METHOD_MARKET_EDIT);

        return $this->request($sUrl, $arData);
    }

    /**
     * Method market.delete
     *
     * @param string $iExternalVkId
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function marketDelete($iExternalVkId)
    {
        if (empty($iExternalVkId) || empty($this->sOwnerId)) {
            return [];
        }

        $arData = [
            'owner_id' => $this->sOwnerId,
            'item_id'  => $iExternalVkId,
        ];

        $sUrl = $this->requestUrl(self::METHOD_MARKET_DELETE);

        return $this->request($sUrl, $arData);
    }

    /**
     * Method photos.getMarketUploadServer
     *
     * @param array $arImagePathList
     * @param bool $bMainPhoto
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function photosGetMarketUploadServer($arImagePathList, $bMainPhoto = false)
    {
        if (empty($arImagePathList) || !is_array($arImagePathList)) {
            return [];
        }

        // Get server url.
        $arData = [
            'main_photo' => $bMainPhoto,
            'group_id'   => $this->iCommunityId,
        ];

        $sUrl = $this->requestUrl(self::METHOD_PHOTOS_GET_MARKET_UPLOAD_SERVER);

        $arResponse = $this->request($sUrl , $arData);

        $sUrl = array_get($arResponse, 'response.upload_url', '');

        // Send images.
        $arMultipart = [];

        foreach ($arImagePathList as $iKey => $sImagePath) {
            if (empty($sImagePath) || !file_exists($sImagePath) || count($arMultipart) >= 5) {
                continue;
            }

            ++$iKey;

            $arMultipart[] = [
                'name'     => 'file'.$iKey,
                'contents' => fopen($sImagePath, 'rb'),
            ];
        }

        return $this->request($sUrl, [], $arMultipart);
    }

    /**
     * Method photos.saveMarketPhoto
     *
     * @param array $arData
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function photosSaveMarketPhoto($arData)
    {
        if (empty($arData) || !is_array($arData)) {
            return [];
        }

        $sUrl = $this->requestUrl(self::METHOD_PHOTOS_SAVE_MARKET_PHOTO);

        array_set($arData, 'group_id',  $this->iCommunityId);

        return $this->request($sUrl, $arData);
    }

    /**
     * Init data
     */
    protected function initData()
    {
        $this->sAccessTokenUser = VkGoodsSettings::getValue('access_token_user', '');
        $this->iCommunityId     = VkGoodsSettings::getValue('community_id');

        if (!empty($this->iCommunityId)) {
            $this->sOwnerId = '-'.$this->iCommunityId;
        }
    }

    /**
     * Request
     *
     * @param string $sUrl
     * @param array $arData
     * @param array $arMultipart
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function request($sUrl, $arData = [], $arMultipart = [])
    {
        $arRequestData = [];

        if (empty($sUrl) || empty($this->sAccessTokenUser)) {
            return $arRequestData;
        }

        if (!empty($arData)) {
            array_set($arData, 'access_token', $this->sAccessTokenUser);
            array_set($arData, 'v', self::VERSION_API);
            array_set($arRequestData, 'form_params', $arData);
        }

        if (!empty($arMultipart)) {
            array_set($arRequestData, 'multipart', $arMultipart);
        }

        $obClient = new Client();
        $obResponse = $obClient->request('POST', $sUrl, $arRequestData);

        if (empty($obResponse) || empty($obResponse->getBody())) {
            return [];
        }
        if ($obResponse->getStatusCode() != 200) {
            return [];
        }

        return json_decode($obResponse->getBody()->getContents(), true);
    }

    /**
     * Get request url
     *
     * @param string $sMethod
     * @return string
     */
    protected function requestUrl($sMethod)
    {
        if (empty($sMethod) || !is_string($sMethod)) {
            return '';
        }

        return self::REQUEST_URL_METHOD.$sMethod;
    }
}
