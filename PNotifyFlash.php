<?php

namespace iutbay\yii2pnotify;

use Yii;
use yii\helpers\Json;

/**
 * PNotifyFlash Widget.
 * 
 * @author Kevin LEVRON <kevin.levron@gmail.com>
 */
class PNotifyFlash extends \yii\base\Widget
{

    public $clientOptions = [
        'styling' => 'bootstrap3',
        'delay' => 5000,
    ];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->registerClientScript();
    }

    /**
     * Registers the needed JavaScript.
     */
    public function registerClientScript()
    {
        $view = $this->getView();
        PNotifyAsset::register($view);

        $flashes = Json::encode(Yii::$app->session->getAllFlashes(true));
        $clientOptions = Json::encode($this->clientOptions);
        $js = <<<JS
            var flashes = {$flashes}, clientOptions = {$clientOptions};
            for (var key in flashes) {
                if (flashes[key]) {
                    if (flashes[key] instanceof Array) {
                        for (var i = 0; i < flashes[key].length; i++) {
                            new PNotify($.extend({}, clientOptions, {
                                type: key,
                                text: flashes[key][i],
                            }));
                        }
                    } else {
                        new PNotify($.extend({}, clientOptions, {
                            type: key,
                            text: flashes[key],
                        }));
                    }
                }
            }
JS;
        $view->registerJs($js);
    }

}
