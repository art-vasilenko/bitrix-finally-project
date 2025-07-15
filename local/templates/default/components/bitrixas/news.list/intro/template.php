<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="intro" style='background-image: url(/upload/images/<?=$arResult['ITEMS'][0]['PROPERTIES']['IMAGE']['VALUE']?>)'>
    <div class="ban">
        <h1><?=$arResult['ITEMS'][0]['PROPERTIES']['TITLE']['VALUE']?></h1>
        <p><?=$arResult['ITEMS'][0]['PROPERTIES']['ANNOUNCE']['VALUE']?></p>
    </div>
</div>