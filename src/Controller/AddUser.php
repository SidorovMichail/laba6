<?php

namespace App\Controller;

use App\DB\Connector;
use Symfony\Component\HttpFoundation\JsonResponse;

class AddUser extends BaseController
{
    function add(): JsonResponse
    {
        $con = new Connector();
        $dbh = $con->include();

        $telephone = htmlspecialchars($this->request->request->get('userFone'));
        $name = htmlspecialchars($this->request->request->get('userName'));
        $surname = htmlspecialchars($this->request->request->get('userSur'));
        $patronymic = htmlspecialchars($this->request->request->get('userPatron'));
        $email = htmlspecialchars($this->request->request->get('userEmail'));
        $password = password_hash($this->request->request->get('userPass'), PASSWORD_BCRYPT);
        $registrationDate = date("Y-m-d");
        $token = "aasdasqwzcWA";
        $id_accessLevel = 2;

        $query = "INSERT INTO `user` 
    ( `telephone`, `name`, `surname`, `patronymic`, 
     `email`, `password`, `registrationDate`, `token`, `idaccessLevel`) 
     VALUES (:telephone, :name, :surname, :patronymic, 
             :email, :password, :registrationDate, :token, :id_accessLevel)";
        $params = [
            ':telephone' => $telephone,
            ':name' => $name,
            ':surname' => $surname,
            ':patronymic' => $patronymic,
            ':email' => $email,
            ':password' => $password,
            ':registrationDate' => $registrationDate,
            ':token' => $token,
            ':id_accessLevel' => $id_accessLevel
        ];
        $stmt = $dbh->prepare($query);
        $stmt->execute($params);

        return new JsonResponse(["errors" => $stmt->errorInfo()[2] == null ? null : $stmt->errorInfo()[2]]);
    }
}