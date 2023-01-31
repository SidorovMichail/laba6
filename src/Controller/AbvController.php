<?php

namespace App\Controller;

use App\DB\Connector;
use Symfony\Component\HttpFoundation\Response;

class AbvController extends BaseController
{
    public function getAdd($id_advertisement): array
    {
        $con = new Connector();
        $infCard = $con->include()->prepare("SELECT * FROM advertisement where id_advertisement = ?");
        $infCard->execute([$id_advertisement,]);
        $card = $infCard->fetchAll();

        $telephone = $con->include()->prepare("SELECT `telephone` FROM `user` inner JOIN advertisement on advertisement.id_User = user.id_User WHERE `id_advertisement` = ?");
        $telephone->execute([$id_advertisement,]);
        $telephone_print = $telephone->fetch();
        $card['telephone'] = $telephone_print;

        return $card;
    }

    public function respond(array $parameters)
    {
        $con = new Connector();
        $data = $con->include()->prepare("SELECT * FROM `application` WHERE id_User = ? AND id_advertisement = ?");

        $data->execute([$_SESSION['id_User'], $parameters['idAbv']]);

        $users_adv = $data->fetch();

        if ($users_adv == null) {
            $query = ("INSERT INTO `application` (`id_User`, `id_advertisement`, `applicationData`, `applicationTime`) VALUES (:id_User, :id_advertisement, :date_, :time_)");
            $params = [
                ':id_User' => $_SESSION['id_User'],
                ':id_advertisement' => $parameters['idAbv'],
                ':date_' => date("Y-m-d"),
                ':time_' => date("H:i:s")
            ];
            $stmt = $con->include()->prepare($query);
            $stmt->execute($params);
            echo "<script> alert('Вы откликнулись!'); </script>";
        } else {
            echo "<script>alert('Вы уже откликнулись на это объявление!');</script>";
        }
        return $this->renderTemplate('index1.php', ['data' => $this->getAdd($parameters['idAbv'])]);
    }


}