<?
foreach ($arResult["PROPERTIES"]["ADD_PICTURES"]["VALUE"] as $key => $value) {
  $picture = CFile::GetFileArray($value);
  $arResult["PROPERTIES"]["ADD_PICTURES"]["RESULT"][] = $picture;
  $arResult["PROPERTIES"]["ADD_PICTURES"]["MIN_RESULT"][] = CFile::ResizeImageGet($picture, Array("width" => 60, "height" => 45));
}

$arResult["PROPERTIES"]["ADD_PICTURES"]["RESULT"][] = $arResult["DETAIL_PICTURE"];
$arResult["PROPERTIES"]["ADD_PICTURES"]["MIN_RESULT"][] = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], Array("width" => 60, "height" => 45));

$arResult["PROPERTIES"]["VIDEO"]["VALUE"] = CFile::GetFileArray($arResult["PROPERTIES"]["VIDEO"]["VALUE"]);

$section = CIBlockSection::GetList(array(), array("IBLOCK_ID" => 6, "ID" => $arResult["IBLOCK_SECTION_ID"]), false, array(), false);
$section = $section->GetNext();
$arResult["SECTION"] = $section;

$APPLICATION->AddChainItem($section["NAME"], $section["SECTION_PAGE_URL"]);

global $USER;

if($USER->IsAuthorized()){
  $data = CUser::GetList(($by="ID"), ($order="ASC"), array('ID' => $USER->GetID()), array("SELECT" => array("UF_FAVORITES")));
  $data = $data->Fetch();
  $data = json_decode($data["UF_FAVORITES"]);
}else{
  $data = json_decode($_COOKIE["UF_FAVORITES"]);
}

?>

<script>
  var data_ids = {<?foreach ($data as $key => $id) {?><?=$key === 0 ? $key . ": " . $id : ", " . $key . ": " . $id?><?}?>};
</script>

<?
// if(in_array($arResult["ID"], $data)){
//   $arResult["FAVORITE"] = "Y";
// }
