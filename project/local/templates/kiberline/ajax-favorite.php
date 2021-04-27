<?require_once ($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include.php");
global $USER;

CModule::IncludeModule('sale');

if($_POST["id_favorite"] or $_POST["id_favorites"]){
  if($_POST["method"] == 'add'){
    if($USER->IsAuthorized()){
      $user_id = $USER->GetID();
      $data = CUser::GetList(($by="ID"), ($order="ASC"), array('ID' => $user_id), array("SELECT" => array("UF_FAVORITES")));
      $data = $data->Fetch();
      $data = json_decode($data["UF_FAVORITES"]);
      if($_POST["id_favorite"]){
        $data[] = $_POST["id_favorite"];
      }else{
        $post_fav = json_decode($_POST["id_favorites"], 1);
        $fav = [];
        foreach ($post_fav as $value) {
          $val = CSaleBasket::GetByID((int)$value);
          $data[] = $val["PRODUCT_ID"];
        }
      }
      $arFields = array(
          'UF_FAVORITES' => json_encode($data)
      );

      $USER->Update($user_id, $arFields);

      echo "success";
    }else{
      $data = json_decode($_COOKIE["UF_FAVORITES"]);
      if($_POST["id_favorite"]){
        $data[] = $_POST["id_favorite"];
      }else{
        $post_fav = json_decode($_POST["id_favorites"], 1);
        foreach ($post_fav as $value) {
          $val = CSaleBasket::GetByID((int)$value);
          $data[] = $val["PRODUCT_ID"];
        }
      }

      echo json_encode(["set" => $data]);
    }
  }elseif($_POST["method"] == 'remove'){
    if($USER->IsAuthorized()){
      $user_id = $USER->GetID();
      $data = CUser::GetList(($by="ID"), ($order="ASC"), array('ID' => $user_id), array("SELECT" => array("UF_FAVORITES")));
      $data = $data->Fetch();
      $data = json_decode($data["UF_FAVORITES"]);
      $bool = false;
      $new_data = [];
      foreach ($data as $key => $value) {
        if($_POST["id_favorite"] !== $value){
          $new_data[] = $value;
        }else{
          $bool = true;
        }
      }
      if($bool){
        $arFields = array(
            'UF_FAVORITES' => json_encode($new_data)
        );
        $USER->Update($user_id, $arFields);
      }
      echo "success";

    }else{
      $data = json_decode($_COOKIE["UF_FAVORITES"]);
      $bool = false;
      $new_data = [];
      foreach ($data as $key => $value) {
        if($_POST["id_favorite"] !== $value){
          $new_data[] = $value;
        }else{
          $bool = true;
        }
      }
      if($bool){
        echo json_encode(["set" => $new_data]);
      }else{
        echo "success";
      }
    }
  }else{
    echo "error method: " . $_POST["method"];
  }
}else{
  echo "error POST: " . json_encode($_POST);
}
