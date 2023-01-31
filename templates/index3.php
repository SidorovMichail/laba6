<?php
session_start();
if (empty($_SESSION['logged'])) {
    header("Refresh:0; url=ASvito");
    exit;
}
?>
<!doctype html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/stayl/.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <title>Личный кабинет</title>
  </head>
<body>
<header id = "header" class = "header">
    <div class = "container">

      <div class="nav">

          <a href="/">
          <img src="/img/logo.png" class="logo">
          </a>
          <img src="/img/loc.png" class = "loc">
          <p class = "city">Липецк </p>

          <ul class = "menu">

            <li><a href="/">
                Главная
              </a>
            </li>
            <li><a href="/place">
                Разместить объявление
              </a>
            </li>

            <li>
              <p class="name"> Здравствуйте, <?php  echo $params['data']['name']?></p>
            </li>
            <li>
              <form method = 'POST' action="/exit">
              <button type='submit' name = 'but_exit' value = 'exit' id = 'Button_Exit' style = "margin-top: 17px;">Выход</button>
            </form>
            </li>
          </ul>

          <button class="menu-open">
              <img src="../public/img/menu.svg">
          </button>
       </div>
    </div>
  </header>

  <section class = "ind3">
    	<div class = "container">
        <div class="about_user">
          <h1 class = "personal_information">Личная информация</h1>
          <p>Фамилия: <?php echo $params['data']['surname']?></p>
          <p>Имя: <?php  echo $params['data']['name']?></p>
          <p>Отчество: <?php echo $params['data']['patronymic']?></p>
          <p>Почта: <?php echo $params['data']['email']?></p>
          <p>Телефон: <?php echo $params['data']['telephone']?></p>
        </div>
      </div>
  </section>

<section class = "ind3">
    <div class = "container">
      <form class = "change_ads" method="POST" action="/my" name = "form">
          <input type="submit" class = "my_ads" name = "my_ads" value = "Мои объявления" id = "hello">
          <input type="submit" class = "my_ads" name = "my_ads" value = "Мои отклики">
      </form>
      <div class = "cards">
      <?php
        foreach ($params['data']['myAdv'] as $k => $v) {
          $id = $v['id_advertisement'];
             ?>
           <a href="/card/<?php echo $id ?>">
           <?php echo
          '<div class ="card">
            <div class = "inside">
              <p>'.$v['heading'].'</p>
              <img class="img1" src="'.$v['photo'].'" >
              <p>'.$v['price']. '₽</p>
            </div>
            <img src="img/card.png" class ="imgcard">
          </div>
          </a>';}
        ?>
      </div>
    </div>
  </section>

  <footer id = "footer">
    <div class="container">
      <div class ="text">
        <p class="mail">Разработчики:<br>
          miha11222211@mail.ru<br>
        </p>
        <p class="mail">
          Объявления.ru — сайт объявлений
        </p>
      </div>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="main.js"></script>
</body>
</html>
