<?php return [
    'plugin'     => [
        'name'        => 'Экспорт товаров во VKontakte',
        'description' => 'Интеграция с API VKontakte для выгрузки каталога',
    ],
    'menu'       => [
        'vkontaktesettings' => 'Экспорта во VKontakte',
    ],
    'field'      => [
        'community_id'                               => 'Идентификатор сообщества',
        'code_model_for_images'                      => 'Получать изображения из:?',
        'section_management_additional_fields_offer' => 'Дополнительные поля',
        'section_vkontakte'                          => 'VKontakte',
        'active_vk'                                  => 'Экспорт во VKontakte',
        'access_token_user'                          => 'Ключ доступа пользователя',
        'category_vk_id'                             => 'Категория VKontakte',
        'queue_name'                                 => 'Название очереди',
    ],
    'button'     => [
        'export_catalog_to_api' => 'Запуск экспорта',
    ],
    'widget'     => [
        'export_catalog_to_api_for_vkontakte' => 'Экспорт каталога в API (Vkontakte)',
    ],
    'permission' => [
        'vkontaktesettings' => 'Управление настройками экспорта во VKontakte',
    ],
    'message'    => [
        'export_is_complete'            => 'Экспорт запущен',
        'update_catalog_to_xml_confirm' => 'Запустить обновление каталога?',
    ],
];
