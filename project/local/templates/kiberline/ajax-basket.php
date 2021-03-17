<?require_once ($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include.php");
$PRODUCT_ID = $_POST["product_id"];
$QUANTITY = $_POST["quantity"];
if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog")) {
	if ($PRODUCT_ID && $QUANTITY) {
		Add2BasketByProductID(
			$PRODUCT_ID,
			$QUANTITY,
			false
		);
    return "success";
	}else{
    return "error";
  }
}
?>
