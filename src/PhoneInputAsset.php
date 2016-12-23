<?php

use yii\web\AssetBundle;

/**
 * Class PhoneInputAsset
 */
class PhoneInputAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@bower/intl-tel-input';

    /**
     * @var array
     */
    public $css = ['build/css/intlTelInput.css'];

    /**
     * @var array
     */
    public $js = [
        'build/js/utils.js',
        'build/js/intlTelInput.min.js',
    ];

    /**
     * @var array
     */
    public $depends = ['yii\web\JqueryAsset'];
}