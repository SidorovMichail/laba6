<?php
function header_site()
{ ?>
    <link rel="stylesheet" href="css/main.css">

    <div class='nav'>

    <a href='/ASvito'>
        <img src='/img/logo.png' class='logo'>
    </a>
    <img src='/img/loc.png' class='loc'>
    <p class='city'>Липецк </p>

    <ul class='menu'>

    <li><a href='/place' id="addAdvertisement0">
            Разместить объявление
        </a>
    </li>
    <?php if (empty($_SESSION['logged'])) { ?>
    <li>
        <button type='button' id='Button_Reg'>Регистрация</button>
    </li>
    <li>
        <button type='button' id='Button_Enter'>Вход</button>
    </li>
    </ul>

    <button class='menu-open'>
        <img src='/img/menu.svg'>
    </button>
    </div>
<?php } else { ?>
    <li><a href='/account'>
            Личный кабинет
        </a>
    </li>
    <li>
        <form method='POST' action="/exit">
            <button type='submit' name='but_exit' value='exit' id='Button_Exit'>Выход</button>
        </form>
    </li>
    </ul>

    <button class='menu-open'>
        <img src='img/menu.svg'>
    </button>
    </div>
<?php }
} ?>