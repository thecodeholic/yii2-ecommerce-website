<?php
/**
 * User: Zura
 * Date: 3/15/2021
 * Time: 9:28 AM
 */

namespace common\components;


/**
 * Class TranslationEventHandler
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package app\components
 */
class TranslationEventHandler
{
    public static function handleMissingTranslation(\yii\i18n\MissingTranslationEvent $event)
    {
        $event->translatedMessage = '[[' . $event->message . ' - ' . $event->category . ' - ' . $event->language . ']]';
    }
}