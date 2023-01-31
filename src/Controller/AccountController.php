<?php

namespace App\Controller;

use App\DB\Connector;
use PDO;
use Symfony\Component\HttpFoundation\Response;

session_start();

class AccountController extends BaseController
{
    public function account(): Response
    {
        $con = new Connector();
        $id_user = $_SESSION['id_User'];

        $about_user = $con->include()->prepare("SELECT * FROM user WHERE id_User = ?");
        $about_user->execute([$id_user,]);
        $inf = $about_user->fetch();

        if (!empty($_POST['my_ads'])) {
            if ($_POST['my_ads'] == "Мои объявления") {
                $infAdv = $con->include()->prepare("SELECT * FROM advertisement where 	id_User = ?");
                $infAdv->execute([$_SESSION['id_User'],]);
                $myAdv = $infAdv->fetchAll();
            } else {
                $data = $con->include()
                    ->prepare("SELECT * FROM advertisement INNER JOIN application on application.id_advertisement = advertisement.id_advertisement WHERE application.id_User = ?");
                $data->execute([$_SESSION['id_User'],]);
                $myAdv = $data->fetchAll();
            }
        } else {
            $infAdv = $con->include()->prepare("SELECT * FROM advertisement where 	id_User = ?");
            $infAdv->execute([$_SESSION['id_User'],]);
            $myAdv = $infAdv->fetchAll();
        }
        $inf['myAdv'] = $myAdv;
        return $this->renderTemplate('index3.php', ['data' => $inf]);
    }

}