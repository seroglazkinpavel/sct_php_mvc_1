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
                    <h2>Мой профиль</h2>
                    <div class="">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

