<?php

namespace App\Exceptions\Repositories\Pterodactyl;

use Illuminate\Validation\ValidationException as BaseValidationException;
use Exception;

class ValidationException extends Exception
{
    protected $errors;

    /**
     * Get the validation errors from API response, translate it, and map the fields.
     *
     * @param array $errors
     * @param array $fields_map
     */
    public function __construct(array $errors = [], array $fields_map = [])
    {
        parent::__construct('The given data was invalid.', 422);

        $new_errors = [];

        foreach ($errors as $value) {
            $field = $value['meta']['source_field'];
            $message = $value['detail'];

            if (isset($fields_map[$field])) {
                $original = $field;
                $field = $fields_map[$field];

                $message = str_replace($original, ':attribute', $message);
            }

            $new_errors[$field] = [__($message, ['attribute' => $field])];
        }

        $this->errors = $new_errors;
    }

    /**
     * Throw the validation exception.
     *
     * @return void
     */
    public function throwValidationException()
    {
        throw BaseValidationException::withMessages($this->errors);
    }
}
