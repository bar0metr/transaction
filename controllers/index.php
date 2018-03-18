<?php
/**
 * Created by PhpStorm.
 * User: bar0metr
 * Date: 18.03.18
 * Time: 14:19
 */

// контролер
Class Controller_Index Extends Controller_Base
{

    // шаблон
    public $layouts = "first_layouts";

    // экшен
    function index()
    {
        $this->template->view('index');
    }

}