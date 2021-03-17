<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '<div class="navi"><div class="wrap"><a href="/">Главная</a> <i class="fa fa-angle-right"></i> ';
$itemSize = count($arResult);

foreach ($arResult as $index => $item) {
	$title = htmlspecialcharsex($item["TITLE"]);

	if(strpos($strReturn, $title) === false){

		if($item["LINK"] <> "" && $index != $itemSize-1 && $APPLICATION->GetCurPage() !== $item["LINK"])
		{
			$strReturn .= '<a href="'.$item["LINK"].'">'.$title.'</a> <i class="fa fa-angle-right"></i> ';
		}
		else
		{
			$strReturn .= $title;
			break;
		}
	}
}

$strReturn .= '</div></div>';

return $strReturn;
