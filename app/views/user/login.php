<div class="page">
        <div class="auth_block">
            <h1 class="titleLogin">Авторизация</h1>
            <form name="auth_form" method="post">
                <div class="auth_form">
                    <div class="alert alert-danger <? if (empty($error_message)) : ?>hidden<?php endif; ?>">
                        <? if (!empty($error_message)) : ?>
                            <?= $error_message ?>
                        <?php endif; ?>
                    </div>
                    <div class="input_box">
                        <label for="field_login">Логин</label>
                        <input type="text"
                               name="login"
                               id="field_login"
                               class="form-control"
                               maxlength="24"
                               value="<?= !empty($_POST['login']) ? $_POST['login'] : '' ?>"
                               placeholder="Введите логин"
                        >
                    </div>
                    <div class="input_box">
                        <label for="field_password">Пароль</label>
                        <input type="password"
                               name="password"
                               id="field_password"
                               class="form-control"
                               maxlength="24"
                               value=""
                               placeholder="Введите пароль"
                        >
                    </div>
                    <div class="links_box">
                        <a href="/user/registration">Регистрация</a>
                    </div>
                    <div class="button_box">
                        <button type="submit"
                                name="btn_login_form"
                                id="btnLoginForm"
                                class="btn btn-primary"
                                value="1"
                        >Войти
                        </button>
                    </div>
                </div>
            </form>
        </div>
</div>
