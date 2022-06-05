<?php

/** @var string $error_message - Текст ошибки */

?>

<div class="create_block">
    <h2 class="titleTop">Добавление категории</h2>
    <form name="create_form" method="post">
        <div class="create_form">
            <div class="alert">
                <?php if (!empty($errors)) : ?>
                    <?= $errors; ?>
                <?php endif; ?>
            </div>
            <div class="input_box">
                <label for="field_title">Название категории</label>
                <input type="text"
                       name="title"
                       id="field_title"
                       class="form-control"
                       maxlength="120"
                       placeholder="Введите название товара"
                       value="<?= !empty($_POST['title']) ? $_POST['title'] : '' ?>"
                >
            </div>
            <div class="input_box">
                <label for="field_user">Алиас</label>
                <input type="text"
                       name="alias"
                       id="field_user"
                       class="form-control"
                       maxlength="120"
                       placeholder="Введите алиас"
                       value="<?= !empty($_POST['alias']) ? $_POST['alias'] : '' ?>"
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
 