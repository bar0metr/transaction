<?php
/**
 * Created by PhpStorm.
 * User: bar0metr
 * Date: 18.03.18
 * Time: 15:50
 */

// контролер
Class Controller_Auth Extends Controller_Base
{

    // шаблон
    public $layouts = "first_layouts";

    // экшен
    function index()
    {
        session_start();
        $user_id = $_SESSION['id'];
        $select = array(
            'where' => "id = '$user_id'"

        );

        $model = new Model_Money($select);
        $money = $model->getOneRow(); //получаем данные юзверя
        $_SESSION['balance'] = $money['balance'];
        session_write_close();
        $this->template->vars('money', $_SESSION['balance']);
        $this->template->view('index');
    }

    public function admin()
    {
        session_start();
        $userPass = $_POST['login']; //считываем из параметров логин и пасс юзера
        $userLogin = $_POST['password'];
        if (isset($userPass) and isset($userLogin)) {
            $md5pass = md5($userPass);
            $select = array(
                'where' => "login = '$userLogin' AND pass = '$md5pass'" // условие
            );
            $model = new Model_Auth($select); // создаем объект модели
            $auth = $model->getOneRow(); //получаем данные юзверя

            $_SESSION['login'] = $auth['login'];
            $_SESSION['id'] = $auth['id'];
            session_write_close();
        } else {
            $auth = false;

        }

        if (isset($_SESSION['login']) and ($auth != false)) { //если сессия успешна, передаем параметры авторизации на админку


            $this->template->vars('auth', $auth);
            $this->template->view('index');
        }
        header('Location: ../auth');
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ../');
        exit();
    }


}