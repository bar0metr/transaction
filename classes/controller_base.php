<?php
/**
 * Created by PhpStorm.
 * User: bar0metr
 * Date: 18.03.18
 * Time: 17:26
 */

// абстрактый класс контроллера
Abstract Class Controller_Base
{

    public $vars = array();
    protected $registry;
    protected $template; // шаблон
    protected $layouts;

    // в конструкторе подключаем шаблоны

    function __construct()
    {
        // шаблоны
        $this->template = new Template($this->layouts, get_class($this));
    }

    abstract function index();

}
