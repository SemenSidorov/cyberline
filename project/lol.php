<?die;
$_SERVER['DOCUMENT_ROOT'] = "/home/h907190572/kiberline.brevis.pro/docs";
require_once ($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include.php");
CModule::IncludeModule("iblock");

// for($i = 1; $i <= 1912; $i++){
  $el = new CIBlockElement;

  $data_file = json_decode("[".substr(file_get_contents("elements_error_arr_1.txt"), 0, -1)."]", 1);

  foreach ($data_file as $item_key => $item) {
    // if(($i == 1855) && ($item_key <= 27)) continue;
    $data = $item["ITEM"];
    $data["CODE"] = Cutil::translit($data["NAME"], "ru", ["max_len" => 90])."-".$data["PROPERTY_VALUES"]["VENDOR_CODE"];

    $PIC = CFile::MakeFileArray($data["DETAIL_PICTURE"]);
    $PIC['name'] = str_replace([".dll", ".asp"], ".jpg", $PIC['name']);
    $PIC['type'] = "image/jpeg";
    $data["DETAIL_PICTURE"] = $PIC;
    $data["PREVIEW_PICTURE"] = $PIC;
    unset($data["DETAIL_PICTURE"]);
    unset($data["PREVIEW_PICTURE"]);

    $PIC = CFile::MakeFileArray($data["PROPERTY_VALUES"]["CERTIFICATE"]);
    $PIC['name'] = str_replace([".dll", ".asp"], ".jpg", $PIC['name']);
    $data["PROPERTY_VALUES"]["CERTIFICATE"] = $PIC;

    if(isset($data["PROPERTY_VALUES"]["ADD_PICTURES"]) && !empty($data["PROPERTY_VALUES"]["ADD_PICTURES"])){
      foreach ($data["PROPERTY_VALUES"]["ADD_PICTURES"] as $key => $picture) {
        $PIC = CFile::MakeFileArray($picture);
        $PIC['name'] = str_replace([".dll", ".asp"], ".jpg", $PIC['name']);
        $data["PROPERTY_VALUES"]["ADD_PICTURES"][$key] = $PIC;
      }
    }

    $section_parent = CIBlockSection::GetList(array(), array("IBLOCK_ID" => 6, "UF_VENDOR_CODE" => $data["PROPERTY_VALUES"]["IBLOCK_SECTION_ID"]), false, array(), false);
    if($section_parent_id = $section_parent->GetNext()){
      $data["IBLOCK_SECTION_ID"] = $section_parent_id["ID"];
    }else{
      unset($data["IBLOCK_SECTION_ID"]);
    }

    if($PRODUCT_ID = $el->Add($data)){
      echo $i . " - " . $item_key." New ID: ".$PRODUCT_ID . " ";

      $arFields = $data_file[$item_key]["FIELDS"];
      $arFields["ID"] = $PRODUCT_ID;

      if(CCatalogProduct::Add($arFields))
      {
         echo "Добавили параметры товара к элементу каталога " . $PRODUCT_ID . " ";

         $arFields = $data_file[$item_key]["PRICE"];
         $arFields["PRODUCT_ID"] = $PRODUCT_ID;
         CPrice::Add($arFields);
      }
    }else{
      echo "Error: ".$el->LAST_ERROR;
      file_put_contents("elements_error.txt", $i . " - " . $item_key . " - " . $el->LAST_ERROR . "\n" , FILE_APPEND);
      file_put_contents("elements_error_arr.txt", json_encode($item) . "," , FILE_APPEND);
    }
    echo Cutil::translit($item["ITEM"]["NAME"], "ru", ["max_len" => 90])."\n";
  }
  unset($el);
// }
