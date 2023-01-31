<?php
require_once __DIR__ . "/../public/header.php";
require_once __DIR__ . "/../public/footer.php";
require_once __DIR__ . "/../public/modal.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Объявления</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/main.css">

</head>
<body>
<header id="header" class="header">
    <div class="container">
        <?php header_site(); ?>
</header>

<section id="about" class="about">
    <div class="container">
        <h1>Удачный выбор для всех и для каждого</h1>
        <p class="p1">Найди свое среди тысячи товаров!</p>
        <a href="place">
            <button type="button" class="mainbut" id="addAdvertisement">
                Разместить объявление
            </button>
        </a>
    </div>
</section>

<section>
    <div class="container">
        <div id="fon"></div>
        <div id="load"></div>

        <form class="sort" method="GET" action="sort">
            Сортировать по: <strong>имени</strong>(<input type="submit" name="namea" value="от А до Я">/<input
                    type="submit" name="named" value="от Я до А">)<strong> цене</strong>(<input type="submit"
                                                                                                name="pricea"
                                                                                                value="возрастание">/<input
                    type="submit" name="priced" value="убывание">)
        </form>
        <div class="search">
            <form class="search1" method="POST" action="sortCategor" name="form">

                <select name="category" onchange="this.form.submit()">
                    <option value="sort" selected disabled hidden>Категории</option>
                    <option>Все категории</option>
                    <option>Транспорт</option>
                    <option>Животные</option>
                    <option>Недвижимость</option>
                    <option>Другое</option>
                </select>
            </form>
            <form class="search2" method="POST" action="sortFind">
                <input name="find_ads" type="text" class="search_line" placeholder="Поиск по объявлениям...">
                <input type="image" class="find" src="img/find.png">

            </form>
        </div>
        <div class="cards">
            <?php

            foreach ($params['data']

            as $k => $v) {
            $id = $v['id_advertisement'];
            ?>
            <a href="index1.php">
                <a href="/card/<?php echo $id ?>">
                    <?php echo
                        '<div class ="card">
						<div class = "inside">
							<p>' . $v['heading'] . '</p>
							<img class="img1" src="' . $v['photo'] . '" >
							<p>' . $v['price'] . '₽</p>
						</div>
						<img src="img/card.png" class ="imgcard">
					</div>
					</a>';
                    }
                    ?>
        </div>
    </div>
</section>
</body>
<?php modal_windows(); ?>
<?php footer_site(); ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>