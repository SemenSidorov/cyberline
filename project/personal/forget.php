<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<div class="forget">
  <?$APPLICATION->IncludeComponent(
    "bitrix:system.auth.forgotpasswd",
    "",
    Array(
    )
  );?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
