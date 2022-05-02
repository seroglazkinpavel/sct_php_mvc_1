<div class="userPanel">
    <div class="cabinet_sidebar">
        <?php if (!empty($sidebar)) : ?>
            <div class="menu_box">
                <ul>
                    <?php foreach ($sidebar as $link) : ?>
                        <li>
                            <a class="menuLink" href="<?= $link['link'] ?>"><?= $link['title'] ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
    <div class="productManagement">
        <h2 class="titleTop">Управление товарами</h2>
        <h3 class="listProduct">Удалить товар <span style="font-weight:100;">название: <?= $product['title']; ?></span>
        </h3>
        <p>Вы действительно хотите удалить товар?</p>
        <form method="post">

            <div class="alert alert-danger">
                <?php if (!empty($error_message)) : ?>
                    <?= $error_message ?>
                <?php endif; ?>
            </div>
            <div class="wrap_button">
                <div class="button_box">
                    <button type="submit"
                            name="btn_product_delete_form"
                            id="btnNewsDeleteForm"
                            class="btn btn-primary"
                            value="1"
                    >Yes
                    </button>
                </div>
                <br>
                <div class="button_box">
                    <button type="submit"
                            name="btn_product_notDelete_form"
                            id="btnNewsDeleteForm"
                            class="btn btn-primary"
                            value="1"
                    >not
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>