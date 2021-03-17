<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<div class="popup question" style="display: none;">
	<div class="window">
		<a class="close"></a>
			<?
if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>
<?=$arResult["FORM_NOTE"]?>
<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>
<table>
<?
if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
{
?>
	<tr>
		<td><?
if ($arResult["isFormTitle"])
{
?>
	<h3><?=$arResult["FORM_TITLE"]?></h3>
<?
} //endif ;

	if ($arResult["isFormImage"] == "Y")
	{
	?>
	<a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>"><img src="<?=$arResult["FORM_IMAGE"]["URL"]?>" <?if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?>width="300"<?elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?>height="200"<?else:?><?=$arResult["FORM_IMAGE"]["ATTR"]?><?endif;?> hspace="3" vscape="3" border="0" /></a>
	<?//=$arResult["FORM_IMAGE"]["HTML_CODE"]?>
	<?
	} //endif
	?>

			<p><?=$arResult["FORM_DESCRIPTION"]?></p>
		</td>
	</tr>
	<?
} // endif
	?>
</table>
<br />
	<?
	$bottom_fields = '';
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
		{
			echo $arQuestion["HTML_CODE"];
		}
		else
		{
	?>
		<?$required = $arQuestion["REQUIRED"] == "Y" ? '*' : ''?>
		<?
			if(strpos($arQuestion["HTML_CODE"], '<input ') !== false && strpos($arQuestion["HTML_CODE"], 'type="checkbox"') === false){
				echo str_replace('<input ', '<input placeholder="'. $arQuestion["CAPTION"] . $required . '" ', $arQuestion["HTML_CODE"]);
			}elseif(strpos($arQuestion["HTML_CODE"], '<textarea ') !== false){
				echo str_replace('<textarea ', '<textarea placeholder="'. $arQuestion["CAPTION"] . $required . '" ', $arQuestion["HTML_CODE"]);
			}elseif(strpos($arQuestion["HTML_CODE"], 'type="checkbox"') !== false){
				$bottom_fields .= str_replace('<input ', '<input class="checkbox-consent" style="display: none;" ', str_replace("Y", '', preg_replace('/id="(.*)"/', 'id="check' . $FIELD_SID . '"', $arQuestion["HTML_CODE"])));
				$bottom_fields .= '<label class="label-consent" for="check' . $FIELD_SID . '">' . $arQuestion["CAPTION"] . '</label>';
			}else{
				echo $arQuestion["HTML_CODE"] . " " . $arQuestion["CAPTION"];
			}
		?>
	<?
		}
	}
	?>
<?
if($arResult["isUseCaptcha"] == "Y")
{
?>
		<input placeholder="Слово с картинки*" type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
		<div class="captcha">
			<input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" />
		</div>
<?
} // isUseCaptcha
?>

<?=$bottom_fields."<br>"?>
				<input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />

<p>
<?=$arResult["REQUIRED_SIGN"];?> - <?=GetMessage("FORM_REQUIRED_FIELDS")?>
</p>
<?=$arResult["FORM_FOOTER"]?>
	</div>
</div>
<?
}
?>

	</div>
</div>
