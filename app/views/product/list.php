<?php

/** @var array $product - Продукт */

?>
<section class="product_card">

    <div class="card">
        <div class="card_gallery">
            <div class="card_itm card_itm-1" style="margin-right:15px;">

                <img src="/app/web/images/<?= $product[0]['img']; ?>" alt="">

            </div>

            <div class="card_itm card_itm-2">
                <h2><?= $product[0]['title']; ?></h2>
                <ul class="">
                    <li>Артикул<span class="record"> <?= $product[0]['article']; ?></span></li>
                    <?php if ($product[0]['grade'] !== '') echo '<li>Класс: <span class="record">' . "{$product[0]['grade']}" . '</span></li>'; ?>
                    <?php if ($product[0]['height'] !== '') echo '<li>Высота: <span class="record">' . "{$product[0]['height']}" . '</span></li>'; ?>
                    <?php if ($product[0]['flower_size'] !== '') echo '<li>Размер цветка: <span class="record">' . "{$product[0]['flower_size']}" . '</span></li>'; ?>
                    <?php if ($product[0]['flowering_period'] !== '') echo '<li>Период цветения: <span class="record">' . "{$product[0]['flowering_period']}" . '</span></li>'; ?>
                    <?php if ($product[0]['landing_place'] !== '') echo '<li>Место посадки: <span class="record">' . "{$product[0]['landing_place']}" . '</span></li>'; ?>
                    <?php if ($product[0]['frost_resistance'] !== '') echo '<li>Морозостойкость: <span class="record">' . "{$product[0]['frost_resistance']}" . '</span></li>'; ?>
                    <?php if ($product[0]["depart"] !== '') echo '<li>Отправляется: <span class="record">' . "{$product[0]['depart']}" . '</span></li>'; ?>
                    <?php if ($product[0]['quantity_per_pack'] !== '') echo '<li>Кол-во в упаковке: <span class="record">' . "{$product[0]['quantity_per_pack']}" . '</span></li>'; ?>

                    <?php if ($product[0]['seedlings'] !== '') echo '<li>Рассада: <span class="record">' . "{$product[0]['seedlings']}" . '</span></li>'; ?>
                    <li><?= $product[0]['price']; ?> руб <a style="margin-left:60px;" class="add-to-cart-link"
                                                            href="/cart/add?id=<?= $product[0]['id']; ?>"><img
                                    src="/app/web/images/pannier.png" alt="pannier"></a></li>
                </ul>
                <hr>

            </div>
        </div>
    </div>
    <!--<div class="suggest">
        <section class="advise">
            <div class="catalog-slider"><p align="center">РЕКОМЕНДУЕМ</p><hr></div>
            <div class="grid_advise">
                <div class="grid-advise_itm">
                    <div class="grid-img"><a href="product/red pearl "><img src="images/20.jpg" width="300" height="300" alt="chandler"></a></div><hr>
                    <div class="product_catalog">
                        <div class="catalog-item"><a href="product/red pearl ">БРУСНИКА RED PEARL</a></div>
                        <ul class="catalog-item">
                            <li>Отправляется:</li>
                            <li>в контейнере<br>P9</li>
                        </ul>
                        <ul class="catalog-item">
                            <li>К-во в упоковке:</li>
                            <li>1 шт.</li>
                        </ul>
                        <ul class="catalog-item">
                            <li class="catalog-item_price"><b>$ 432</b></li>
                            <li><a class="add-to-cart-link" href="cart/add?id=1"><img src="images/pannier.png" alt="pannier"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="grid-advise_itm">
                    <div class="grid-img"><a href="product/nashville"><img src="images/22.jpg" width="300" height="300" alt="chandler"></a></div><hr>
                    <div class="product_catalog">
                        <div class="catalog-item"><a href="product/nashville">КАЛЛА NASHVILLE</a></div>
                        <ul class="catalog-item">
                            <li>Отправляется:</li>
                            <li>упаковкой</li>
                        </ul>
                        <ul class="catalog-item">
                            <li>К-во в упоковке:</li>
                            <li>1 шт.</li>
                        </ul>
                        <ul class="catalog-item">
                            <li class="catalog-item_price"><b>$ 158</b></li>
                            <li><a class="add-to-cart-link" href="cart/add?id=2"><img src="images/pannier.png" alt="pannier"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="grid-advise_itm">
                    <div class="grid-img"><a href="product/zenobia ZENOBIA"><img src="images/23.jpg" width="300" height="300" alt="chandler"></a></div><hr>
                    <div class="product_catalog">
                        <div class="catalog-item"><a href="product/zenobia ZENOBIA"> ФЛОКС ZENOBIA</a></div>
                        <ul class="catalog-item">
                            <li>Отправляется:</li>
                            <li>упаковкой</li>
                        </ul>
                        <ul class="catalog-item">
                            <li>К-во в упоковке:</li>
                            <li>1 шт.</li>
                        </ul>
                        <ul class="catalog-item">
                            <li class="catalog-item_price"><b>$ 158</b></li>
                            <li><a class="add-to-cart-link" href="cart/add?id=3"><img src="images/pannier.png" alt="pannier"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="grid-advise_itm">
                    <div class="grid-img"><a href="product/bordeaux "><img src="images/24.jpg" width="300" height="300" alt="chandler"></a></div><hr>
                    <div class="product_catalog">
                        <div class="catalog-item"><a href="product/bordeaux ">ЛАНДЫШ BORDEAUX</a></div>
                        <ul class="catalog-item">
                            <li>Отправляется:</li>
                            <li>упаковкой</li>
                        </ul>
                        <ul class="catalog-item">
                            <li>К-во в упоковке:</li>
                            <li>1 шт.</li>
                        </ul>
                        <ul class="catalog-item">
                            <li class="catalog-item_price"><b>$ 70</b></li>
                            <li><a class="add-to-cart-link" href="cart/add?id=4"><img src="images/pannier.png" alt="pannier"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>-->
</section>