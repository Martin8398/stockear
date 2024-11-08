<?php
require_once './app/controllers/itemController.php';

class itemView {


    public function error($error = ''){
        require './templates.error.phtml';
    }
}