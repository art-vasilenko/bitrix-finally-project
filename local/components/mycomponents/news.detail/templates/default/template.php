<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<img class="line-head" src="/upload/images/Line.png" alt="">
<div class="container">
    <div class="path">
        <p class="path-text">Главная  /  <span class="gray-text"><?= $arResult['ITEM']['TITLE']; ?></span></p>
    </div>
    <h1 class="title"><?= $arResult['ITEM']['TITLE']; ?></h1>
    <div class="carts">
        <div class="cart_item">
            <p class="cart_time"><?= $arResult['ITEM']['DATE_FMT']; ?></p>
            <p class="cart_text"><span class="cart_text_bold"><?= strip_tags($arResult['ITEM']['TITLE']); ?></span></p>
            <div class="cart_text"><?= $arResult['ITEM']['DETAIL_TEXT']['TEXT']; ?></div>
            <a class="link-btn" href="/news/">
                <button class="cart_button">
                    <p class="btn-text">Назад к новостям</p> 
                    <img src="/upload/images/arrow_default.png" alt="Arrow" class="arrow">
                </button>
            </a>
        </div>
        <div class="cart_item">
            <img class="cart-img" src='/upload/images/<?=$arResult['ITEM']['DETAIL_PICTURE']?>'>
        </div>
    </div>
</div>