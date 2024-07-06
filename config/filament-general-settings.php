<?php

use Filament\Actions\Action;
use Joaopaulolndev\FilamentGeneralSettings\Enums\TypeFieldEnum;

return [
    'show_application_tab' => true,
    'show_analytics_tab' => true,
    'show_seo_tab' => true,
    'show_email_tab' => true,
    'show_social_networks_tab' => true,
    'expiration_cache_config_time' => 60,
    'show_custom_tabs' => true,
    'custom_tabs' => [
        'more_configs' => [
            'label' => 'More Configs',
            'icon' => 'heroicon-o-plus-circle',
            'columns' => 1,
            'fields' => [
                'razor_pay_secret_key' => [
                    'type' => TypeFieldEnum::Text->value,
                    'label' => 'Secret Key',
                    'placeholder' => 'Enter your secret key',
                    'required' => false,
                    'rules' => 'required|string|max:255',
                ],
                'razor_pay_public_key' => [
                    'type' => TypeFieldEnum::Text->value,
                    'label' => 'Public Key',
                    'placeholder' => 'Enter your public key',
                    'required' => false,
                    'rules' => 'required|string|max:255',
                ],
                'admin_url' => [
                    'type' => TypeFieldEnum::Text->value,
                    'label' => 'Admin URL',
                    'placeholder' => 'Enter your admin url',
                    'required' => false,
                    'rules' => 'required|string|max:255',
                ],
            ]
        ]
    ]
];
