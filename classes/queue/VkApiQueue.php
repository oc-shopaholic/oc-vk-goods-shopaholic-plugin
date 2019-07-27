<?php namespace Lovata\VkGoodsShopaholic\Classes\Queue;

use Illuminate\Queue\Jobs\Job;
use Lovata\VkGoodsShopaholic\Classes\Helper\RequestToApi;

/**
 * Class VkApiQueue
 *
 * @package Lovata\VkGoodsShopaholic\Classes\Queue
 * @author  Sergey Zakharevich, s.zakharevich@lovata.com, LOVATA Group
 */
class VkApiQueue
{
    /**
     * Fire method.
     * @param Job   $obJob
     * @param array $arQueueData
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function fire($obJob, $arQueueData)
    {
        if (empty($arQueueData) || !is_array($arQueueData)) {
            $obJob->delete();

            return;
        }

        $arData  = array_get($arQueueData, 'data', []);
        $sMethod = array_get($arQueueData, 'method');

        $obGenerate = new RequestToApi();
        $obGenerate->generate($arData, $sMethod);

        $obJob->delete();
    }
}
