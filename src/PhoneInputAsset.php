<?php

namespace Tapakan\PhoneInput;

use yii\web\AssetBundle;

/**
 * Class PhoneInputAsset
 */
class PhoneInputAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@bower/';

    /**
     * @var array
     */
    public $css = ['intl-tel-input/build/css/intlTelInput.css'];

    /**
     * @var array
     */
    public $js = [
        'intl-tel-input/build/js/utils.js',
        'intl-tel-input/build/js/intlTelInput.min.js',
        'jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js'
    ];

    /** @var array */
    public $depends = ['yii\web\JqueryAsset'];
}