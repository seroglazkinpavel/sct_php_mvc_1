<?php

/** @var array $sidebar - Меню */
/** @var array $category - Товар */

?>

<div class="cabinet_wrapper">
    <div class="cabinet_sidebar">
        <?php if (!empty($sidebar)) : ?>
            <div class="menu_box">
                <ul>
                    <?php foreach ($sidebar as $link) : ?>
                        <li>
                            <a href="<?= $link['link'] ?>"><?= $link['title'] ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
    <div class="cabinet_content">
        <div class="page-content-inner">
            <h2>Редактирование категории</h2>
            <form method="post" name="coming-add-form">
                <div class="coming-add-form">
                    <div class="alert alert-danger">
                        <?php if (!empty($error_message)) : ?>
                            <?= $error_message ?>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (!empty($category)) : ?>
                    <div class="input_box">
                        <label for="field_title">Название категории</label>
                        <input type="text"
                               name="category[title]"
                               id="field_title"
                               class="form-control"
                               placeholder="Введите название товара"
                               max length="255"
                               value="<?= $category['title'] ?>"
                        >
                    </div>
                    <div class="input_box">
                        <label for="field_user">Алиас</label>
                        <input type="text"
                               name="category[alias]"
                               id="field_user"
                               class="form-control"
                               placeholder="Введите алиас"
                               value="<?= $category['alias'] ?>"
                               max length="120"
                        >
                    </div>
                    <div class="button_box">
                        <button type="submit"
                                name="btn_coming_edit_form"
                                id="btnComingsEditForm"
                                class="btn btn-primary"
                                value="1"
                        >Добавить
                        </button>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
