<?php

namespace App\Controller;

use App\DB\Connector;
use Symfony\Component\HttpFoundation\Response;

session_start();

class MainController extends BaseController
{

    public function getAllAdd(): array
    {
        $con = new Connector();
        $data = $con->include()
            ->query("SELECT * FROM advertisement")
            ->fetchAll();
        return $data;
    }

    public function getAdd($id_advertisement): array
    {
        $con = new Connector();
        $infAdv = $con->include()->prepare("SELECT * FROM advertisement where id_advertisement = ?");
        $infAdv->execute([$id_advertisement,]);
        $adv = $infAdv->fetchAll();

        $telephone = $con->include()->prepare("SELECT `telephone` FROM `user` inner JOIN advertisement on advertisement.id_User = user.id_User WHERE `id_advertisement` = ?");
        $telephone->execute([$id_advertisement,]);
        $telephone_print = $telephone->fetch();
        $adv['telephone'] = $telephone_print;

        return $adv;
    }

    public function indexController(): Response
    {
        return $this->renderTemplate('index.php', ['data' => $this->getAllAdd()]);
    }

    public function place(): Response
    {
        return $this->renderTemplate('index2.php', ['data' => $this->getAllAdd()]);
    }

    public function card(array $parameters): Response
    {
        $id = $parameters['id'];
        return $this->renderTemplate('index1.php', ['data' => $this->getAdd($id)]);
    }

    public function sortCategor(): Response
    {
        $con = new Connector();
        $data = null;
        if (!empty($_POST)) {
            if (!empty($_POST['category'])) {
                if ($_POST['category'] != "Все категории") {
                    $search = $_POST['category'];
                    $query = "SELECT * FROM advertisement WHERE `charter` LIKE ?";
                    $params = ["%$search%"];
                    $stmt = $con->include()->prepare($query);
                    $stmt->execute($params);
                    $data = $stmt->fetchAll();
                } else {
                    $data = $con->include()
                        ->query("SELECT * FROM advertisement")
                        ->fetchAll();
                }
            }
        } else {
            $data = $con->include()
                ->query("SELECT * FROM advertisement")
                ->fetchAll();
        }

        return $this->renderTemplate('index.php', ['data' => $data]);
    }

    public function sortFind()
    {
        $con = new Connector();
        if (!empty($_POST)) {
            if ($_POST['find_ads'] != null) {
                $search = $_POST['find_ads'];
                $query = "SELECT * FROM advertisement WHERE `heading` LIKE ?";
                $params = ["%$search%"];
                $stmt = $con->include()->prepare($query);
                $stmt->execute($params);
                $data = $stmt->fetchAll();
            } else {
                $data = $con->include()
                    ->query("SELECT * FROM advertisement")
                    ->fetchAll();
            }
        } else {
            $data = $con->include()
                ->query("SELECT * FROM advertisement")
                ->fetchAll();
        }
        return $this->renderTemplate('index.php', ['data' => $data]);
    }

    public function sort()
    {
        $con = new Connector();
        if (!empty($_GET)) {
            if (!empty($_GET['namea'])) {
                if ($_GET['namea'] == 'от А до Я') {
                    $data = $con->include()
                        ->query("SELECT * FROM `advertisement` ORDER BY heading")
                        ->fetchAll();
                }
            } else {
                $data = $con->include()
                    ->query("SELECT * FROM advertisement")
                    ->fetchAll();
            }
            if (!empty($_GET['named'])) {
                if ($_GET['named'] == 'от Я до А') {
                    $data = $con->include()
                        ->query("SELECT * FROM `advertisement` ORDER BY heading DESC")
                        ->fetchAll();
                }
            }
            if (!empty($_GET['pricea'])) {
                if ($_GET['pricea'] == 'возрастание') {
                    $data = $con->include()
                        ->query("SELECT * FROM `advertisement` ORDER BY price")
                        ->fetchAll();
                }
            }
            if (!empty($_GET['priced'])) {
                if ($_GET['priced'] == 'убывание') {
                    $data = $con->include()
                        ->query("SELECT * FROM `advertisement` ORDER BY price DESC")
                        ->fetchAll();
                }
            }
        } else {
            $data = $con->include()
                ->query("SELECT * FROM advertisement")
                ->fetchAll();
        }
        return $this->renderTemplate('index.php', ['data' => $data]);
    }

    public function exitB()
    {
        if (!empty($_POST['but_exit'])) {
            session_unset();
            unset($_SESSION['logged']);
        }
        $this->place();
    }

    public function entrance()
    {
        $con = new Connector();
        if (!empty($_POST['users_log']) && !empty($_POST['users_pwd'])) {
            $logIN = $_POST['users_log'];
            $Password = $_POST['users_pwd'];
            $data = $con->include()->prepare("SELECT id_User, password, idaccessLevel FROM `user` WHERE email = ?");

            $data->execute([$logIN,]);

            $users_data = $data->fetch();

            if (!empty($users_data)) {
                if (password_verify($Password, $users_data['password'])) {
                    $_SESSION['id_User'] = $users_data['id_User'];
                    $_SESSION['idaccessLevel'] = $users_data['idaccessLevel'];
                    $_SESSION['logged'] = 1;
                    return $this->renderTemplate('index.php', ['data' => $this->getAllAdd()]);
                } else {
                    echo "<script>alert('Неправильный логин или пароль!')</script>";
                }
            } else {
                echo "<script>alert('Неправильный логин или пароль!')</script>";
            }
        }
        return $this->renderTemplate('index.php', ['data' => $this->getAllAdd()]);
    }

}