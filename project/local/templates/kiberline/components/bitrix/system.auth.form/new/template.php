<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init();
?>

<div class="bx-system-auth-form">

<?if ($arResult['ERROR'])	ShowMessage($arResult['ERROR_MESSAGE']);?>

<?if($arResult["FORM_TYPE"] == "login"):?>

<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?foreach ($arResult["POST"] as $key => $value):?>
	<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
<?endforeach?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="AUTH" />

	<input type="text" name="USER_LOGIN" maxlength="50" value="" size="17" placeholder="<?=GetMessage("AUTH_LOGIN")?>" />
	<script>
		BX.ready(function() {
			var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
			if (loginCookie)
			{
				var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
				var loginInput = form.elements["USER_LOGIN"];
				loginInput.value = loginCookie;
			}
		});
	</script>
	<input type="password" name="USER_PASSWORD" maxlength="255" size="17" autocomplete="off" placeholder="<?=GetMessage("AUTH_PASSWORD")?>" />
<?if($arResult["SECURE_AUTH"]):?>
	<span class="bx-auth-secure" id="bx_auth_secure<?=$arResult["RND"]?>" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
		<div class="bx-auth-secure-icon"></div>
	</span>
	<noscript>
	<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
		<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
	</span>
	</noscript>
	<script type="text/javascript">
		document.getElementById('bx_auth_secure<?=$arResult["RND"]?>').style.display = 'inline-block';
	</script>
<?endif?>
	<div class="forget">
		<a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
	</div>
<?if ($arResult["CAPTCHA_CODE"]):?>
	<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
	<div class="captcha">
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
	</div>
	<input type="text" name="captcha_word" maxlength="50" value="" placeholder="<?=GetMessage("AUTH_CAPTCHA_PROMT")?>" />
<?endif?>

	<input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" />

</form>
<?else:?>
	<?=GetMessage("MAIN_AUTH")?>
<?endif?>
</div>
