<?php

namespace App\Controller;
session_start();

use App\DB\Connector;

class AddAbv extends BaseController
{
    function add()
    {
        $con = new Connector();
        $dbh = $con->include();
        var_dump($this->request->request);
        $id_User = $_SESSION['id_User'];
        $heading = $this->request->request->get('guruweba_example_text_addHeading');
        $price = $this->request->request->get('guruweba_example_text_addPrise');
        $description = $this->request->request->get('addOpes');
        $photo = "img/" . basename($_FILES['file']['name']);
        $chapter = $this->request->request->get('category');
        if (empty($chapter))
            $chapter = "Другое";

        $uploadfile = "img/" . basename($_FILES['file']['name']);
        $types = array('image/png', 'image/jpeg', 'image/jpg');

        if (!in_array($_FILES['file']['type'], $types)) {
            echo "<script> alert('Запрещенный тип файла! Формат должен быть jpeg, png или jpg!')</script>";
            die();
        }

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
            $query = "INSERT INTO `advertisement` (`id_User`, `heading`, `price`,
                             `description`, `photo`, `charter`)
    VALUES (:id_User,:heading,:price,:description,:photo,:chapter)";
            $params = [
                ':id_User' => $id_User,
                ':heading' => $heading,
                ':price' => $price,
                ':description' => $description,
                ':photo' => $photo,
                ':chapter' => $chapter
            ];
            $stmt = $dbh->prepare($query);
            $stmt->execute($params);
        } else {
            echo "Возможная атака с помощью файловой загрузки!\n";
        }
        header("Location: http://lab2-main/index.php");
        exit();
    }
}