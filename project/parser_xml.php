<?die;
require_once ($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include.php");
CModule::IncludeModule("iblock");
$bs = new CIBlockSection;

$start = microtime(true);
$reader = new XMLReader();
$reader->open('Price.xml');
$count_categories = 0;
$count_elements = 0;

$count_parent_category = 0;
$count_child_category = 0;
$count_file_parent_category = 1;
$count_file_child_category = 1;

while($reader->read()) {
  if($reader->nodeType == XMLReader::ELEMENT) {

    if($reader->localName == 'category') {
      $count_categories++;
      $id = $reader->getAttribute('id');
      $parentId = $reader->getAttribute('parentId');
      $OrderBy = $reader->getAttribute('OrderBy');
      $reader->read();
      $name = $reader->value;

      if(isset($parentId) && !empty($parentId)){
        $data = [
          "NAME" => $name,
          "CODE" => Cutil::translit($name, "ru", []).$id,
          "UF_VENDOR_CODE" => $id,
          "IBLOCK_SECTION_ID" => $parentId
        ];
        if(isset($OrderBy) && !empty($OrderBy)) $data["SORT"] = $OrderBy;
        if($count_child_category < 100){
          file_put_contents("data_child_category_" . $count_file_child_category . ".txt", json_encode($data) . ",", FILE_APPEND);
        }else{
          $count_child_category = 0;
          $count_file_child_category++;
          file_put_contents("data_child_category_" . $count_file_child_category . ".txt", json_encode($data) . ",", FILE_APPEND);
        }
        $count_child_category++;
      }else{
        $data = [
          "NAME" => $name,
          "CODE" => Cutil::translit($name, "ru", []).$id,
          "UF_VENDOR_CODE" => $id
        ];
        if(isset($OrderBy) && !empty($OrderBy)) $data["SORT"] = $OrderBy;
        if($count_parent_category < 100){
          file_put_contents("data_parent_category_" . $count_file_parent_category . ".txt", json_encode($data) . ",", FILE_APPEND);
        }else{
          $count_parent_category = 0;
          $count_file_parent_category++;
          file_put_contents("data_parent_category_" . $count_file_parent_category . ".txt", json_encode($data) . ",", FILE_APPEND);
        }
        $count_parent_category++;
      }

      // $arFields = Array(
      //   "ACTIVE" => "Y",
      //   "IBLOCK_ID" => 6
      // );
      //
      // $arFields["UF_VENDOR_CODE"] = $id;
      // $arFields["NAME"] = $name;
      // $arFields["CODE"] = Cutil::translit($name, "ru", []).$id;
      // if(isset($OrderBy)) $arFields["SORT"] = $OrderBy;
      // if(isset($parentId)){
      //   $section_parent = CIBlockSection::GetList(array(), array("UF_VENDOR_CODE" => $parentId), false, array(), false);
      //   if($section_parent_id = $section_parent->GetNext()){
      //     $arFields["IBLOCK_SECTION_ID"] = $section_parent_id["ID"];
      //   }else{
      //     $arFields["IBLOCK_SECTION_ID"] = $parentId;
      //     file_put_contents("data_sect_parent_no_exist.txt", json_encode(arFields) . ",", FILE_APPEND);
      //     //$data_sect_parent_no_exist[] = $arFields;
      //     continue;
      //   }
      // }
      // $ID = $bs->Add($arFields);
      // $res = ($ID>0);
      // if(!$res)
      //   echo $bs->LAST_ERROR;
    }

  }
}
echo "COUNT_TIME = " . (microtime(true) - $start) . "ms\n";
