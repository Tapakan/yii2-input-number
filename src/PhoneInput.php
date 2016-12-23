<?php

namespace Tapakan\PhoneInput;

use PhoneInputAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use yii\helpers\ArrayHelper;

/**
 * Class PhoneInput
 */
class PhoneInput extends InputWidget
{
    /**
     * @var string HTML tag type of the widget input ("tel" by default)
     */
    public $htmlTagType = 'tel';

    /**
     * @var array Default widget options of the HTML tag
     */
    public $defaultOptions = [
        'autocomplete' => 'off',
        'class'        => 'form-control'
    ];

    /**
     * @var array
     */
    public $jsOptions = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        PhoneInputAsset::register($this->view);

        $id        = ArrayHelper::getValue($this->options, 'id');
        $jsOptions = $this->jsOptions ? Json::encode($this->jsOptions) : '';

        $this->view->registerJs("$('#{$id}').intlTelInput($jsOptions);");
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $options = ArrayHelper::merge($this->defaultOptions, $this->options);
        if ($this->hasModel()) {
            return Html::activeInput($this->htmlTagType, $this->model, $this->attribute, $options);
        }

        return Html::input($this->htmlTagType, $this->name, $this->value, $options);
    }
}
