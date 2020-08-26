<?
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

Loc::loadMessages(__FILE__);

global $APPLICATION, $USER;

set_time_limit(0);

if (!Loader::includeModule("shape.answer"))
{
	ShowError("Module is not installed");
	return;
}



$arGroups = array();



$APPLICATION->SetTitle('SHAPE_ANSWER_AUTO_TITLE');

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");


\CJSCore::Init(array("jquery"));

$aTabs = array(
	array(
		"DIV" => "shape-users",
		"TAB" => 'SHAPE_ANSWER_USERS',//Loc::getMessage("SHAPE_ANSWER_USERS"),
		"ICON" => "main_settings",
		"TITLE" => 'SHAPE_ANSWER_USERS',//Loc::getMessage("SHAPE_ANSWER_USERS"),
	)
);


// get options

$tabControl = new \CAdminTabControl("tabControl", $aTabs, true, true);

?>
<style>
	 
	table.iksweb{text-decoration: none;border-collapse:collapse;width:100%;text-align:center;}
	table.iksweb th{font-weight:normal;font-size:14px; color:#ffffff;background-color:#354251;}
	table.iksweb td{font-size:13px;color:#354251;}
	table.iksweb td,table.iksweb th{white-space:pre-wrap;padding:10px 5px;line-height:13px;vertical-align: middle;border: 1px solid #354251;}	table.iksweb tr:hover{background-color:#f9fafb}
	table.iksweb tr:hover td{color:#354251;cursor:pointer;}
</style>
<table class="iksweb">
<thead>
<tr>
	<th>Заголовок</th>
	<th>Заголовок</th>
	<th>Заголовок</th>
	<th>Заголовок</th>
</tr>
</thead>
<tbody>
<tr>
	<td>Ячейка</td>
	<td>Ячейка</td>
	<td>Ячейка</td>
	<td>Ячейка</td>
</tr>
<tr>
	<td>Ячейка</td>
	<td>Ячейка</td>
	<td>Ячейка</td>
	<td>Ячейка</td>
</tr>
<tr>
	<td>Ячейка</td>
	<td>Ячейка</td>
	<td colspan="2">Ячейка</td>
</tr>
<tr>
	<td>Ячейка</td>
	<td>Ячейка</td>
	<td>Ячейка</td>
	<td>Ячейка</td>
</tr>
</tbody>
</table>

<?
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_admin.php");
