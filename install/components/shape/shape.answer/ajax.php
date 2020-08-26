<?
/** options
 * Copyright (c) 2020. . https://github.com/mrBannyJo
 */
if ($_SERVER["REQUEST_METHOD"] != "POST" and !isset($_POST["action"])) {
	die();
}

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
IncludeModuleLangFile(__FILE__);

if (!check_bitrix_sessid() || $_SERVER["REQUEST_METHOD"] != "POST") {
	die();
}

if (!CModule::IncludeModule("iblock")) {
	die();
}

global $USER, $APPLICATION;

CUtil::JSPostUnescape();

$answer = Array();
$answer["success"] = 0;
$arErrors = array();

$action = $_POST["action"];

$module_id = "shape.answer";
CModule::IncludeModule($module_id);


if ($action == 'writeform') {
	$arFormatted = [];
	$_f = array_map(function ($a, $b) use (&$arFormatted) {

		$b['name'] == 'name' && $arFormatted['UF_NAME'] = $b['value'];
		$b['name'] == 'url' && $arFormatted['UF_URL'] = $b['value'];
		$b['name'] == 'phone' && $arFormatted['UF_PHONE'] = $b['value'];
		$b['name'] == 'email' && $arFormatted['UF_EMAIL'] = $b['value'];
		$b['name'] == 'texmessage' && $arFormatted['UF_MSG'] = $b['value'];

	},
		array_keys($_REQUEST['data']),
		array_values($_REQUEST['data'])
	);

	$arFormatted['UF_ID_AGREE'] = 1;
	$arFormatted['UF_DATE'] = '';
	$arFormatted['UF_SORT'] = 100;
	$arFormatted['UF_URL'] = $_SERVER['HTTP_REFERER'];
	$arFormatted['UF_IP'] = $_SERVER['REMOTE_ADDR'];

	$addResult = Shape\Answer\EntityTable::add(
		$arFormatted
	);
	$answer["id_hl"] = (int)$addResult;
	if ($answer["id_hl"] > 0) $answer["success"] = 1;
}


echo json_encode($answer);