<?php

namespace controllers;

use core\Controller;
use models\Member;
use components\Validator;

class MemberController extends Controller
{
    public function actionLoginPage(): void
    {
        $this->render('login', []);
    }

    public function actionRegister(): void
    {
        $this->render('register', []);
    }

    /*
     * Currently I am just checking if credentials are correct
     * Obviously we also need some proper auth system like JWT
     * But I kept it simple due to lack of time
     * */
    public function actionLogin(): bool
    {
        $data = [];
        parse_str($_POST['form_data'], $data);

        $member = new Member();
        if ($member->login($data['email'], $data['password'])) {
            http_response_code(200);
        } else {
            $this->returnJSON([
                'Incorrect email or password'
            ], 401);
        }

        return true;
    }

    public function actionCreate(): bool
    {
        $data = [];
        parse_str($_POST['form_data'], $data);

        $required = ['first_name', 'last_name', 'phone', 'email', 'password'];
        $maxLength = [
            'first_name' => 255,
            'last_name' => 255,
            'email' => 255,
            'password' => 255,
        ];
        $filter = [
            'email' => 'email',
            'phone' => 'phone',
            'password' => 'password'
        ];

        $validator = new Validator($data, $required, $maxLength, $filter);
        $errors = $validator->validate();

        if (empty($errors)) {
            // Since I am not hashing password on the client, HTTPS is required in this case
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            $member = new Member();
            $member->create($data);
            http_response_code(200);
        } else {
            $this->returnJSON($errors, 422);
        }

        return true;
    }
}