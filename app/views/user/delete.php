<?php
/** @var array $sidebar - Меню */

/** @var array $user - Пользователь */


use app\lib\UserOperations;

?>

<div class="page">
    <div class="container">
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
                    <h2>Удаление пользователя</h2>
                    <form name="user_add_form" method="post">
                        <div class="auth_form">
                            <div class="alert alert-danger <?php if (empty($error_message)) : ?>hidden<?php endif; ?>">
                                <?php if (!empty($error_message)) : ?>
                                    <?= $error_message ?>
                                <?php endif; ?>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>