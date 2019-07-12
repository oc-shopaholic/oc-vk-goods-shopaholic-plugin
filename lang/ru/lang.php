<?php return [
    'plugin'     => [
        'name'        => 'Экспорт товаров для VKontakte',
        'description' => 'Интеграция через API',
    ],
    'menu'       => [
        'vkontaktesettings' => 'Экспорта в VKontakte',
    ],
    'component'  => [],
    'tab'        => [
        'store' => 'Магазин',
    ],
    'field'      => [
        'community_id'                               => 'Идентификатор сообщества',
        'code_model_for_images'                      => 'Откуда брать изображения?',
        'section_management_additional_fields_offer' => 'Управление дополнительными полями',
        'section_vkontakte'                          => 'VKontakte',
        'active_vk'                                  => 'Экспорт в VKontakte',
        'access_token_user'                          => 'Ключ доступа пользователя',
        'category_vk_id'                             => 'Категория VKontakte',
        'queue_name'                                 => 'Название очереди',
    ],
    'button'     => [
        'export_catalog_to_api' => 'Обновить каталог в API',
    ],
    'widget'     => [
        'export_catalog_to_api_for_vkontakte' => 'Экспорт каталога в API для Vkontakte',
    ],
    'permission' => [
        'vkontaktesettings' => 'Управление экспортом для VKontakte',
    ],
    'message'    => [
        'export_is_complete'            => 'Экспорт завершен',
        'update_catalog_to_xml_confirm' => 'Обновить каталог в API?',
    ],
];
