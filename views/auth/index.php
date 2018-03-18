<?php
/**
 * Created by PhpStorm.
 * User: bar0metr
 * Date: 18.03.18
 * Time: 15:43
 */
if (isset($_SESSION['login'])): ?>

    <script>
        $("#infopanel").html("<div class='okinf'>Панель управления</div>");
    </script>


    <div class="admbutblock">
        <a class="admpanelbutton" href="/money">Вывод средств</a>
    </div>

    <!-- После неверной авторизации \ не авторизации вообще -->
<?php else: ?>
    <h2>Авторизация в личном кабинете</h2>
    <form class="logincontainer" action="/auth/admin" method="post">
        <label>Имя пользователя</label><br><input class="linput" type="text" name="login"><br><br>
        <label>Пароль</label><br><input class="linput" type="password" name="password"><br>
        <label></label><input type="submit" value="Вход">
    </form>
<?php endif; ?>





