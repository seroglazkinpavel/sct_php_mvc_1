<div class="page">
    <div class="container">
        <div class="cabinet_wrapper">
            <div class="cabinet_sidebar">
                <?php if (!empty($sidebar)) :?>
                    <div class="menu_box">
                        <ul>
                            <?php foreach($sidebar as $link) :?>
                                <li>
                                    <a href="<?= $link['link']?>"><?= $link['title']?></a>
                                </li>
                            <?php endforeach?>
                        </ul>
                    </div>
                <?php endif;?>
            </div>
            <div class="cabinet_content">
                <div class="page-content-inner">
                    <h2>Добавление новости</h2>
                    <form method="post" name="news-add-form">
                        <div class="news-add-form">
                            <div class="alert alert-danger <?php if (empty($error_message)) : ?>hidden<?php endif; ?>">
                                <?php if (!empty($error_message)) : ?>
                                    <?= $error_message ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="input_box">
                            <label for="field_current_password">Наименование</label>
                            <input type="text"
                                   name="news[title]"
                                   id="field_title"
                                   class="form-control"
                                   placeholder="Введите наименование"
                                   max length="120"
                                   value="<?= !empty($_POST['news']['title']) ? $_POST['news']['title'] : ''?>"
                            >
                        </div>
                        <div class="input_box">
                            <label for="field_short_description">Краткое описание</label>
                            <input type="text"
                                   name="news[short_description]"
                                   id="field_short_description"
                                   class="form-control"
                                   placeholder="Введите краткое описание"
                                   value="<?= !empty($_POST['news']['short_description']) ? $_POST['news']['short_description'] : ''?>"
                                   max length="255"
                            >
                        </div>
                        <div class="input_box">
                            <label for="field_description">Описание</label>
                            <textarea name="news[description]"
                                      id="field_description"
                                      cols="50"
                                      rows="8"
                                      class="form-control"
                                      placeholder="Введение описания"
                            ><?= !empty($_POST['news']['description']) ? $_POST['news']['description'] : ''?></textarea>
                        </div>
                        <div class="button_box">
                            <button type="submit"
                                    name="btn_news_add_form"
                                    id="btnNewsAddForm"
                                    class="btn btn-primary"
                                    value="1"
                            >Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
