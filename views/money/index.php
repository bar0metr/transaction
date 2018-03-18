<?php
/**
 * Created by PhpStorm.
 * User: bar0metr
 * Date: 18.03.18
 * Time: 15:27
 */

if (isset($_SESSION['login'])): ?>

    <h2>Вывод средств</h2>
    <form class="logincontainer" action="/money/withdraw" method="post">
        <label>Сумма для вывода</label><br><input class="summ" type="text" name="summ"><br><br>
        <label>Номер карты</label><br><input class="summ" type="text" name="card"><br>
        <label></label><input type="submit" value="Вывести">
    </form>


    <div class="admbutblock">
        <a class="admpanelbutton" href="/auth">Вернуться в личный кабинет</a>
    </div>

<?php
endif; ?>