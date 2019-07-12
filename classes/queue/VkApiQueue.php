<?php namespace Lovata\VkontakteShopaholic\Classes\Queue;

use Illuminate\Queue\Jobs\Job;
use Lovata\VkontakteShopaholic\Classes\Helper\Generate;

/**
 * Class VkApiQueue
 *
 * @package Lovata\VkontakteShopaholic\Classes\Queue
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

        $obGenerate = new Generate();
        $obGenerate->generate($arData, $sMethod);

        $obJob->delete();
    }
}
