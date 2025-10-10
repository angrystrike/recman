<?php

namespace controllers;

require_once ROOT . '/utility/response.php';
use core\Controller;
use models\Member;
use components\Validator;

class MemberController extends Controller
{
    public function actionIndex()
    {
        $member = new Member();
        $members = $member->all();

        $this->render("members", ['members' => $members]);
    }

    public function actionRegister()
    {
        $params = include(ROOT . '/config/params.php');
        $member = new Member();

        $this->render("register", [
            'twitterText' => $params['twitter_text'],
            'twitterUrl' => $params['twitter_url'],
            'membersCount' => $member->count(),
        ]);
    }

    public function actionCurrent()
    {
        $member = new Member();
        $currentMember = $member->findOneById($_SESSION['member_id']);

        returnJSON($currentMember);
    }

    public function actionCount()
    {
        $member = new Member();
        returnJSON($member->count());
    }

    public function actionIsLogged()
    {
        if (empty($_SESSION['member_id'])) {
            returnJSON("false");
        } else {
            returnJSON("true");
        }
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
            if (empty($_SESSION['member_id'])) {
                $member = new Member();
                $newMemberId = $member->create($data);
                $_SESSION['member_id'] = $newMemberId;
            } else {
                $member = new Member();
                $member->edit($data);
            }
            http_response_code(200);
        } else {
            http_response_code(422);
            returnJSON($errors);
        }

        return true;
    }

    public function actionUpdate()
    {
        $maxLength = [
            'company' => 45,
            'position' => 45,
            'about_me' => 300
        ];
        $filter = ['photo' => 'photo'];

        $validator = new Validator($_POST,null, $maxLength, $filter);
        $errors = $validator->validate();

        if (empty($errors)) {
            $img = $_FILES["photo"]["name"];
            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            if (!empty($img)) {
                $randomName = uniqid() . ".$ext";
                move_uploaded_file($_FILES['photo']['tmp_name'], 'public/img/' . $randomName);
            } else {
                $randomName = 'no-photo.jpeg';
            }

            $member = new Member();
            $member->update([
                'company' => $_POST['company'],
                'position' => $_POST['position'],
                'about_me' => $_POST['about_me'],
                'photo_name' => $randomName
            ]);

            unset ($_SESSION["member_id"]);
            http_response_code(200);
        } else {
            http_response_code(422);
            returnJSON($errors);
        }

        return true;
    }
}