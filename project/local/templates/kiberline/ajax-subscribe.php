<?require_once ($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include.php");
global $USER;

if($_POST["test"]){
  echo "success";
  die;
}

if($_POST["email"]){
  $id = 0;
  if($USER->IsAuthorized()){
    $id = $USER->GetID();
  }

  if (CModule::IncludeModule("iblock")) {

    $checkEmail = CIBlockElement::GetList([], ["NAME" => $_POST["email"]], false, false, []);
    if($checkEmail->GetNext()){
      echo "error";
      die;
    }

    $el = new CIBlockElement;

    $PROP = array();
    $PROP["EMAIL"] = $_POST["email"];
    if($id !== 0) $PROP["ID_USER"] = $id;

    $arLoadProductArray = Array(
      "IBLOCK_ID"      => 10,
      "PROPERTY_VALUES"=> $PROP,
      "NAME"           => $_POST["email"],
      "ACTIVE"         => "Y"
      );

    if($PRODUCT_ID = $el->Add($arLoadProductArray)){
      echo "success";
    }else{
      echo "error";
    }

  }else{
    echo "error";
  }

}else{
  echo "error";
}
