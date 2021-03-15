<?php
require_once __DIR__.'/../../common/helpers.php';

return [
    'language' => 'de-DE', // ka-GE
    'sourceLanguage' => 'en-US',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'class' => \common\i18n\Formatter::class,
            'datetimeFormat' => 'php:d/m/Y H:i',
        ],
        'i18n' => [
            'translations' => [
//                'yii' => [
//                    'class' => \yii\i18n\PhpMessageSource::class,
//                    'basePath' => '@common/messages/yii',
//                ],
                'app*' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => '@common/messages',
                    'on missingTranslation' => function(\yii\i18n\MissingTranslationEvent $event) {
                        $event->translatedMessage = '[['.$event->message.' - '.$event->category. ' - '.$event->language.']]';
                    }
                ],
                '*' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => '@common/messages',
                ]
            ],
        ]
    ],
];
