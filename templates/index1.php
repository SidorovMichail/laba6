<?php
require_once __DIR__ . "/../public/header.php";
require_once __DIR__ . "/../public/footer.php";
require_once __DIR__ . "/../public/modal.php";
session_start();
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/stayl.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Детали</title>
</head>
<body>
<header id="header" class="header">
    <div class="container">
        <?php header_site(); ?>
    </div>
</header>

<section>
    <div class="container">
        <div class="description">

            <div class="photoDescription">
                <h4><?php echo $params['data'][0]['heading']; ?></h4>
                <img src="/<?php echo $params['data'][0]['photo']; ?>" alt="Rectangle5" class="adve">
            </div>
            <div class="Information">
                <div class="InformationBut">

                    <h4><?php echo $params['data'][0]['price']; ?> ₽</h4>
                    <button class="button Telephone">
            <span>Телефон: <br>
              <?php
              if (empty($_SESSION['logged'])) {
                  echo "+7-xxx-xxx-xx-xx";
              } else {
                  echo $params['data']['telephone']['telephone'];
              }
              ?>
          </span>
                    </button>

                    <form method="POST" action="/respond/<?php echo $params['data'][0]['id_advertisement'] ?>">
                        <?php
                        if (!empty($_SESSION['id_User'])) {
                            if ($_SESSION['id_User'] != $params['data'][0]['id_User']) { ?>
                                <button type="submit" name="respond" class="button Respond" value="1"
                                        style="width:500px">
                                    <span>Откликнуться</span>
                                </button>
                            <?php }
                        } ?>
                    </form>
                    <p class="text" style="color:black">
                        <?php echo $params['data'][0]['description']; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="listResponders">
        </div>
    </div>
</section>
<?php modal_windows(); ?>
<?php footer_site(); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="/js/main.js"></script></body>
</html>
