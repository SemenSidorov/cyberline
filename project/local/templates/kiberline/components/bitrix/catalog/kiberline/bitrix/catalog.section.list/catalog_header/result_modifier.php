<?
$section = new CIBlockSection();
	foreach ($arResult["SECTIONS"] as $key => $item) {
    if(empty($item["PICTURE"])){
  		$elem = CIBlockElement::GetList(["HAS_DETAIL_PICTURE" => "Y", "sort" => "asc"], ["SECTION_ID" => $item["ID"], "INCLUDE_SUBSECTIONS" => "Y"], false, ["nTopCount" => 1], []);
  		$elem = $elem->GetNext();
      $picture = CFile::GetFileArray($elem["DETAIL_PICTURE"]);
      $picture = CFile::ResizeImageGet($picture, array("width" => "270", "height" => "120"));
  		$arResult["SECTIONS"][$key]["PICTURE"] = $picture;
      $file = CFile::MakeFileArray($picture["src"]);
      $section->Update($item["ID"], ["PICTURE" => $file]);
    }
	}
?>
