<?php

namespace iutbay\yii2pnotify;

use yii\web\AssetBundle;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * PNotify Widget.
 * 
 * @author Kevin LEVRON <kevin.levron@gmail.com>
 */
class PNotify extends \yii\base\Widget
{

    public $title;
    public $text;
    public $type;

    public $notifications = [];

    public $clientOptions = [
        'styling' => 'fontawesome',
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

        $this->createNotification([
            'title' => $this->title,
            'text' => $this->text,
            'type' => $this->type,
        ]);
        
        foreach ($this->notifications as $n) {
            $this->createNotification($n);
        }
    }

    /**
     * Create notification
     * @param [] $n
     */
    protected function createNotification($n)
    {
        $view = $this->getView();
        $options = [];

        $text = ArrayHelper::getValue($n, 'text');
        if ($text) $options['text'] = $text;
        else throw new \Imagine\Exception\InvalidArgumentException('Missing text param.');

        $title = ArrayHelper::getValue($n, 'title');
        if ($title) $options['title'] = $title;

        $type = ArrayHelper::getValue($n, 'type');
        if ($type) $options['type'] = $type;

        $options = array_merge($this->clientOptions, $options);
        $options = Json::encode($options);
        $view->registerJs("new PNotify({$options});");
    }

    /**
     * Registers the needed JavaScript.
     */
    public function registerClientScript()
    {
        $view = $this->getView();
        PNotifyAsset::register($view);
    }

}
