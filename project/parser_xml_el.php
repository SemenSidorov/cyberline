<?die;
$start = microtime(true);
// $_SERVER['DOCUMENT_ROOT'] = "/home/h907190572/kiberline.brevis.pro/docs";
// require_once ($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include.php");
// CModule::IncludeModule("iblock");
// CModule::IncludeModule("catalog");
// $bs = new CIBlockSection;
// $el = new CIBlockElement;

$rate = new XMLReader();
$rate->open('http://www.cbr.ru/scripts/XML_daily.asp');
$rate_check = false;
$rate_value = [];

while($rate->read()) {
  if($rate->nodeType == XMLReader::ELEMENT) {
    if($rate->localName == 'CharCode') {
      $rate->read();
      $rate_check = $rate->value;
    }
    if($rate->localName == 'Nominal' && $rate_check) {
      $rate->read();
      $rate_value[$rate_check]["Nominal"] = $rate->value;
    }
    if($rate->localName == 'Value' && $rate_check) {
      $rate->read();
      $rate_value[$rate_check]["Value"] = $rate->value;
    }
  }
}

$reader = new XMLReader();
$reader->open('Price.xml');
$count_elements = 0;
$count_file_elements = 1;

while($reader->read()) {
  if($reader->nodeType == XMLReader::ELEMENT) {
    if($reader->localName == 'offer') {
      $data = Array(
        "MODIFIED_BY" => 1,
        "IBLOCK_SECTION_ID" => false,
        "IBLOCK_ID" => 6,
        "ACTIVE" => "Y"
      );
      $PROP = [];
      $prop_price = [];
      $id = $reader->getAttribute('id');
      $PROP["VENDOR_CODE"] = $id;
      $OrderBy = $reader->getAttribute('OrderBy');
      if(isset($OrderBy)) $data["SORT"] = $OrderBy;

      while($reader->read()) {

        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'categoryId') {
          $reader->read();
          $data["IBLOCK_SECTION_ID"] = $reader->value;
          // $section_parent = CIBlockSection::GetList(array(), array("IBLOCK_ID" => 6, "UF_VENDOR_CODE" => $reader->value), false, array(), false);
          // if($section_parent_id = $section_parent->GetNext()){
          //   $data["IBLOCK_SECTION_ID"] = $section_parent_id["ID"];
          // }
        }
        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'picture') {
          $reader->read();
          // $PIC = CFile::MakeFileArray($reader->value);
          // $PIC['name'] = str_replace(".dll", ".jpg", $PIC['name']);
          $data["DETAIL_PICTURE"] = $reader->value;
          $data["PREVIEW_PICTURE"] = $reader->value;
        }
        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'RussianName') {
          $reader->read();
          $data["NAME"] = $reader->value;
          //$data["CODE"] = Cutil::translit($reader->value, "ru", []).$id;
        }
        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'warranty') {
          $reader->read();
          $PROP["WARRANTY"] = $reader->value;
        }
        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'PN') {
          $reader->read();
          $PROP["PN"] = $reader->value;
        }
        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'volume') {
          $reader->read();
          $PROP["VOLUME"] = $reader->value;
        }
        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'weight') {
          $reader->read();
          $PROP["WEIGHT"] = $reader->value;
        }
        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'Model') {
          $reader->read();
          $PROP["MODEL"] = $reader->value;
        }
        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'Vendor') {
          $reader->read();
          $PROP["VENDOR"] = $reader->value;
        }
        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'LastCountry') {
          $reader->read();
          $PROP["COUNTRY"] = $reader->value;
        }
        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'LastGTD') {
          $reader->read();
          $PROP["GTD"] = $reader->value;
        }
        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'Colour') {
          $reader->read();
          $PROP["COLOR"] = $reader->value;
        }
        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'Certificate') {
          $reader->read();
          $PROP["CERTIFICATE"] = $reader->value;
        }
        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'GTIN') {
          $reader->read();
          $PROP["GTIN"] = $reader->value;
        }
        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'picture2') {
          $reader->read();
          if(isset($reader->value) && !empty($reader->value))
            $PROP["ADD_PICTURES"][] = $reader->value;
        }
        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'picture3') {
          $reader->read();
          if(isset($reader->value) && !empty($reader->value))
            $PROP["ADD_PICTURES"][] = $reader->value;
        }


        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'priceE') {
          $reader->read();
          $prop_price["priceE"] = $reader->value;
        }
        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'currencyId') {
          $reader->read();
          $prop_price["currencyId"] = $reader->value;
        }
        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'count') {
          $reader->read();
          if($reader->value == "*") $prop_price["count"] = 20;
          elseif($reader->value == "**") $prop_price["count"] = 50;
          elseif($reader->value == "***") $prop_price["count"] = 100;
          else $prop_price["count"] = 0;
        }
        if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'remote') {
          $reader->read();
          if($reader->value == "*") $prop_price["remote"] = 20;
          elseif($reader->value == "**") $prop_price["remote"] = 50;
          elseif($reader->value == "***") $prop_price["remote"] = 100;
          else $prop_price["remote"] = 0;
        }

        // if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'priceR'){
        //   $reader->read();
        //   $data[$id]["priceR"] = $reader->value;
        // }
        // if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'priceB') {
        //   $reader->read();
        //   $data[$id]["priceB"] = $reader->value;
        // }
        // if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'priceC') {
        //   $reader->read();
        //   $data[$id]["priceC"] = $reader->value;
        // }
        // if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'priceD') {
        //   $reader->read();
        //   $data[$id]["priceD"] = $reader->value;
        // }
        // if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'priceF') {
        //   $reader->read();
        //   $data[$id]["priceF"] = $reader->value;
        // }
        // if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'priceRRP') {
        //   $reader->read();
        //   $data[$id]["priceRRP"] = $reader->value;
        // }
        // if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'transit') {
        //   $reader->read();
        //   $data[$id]["transit"] = $reader->value;
        // }
        // if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'transitdate') {
        //   $reader->read();
        //   $data[$id]["transitdate"] = $reader->value;
        // }
        // if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'DescrUpdated') {
        //   $reader->read();
        //   $data[$id]["DescrUpdated"] = $reader->value;
        // }
        // if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'OutOfProd') {
        //   $reader->read();
        //   $data[$id]["OutOfProd"] = $reader->value;
        // }
        if(($reader->nodeType == XMLReader::END_ELEMENT) && ($reader->name == 'offer')) break;
      }
      $data["PROPERTY_VALUES"] = $PROP;
      $data = [
        "ITEM" => $data,
        "FIELDS" => [
           "VAT_INCLUDED" => "Y",
           "QUANTITY" => $prop_price["remote"] + $prop_price["count"],
           "QUANTITY_RESERVED" => $prop_price["remote"] + $prop_price["count"],
           "QUANTITY_TRACE" => "Y"
         ],
         "PRICE" => [
           "CATALOG_GROUP_ID" => 1,
           "PRICE" => $prop_price["currencyId"] == "RUB" ? $prop_price["priceE"] : $rate_value[$prop_price["currencyId"]]["Value"] * $prop_price["priceE"] / $rate_value[$prop_price["currencyId"]]["Nominal"],
           "CURRENCY" => "RUB",
         ]
      ];
      if($count_elements < 100){
        $count_elements++;
        file_put_contents("data_elements_" . $count_file_elements . ".txt", json_encode($data) . ",", FILE_APPEND);
      }else{
        $count_elements = 0;
        $count_file_elements++;
        file_put_contents("data_elements_" . $count_file_elements . ".txt", json_encode($data) . ",", FILE_APPEND);
        echo $count_file_elements."\n";
      }
      // if($PRODUCT_ID = $el->Add($data)){
      //   echo "New ID: ".$PRODUCT_ID . "<br>";
      //
      //   $arFields = array(
      //      "ID" => $PRODUCT_ID,
      //      "VAT_INCLUDED" => "Y",
      //      "QUANTITY" => $remote + $count,
      //      "QUANTITY_RESERVED" => $prop_price["remote"] + $prop_price["count"],
      //      "QUANTITY_TRACE" => "Y"
      //   );
      //
      //   if(CCatalogProduct::Add($arFields))
      //   {
      //      echo "Добавили параметры товара к элементу каталога " . $PRODUCT_ID . '<br>';
      //
      //      $arFields = Array(
      //         "PRODUCT_ID" => $PRODUCT_ID,
      //         "CATALOG_GROUP_ID" => 1,
      //         "PRICE" => $prop_price["currencyId"] == "RUB" ? $prop_price["priceE"] : $rate_value[$prop_price["currencyId"]]["Value"] * $prop_price["priceE"] / $rate_value[$prop_price["currencyId"]]["Nominal"],
      //         "CURRENCY" => "RUB",
      //      );
      //      CPrice::Add($arFields);
      //   }
      // }else{
      //   echo "Error: ".$el->LAST_ERROR;
      // }
    }

    // if($reader->localName == 'category') {
    //   $count_categories++;
    //   $id = $reader->getAttribute('id');
    //   $parentId = $reader->getAttribute('parentId');
    //   $OrderBy = $reader->getAttribute('OrderBy');
    //   $reader->read();
    //   $name = $reader->value;
    //
    //   if(isset($parentId) && !empty($parentId)){
    //     $data = [
    //       "NAME" => $name,
    //       "CODE" => Cutil::translit($name, "ru", []).$id,
    //       "UF_VENDOR_CODE" => $id,
    //       "IBLOCK_SECTION_ID" => $parentId
    //     ];
    //     if(isset($OrderBy) && !empty($OrderBy)) $data["SORT"] = $OrderBy;
    //     if($count_child_category < 100){
    //       file_put_contents("data_child_category_" . $count_file_child_category . ".txt", json_encode($data) . ",", FILE_APPEND);
    //     }else{
    //       $count_child_category = 0;
    //       $count_file_child_category++;
    //       file_put_contents("data_child_category_" . $count_file_child_category . ".txt", json_encode($data) . ",", FILE_APPEND);
    //     }
    //     $count_child_category++;
    //   }else{
    //     $data = [
    //       "NAME" => $name,
    //       "CODE" => Cutil::translit($name, "ru", []).$id,
    //       "UF_VENDOR_CODE" => $id
    //     ];
    //     if(isset($OrderBy) && !empty($OrderBy)) $data["SORT"] = $OrderBy;
    //     if($count_parent_category < 100){
    //       file_put_contents("data_parent_category_" . $count_file_parent_category . ".txt", json_encode($data) . ",", FILE_APPEND);
    //     }else{
    //       $count_parent_category = 0;
    //       $count_file_parent_category++;
    //       file_put_contents("data_parent_category_" . $count_file_parent_category . ".txt", json_encode($data) . ",", FILE_APPEND);
    //     }
    //     $count_parent_category++;
    //   }
    // }
  }
}
echo "COUNT_TIME = " . (microtime(true) - $start) . "ms\n";
