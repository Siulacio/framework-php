<?php

namespace Application\Validators;

use Respect\Validation\Validator;

class LoginValidator
{
    protected static Validator $validator;
    protected array $rules = [];
    protected array $messages = [];

    public function __construct()
    {
        self::$validator = new Validator();
        $this->rules();
        $this->messages();
    }

    public function rules(): void
    {
        self::$validator
            ->key('email', Validator::email())
            ->key('password', Validator::length(6, 20));
        
    }

    public function messages(): void
    {
        $this->messages = [
            'length' => 'El {{name}} debe tener entre {{minValue}} y {{maxValue}} caracteres.',
            'email' => 'El formato del email no es válido.',
        ];
    }

    public function getMessages(): array
    {
        return $this->messages;
    }

    public function validate(): bool
    {
        return self::$validator->assert($_POST);
    }
}
