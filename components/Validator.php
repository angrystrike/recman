<?php

namespace components;

use models\Member;

/**
 * Simple validator class to avoid writing validation directly in Controller
 */
class Validator
{
    private $fields;
    private $required;
    private $maxLength;
    private $filter;
    private $errors = [];

    public function __construct($fields, $required, $maxLength, $filter)
    {
        $this->fields = $fields;
        $this->required = $required;
        $this->maxLength = $maxLength;
        $this->filter = $filter;
    }

    private function checkRequired()
    {
        if (!empty($this->required)) {
            foreach ($this->required as $field) {
                if (empty($this->fields[$field])) {
                    $field = ucfirst(str_replace('_', ' ', $field));
                    array_push($this->errors, $field . ' could not be empty');
                }
            }
        }
    }

    private function checkMaxLength()
    {
        if (!empty($this->maxLength)) {
            foreach ($this->maxLength as $field => $maxLength) {
                if (strlen($this->fields[$field]) > $maxLength) {
                    $field = ucfirst(str_replace('_', ' ', $field));
                    array_push($this->errors, "{$field} length could not be more than {$maxLength} symbols");
                }
            }
        }
    }

    private function checkFilter()
    {
        if (!empty($this->filter)) {
            foreach ($this->filter as $field => $rule) {

                if ($rule == 'email') {
                    $member = new Member();
                    if ($member->isEmailInUse($this->fields[$field])) {
                        array_push($this->errors, "Email is already in use");
                    }
                    if (!filter_var($this->fields['email'], FILTER_VALIDATE_EMAIL)) {
                        array_push($this->errors, "Email is not formatted correctly");
                    }
                } elseif ($rule == 'phone') {
                    $phone = preg_replace('~\D~', '', $this->fields[$field]);
                    if (strlen($phone) != 11) {
                        array_push($this->errors, "Phone number should be 11 digits");
                    }
                } elseif ($rule == 'password') {
                    $password = $this->fields[$field];
                    if (strlen($password) < 8) {
                        array_push($this->errors, "Password must be at least 8 characters long");
                    }
                    if (!preg_match('/[A-Za-z]/', $password)) {
                        array_push($this->errors, "Password must contain at least one letter");
                    }
                    if (!preg_match('/\d/', $password)) {
                        array_push($this->errors, "Password must contain at least one digit");
                    }
                }

            }
        }
    }

    public function validate()
    {
        self::checkRequired();
        self::checkMaxLength();
        self::checkFilter();

        return $this->errors;
    }
}