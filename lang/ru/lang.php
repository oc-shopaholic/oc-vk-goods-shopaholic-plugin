<?php return [
    'plugin'     => [
        'name'        => '',
        'description' => 'Позволяет экспортировать товары в VK Goods (vk.com)',
    ],
    'menu'       => [
        'settings'             => 'Настройки VK Goods',
        'settings_description' => 'Настройка экспорта товаров и управления очередью',
    ],
    'field'      => [
        'community_id'                               => 'ID сообщества',
        'code_model_for_images'                      => 'Получать изображения из',
        'section_management_additional_fields_offer' => 'Дополнительные поля',
        'section_vk_goods'                           => '',
        'active_vk'                                  => 'Экспортировать товары в VK Goods',
        'access_token_user'                          => 'Ключ доступа к API',
        'category_vk_id'                             => 'Категория VK Goods',
        'queue_name'                                 => 'Название очереди',
    ],
    'button'     => [
        'export_catalog_to_api' => 'Запустить экспорт',
    ],
    'widget'     => [
        'export_catalog_to_api_for_vk_goods' => 'Экспорт товаров в VK Goods',
    ],
    'permission' => [
        'vkgoodssettings' => 'Управление настройками VK Goods',
    ],
    'message'    => [
        'export_is_completed'           => 'Экспорт успешно завершён!',
        'update_catalog_to_xml_confirm' => 'Все товары будут экспортированы в ваш VK магазин. Продолжить?',
    ],
];
