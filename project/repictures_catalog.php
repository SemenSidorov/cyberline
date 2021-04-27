<?die;
ini_set('memory_limit', '3000M');
$start = microtime(true);
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']?$_SERVER['DOCUMENT_ROOT']:"/home/h907190572/kiberline.brevis.pro/docs";
require_once ($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/include/pclzip.lib.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
$bs = new CIBlockSection;
$el = new CIBlockElement;

// $file = file_get_contents('http://www.netlab.ru/products/pricexml4.zip');
// file_put_contents('/home/h907190572/kiberline.brevis.pro/docs/include/catalog_update/Price.zip', $file);
//
// $zip = new ZipArchive;
// if($zip->open('/home/h907190572/kiberline.brevis.pro/docs/include/catalog_update/Price.zip')){
//   $zip->extractTo('/home/h907190572/kiberline.brevis.pro/docs/include/catalog_update/');
//   $zip->close();
// }else{
//   die;
// }

$elements = CIBlockElement::GetList([], ["IBLOCK_ID" => 6, "!PROPERTY_VENDOR_CODE" => false], false, false, ['ID', 'PROPERTY_VENDOR_CODE']);
while($element = $elements->Fetch())
{
  $elemt_arr[$element["PROPERTY_VENDOR_CODE_VALUE"]] = $element["ID"];
}

$count_elements = 0;
$reader = new XMLReader();
$reader->open('/home/h907190572/kiberline.brevis.pro/docs/include/catalog_update/Price.xml');
while($reader->read()) {
  if($reader->nodeType == XMLReader::ELEMENT) {

    if($reader->nodeType == XMLReader::ELEMENT && $reader->localName == 'offer') {
      $count_elements++;
      if($count_elements <= 183575) continue;
      $id = $reader->getAttribute('id');
      if(isset($elemt_arr[$id]) && !empty($elemt_arr[$id])){
        $PROP = [];
        while($reader->read()) {
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
            $data = ["DETAIL_PICTURE" => $PIC, "PREVIEW_PICTURE" => $PIC];
            $el->Update($elemt_arr[$id], $data);
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

          if(($reader->nodeType == XMLReader::END_ELEMENT) && ($reader->name == 'offer')) break;
        }
        if($PROP){
          $el->SetPropertyValuesEx($elemt_arr[$id], 6, $PROP);
        }
      }
      echo $count_elements . "\n";
    }

  }
}
echo "TIME: " . (microtime(true) - $start) . "\n";
