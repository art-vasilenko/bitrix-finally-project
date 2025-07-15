<?php
    if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

    class NewsDetailComponent extends CBitrixComponent
    {
        public function onPrepareComponentParams($arParams)
        {
            $arParams['IBLOCK_ID'] = (int)($arParams['IBLOCK_ID'] ?? 0);
            $arParams['ELEMENT_ID'] = (int)($arParams['ELEMENT_ID'] ?? 1);

            $arParams['DATE_CODE'] = trim($arParams['DATE_CODE'] ?? '');
            $arParams['DETAIL_TEXT_CODE'] = trim($arParams['DETAIL_TEXT_CODE'] ?? '');
            $arParams['TITLE_CODE'] = trim($arParams['TITLE_CODE'] ?? '');
            $arParams['PICTURE_CODE'] = trim($arParams['PICTURE_CODE'] ?? '');
            $arParams['ANNOUNCE_CODE'] = trim($arParams['ANNOUNCE_CODE'] ?? '');

            return $arParams;
        }

        public function executeComponent()
        {
            if (!\Bitrix\Main\Loader::includeModule("iblock")) {
                ShowError('iblock не установлен');
                return;
            }

            $this->getItem();
            $this->IncludeComponentTemplate();
        }

        private function getItem()
        {
            $elementId = $this->arParams['ELEMENT_ID'];

            if ($elementId <= 0) {
                ShowError('Не указан ID элемента');
                return;
            }

            $selectFields = ['ID', 'IBLOCK_ID', 'NAME', 'DETAIL_TEXT', 'PICTURE_CODE', 'PREVIEW_TEXT'];
            $filter = ['IBLOCK_ID' => $this->arParams['IBLOCK_ID'], 'ID' => $elementId];

            if (!empty($this->arParams['DATE_CODE'])) {
                $selectFields[] = 'PROPERTY_' . $this->arParams['DATE_CODE'];
            }

            if (!empty($this->arParams['DETAIL_TEXT_CODE'])) {
                $selectFields[] = 'PROPERTY_' . $this->arParams['DETAIL_TEXT_CODE'];
            }

            if (!empty($this->arParams['TITLE_CODE'])) {
                $selectFields[] = 'PROPERTY_' . $this->arParams['TITLE_CODE'];
            }

            if (!empty($this->arParams['ANNOUNCE_CODE'])) {
                $selectFields[] = 'PROPERTY_' . $this->arParams['ANNOUNCE_CODE'];
            }

            if (!empty($this->arParams['PICTURE_CODE'])) {
                $selectFields[] = 'PROPERTY_' . $this->arParams['PICTURE_CODE'];
            }

            $res = \CIBlockElement::GetList(
                [],
                $filter,
                false,
                false,
                $selectFields
            );

            if ($item = $res->GetNext()) {

                if (isset($item['PROPERTY_' . $this->arParams['TITLE_CODE'] . '_VALUE'])) {
                    $title = $item['PROPERTY_' . $this->arParams['TITLE_CODE'] . '_VALUE'];
                }

                if (isset($item['PROPERTY_' . $this->arParams['DETAIL_TEXT_CODE'] . '_VALUE'])) {
                    $detailText = $item['PROPERTY_' . $this->arParams['DETAIL_TEXT_CODE'] . '_VALUE'];
                }
                
                if (isset($item['PROPERTY_' . $this->arParams['DATE_CODE'] . '_VALUE'])) {
                    $dateFormatted = FormatDate('d.m.Y', MakeTimeStamp($item['PROPERTY_' . $this->arParams['DATE_CODE'] . '_VALUE']));
                }

                if (isset($item['PROPERTY_' . $this->arParams['ANNOUNCE_CODE'] . '_VALUE'])) {
                    $announce = $item['PROPERTY_' . $this->arParams['ANNOUNCE_CODE'] . '_VALUE'];
                }

                if (isset($item['PROPERTY_' . $this->arParams['PICTURE_CODE'] . '_VALUE'])) {
                    $detailPicture = $item['PROPERTY_' . $this->arParams['PICTURE_CODE'] . '_VALUE'];
                }

                $this->arResult['ITEM'] = [
                    'TITLE' => $title,
                    'DETAIL_TEXT' => $detailText,
                    'DATE_FMT' => $dateFormatted,
                    'DETAIL_PICTURE' => $detailPicture,
                    'ANNOUNCE' => $announce,

                ];
            } else {
                ShowError('Элемент не найден');
            }
        }
    }
?>