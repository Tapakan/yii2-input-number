<?php

use yii\helpers\Html;

echo Html::input($this->context->htmlTagType, $this->context->name, $this->context->value, $options);
