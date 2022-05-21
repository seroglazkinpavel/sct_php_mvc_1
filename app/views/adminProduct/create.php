<?php
/** @var string $error_message - Текст ошибки */
?>
<!--<div class="page">
    <div class="container">-->
<div class="create_block">
    <h2 class="titleTop">Добавление товара</h2>
    <form name="create_form" method="post" enctype="multipart/form-data">
        <div class="create_form">
            <div class="alert">
                <?php if (!empty($errors)) : ?>
                    <?= $errors; ?>
                <?php endif; ?>
            </div>
            <div class="celect_box">
                <p>Категория</p>
                <select name="category_id">
                    <?php if (!empty($categoriesList)): ?>
                        <?php foreach ($categoriesList as $category): ?>
                            <option value="<?= $category['category_id']; ?>">
                                <?= $category['title']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="input_box">
                <label for="field_title">Название товара</label>
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
                <label for="field_alias">Алиас</label>
                <input type="text"
                       name="alias"
                       id="field_alias"
                       class="form-control"
                       maxlength="120"
                       placeholder="Введите алиас"
                       value="<?= !empty($_POST['alias']) ? $_POST['alias'] : '' ?>"
                >
            </div>
            <div class="input_box">
                <label for="field_price">Стоимость</label>
                <input type="text"
                       name="price"
                       id="field_price"
                       class="form-control"
                       maxlength="24"
                       placeholder="Введите стоимость"
                       value="<?= !empty($_POST['price']) ? $_POST['price'] : '' ?>"
                >
            </div>
            <div class="celect_box">
                <p>Статус</p>
                <select name="status">
                    <option value="1" selected="selected">Отображается</option>
                    <option value="0">Скрыт</option>
                </select>
            </div>
            <div class="input_box">
                <label for="field_depart">Отправляются</label>
                <input type="text"
                       name="depart"
                       id="field_depart"
                       class="form-control"
                       maxlength="120"
                       placeholder="Введите как отправляются"
                       value="<?= !empty($_POST['depart']) ? $_POST['depart'] : '' ?>"
                >
            </div>
            <div class="input_box">
                <label for="field_article">Артикул</label>
                <input type="text"
                       name="article"
                       id="field_article"
                       class="form-control"
                       maxlength="24"
                       placeholder="Введите артикул"
                       value="<?= !empty($_POST['article']) ? $_POST['article'] : '' ?>"
                >
            </div>
            <div class="input_box">
                <label for="field_grade">Класс</label>
                <input type="text"
                       name="grade"
                       id="field_grade"
                       class="form-control"
                       maxlength="24"
                       placeholder="Введите класс"
                       value="<?= !empty($_POST['grade']) ? $_POST['grade'] : '' ?>"
                >
            </div>
            <div class="input_box">
                <label for="field_height">Высота</label>
                <input type="text"
                       name="height"
                       id="field_height"
                       class="form-control"
                       maxlength="24"
                       placeholder="Введите высоту"
                       value="<?= !empty($_POST['height']) ? $_POST['height'] : '' ?>"
                >
            </div>
            <div class="input_box">
                <label for="field_img">Изображение товара</label>
                <input type="file"
                       name="img"
                       id="field_img"
                       class="form-control"
                       maxlength="24"
                       placeholder="Введите изображение товара "
                       value="<?= !empty($_POST['img']) ? $_POST['img'] : '' ?>"
                >
            </div>

            <div class="celect_box">
                <p>Наличие на складе</p>
                <select name="status">
                    <option value="1" selected="selected">Да</option>
                    <option value="0">Нет</option>
                </select>
            </div>
            <div class="button_box">
                <button type="submit"
                        name="btn_create_form"
                        id="btnCreateForm"
                        class="btn btn-primary"
                        value="1"
                >Добавить
                </button>
            </div>
        </div>
    </form>
</div>
<!--</div>
</div>-->