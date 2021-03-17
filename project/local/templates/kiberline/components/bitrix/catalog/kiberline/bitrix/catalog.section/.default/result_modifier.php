<?
foreach ($arResult["PROPERTIES"]["ADD_PICTURES"]["VALUE"] as $key => $value) {
  $arResult["PROPERTIES"]["ADD_PICTURES"]["RESULT"][] = CFile::GetFileArray($value);
}

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
// foreach ($arResult["ITEMS"] as $key => $item) {
//   if(in_array($item["ID"], $data)){
//     $arResult["ITEMS"][$key]["FAVORITE"] = "Y";
//   }
// }
?>
