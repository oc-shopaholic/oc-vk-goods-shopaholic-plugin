<?php return [
    'plugin'     => [
        'name'        => 'VK Goods for Shopaholic',
        'description' => 'Export catalog to VKontakte with using API',
    ],
    'menu'       => [
        'settings'             => 'Export to VKontakte',
        'settings_description' => 'Configure export catalog to VKontakte',
    ],
    'field'      => [
        'community_id'                               => 'Community id',
        'code_model_for_images'                      => 'Get images from:',
        'section_management_additional_fields_offer' => 'Additional fields',
        'section_vkontakte'                          => 'VKontakte',
        'active_vk'                                  => 'Export to VKontakte',
        'access_token_user'                          => 'User access key',
        'category_vk_id'                             => 'Category VKontakte',
        'queue_name'                                 => 'Queue name',
    ],
    'button'     => [
        'export_catalog_to_api' => 'Run export',
    ],
    'widget'     => [
        'export_catalog_to_api_for_vkontakte' => 'Export catalog to Vkontakte',
    ],
    'permission' => [
        'vkgoodssettings' => 'Manager settings of catalog export to VKontakte',
    ],
    'message'    => [
        'export_is_completed'           => 'Export is completed',
        'update_catalog_to_xml_confirm' => 'Run export catalog?',
    ],
];
