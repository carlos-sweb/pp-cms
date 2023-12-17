<?php


class ControllerLogin extends Controller{

    public function login($fw){

        echo \Template::instance()->render('app/views/admin/login.htm');

    }

}