<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CModule::IncludeModule('iblock');
$arResult["CATEGORIES"] = [];
foreach ($arResult["SEARCH"] as $key => $item) {
	$elem = CIBlockElement::GetList([], ["IBLOCK_ID" => 6, "ID" => $item["ITEM_ID"], "ACTIVE" => "Y"], false, false, ["ID", "IBLOCK_ID", "PREVIEW_PICTURE", "DETAIL_PICTURE"]);
	if($elem->SelectedRowsCount()!=0){
		$elem = $elem->Fetch();
		if($elem["PREVIEW_PICTURE"]){
			$arResult["SEARCH"][$key]["PICTURE"] = CFile::GetFileArray($elem["PREVIEW_PICTURE"]);
		}elseif($elem["DETAIL_PICTURE"]){
			$arResult["SEARCH"][$key]["PICTURE"] = CFile::GetFileArray($elem["DETAIL_PICTURE"]);
		}
		$price = CPrice::GetList([], ["PRODUCT_ID" => $item["ITEM_ID"]], false, false, []);
		$arResult["SEARCH"][$key]["PRICE"] = $price->Fetch();
	}
}
?>
