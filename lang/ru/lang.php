<?php return [
    'plugin'     => [
        'name'        => 'VK товары для Shopaholic',
        'description' => 'Интеграция с API VK Goods для выгрузки каталога',
    ],
    'menu'       => [
        'settings'             => 'Экспорт в Товары VK',
        'settings_description' => 'Настроить экспорт каталога в Товары VK',
    ],
    'field'      => [
        'community_id'                               => 'ID сообщества',
        'code_model_for_images'                      => 'Получать изображения из:',
        'section_management_additional_fields_offer' => 'Дополнительные поля',
        'section_vk_goods'                           => 'Товары VK',
        'active_vk'                                  => 'Экспорт в Товары VK',
        'access_token_user'                          => 'Ключ доступа пользователя',
        'category_vk_id'                             => 'Категория VK Goods',
        'queue_name'                                 => 'Название очереди',
    ],
    'button'     => [
        'export_catalog_to_api' => 'Начать экспортирование',
    ],
    'widget'     => [
        'export_catalog_to_api_for_vk_goods' => 'Экспорт каталога в API (VK Goods)',
    ],
    'permission' => [
        'vkgoodssettings' => 'Управление настройками экспорта в VK Goods',
    ],
    'message'    => [
        'export_is_completed'           => 'Экспортирование начато',
        'update_catalog_to_xml_confirm' => 'Начать экспортирование каталога?',
    ],
];
