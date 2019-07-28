<?php return [
    'plugin'     => [
        'name'        => 'VK Goods for Shopaholic',
        'description' => 'Allows to export products to VK Goods (vk.com)',
    ],
    'menu'       => [
        'settings'             => 'VK Goods settings',
        'settings_description' => 'Configure products export and queue management',
    ],
    'field'      => [
        'community_id'                               => 'Community ID',
        'code_model_for_images'                      => 'Get images from',
        'section_management_additional_fields_offer' => 'Additional fields',
        'section_vk_goods'                           => 'VK Goods',
        'active_vk'                                  => 'Export to VK Goods',
        'access_token_user'                          => 'API Access token',
        'category_vk_id'                             => 'VK Goods category',
        'queue_name'                                 => 'Queue name',
    ],
    'button'     => [
        'export_catalog_to_api' => 'Run export',
    ],
    'widget'     => [
        'export_catalog_to_api_for_vk_goods' => 'Export products to VK Goods',
    ],
    'permission' => [
        'vkgoodssettings' => 'Manage VK Goods settings',
    ],
    'message'    => [
        'export_is_completed'           => 'Export has completed successfully!',
        'update_catalog_to_xml_confirm' => 'All products will be exported to your VK shop. Continue?',
    ],
];
