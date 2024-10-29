<?php
require_once './app/models/model.php';
require_once './app/controllers/userController.php';

class userModel extends model {
    function __construct() {
        parent::__construct();
    }

    public function getUserName($user) {
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE username=?");
        $query->execute([$user]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}