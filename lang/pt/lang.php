<?php return [
    'plugin'     => [
        'name'        => 'VK Goods for Shopaholic',
        'description' => 'Export catalog to VK Goods using API',
    ],
    'menu'       => [
        'settings'             => 'Export to VK Goods',
        'settings_description' => 'Configure catalog export to VK Goods',
    ],
    'field'      => [
        'community_id'                               => 'Community ID',
        'code_model_for_images'                      => 'Get images from:',
        'section_management_additional_fields_offer' => 'Additional fields',
        'section_vk_goods'                           => 'VK Goods',
        'active_vk'                                  => 'Export to VK Goods',
        'access_token_user'                          => 'User access key',
        'category_vk_id'                             => 'VK Goods category',
        'queue_name'                                 => 'Queue name',
    ],
    'button'     => [
        'export_catalog_to_api' => 'Run export',
    ],
    'widget'     => [
        'export_catalog_to_api_for_vk_goods' => 'Export catalog to VK Goods',
    ],
    'permission' => [
        'vkgoodssettings' => 'Manage settings of catalog export to VK Goods',
    ],
    'message'    => [
        'export_is_completed'           => 'Export is completed',
        'update_catalog_to_xml_confirm' => 'Run catalog export?',
    ],
];
