<?php

namespace Tapakan\PhoneInput;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberType;
use yii\validators\Validator;

/**
 * Class PhoneInputValidator
 */
class PhoneInputValidator extends Validator
{
    /**
     * @var mixed
     */
    public $region;
    /**
     * @var integer
     */
    public $type;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!$this->message) {
            $this->message = \Yii::t('yii', 'The format of {attribute} is invalid.');
        }
        parent::init();
    }

    /**
     * @param mixed $value
     *
     * @return array|null
     */
    protected function validateValue($value)
    {
        $valid     = false;
        $phoneUtil = PhoneNumberUtil::getInstance();
        try {
            $phoneProto = $phoneUtil->parse($value, null);
            if ($this->region !== null) {
                $regions = is_array($this->region) ? $this->region : [$this->region];
                foreach ($regions as $region) {
                    if ($phoneUtil->isValidNumberForRegion($phoneProto, $region)) {
                        $valid = true;
                        break;
                    }
                }
            } else {
                if ($phoneUtil->isValidNumber($phoneProto)) {
                    $valid = true;
                }
            }
            if ($this->type !== null) {
                if (PhoneNumberType::UNKNOWN != $type = $phoneUtil->getNumberType($phoneProto)) {
                    $valid = $valid && $type == $this->type;
                }
            }
        } catch (NumberParseException $e) {
        }

        return $valid ? null : [$this->message, []];
    }
}
