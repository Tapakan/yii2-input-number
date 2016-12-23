<?php

use yii\helpers\Html;

echo Html::activeInput($this->context->htmlTagType, $this->context->model, $this->context->attribute, $options);
