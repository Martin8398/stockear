<?php

require_once './app/views/clientView.php';
require_once 'app/models/clientModel.php';

class clientController
{

    private $model;
    private $view;

    public function __contruct()
    {
        $this->model = new ClientModel();
        $this->view = new ClientView();
    }

    public function getClients()
    {
        $clients = $this->model->getAllClients();
        $this->view->showClients($clients);
    }

    public function showClient($id)
    {
        $client = $this->model->getClientById($id);

        if ($client) {
            $this->view->showClient($client);
        } else {
            echo "Client Not Found";
        }
    }

    public function addClient()
    {
        $fields = [
            'name' => 'name input cannot be empty',
            'lastName' => 'lastName input cannot be empty',
            'dni' => 'Dni input cannot be empty',
            'phone' => 'Phone input cannot be empty',
            'mail' => 'Mail input cannot be empty',
        ];

        # field validations

        foreach ($fields as $field => $messajeError) {
            if (!isset($_POST[$field]) || empty($_POST[$field])) {
                return $this->view->showError($messajeError);
            }
        }

        # if true then

        $name = htmlspecialchars($_POST['name']);
        $lastName = htmlspecialchars($_POST['lastName']);
        $dni = htmlspecialchars($_POST['dni']);
        $phone = htmlspecialchars($_POST['phone']);
        $mail = htmlspecialchars($_POST['mail']);


        # model call to create client

        $id = $this->model->addClient($name, $lastName,  $dni, $phone, $mail);

        header('Location: ' . BASE_URL . 'clients');
        exit;
    }
}
