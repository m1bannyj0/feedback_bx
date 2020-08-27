<?

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $APPLICATION;

if ($APPLICATION->GetGroupRight("shape.answer") != "D") {
	$aMenu = array(
		"parent_menu" => "global_menu_services",
		"section" => "shape.answer",
		"sort" => 50,
		"text" => Loc::getMessage("SHAPE_ANSWER_MENU_TITLE"),
		"title" => Loc::getMessage("SHAPE_ANSWER_MENU_TITLE"),
		"icon" => "p_menu_icon",
		"page_icon" => "p_page_icon",
		"items_id" => "menu_shape.answer",
		"items" => array(
			array(
				"text" => 'SHAPE_ANSWER_MENU_AUTO',//Loc::getMessage("SHAPE_ANSWER_MENU_INDEX"),
				"url" => "shape_sender_index.php?lang=" . LANGUAGE_ID,
				"title" => Loc::getMessage("SHAPE_ANSWER_MENU_INDEX"),
			),
			array(
				"text" => 'SHAPE_ANSWER_MENU_AUTO',//Loc::getMessage("SHAPE_ANSWER_MENU_AUTO"),
				"url" => "shape_sender_auto.php?lang=" . LANGUAGE_ID,
				"title" => Loc::getMessage("SHAPE_ANSWER_MENU_AUTO"),
			),
		)
	);

	return $aMenu;
}
?>