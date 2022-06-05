<?php
/** @var array $sidebar - Меню */
/** @var array $user - Пользователь */


use app\lib\UserOperations;
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
                    <h2>Редактирование пользователя</h2>
                    <form name="user_add_form" method="post">
                        <div class="auth_form">
                            <div class="alert alert-danger <?php if (empty($error_message)) : ?>hidden<?php endif; ?>">
                                <?php if (!empty($error_message)) : ?>
                                    <?= $error_message ?>
                                <?php endif; ?>
                            </div>
			                <?php if (!empty($user)) : ?>
                                <div class="input_box">
                                    <label for="field_username">Имя</label>
                                    <input type="text"
                                           name="user[username]"
                                           id="field_username"
                                           class="form-control"
                                           maxlength="120"
                                           value="<?=$user['username'] ?>"
                                           placeholder="Введите имя"
                                    >
                                </div>
                                <div class="input_box">
                                   <label for="field_login">Логин</label>
                                   <input type="text"
                                        name="user[login]"
                                        id="field_login"
                                        class="form-control"
                                        maxlength="24"
                                        value="<?= $user['login'] ?>"
                                        placeholder="Введите логин"
                                    >
                                </div>
                            <div class="input_box">
                                <label for="field_login">1(администратор) или 0(пользователь)</label>
                                <input type="text"
                                       name="user[is_admin]"
                                       id="field_login"
                                       class="form-control"
                                       maxlength="24"
                                       value="<?= $user['is_admin'] ?>"
                                       placeholder="Введите 1 или 0"
                                >
                            </div>
                                <div class="button_box">
                                  <button type="submit"
                                          name="btn_user_edit_form"
                                          id="btnUserEditForm"
                                          class="btn btn-primary"
                                          value="1"
                                  >Редактировать</button>
                                <div>
			                <?php endif;?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
