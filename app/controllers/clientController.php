<?php

require_once './app/views/clientView.php';
require_once 'app/models/clientModel.php';

class clientController {
    
    private $model;
    private $view;

    public function __contruct(){
        $this -> model = new ClientModel();
        $this -> view = new ClientView();
    }

    public function getClients(){
        $clients = $this -> model -> getAllClients();
        $this -> view -> showClients($clients);
    }

    public function showClient($id){
        $client = $this -> model -> getClientById($id);

        if ($client) {
            
        }
    }

    
}

