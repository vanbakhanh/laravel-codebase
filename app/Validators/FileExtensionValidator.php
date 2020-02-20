<?php

namespace App\Validators;

use Illuminate\Validation\Validator;
use Illuminate\Http\UploadedFile;

class FileExtensionValidator extends Validator {
    /**
     * Validate the file extension
     */
    public function validateFileExtension($attribute, $value, $parameters)
    {
        if (!$value instanceof UploadedFile) {
            return false;
        }

        $extension = strtolower(pathinfo($value->getClientOriginalName(), PATHINFO_EXTENSION));
        return $extension != '' && in_array($extension, $parameters);
    }
}

