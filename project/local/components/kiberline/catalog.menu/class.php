<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Error;

if (!\Bitrix\Main\Loader::includeModule('iblock')) {
    ShowError(Loc::getMessage('IBLOCK_MODULE_NOT_INSTALLED'));
    return;
}
Loc::loadMessages(__FILE__);


class NewsSectionsList extends CBitrixComponent
{
    /**
     * @param $arOrder
     * @param $arFilter
     * @return array
     */
    private function getList($iblock_id)
    {
        $result = [];

        $main_sections = CIBlockSection::GetList([], ["ACTIVE" => "Y", "IBLOCK_ID" => $iblock_id, "SECTION_ID" => false], false, [], false);
        while($ar_main_sect = $main_sections->GetNext()){
          $sections = CIBlockSection::GetList([], ["ACTIVE" => "Y", "IBLOCK_ID" => $iblock_id, "SECTION_ID" => $ar_main_sect["ID"]], false, [], false);
          while($ar_sect = $sections->GetNext()){
            $folders = CIBlockSection::GetList([], ["ACTIVE" => "Y", "IBLOCK_ID" => $iblock_id, "SECTION_ID" => $ar_sect["ID"]], false, false, []);
            while($item = $folders->GetNext()){
              $ar_sect["CATEGORIES"][] = $item;
            }
            $ar_main_sect["SECTIONS"][] = $ar_sect;
          }
          $ar_main_sect["DETAIL_PICTURE"] = CFile::GetFileArray($ar_main_sect["DETAIL_PICTURE"]);
          $result[] = $ar_main_sect;
        }

        return $result;
    }

    private function status404()
    {
        Bitrix\Iblock\Component\Tools::process404(
            '',
            true,
            true,
            true,
            false
        );
        die();
    }

    public function executeComponent()
    {
        global $APPLICATION;
        $this->arResult["MAIN_SECTIONS"] = $this->getList($this->arParams["IBLOCK_ID"]);

        $this->includeComponentTemplate();
    }
}
