<?php
//var_dump($_SESSION['user']['username']);exit;
?>
<div class="makingOrder">
    <h2 class="makingOrderTitle">Корзина</h2>

    <?php if ($result): ?>

        <p>Заказ оформлен. Мы Вам перезвоним.</p>

    <?php else: ?>

        <p>Выбрано товаров: <?= $totalQuantity ?>, на сумму: <?= $totalPrice; ?>, руб</p>

        <div class="makingOrderWrap">

            <p>Для оформления заказа заполните форму. Наш менеджер свяжется с Вами.</p>
            <?php if (!empty($errors)): ?>
                <p class="errors"><?= $errors; ?></p>
            <?php endif; ?>
            <div class="makingOrderForm">
                <form action="" method="post">
                    <div>
                        <label for="forename">Имя:</label>
                        <input class="makingInput" id="forename" type="text" name="userName" placeholder=""
                               value="<?php if (isset($_SESSION['user']['username'])) {
                                   echo $_SESSION['user']['username'];
                               } else echo !empty($_POST['username']) ? $_POST['username'] : null; ?>">
                    </div>
                    <div>
                        <label for="tel">Телефон:</label>
                        <input class="makingInput" id="tel" type="tel" name="userPhone" placeholder=""
                               value="<?= !empty($_POST['userPhone']) ? $_POST['userPhone'] : null; ?>">
                    </div>
                    <div>
                        <label for="email">Email:</label>
                        <input class="makingInput" id="email" type="email" name="userEmail" placeholder=""
                               value="<?= !empty($_POST['userEmail']) ? $_POST['userEmail'] : null; ?>">
                    </div>
                    <input type="submit" name="submit" class="btn btn-default" value="Оформить">
                    <!--<button type="submit" name="submit">Оформить</button>-->
                </form>
            </div>
        </div>

    <?php endif ?>
</div>
