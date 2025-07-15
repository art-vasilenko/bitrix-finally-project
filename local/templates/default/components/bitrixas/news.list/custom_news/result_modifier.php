<?php 
if($_GET['theme']) {
    if(CModule::IncludeModule("iblock")) {
        $arFilter = array('IBLOCK_ID' => 6, 'ID' => $_GET['theme'], 'ACTIVE' => 'Y');
        $arSelect = array('ID', 'NAME');
        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        $arResult['THEME'] = $res->GetNext();
    } 
}
    if (!empty($_GET['theme'])) {
    $APPLICATION->SetTitle("Новости по теме" . ' ' . '"' . $arResult['THEME']['NAME'] . '"'); 
}
?>