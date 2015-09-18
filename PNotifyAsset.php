<?php

namespace iutbay\yii2pnotify;

use yii\web\AssetBundle;

/**
 * PNotify Asset Bundle.
 * 
 * @author Kevin LEVRON <kevin.levron@gmail.com>
 */
class PNotifyAsset extends AssetBundle
{

    public $sourcePath = '@bower/pnotify/src';
    public $js = [
        'pnotify.core.js',
        'pnotify.buttons.js',
    ];
    public $css = [
        'pnotify.core.css',
        'pnotify.buttons.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];

}
