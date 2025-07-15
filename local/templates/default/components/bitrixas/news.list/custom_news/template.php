<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<main class="main">
    <div class="container">
        <h2 class="news">
            Новости 
            <?php if($_GET['theme']): ?>
                по теме
                "<?=$arResult['THEME']['NAME']; ?>"
            <?php endif ?>
        </h2>
        <div class="carts">
            <?php
                foreach ($arResult['ITEMS'] as $post) :
            ?>
            <div class="cart_item">
                <p class="cart_time"><?= $post['PROPERTIES']['DATE']['VALUE'] ?></p>
                <p class="cart_title"><?= $post['PROPERTIES']['TITLE']['VALUE'] ?></p>
                <p class="cart_text"><?= $post['PROPERTIES']['ANNOUNCE']['VALUE'] ?></p>
                <a class="link-btn" href="/news/<?= $post['ID']?>/">
                    <button class="cart_button">
                        <p class="btn-text">Подробнее</p>
                        <img src="/upload/images/arrow_default.png" alt="Arrow" class="arrow">
                    </button>
                </a>
            </div>
             <?php
                endforeach;
            ?>
        </div>
        <?php  if($arParams['DISPLAY_BOTTOM_PAGER']): ?>
            <div class="pagination">
                <?= $arResult['NAV_STRING']; ?>
            </div>
        <? endif; ?>
    </div>
</main>