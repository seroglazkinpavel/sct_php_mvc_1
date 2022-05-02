<?php
/** @var string $error_message - Текст ошибки */
?>
<div class="cabinet_sidebar">
    <?php if (!empty($sidebar)) : ?>
        <div class="menu_box">
            <ul>
                <?php foreach ($sidebar as $link): ?>
                    <li>
                        <a class="menuLink" href="<?= $link['link'] ?>"><?= $link['title'] ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>
<div class="create_block">
    <h2 class="titleTop">Редактирование товара</h2>
    <form name="create_form" method="post">
        <div class="create_form">
            <div class="alert">
                <?php if (!empty($errors)) : ?>
                    <?= $errors; ?>
                <?php endif; ?>
            </div>
            <!--<div class="celect_box">
 			<p>Категория</p>
                <select name="category_id">						
 				<?php if (!empty($categoriesList)): ?>
 					<?php foreach ($categoriesList as $category): ?>
 						<option value="<?= $category['id']; ?>">
 							<?= $category['title']; ?>
 						</option>						
 					<?php endforeach; ?>
 				<?php endif; ?>
 			</select>
            </div>-->
            <div class="input_box">
                <label for="field_title">Название товара</label>
                <input type="text"
                       name="product[title]"
                       id="field_title"
                       class="form-control"
                       maxlength="120"
                       placeholder="Введите Название товара"
                       value="<?= !empty($_POST['product']['title']) ? $_POST['product']['title'] : '' ?>"
                >
            </div>
            <div class="input_box">
                <label for="field_alias">Алиас</label>
                <input type="text"
                       name="product[alias]"
                       id="field_alias"
                       class="form-control"
                       maxlength="120"
                       placeholder="Введите алиас"
                       value="<?= !empty($_POST['product']['alias']) ? $_POST['product']['alias'] : '' ?>"
                >
            </div>
            <div class="input_box">
                <label for="field_price">Стоимость</label>
                <input type="text"
                       name="product[price]"
                       id="field_price"
                       class="form-control"
                       maxlength="24"
                       placeholder="Введите стоимость"
                       value="<?= !empty($_POST['product']['price']) ? $_POST['product']['price'] : '' ?>"
                >
            </div>
            <div class="celect_box">
                <p>Статус</p>
                <select name="product[status]">
                    <option value="1" selected="selected">Отображается</option>
                    <option value="0">Скрыт</option>
                </select>
            </div>
            <div class="input_box">
                <label for="field_depart">Отправляются</label>
                <input type="text"
                       name="product[depart]"
                       id="field_depart"
                       class="form-control"
                       maxlength="120"
                       placeholder="Введите как отправляются"
                       value="<?= !empty($_POST['product']['depart']) ? $_POST['product']['depart'] : '' ?>"
                >
            </div>
            <div class="input_box">
                <label for="field_article">Артикул</label>
                <input type="text"
                       name="product[article]"
                       id="field_article"
                       class="form-control"
                       maxlength="24"
                       placeholder="Введите артикул"
                       value="<?= !empty($_POST['product']['article']) ? $_POST['product']['article'] : '' ?>"
                >
            </div>
            <div class="input_box">
                <label for="field_grade">Класс</label>
                <input type="text"
                       name="product[grade]"
                       id="field_grade"
                       class="form-control"
                       maxlength="24"
                       placeholder="Введите класс"
                       value="<?= !empty($_POST['product']['grade']) ? $_POST['product']['grade'] : '' ?>"
                >
            </div>
            <div class="input_box">
                <label for="field_height">Высота</label>
                <input type="text"
                       name="product[height]"
                       id="field_height"
                       class="form-control"
                       maxlength="24"
                       placeholder="Введите высоту"
                       value="<?= !empty($_POST['product']['height']) ? $_POST['product']['height'] : '' ?>"
                >
            </div>
            <div class="input_box">
                <label for="field_img">Изображение товара</label>
                <input type="file"
                       name="product[img]"
                       id="field_img"
                       class="form-control"
                       maxlength="24"
                       placeholder="Введите изображение товара "
                       value="<?= !empty($_POST['img']) ? $_POST['img'] : '' ?>"
                >
            </div>

            <div class="celect_box">
                <p>Наличие на складе</p>
                <select name="product[status]">
                    <option value="1" selected="selected">Да</option>
                    <option value="0">Нет</option>
                </select>
            </div>
            <div class="button_box">
                <button type="submit"
                        name="btn_edit_product_form"
                        id="btnEditForm"
                        class="btn btn-primary"
                        value="1"
                >Редактировать
                </button>
            </div>
        </div>
    </form>
</div>
