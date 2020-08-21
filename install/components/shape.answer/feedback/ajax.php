<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
IncludeModuleLangFile(__FILE__);

if (!check_bitrix_sessid() || $_SERVER["REQUEST_METHOD"] != "POST"){
    die();
}

if (!CModule::IncludeModule("iblock")){
    die();
}

global $USER, $APPLICATION;

CUtil::JSPostUnescape();

$answer            = Array();
$answer["success"] = 0;
$arErrors          = array();

$action = $_POST["action"];

$module_id = "shape.answer";
CModule::IncludeModule($module_id);

echo json_encode($answer);