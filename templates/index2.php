<?php
require_once __DIR__ . "/../public/header.php";
require_once __DIR__ . "/../public/modal.php";
require_once __DIR__ . "/../public/footer.php";
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
    <link rel="stylesheet" href="/css/stayl.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Добавление</title>
</head>
<body>
<header id="header" class="header">
    <div class="container">
        <?php header_site(); ?>
    </div>
</header>

<section>
    <div class="container">
        <form class="container" action="/add" method="post" name="add" enctype="multipart/form-data">
            <div class="description">
                <div class="photoDescription">

                    <img id="img-preview" type="file" src="/img/addFoto.png" alt="Rectangle5" class="adve">

                    <div class="upload_form">
                        <label>
                            <input name="file" id="img" type="file" class="main_input_file" accept="image/*"/>
                            <div>Обзор...</div>
                            <input class="f_name" type="text" id="f_name" value="Добавить фото." disabled/>
                        </label>
                    </div>

                </div>
                <div class="Information">
                    <div class="InformationBut">
                        <div style="margin-top: 35px;">
                            <p>Добавить заголовок:</p>
                            <input name="guruweba_example_text addHeading" type="text" class="addZag"/>
                        </div>
                        <div>
                            <p>Добавить цену:</p>
                            <input name="guruweba_example_text addPrise" type="text" class="addZag"/>
                        </div>
                        <div>
                            <select name="category">
                                <option value="" selected disabled hidden>Категории</option>
                                <option>Транспорт</option>
                                <option>Животные</option>
                                <option>Недвижимость</option>
                                <option>Другое</option>
                            </select>
                        </div>
                        <div>
                            <p>Добавить описание:</p>
                            <textarea class="addOpes" name="addOpes"></textarea>
                        </div>
                        <div class="publish">
                            <button type="submit" name="button" class="button Add" id="ref">
                                <span>Опубликовать</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?php footer_site(); ?>
<?php modal_windows(); ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="../public/js/main.js"></script>
<script>
    $(document).ready(function () {

        $(".main_input_file").change(function () {

            var f_name = [];

            for (var i = 0; i < $(this).get(0).files.length; ++i) {

                f_name.push($(this).get(0).files[i].name);

            }

            $("#f_name").val(f_name.join(", "));
        });
    });
</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<script>
    $('#img').change(function () {
        var input = $(this)[0];
        if (input.files && input.files[0]) {
            if (input.files[0].type.match('image.*')) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#img-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                console.log('ошибка, не изображение');
            }
        } else {
            console.log('Возникли проблемы');
        }
    });

    $('#reset-img-preview').click(function () {
        $('#img').val('');
        $('#img-preview').attr('src', 'default-preview.jpg');
    });

    $('#form').bind('reset', function () {
        $('#img-preview').attr('src', 'default-preview.jpg');
    });
</script>

</body>
</html>
