<?php

class Admin extends CtlBase{
    public function login($f3){
        // echo \Template::instance()->render('app/views/admin/login.htm');
        $this->render($f3);
    }
}
