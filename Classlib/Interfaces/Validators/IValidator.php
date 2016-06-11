<?php

namespace DevSpace\Interfaces\Validators;

interface IValidator {

    /**
     * @param mixed $value
     * @return bool
     */
    public function validate($value);
}