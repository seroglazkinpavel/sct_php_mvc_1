<?php

/** @var array $sidebar -Меню  */
/** @var array $news - Новость */

?>

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
                    <h2>Удаление новости</h2>
                    <form method="post" name="news-add-form">
                        <div class="news-add-form">
                            <div class="alert alert-danger <?php if (empty($error_message)) : ?>hidden<?php endif; ?>">
                                <?php if (!empty($error_message)) : ?>
                                    <?= $error_message ?>
                                <?php endif; ?>
                            </div>
							<p>Вы действительно хотите удалить новость <?= $news['title']?></p>
                            <div class="wrap_button">
                                <div class="button_box">
                                    <button type="submit"
                                            name="btn_news_delete_form"
                                            id="btnNewsDeleteForm"
                                            class="btn btn-primary"
                                            value="1"
                                    >Yes
                                    </button>
                                </div>
                                <br>
                                <div class="button_box">
                                    <button type="submit"
                                            name="btn_news_notDelete_form"
                                            id="btnNewsDeleteForm"
                                            class="btn btn-primary"
                                            value="1"
                                    >not
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
