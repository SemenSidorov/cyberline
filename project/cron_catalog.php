<?
function GetChildSections($section_id = 0, $percent = 0){
  if($section_id == 0) return false;
  $rsParentSection = CIBlockSection::GetByID($section_id);
  if ($arParentSection = $rsParentSection->GetNext())
  {
    $ar_ex_ids = [];
    $arFilter = array('IBLOCK_ID' => 6,'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']); // выберет потомков без учета активности
    $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
    while ($arSect = $rsSect->GetNext())
    {
      $ar_ex_ids[$arSect["ID"]] = $percent;
       // $ar_extra_charge[$key]["IDs"][] = $arSect["ID"];
    }
    $ar_ex_ids[$section_id] = $percent;
    // $ar_extra_charge[$key]["IDs"][] = $parentSect["ID"];
    return $ar_ex_ids;
  }
  return false;
}
ini_set('memory_limit', '990M');
$start = microtime(true);
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']?$_SERVER['DOCUMENT_ROOT']:"/home/h907190572/cyberline.store/docs";
require_once ($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/include/pclzip.lib.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
$bs = new CIBlockSection;
$el = new CIBlockElement;

$file = file_get_contents('http://www.netlab.ru/products/pricexml4.zip');
file_put_contents('/home/h907190572/cyberline.store/docs/include/catalog_update/Price.zip', $file);

$zip = new ZipArchive;
if($zip->open('/home/h907190572/cyberline.store/docs/include/catalog_update/Price.zip')){
  $zip->extractTo('/home/h907190572/cyberline.store/docs/include/catalog_update/');
  $zip->close();
}else{
  die;
}

require_once ($_SERVER['DOCUMENT_ROOT']."/price_config.php");
$price_percent_sect = [];
foreach ($ar_extra_charge as $parentSect) {
  $res = GetChildSections($parentSect["ID"], $parentSect["PERCENT"]);
  foreach ($res as $key => $value) {
    $price_percent_sect[$key] = $value;
  }
  if(count($parentSect["EXCEPTION_IDs"])){
    foreach ($parentSect["EXCEPTION_IDs"] as $except) {
      $res = GetChildSections($except["ID"], $except["PERCENT"]);
      foreach ($res as $key => $value) {
        $price_percent_sect[$key] = $value;
      }
    }
  }
}

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

$sections_arr = $elemt_arr = $products_arr = $sect_no_active = [];

$sections = CIBlockSection::GetList([], ["IBLOCK_ID" => 6, "!UF_VENDOR_CODE" => false], false, ["ID","UF_VENDOR_CODE"], false);
while($section = $sections->Fetch()){
  $sections_arr[$section["UF_VENDOR_CODE"]] = $section["ID"];
}

$elements = CIBlockElement::GetList([], ["IBLOCK_ID" => 6, "!PROPERTY_VENDOR_CODE" => false], false, false, ['ID', 'PROPERTY_VENDOR_CODE']);
while($element = $elements->Fetch())
{
  $elemt_arr[$element["PROPERTY_VENDOR_CODE_VALUE"]] = $element["ID"];
}

$products = CCatalogProduct::GetList([], [], false, false, ["ID", "QUANTITY_RESERVED", "QUANTITY"]);
while($product = $products->Fetch())
{
  $products_arr[$product["ID"]] = [
    "QUANTITY_RESERVED" => $product["QUANTITY_RESERVED"],
    "QUANTITY" => $product["QUANTITY_RESERVED"]
  ];
}

$prices = CPrice::GetList([], [], false, false, ["ID", "PRODUCT_ID", "PRICE"]);
while($price = $prices->Fetch())
{
  $products_arr[$price["PRODUCT_ID"]]["PRICE_ID"] = $price["ID"];
  $products_arr[$price["PRODUCT_ID"]]["PRICE"] = $price["PRICE"];
}

$reader = new XMLReader();
$reader->open('/home/h907190572/cyberline.store/docs/include/catalog_update/Price.xml');
while($reader->read()) {
  if($reader->nodeType == XMLReader::ELEMENT) {

    if($reader->localName == 'category') {
      $id = $reader->getAttribute('id');
      if(!isset($sections_arr[$id]) || empty($sections_arr[$id])){
        $parentId = $reader->getAttribute('parentId');
        $OrderBy = $reader->getAttribute('OrderBy');
        $reader->read();
        $name = $reader->value;
        if(isset($parentId) && !empty($parentId)){
          $parentId = $sections_arr[$parentId];
          if($parentId){
            $data = [
              "ACTIVE" => "Y",
              "IBLOCK_ID" => 6,
              "NAME" => $name,
              "CODE" => Cutil::translit($name, "ru", []).$id,
              "UF_VENDOR_CODE" => $id,
              "IBLOCK_SECTION_ID" => $parentId
            ];
            if(isset($OrderBy) && !empty($OrderBy)) $data["SORT"] = $OrderBy;
            $ID = $bs->Add($data);
            $res = ($ID>0);
          }else{
            $res = false;
          }
          if(!$res){
            file_put_contents("error_categories" . date("Y-m-d H") . "-00-00.txt", $bs->LAST_ERROR . "\n", FILE_APPEND);
            file_put_contents("error_categories_array" . date("Y-m-d H") . "-00-00.txt", json_encode($data) . ",", FILE_APPEND);
          }else{
            $sections_arr[$id] = $ID;
          }
        }else{
          $data = [
            "ACTIVE" => "Y",
            "IBLOCK_ID" => 6,
            "NAME" => $name,
            "CODE" => Cutil::translit($name, "ru", []).$id,
            "UF_VENDOR_CODE" => $id
          ];
          if(isset($OrderBy) && !empty($OrderBy)) $data["SORT"] = $OrderBy;
          $ID = $bs->Add($data);
          $res = ($ID>0);
          if(!$res){
            file_put_contents("error_categories" . date("Y-m-d H") . "-00-00.txt", $bs->LAST_ERROR . "\n", FILE_APPEND);
            file_put_contents("error_categories_array" . date("Y-m-d H") . "-00-00.txt", json_encode($data) . ",", FILE_APPEND);
          }else{
            $sections_arr[$id] = $ID;
          }
        }
      }
    }

    if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'offer') {
      $id = $reader->getAttribute('id');
      if(isset($elemt_arr[$id]) && !empty($elemt_arr[$id])){
        while($reader->read()) {

          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'categoryId') {
            $reader->read();
            if(isset($sections_arr[$reader->value]) && !empty($sections_arr[$reader->value])){
              $parentId = $sections_arr[$reader->value];
            }else{
              $parentId = 0;
            }
          }

          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'priceE') {
            $reader->read();
            $price = $reader->value;
          }
          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'currencyId') {
            $reader->read();
            $currency = $reader->value;
          }
          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'count') {
            $reader->read();
            if($reader->value == "*") $count = 20;
            elseif($reader->value == "**") $count = 50;
            elseif($reader->value == "***") $count = 100;
            else $count = 0;
          }
          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'remote') {
            $reader->read();
            if($reader->value == "*") $remote = 20;
            elseif($reader->value == "**") $remote = 50;
            elseif($reader->value == "***") $remote = 100;
            else $remote = 0;
          }

          if(($reader->nodeType == XMLReader::END_ELEMENT) && ($reader->name == 'offer')) break;
        }

        if($currency !== "RUB"){
          $price = $rate_value[$currency]["Value"] * $price / $rate_value[$currency]["Nominal"];
        }
        if((int)$products_arr[$elemt_arr[$id]]["QUANTITY"] != (int)$count+$remote or (int)$products_arr[$elemt_arr[$id]]["QUANTITY_RESERVED"] != (int)$count+$remote){
          CCatalogProduct::Update($elemt_arr[$id], ["QUANTITY" => $count+$remote, "QUANTITY_RESERVED" => $count+$remote]);
        }

        if($price_percent_sect[$parentId]){
          $products_arr[$elemt_arr[$id]]["PRICE"] = $products_arr[$elemt_arr[$id]]["PRICE"] + $products_arr[$elemt_arr[$id]]["PRICE"]/100*$price_percent_sect[$parentId];
        }
        if($price_percent_sect[$parentId]){
          $price[$elemt_arr[$id]] = $price + $price/100*$price_percent_sect[$parentId];
        }
        if(fmod($products_arr[$elemt_arr[$id]]["PRICE"], 1)){
          $products_arr[$elemt_arr[$id]]["PRICE"] = $products_arr[$elemt_arr[$id]]["PRICE"] - fmod($products_arr[$elemt_arr[$id]]["PRICE"], 1) + 1;
        }
        if(fmod($price, 1)){
          $price = $price - fmod($price, 1) + 1;
        }
        if((int)$products_arr[$elemt_arr[$id]]["PRICE"] != (int)$price){
          CPrice::Update($products_arr[$elemt_arr[$id]]["PRICE_ID"], ["PRICE" => $price], false);
        }
        if($price < 30){
          $el->Update($elemt_arr[$id], ["ACTIVE" => "N"]);
        }
      }else{
        $data = Array(
          "MODIFIED_BY" => 1,
          "IBLOCK_ID" => 6,
          "ACTIVE" => "Y"
        );
        $PROP = [];
        $prop_price = [];
        $PROP["VENDOR_CODE"] = $id;
        $OrderBy = $reader->getAttribute('OrderBy');
        if(isset($OrderBy)) $data["SORT"] = $OrderBy;
        $parentIdNo = false;
        while($reader->read()) {

          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'uid') {
            $reader->read();
            $PROP["P_VENDOR_CODE"] = $reader->value;
          }
          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'categoryId') {
            $reader->read();
            if(isset($sections_arr[$reader->value]) && !empty($sections_arr[$reader->value])){
              $parentId = $sections_arr[$reader->value];
              $data["IBLOCK_SECTION_ID"] = $sections_arr[$reader->value];
            }else{
              $parentId = 0;
              $parentIdNo = true;
            }
          }
          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'picture') {
            $reader->read();
            $url = array_reverse(explode("&", str_replace("amp;", "&", $reader->value)));
            $url[0] = 100154252;
            $str_url = '';
            foreach (array_reverse($url) as $value) {
              $str_url .= $value."&";
            }
            $str_url = substr($str_url, 0, -1);
            $PIC = CFile::MakeFileArray($str_url);
            $PIC['name'] = str_replace([".dll", ".asp"], ".jpg", $PIC['name']);
            $PIC['type'] = "image/jpeg";
            $data["DETAIL_PICTURE"] = $PIC;
            $data["PREVIEW_PICTURE"] = $PIC;
          }
          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'name') {
            $reader->read();
            $data["NAME"] = $reader->value;
            $data["CODE"] = Cutil::translit($reader->value, "ru", []).$id;
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
            $PROP["VENDOR"] = strtoupper(substr(trim($reader->value), 0, 1)) . mb_strtolower(substr(trim($reader->value), 1));
          }
          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'LastCountry') {
            $reader->read();
            $PROP["COUNTRY"] = strtoupper(substr(trim($reader->value), 0, 1)) . mb_strtolower(substr(trim($reader->value), 1));
          }
          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'LastGTD') {
            $reader->read();
            $PROP["GTD"] = $reader->value;
          }
          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'Colour') {
            $reader->read();
            $PROP["COLOR"] = strtoupper(substr(trim($reader->value), 0, 1)) . mb_strtolower(substr(trim($reader->value), 1));
          }
          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'Certificate') {
            $reader->read();
            if(isset($reader->value) && !empty($reader->value)){
              $PIC = CFile::MakeFileArray($reader->value);
              $PIC['name'] = str_replace([".dll", ".asp"], ".jpg", $PIC['name']);
              $PIC['type'] = "image/jpeg";
              $PROP["CERTIFICATE"][] = $PIC;
            }
          }
          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'GTIN') {
            $reader->read();
            $PROP["GTIN"] = $reader->value;
          }
          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'picture2') {
            $reader->read();
            if(isset($reader->value) && !empty($reader->value)){
              $url = array_reverse(explode("&", str_replace("amp;", "&", $reader->value)));
              $url[0] = 100154252;
              $str_url = '';
              foreach (array_reverse($url) as $value) {
                $str_url .= $value."&";
              }
              $str_url = substr($str_url, 0, -1);
              $PIC = CFile::MakeFileArray($str_url);
              $PIC['name'] = str_replace([".dll", ".asp"], ".jpg", $PIC['name']);
              $PIC['type'] = "image/jpeg";
              $PROP["ADD_PICTURES"][] = $PIC;
            }
          }
          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'picture3') {
            $reader->read();
            if(isset($reader->value) && !empty($reader->value)){
              $url = array_reverse(explode("&", str_replace("amp;", "&", $reader->value)));
              $url[0] = 100154252;
              $str_url = '';
              foreach (array_reverse($url) as $value) {
                $str_url .= $value."&";
              }
              $str_url = substr($str_url, 0, -1);
              $PIC = CFile::MakeFileArray($str_url);
              $PIC['name'] = str_replace([".dll", ".asp"], ".jpg", $PIC['name']);
              $PIC['type'] = "image/jpeg";
              $PROP["ADD_PICTURES"][] = $PIC;
            }
          }

          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'priceE') {
            $reader->read();
            $price = $reader->value;
          }
          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'currencyId') {
            $reader->read();
            $currency = $reader->value;
          }
          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'count') {
            $reader->read();
            if($reader->value == "*") $count = 20;
            elseif($reader->value == "**") $count = 50;
            elseif($reader->value == "***") $count = 100;
            else $count = 0;
          }
          if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'remote') {
            $reader->read();
            if($reader->value == "*") $remote = 20;
            elseif($reader->value == "**") $remote = 50;
            elseif($reader->value == "***") $remote = 100;
            else $remote = 0;
          }
          if(($reader->nodeType == XMLReader::END_ELEMENT) && ($reader->name == 'offer')) break;
        }
        $data["PROPERTY_VALUES"] = $PROP;
        if($currency !== "RUB"){
          $price = $rate_value[$currency]["Value"] * $price / $rate_value[$currency]["Nominal"];
        }
        if($price_percent_sect[$parentId]){
          $price[$elemt_arr[$id]] = $price + $price/100*$price_percent_sect[$parentId];
        }
        if(fmod($price, 1)){
          $price = $price - fmod($price, 1) + 1;
        }
        if($price < 30){
          $data["ACTIVE"] = "N";
        }
        if($PRODUCT_ID = $el->Add($data)){
          $arFields = [
             "ID" => $PRODUCT_ID,
             "VAT_INCLUDED" => "Y",
             "QUANTITY" => $remote + $count,
             "QUANTITY_RESERVED" => $remote + $count,
             "QUANTITY_TRACE" => "Y"
          ];

          if(CCatalogProduct::Add($arFields))
          {
             $arFields = [
               "PRODUCT_ID" => $PRODUCT_ID,
               "CATALOG_GROUP_ID" => 1,
               "PRICE" => $price,
               "CURRENCY" => "RUB"
             ];
             CPrice::Add($arFields);
          }
        }else{
          $item = [
            "DATA" => $data,
            "PRODUCT" => [
              "VAT_INCLUDED" => "Y",
              "QUANTITY" => $remote + $count,
              "QUANTITY_RESERVED" => $remote + $count,
              "QUANTITY_TRACE" => "Y"
            ],
            "PRICE" => [
              "CATALOG_GROUP_ID" => 1,
              "PRICE" => $price,
              "CURRENCY" => "RUB"
            ]
          ];
          file_put_contents("elements_error" . date("Y-m-d H") . "-00-00.txt", $el->LAST_ERROR . "\n" , FILE_APPEND);
          file_put_contents("elements_error_arr" . date("Y-m-d H") . "-00-00.txt", json_encode($item) . "," , FILE_APPEND);
        }

      }
    }

  }
}
echo "TIME: " . (microtime(true) - $start) . "\n";
