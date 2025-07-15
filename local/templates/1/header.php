<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?echo LANG_CHARSET;?>">
<? $APPLICATION->ShowHead() ?>
<? $APPLICATION->ShowMeta("description"); ?>
<? $APPLICATION->ShowCSS(); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
<title><?$APPLICATION->ShowTitle()?></title>
</head>
<body>
<div id="panel">
    <? $APPLICATION->ShowPanel(); ?> 
</div>
<header class="header">
	<a href="/">
		<img class="header_logo" src="/upload/images/logo.png" alt="logo">
	</a>
    <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"horizontal_multilevel", 
	array(
		"ROOT_MENU_TYPE" => "top",
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "menu_infoblock",
		"USE_EXT" => "Y",
		"ALLOW_MULTI_SELECT" => "Y",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"DELAY" => "N",
		"COMPONENT_TEMPLATE" => "horizontal_multilevel"
	),
	false
);?>
</header>