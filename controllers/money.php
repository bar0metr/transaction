<?php
/**
 * Created by PhpStorm.
 * User: bar0metr
 * Date: 18.03.18
 * Time: 14:22
 */

// контролер
Class Controller_Money Extends Controller_Base
{

    // шаблон
    public $layouts = "first_layouts";

    // экшен
    function index()
    {
        session_start();
        if (isset($_SESSION['login'])) {
            $this->template->view('index');
        }
    }


    public function withdraw()
    {
        session_start();
        if (isset($_SESSION['login'])) {
            $summ = filter_input(INPUT_POST, 'summ', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $card = filter_input(INPUT_POST, 'card', FILTER_SANITIZE_NUMBER_INT);

            $user_id = $_SESSION['id'];
            $select = array(
                'where' => "id = '$user_id'"
            );

            $model = new Model_Money($select);
            $money = $model->getOneRow(); //получаем данные юзверя
            // извлекаем данные
            $model->fetchOne();

            $balance = $money['balance'];
            if ($balance > $summ) {
                if (is_numeric($summ)) {
                    $summ = floatval($summ);
                }
                if (is_float($summ)) {

                    $amount = $balance - $summ;
                    $model->balance = $amount;

                    $_SESSION['balance'] = $amount;
                    session_write_close();
                    // обновляем запись
                    $result = $model->update();
                }
            } else {
                $withdraw_status = "Мало средств";
            }
            if ($result == '1') {
                $withdraw_status = "ok";
            }
            $this->template->vars('withdraw_status', $withdraw_status);
            $this->template->vars('summ', $summ);
            $this->template->vars('card', $card);

            $this->template->view('success');
        }
    }
}