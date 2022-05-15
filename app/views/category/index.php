<?php

/** @var array $category - Категория */

?>
<?php if (!empty($error_message)): ?>
    <div style="margin: 20px auto;text-align:center;"><h2><?= $error_message; ?></h2></div>
<?php endif; ?>
<?php if (!empty($products)): ?>
    <section class="novelty" style="margin-top:20px">
        <div class="catalog-slider"><p><?= $category[0]['title'] ?></p>
            <hr>
        </div>
        <div class="grid">
            <?php foreach ($products as $product): ?>
                <div class="grid-itm">
                    <div class="grid-img"><a href="/product/list?alias=<?= $product['alias']; ?>"><img
                                    src="/app/web/images/<?= $product['img']; ?>" width="300" height="300"
                                    alt="chandler"></a></div>
                    <hr>
                    <div class="product_catalog">
                        <div class="catalog-item"><a
                                    href="/product/list?alias=<?= $product['alias']; ?>"><?= $product['title']; ?></a>
                        </div>
                        <ul class="catalog-item">
                            <li>Отправляется:</li>
                            <li><?= $product['depart']; ?></li>
                        </ul>
                        <ul class="catalog-item">
                            <li>К-во в упоковке:</li>
                            <li>1 шт.</li>
                        </ul>
                        <ul class="catalog-item">
                            <li class="catalog-item_price"><b><?= $product['price']; ?></b> руб.</li>
                            <li><a class="add-to-cart-link" href="/cart/add?id=<?= $product['id']; ?>"><img
                                            src="/app/web/images/pannier.png" alt="pannier"></a></li>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>