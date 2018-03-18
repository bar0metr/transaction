<?php
/**
 * Created by PhpStorm.
 * User: bar0metr
 * Date: 18.03.18
 * Time: 16:59
 */

if (isset($_SESSION['login'])): ?>

    <?php if ($withdraw_status == 'ok') { ?>
        <h2>Поздравляем! Вы успешно перевели средства в размере <?php echo $summ ?> на карту <?php echo $card ?></h2>
        <div class="admbutblock">
            <a class="admpanelbutton" href="/auth">Вернуться в личный кабинет</a>
        </div>

        <?php
    } else {
        ?>
        <h2>Ошибка перевода срадств в размере <?php echo $summ ?> на карту <?php echo $card ?></h2><br>
        Причина: <?php echo $withdraw_status ?>

        <?php
    };
    ?>
<?php
endif; ?>