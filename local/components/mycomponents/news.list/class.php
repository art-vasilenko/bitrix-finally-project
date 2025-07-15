<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class NewsListComponent extends CBitrixComponent
{

    public function onPrepareComponentParams($arParams)
    {
        $arParams['IBLOCK_ID'] = (int)($arParams['IBLOCK_ID'] ?? 0);
        $arParams['PAGE_SIZE'] = (int)($arParams['PAGE_SIZE'] ?? 4);
        $arParams['VISIBLE_PAGES'] = (int)($arParams['VISIBLE_PAGES'] ?? 3);

        $arParams['INTRO_TEXT_CODE'] = trim($arParams['INTRO_TEXT_CODE']) ?? '';
        $arParams['INTRO_TITLE_CODE'] = trim($arParams['INTRO_TITLE_CODE'] ?? '');
        $arParams['PICTURE_CODE'] = trim($arParams['PICTURE_CODE'] ?? '');

        $arParams['DATE_CODE'] = trim($arParams['DATE_CODE']) ?? '';
        $arParams['ANNOUNCE_CODE'] = trim($arParams['ANNOUNCE_CODE']) ?? '';
        $arParams['TITLE_CODE'] = trim($arParams['TITLE_CODE']) ?? '';

        return $arParams;
    }

    public function executeComponent()
    {
        if (!\Bitrix\Main\Loader::includeModule("iblock"))
        {
            ShowError('iblock не установлен');
            return;
        }
        
        $this->getIntroItem();
        $this->getPosts();
        
        $this->IncludeComponentTemplate();
    }

    private function getIntroItem()
    {
        $selectFields = ['ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE'];
        $filter = ['IBLOCK_ID' => $this->arParams['IBLOCK_ID']];

        if (!empty($this->arParams['INTRO_TEXT_CODE'])) {
            $selectFields[] = 'PROPERTY_' . $this->arParams['INTRO_TEXT_CODE'];
        }

        if (!empty($this->arParams['INTRO_TITLE_CODE'])) {
            $selectFields[] = 'PROPERTY_' . $this->arParams['INTRO_TITLE_CODE'];
        }

        if (!empty($this->arParams['PICTURE_CODE'])) {
            $selectFields[] = 'PROPERTY_' . $this->arParams['PICTURE_CODE'];
        }

        $sortBy = ["PROPERTY_" . $this->arParams['DATE_CODE'] => "DESC"];
        
        $res = \CIBlockElement::GetList(
            $sortBy,
            $filter,
            false,
            ['nTopCount' => 1],
            $selectFields
        );

        if ($item = $res->GetNext()) {
            $introTitle = $item['NAME'];
            $introAnnounce = $item['PREVIEW_TEXT'];
            $introImage = '';
        }
        if (isset($item['PROPERTY_' . $this->arParams['INTRO_TITLE_CODE'] . '_VALUE'])) {
            $introTitle = $item['PROPERTY_' . $this->arParams['INTRO_TITLE_CODE'] . '_VALUE'];
        }

        if (isset($item['PROPERTY_' . $this->arParams['INTRO_TEXT_CODE'] . '_VALUE'])) {
            $introAnnounce = $item['PROPERTY_' . $this->arParams['INTRO_TEXT_CODE'] . '_VALUE'];
        }

        if (isset($item['PROPERTY_' . $this->arParams['PICTURE_CODE'] . '_VALUE'])) {
            $introImage = $item['PROPERTY_' . $this->arParams['PICTURE_CODE'] . '_VALUE'];
        }

        $this->arResult['INTRO'] = [
            'INTRO_TITLE' => $introTitle,
            'INTRO_ANNOUNCE' => $introAnnounce,
            'INTRO_IMAGE' => $introImage,
        ];
    }


    private function getPosts()
    {
        $page = (int)($_GET['page'] ?? 1);
        $total = \CIBlockElement::GetList(
            [],
            ['IBLOCK_ID' => $this->arParams['IBLOCK_ID']],
            [],
        );

        $pagesCnt = ceil($total / $this->arParams['PAGE_SIZE']);
        $page = max(1, min($page, $pagesCnt));
        // $offset = ($page - 1) * $this->arParams['PAGE_SIZE'];

        $selectFields = ['ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_TEXT', 'DATA_ACTIVE']; 

        $sortBy = ["PROPERTY_" . $this->arParams['DATE_CODE'] => "DESC"];
        
        if (!empty($this->arParams['ANNOUNCE_CODE'])) {
            $selectFields[] = 'PROPERTY_' . $this->arParams['ANNOUNCE_CODE'];
        }
        if (!empty($this->arParams['TITLE_CODE'])) {
            $selectFields[] = 'PROPERTY_' . $this->arParams['TITLE_CODE'];
        }


        $res = \CIBlockElement::GetList(
            $sortBy, 
            ['IBLOCK_ID' => $this->arParams['IBLOCK_ID']], 
            false,
            ['iNumPage' => $page, 'nPageSize' => $this->arParams['PAGE_SIZE']],
            $selectFields
        );

        $this->arResult['POSTS'] = [];

        while ($item = $res->GetNext()) { 
            $title = $item['NAME']; 
            $announce = $item['PREVIEW_TEXT']; 

            if (isset($item['PROPERTY_' . $this->arParams['TITLE_CODE'] . '_VALUE'])) {
                $title = $item['PROPERTY_' . $this->arParams['TITLE_CODE'] . '_VALUE'];
            }

            if (isset($item['PROPERTY_' . $this->arParams['ANNOUNCE_CODE'] . '_VALUE'])) {
                $announce = $item['PROPERTY_' . $this->arParams['ANNOUNCE_CODE'] . '_VALUE'];
            }

            if (isset($item['PROPERTY_' . $this->arParams['ANNOUNCE_CODE'] . '_VALUE'])) {
                $dateFormatted = FormatDate('d.m.Y', MakeTimeStamp($item['PROPERTY_' . $this->arParams['DATE_CODE'] . '_VALUE']));
            }

            $this->arResult['POSTS'][] = [
                'ID' => $item['ID'],
                'TITLE' => $title,
                'ANNOUNCE' => $announce,
                'DATE_FMT' => $dateFormatted,
            ];
        }

        $this->arResult['PAGE'] = $page;
        $this->arResult['PAGES_CNT'] = $pagesCnt;
        $this->arResult['VISIBLE_PAGES'] = min(3, $pagesCnt);
    }
}
?>