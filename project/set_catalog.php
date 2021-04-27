<?die;
require_once ($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include.php");
CModule::IncludeModule("iblock");
$bs = new CIBlockSection;

// $data = json_decode("[".substr(file_get_contents("data_parent_category_1.txt"), 0, -1)."]", 1);
//
// foreach ($data as $arFields) {
//   echo print_r($arFields);
//   $arFields["ACTIVE"] = "Y";
//   $arFields["IBLOCK_ID"] = 6;
//   $ID = $bs->Add($arFields);
//   $res = ($ID>0);
//   if(!$res)
//     echo $bs->LAST_ERROR;
// }

// $count_file = 2;
//
// while($count_file <= 26){
  $data = json_decode("[".substr(file_get_contents("data_child_category_no.txt"), 0, -1)."]", 1);
  foreach ($data as $arFields) {
    echo print_r($arFields);
    echo "<br>";
    $arFields["ACTIVE"] = "Y";
    $arFields["IBLOCK_ID"] = 6;

    $section_parent = CIBlockSection::GetList(array(), array("IBLOCK_ID" => 6, "UF_VENDOR_CODE" => $arFields["IBLOCK_SECTION_ID"]), false, array(), false);
    if($section_parent_id = $section_parent->GetNext()){
      $arFields["IBLOCK_SECTION_ID"] = $section_parent_id["ID"];
      $ID = $bs->Add($arFields);
      $res = ($ID>0);
      if(!$res)
        echo $bs->LAST_ERROR . "<br>";
    }else{
      file_put_contents("data_child_category_no_1.txt", json_encode($arFields) . ",", FILE_APPEND);
    }
  }
//   $count_file++;
// }
