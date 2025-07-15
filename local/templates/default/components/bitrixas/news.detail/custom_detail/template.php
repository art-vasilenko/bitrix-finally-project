<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<img class="line-head" src="/upload/images/Line.png" alt="">
<div class="container">
    <div class="path">
        <p class="path-text">Главная  /  <span class="gray-text"><?= $arResult['PROPERTIES']['TITLE']['VALUE']; ?></span></p>
    </div>
    <h1 class="title"><?= $arResult['PROPERTIES']['TITLE']['VALUE']; ?></h1>
    <div class="carts">
        <div class="cart_item">
            <p class="cart_time"><?= $arResult['PROPERTIES']['DATE']['VALUE']; ?></p>
            <p class="cart_text"><span class="cart_text_bold"><?= $arResult['PROPERTIES']['ANNOUNCE']['VALUE']; ?></span></p>
            <div class="cart_text"><?= $arResult['PROPERTIES']['CONTENT']['VALUE']['TEXT']; ?></div>
            <a class="link-btn" href="/news/">
                <button class="cart_button">
                    <p class="btn-text">Назад к новостям</p> 
                    <img src="/upload/images/arrow_default.png" alt="Arrow" class="arrow">
                </button>
            </a>
        </div>
        <div class="cart_item">
            <img class="cart-img" src='/upload/images/<?=$arResult['PROPERTIES']['IMAGE']['VALUE']?>'>
        </div>
    </div>
    <div class="themes">
        <strong>Темы:</strong>
        <?php
            $themes = $arResult['DISPLAY_PROPERTIES']['THEMES']['DISPLAY_VALUE']; 
            if(is_string($themes)) {
                $themes = [$themes];
            }
            if(empty($themes)) {
                $themes = [$themes];
            }
            $res = implode(", ", $themes);
        ?>
        <div class="news-themes">
            <p><?= $res; ?></p> 
        </div>
    </div>
</div>