<?php return [
    'plugin'     => [
        'name'        => 'Export products for VKontakte',
        'description' => 'Integration through ATOM format',
    ],
    'menu'       => [
        'vkontaktesettings' => 'Export to VKontakte',
    ],
    'component'  => [],
    'tab'        => [
        'store' => 'Store',
    ],
    'field'      => [
        'community_id'                               => 'Community id',
        'code_model_for_images'                      => 'Where to get the images?',
        'section_management_additional_fields_offer' => 'Management additional fields',
        'section_vkontakte'                          => 'VKontakte',
        'active_vk'                                  => 'Export to VKontakte',
        'access_token_user'                          => 'User access key',
        'category_vk_id'                             => 'Category VKontakte',
        'queue_name'                                 => 'Queue name',
    ],
    'button'     => [
        'export_catalog_to_api' => 'Update catalog to API',
    ],
    'widget'     => [
        'export_catalog_to_api_for_vkontakte' => 'Export catalog to API for Vkontakte',
    ],
    'permission' => [
        'vkontaktesettings' => 'Manager export for VKontakte',
    ],
    'message'    => [
        'export_is_complete'            => 'Export is complete',
        'update_catalog_to_xml_confirm' => 'Update catalog to API?',
    ],
];
