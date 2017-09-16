<?php

namespace Candasm\Lafres;

use Exception;
use ReflectionClass;

trait SanitizeWhenResolvedTrait
{
    protected function getValidatorInstance()
    {
        if ($this->shouldBeSanitized()) {
            $this->sanitize();
        }
        return parent::getValidatorInstance();
    }

    private function sanitize()
    {
        $rules = $this->rules();
        $inputs = $this->only(array_keys($rules));
        foreach ($inputs as $key => $input) {
            if (is_null($input) && strpos('required', $rules[$key]) === false) {
                unset($inputs[$key]);
            }
        }
        $this->replace($inputs);
    }

    private function shouldBeSanitized()
    {
        try {
            return (new ReflectionClass(get_called_class()))->implementsInterface(SanitizeFormRequest::class);
        } catch (Exception $e) {
            return false;
        }
    }
}