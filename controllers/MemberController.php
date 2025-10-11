<?php

namespace controllers;

use core\Controller;
use models\Member;
use components\Validator;

class MemberController extends Controller
{
    public function actionLoginPage()
    {
        $this->render('login', []);
    }

    public function actionRegister()
    {
        $this->render('register', []);
    }

    public function actionLogin()
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

    public function actionCreate()
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