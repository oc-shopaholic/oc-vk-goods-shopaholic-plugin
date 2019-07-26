<?php return [
    'plugin'     => [
        'name'        => 'VK товары для Shopaholic',
        'description' => 'Интеграция с API VK Goods для выгрузки каталога',
    ],
    'menu'       => [
        'vkgoodssettings' => 'Экспорта во VK Goods',
    ],
    'field'      => [
        'community_id'                               => 'Идентификатор сообщества',
        'code_model_for_images'                      => 'Получать изображения из:?',
        'section_management_additional_fields_offer' => 'Дополнительные поля',
        'section_vk_goods'                           => 'VK Goods',
        'active_vk'                                  => 'Экспорт во VK Goods',
        'access_token_user'                          => 'Ключ доступа пользователя',
        'category_vk_id'                             => 'Категория VK Goods',
        'queue_name'                                 => 'Название очереди',
    ],
    'button'     => [
        'export_catalog_to_api' => 'Запуск экспорта',
    ],
    'widget'     => [
        'export_catalog_to_api_for_vk_goods' => 'Экспорт каталога в API (VK Goods)',
    ],
    'permission' => [
        'vkgoodssettings' => 'Управление настройками экспорта во VK Goods',
    ],
    'message'    => [
        'export_is_complete'            => 'Экспорт запущен',
        'update_catalog_to_xml_confirm' => 'Запустить обновление каталога?',
    ],
];
