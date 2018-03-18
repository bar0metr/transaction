<?php
/**
 * Created by PhpStorm.
 * User: bar0metr
 * Date: 18.03.18
 * Time: 14:27
 */

Class Model_Auth Extends Model_Base
{

    public $id;
    public $login;
    public $pass;
    public $role;

    public function fieldsTable()
    {
        return array(

            'id' => 'Id',
            'login' => 'Login',
            'pass' => 'Pass',
            'role' => 'Role',

        );
    }

}