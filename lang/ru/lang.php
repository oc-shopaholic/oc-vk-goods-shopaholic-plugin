<?php return [
    'plugin'     => [
        'name'        => 'VK товары для Shopaholic',
        'description' => 'Export catalog to VK Goods with using API',
    ],
    'menu'       => [
        'settings'             => 'Export to VK Goods',
        'settings_description' => 'Configure export catalog to VK Goods',
    ],
    'field'      => [
        'community_id'                               => 'Идентификатор сообщества',
        'code_model_for_images'                      => 'Получать изображения из:?',
        'section_management_additional_fields_offer' => 'Дополнительные поля',
        'section_vk_goods'                           => 'VK Goods',
        'active_vk'                                  => 'Export to VK Goods',
        'access_token_user'                          => 'Ключ доступа пользователя',
        'category_vk_id'                             => 'Category VK Goods',
        'queue_name'                                 => 'Название очереди',
    ],
    'button'     => [
        'export_catalog_to_api' => 'Запуск экспорта',
    ],
    'widget'     => [
        'export_catalog_to_api_for_vk_goods' => 'Export catalog to VK Goods',
    ],
    'permission' => [
        'vkgoodssettings' => 'Manager settings of catalog export to VK Goods',
    ],
    'message'    => [
        'export_is_completed'           => 'Export is completed',
        'update_catalog_to_xml_confirm' => 'Запустить обновление каталога?',
    ],
];
