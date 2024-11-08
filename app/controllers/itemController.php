<?php
require_once './app/views/clientView.php';
require_once './app/models/clientModel.php';

class itemController
{

    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new itemModel();
        $this->view = new itemView();
    }

    public function getItems($req, $res)
    {

        if (isset($req->params->id)) {
            $id = $req->params->id;

            $item = $this->model->getItemById($id);

            if (!$item) {
                return $this->view->error('No existe un item con la id:' . $id);
            }
            $this->view->getItem($item);
        }
        $items = $this->getItems();
        return $this->view->getItems($items);
    }

    public function createItem($req, $res)
    {
        $fields = [
            'name' => 'Name input cannot be empty',
            'description' => 'description input cannot be empty',
            'price' => 'Price input cannot be empty',
            'category' => 'Category input cannot be empty',
            'stock' => 'Stock input cannot be empty',
        ];

        foreach ($fields as $field => $messajeError) {
            if (!isset($req->body->$field) || empty($req->body->$field)) {
                return $this->view->error($messajeError);
            }
        }

        $name = htmlspecialchars($req->body->name);
        $description = htmlspecialchars($req->body->descriprion);
        $price = htmlspecialchars($req->body->price);
        $category = htmlspecialchars($req->body->category);
        $stock = htmlspecialchars($req->body->stock);

        $item = $this->model->createItem($name, $description, $price, $category, $stock);

        if (!$item) {
            return $this->view->error('no se pudo crear el item');
        }

        $items = $this->model->getItems();
        return $this->view->getItems($items);
        header("location: " . BASE_URL);
    }

    public function updateItem($req, $res)
    {
        $fields = [
            'name' => 'Name input cannot be empty',
            'description' => 'description input cannot be empty',
            'price' => 'Price input cannot be empty',
            'category' => 'Category input cannot be empty',
            'stock' => 'Stock input cannot be empty',
        ];

        # field validations

        foreach ($fields as $field => $messajeError) {
            if (!isset($req->body->$field) || empty($req->body->$field)) {
                return $this->view->error($messajeError);
            }
        }

        # if true then

        $name = htmlspecialchars($req->body->name);
        $description = htmlspecialchars($req->body->descriprion);
        $price = htmlspecialchars($req->body->price);
        $category = htmlspecialchars($req->body->category);
        $stock = htmlspecialchars($req->body->stock);


        $this->model->updateItem($name,$description,$price,$category,$stock);

        
    }


    public function deleteItem($req, $res)
    {
        if (!isset($req->params->id)) {
            return $this->view->error('el item seleccionado no existe');
        }
        $id = $req->params->id;
        $this->model->deleteItem($id);
        header("location: " . BASE_URL);
    }
}
