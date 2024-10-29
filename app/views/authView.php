<?php

require_once './app/controllers/userController.php';

class authView
{

    public function error($error = ''){
        require './templates.error.phtml';
    }
}
