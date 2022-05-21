<?php

/** @var array $brands -  Бренды*/
/** @var array $hits - Новинки */

?>
<section>
    <div class="runner"><img src="/app/web/images/1963.jpg"></div>
    <div class="benefit">
        <div class="privilege">
            <div class="col-1">
                <img src="/app/web/images/material.png" width="80" height="82" alt="material">
            </div>
            <div class="col-2">
                <p class="material">КАЧЕСТВЕННЫЙ<br>ПОСАДОЧНЫЙ МАТЕРИАЛ</p>
                <p>Все растения перед отправкой<br>проходят тщательный отбор</p>
            </div>
        </div>
        <div class="privilege">
            <div class="col-1">
                <img src="/app/web/images/packaging.png" width="80" height="82" alt="packaging">
            </div>
            <div class="col-2">
                <p class="packaging">НАДЕЖНАЯ УПАКОВКА</p>
                <p>Используем современные технологии<br>упаковки и хранения посадочного материала</p>
            </div>
        </div>
        <div class="privilege">
            <div class="col-1">
                <img src="/app/web/images/assortment.png" width="80" height="82" alt="assortment">
            </div>
            <div class="col-2">
                <p class="assortment">БОЛЬШОЙ АССОРТИМЕНТ</p>
                <p>Предлогаем большой выбор<br>посадочного материала. Следим за<br>новинками.</p>
            </div>
        </div>
    </div>
</section>
<?php if ($brands): ?>
    <section class="brand">
        <div class="catalog-slider"><p>БРЕНДЫ</p>
            <hr>
        </div>
        <div class="home-demo">
            <div class="slider owl-carousel">
                <?php foreach ($brands as $brand): ?>
                    <div class="about-left">
                        <figure class="effect-bubba">
                            <img class="mg" src="/app/web/images/<?= $brand['img']; ?>">
                            <figcaption>
                                <h4><?= $brand['title']; ?></h4>
                                <p><?= $brand['description']; ?></p>
                            </figcaption>
                        </figure>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php if ($hits): ?>

    <section class="novelty">
        <div class="catalog-slider"><p>НОВИНКИ</p>
            <hr>
        </div>
        <div class="grid">
            <?php foreach ($hits as $hit): ?>
                <div class="grid-itm">
                    <div class="grid-img"><a href="product/list?alias=<?= $hit['alias']; ?>"><img
                                    src="/app/web/images/<?= $hit['img']; ?>" width="300" height="300"
                                    alt="chandler"></a></div>
                    <hr>
                    <div class="product_catalog">
                        <div class="catalog-item"><a
                                    href="product/list?alias=<?= $hit['alias']; ?>"><?= $hit['title']; ?></a></div>
                        <ul class="catalog-item">
                            <li>Отправляется:</li>
                            <li><?= $hit['depart']; ?></li>
                        </ul>
                        <ul class="catalog-item">
                            <li>К-во в упоковке:</li>
                            <li>1 шт.</li>
                        </ul>
                        <ul class="catalog-item">
                            <li class="catalog-item_price"><b><?= $hit['price']; ?></b> руб.</li>
                            <li><a class="add-to-cart-link" href="cart/add?id=<?= $hit['id']; ?>"><img
                                            src="/app/web/images/pannier.png" alt="pannier"></a></li>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>