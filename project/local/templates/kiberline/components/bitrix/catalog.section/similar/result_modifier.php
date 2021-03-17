<?
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

$PRICE_TYPE_ID = 1;

foreach ($arResult["ITEMS"] as $key => $item) {
  $rsPrices = CPrice::GetList(array(), array('PRODUCT_ID' => $item['ID'], 'CATALOG_GROUP_ID' => $PRICE_TYPE_ID));
  if ($arPrice = $rsPrices->Fetch())
  {
     $arResult["ITEMS"][$key]["PRICE"] = $arPrice;
  }
  // if(in_array($item["ID"], $data)){
  //   $arResult["ITEMS"][$key]["FAVORITE"] = "Y";
  // }
}
