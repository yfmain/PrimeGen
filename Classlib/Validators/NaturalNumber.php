<?php

namespace DevSpace\Validators;

use DevSpace\Interfaces\Validators\INaturalNumber;

class NaturalNumber implements INaturalNumber{

    public function validate($input) {
        return filter_var($input, FILTER_VALIDATE_INT) && $input > 0;
    }
}