<?php
function modal_windows()
{
    ?>
    <div id="blackout" style="display:none"></div>
    <form id="windowEntrance" style="display:none" method="POST" action="/entrance">
        <p>Вход</p>
        <img src="/img/cross.png" class="cross">
        <input type="text" name="users_log" class="name" placeholder="Введите почту">

        <div class="textbox">
            <input type="password" name="users_pwd" class="pword" placeholder="Введите пароль">
        </div>
        <button type="submit" name="logInSubmit" id="logIN" class="newbut" value="1">Войти</button>
    </form>

    <form action="index.php" method="POST" id="form1">
        <div id="windowReg" style="display:none">

            <p>Регистрация</p>
            <img src="/img/cross.png" class="cross1">

            <input type="text" class="new_name" placeholder="Введите имя" name="userName">

            <div class="textbox">
                <input type="text" class="new_surname" placeholder="Введите фамилию" name="userSur">
            </div>

            <div class="textbox">
                <input type="text" class="new_patr" placeholder="Введите отчество" name="userPatron">
            </div>

            <div class="textbox">
                <input type="text" class="new_email" placeholder="Введите email" name="userEmail">
            </div>
            <div class="textbox">
                <input type="text" class="new_phone" placeholder="Введите телефон" name="userFone">
            </div>
            <div class="textbox">
                <input type="password" class="new_password" placeholder="Введите пароль" name="userPass">
            </div>
            <div class="textbox">
                <input type="password" class="new_password_again"
                       placeholder="Повторите пароль" name="userPassToo">
            </div>

            <div class="yes">
                <input type="checkbox" class="check_box">
                <p class="agree">Согласие на обработку данных</p>

            </div>
            <button type="submit" id="Register" class="newbut">Зарегистрироваться</button>
        </div>
        </div>
    </form>

<?php } ?>