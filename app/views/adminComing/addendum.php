<?php

/** @var string $error_message - Текст ошибки */

?>

<div class="create_block">
    <h2 class="titleTop">Добавление товара</h2>
    <form name="create_form" method="post">
        <div class="create_form">
            <div class="alert">
                <?php if (!empty($errors)) : ?>
                    <?= $errors; ?>
                <?php endif; ?>
            </div>
            <div class="input_box">
                <label for="field_title">название товара</label>
                <input type="text"
                       name="title"
                       id="field_title"
                       class="form-control"
                       maxlength="120"
                       placeholder="Введите Название товара"
                       value="<?= !empty($_POST['title']) ? $_POST['title'] : '' ?>"
                >
            </div>
            <div class="input_box">
                <label for="field_user">Пользователь</label>
                <input type="text"
                       name="user"
                       id="field_user"
                       class="form-control"
                       maxlength="120"
                       placeholder="Введите пользователя"
                       value="<?= !empty($_POST['user']) ? $_POST['user'] : '' ?>"
                >
            </div>
            <div class="input_box">
                <label for="field_count">Количество</label>
                <input type="text"
                       name="count"
                       id="field_count"
                       class="form-control"
                       maxlength="24"
                       placeholder="Введите количество товаров"
                       value="<?= !empty($_POST['count']) ? $_POST['count'] : '' ?>"
                >
            </div>
            <div class="button_box">
                <button type="submit"
                        name="btn_addendum_form"
                        id="btnAddendumForm"
                        class="btn btn-primary"
                        value="1"
                >Добавить
                </button>
            </div>
        </div>
    </form>
</div>
 