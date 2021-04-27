<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!$arResult["NavShowAlways"]) {
  if (($arResult["NavRecordCount"] == 0) || (($arResult["NavPageCount"] == 1) && ($arResult["NavShowAll"] === false))) return;
}

$navQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$navQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

?>

<nav class="pages">
	<ul>

    <?if($arResult["NavPageNomer"] > 1){
      echo '<li><a href="' . $arResult["sUrlPath"] . '?' . $navQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"]-1) . '">&laquo;</a></li>';
    }

    if($arResult["nEndPage"] <= 5){
      for($i = 1; $i <= $arResult["nEndPage"]; $i++){
        if($arResult["NavPageNomer"] == $i){
          echo '<li><a class="active">' . $i . '</a></li>';
        }else{
          echo '<li><a href="' . $arResult["sUrlPath"] . '?' . $navQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . $i . '">' . $i . '</a></li>';
        }
      }
    }else{
      if($arResult["NavPageNomer"] <= 4){
        for($i = 1; $i <= $arResult["NavPageNomer"]+1; $i++){
          if($arResult["NavPageNomer"] == $i){
            echo '<li><a class="active">' . $i . '</a></li>';
          }else{
            echo '<li><a href="' . $arResult["sUrlPath"] . '?' . $navQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . $i . '">' . $i . '</a></li>';
          }
        }
      }else{
        echo '<li><a href="' . $arResult["sUrlPath"] . '?' . $navQueryString . 'PAGEN_' . $arResult["NavNum"] . '=1">1</a></li>';
        echo "<li><a>...</a></li>";
        if($arResult["NavPageNomer"] >= $arResult["nEndPage"]-3){
          for($i = $arResult["NavPageNomer"]-1; $i <= $arResult["nEndPage"]; $i++){
            if($arResult["NavPageNomer"] == $i){
              echo '<li><a class="active">' . $i . '</a></li>';
            }else{
              echo '<li><a href="' . $arResult["sUrlPath"] . '?' . $navQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . $i . '">' . $i . '</a></li>';
            }
          }
        }else{
          for($i = $arResult["NavPageNomer"]-1; $i <= $arResult["NavPageNomer"]+1; $i++){
            if($arResult["NavPageNomer"] == $i){
              echo '<li><a class="active">' . $i . '</a></li>';
            }else{
              echo '<li><a href="' . $arResult["sUrlPath"] . '?' . $navQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . $i . '">' . $i . '</a></li>';
            }
          }
          echo "<li><a>...</a></li>";
          echo '<li><a href="' . $arResult["sUrlPath"] . '?' . $navQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . $arResult["nEndPage"] . '">' . $arResult["nEndPage"] . '</a></li>';
        }
      }
    }

    if($arResult["NavPageNomer"] < $arResult["nEndPage"]){
      echo '<li><a href="' . $arResult["sUrlPath"] . '?' . $navQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"]+1) . '">&raquo;</a></li>';
    }?>

	</ul>
</nav>
