<?php
/**
 * Created by PhpStorm.
 * User: bar0metr
 * Date: 18.03.18
 * Time: 14:29
 */

Class Model_Money Extends Model_Base
{

    public $id;
    public $balance;


    public function fieldsTable()
    {
        return array(

            'id' => 'Id',
            'balance' => 'Balance',


        );
    }

}