<?php

/** @var array $sidebar - Меню */
/** @var array $coming - Товар */

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
            <h2>Редактирование прихода</h2>
            <form method="post" name="coming-add-form">
                <div class="coming-add-form">
                    <div class="alert alert-danger">
                        <?php if (!empty($error_message)) : ?>
                            <?= $error_message ?>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (!empty($coming)) : ?>
                    <div class="input_box">
                        <label for="field_title">Название товара</label>
                        <input type="text"
                               name="coming[title]"
                               id="field_title"
                               class="form-control"
                               placeholder="Введите название товара"
                               max length="255"
                               value="<?= !empty($_POST['coming']['title']) ? $_POST['coming']['title'] : (!empty($coming['title']) ? $coming['title'] : '') ?>"
                        >
                    </div>
                    <div class="input_box">
                        <label for="field_user">Пользователь</label>
                        <input type="text"
                               name="coming[user]"
                               id="field_user"
                               class="form-control"
                               placeholder="Введите пользователя"
                               value="<?= !empty($_POST['coming']['user']) ? $_POST['coming']['user'] : (!empty($coming['user']) ? $coming['user'] : '') ?>"
                               max length="120"
                        >
                    </div>
                    <div class="input_box">
                        <label for="field_count">Количество</label>
                        <input type="text"
                               name="coming[count]"
                               id="field_count"
                               class="form-control"
                               placeholder="Введение количества товара"
                               value="<?= !empty($_POST['coming']['count']) ? $_POST['coming']['count'] : (!empty($coming['count']) ? $coming['count'] : '') ?>"
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
