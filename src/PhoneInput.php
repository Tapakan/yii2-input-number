<?php

namespace Tapakan\PhoneInput;

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
    public $jsOptions = [
        'autoHideDialCode'   => false,
        'autoPlaceholder'    => true,
        'nationalMode'       => false,
        'preferredCountries' => [
            'ua'
        ]
    ];

    const DEFAULT_VIEW = 'default';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        PhoneInputAsset::register($this->view);

        $this->loadAssets();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $options = ArrayHelper::merge($this->defaultOptions, $this->options);
        $view    = self::DEFAULT_VIEW;

        if ($this->hasModel()) {
            $view .= '-model';
        }

        return $this->render($view, [
            'options' => $options,
        ]);
    }

    /**
     * Include assets
     */
    private function loadAssets()
    {
        $id        = ArrayHelper::getValue($this->options, 'id');
        $jsOptions = $this->jsOptions ? Json::encode($this->jsOptions) : '';

        $this->view->registerJs(
            "var input = $('#{$id}');" .
            "input.intlTelInput($jsOptions);"
        );
    }
}
