<?php return [
    'plugin'     => [
        'name'        => '',
        'description' => 'Дазваляе экспартаваць тавары ў VK Goods (vk.com)',
    ],
    'menu'       => [
        'settings'             => 'Налады VK Goods',
        'settings_description' => 'Налада экспарту тавараў і кіравання чаргой',
    ],
    'field'      => [
        'community_id'                               => 'ID суполкi',
        'code_model_for_images'                      => 'Атрымліваць відарысы з',
        'section_management_additional_fields_offer' => 'Дадатковыя палі',
        'section_vk_goods'                           => '',
        'active_vk'                                  => 'Экспартаваць у VK Goods',
        'access_token_user'                          => 'Ключ доступу да API',
        'category_vk_id'                             => 'Катэгорыя VK Goods',
        'queue_name'                                 => 'Назва чаргi',
    ],
    'button'     => [
        'export_catalog_to_api' => 'Запусціць экспарт',
    ],
    'widget'     => [
        'export_catalog_to_api_for_vk_goods' => 'Экспарт тавараў у VK Goods',
    ],
    'permission' => [
        'vkgoodssettings' => 'Кіраванне наладамі VK Goods',
    ],
    'message'    => [
        'export_is_completed'           => 'Экспарт паспяхова завершаны!',
        'update_catalog_to_xml_confirm' => 'Усе тавары будуць экспартаваныя ў вашу VK краму. Працягнуць?',
    ],
];
