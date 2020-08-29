<?

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Shape\Answer;

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

Loc::loadMessages(__FILE__);

global $APPLICATION, $USER;

set_time_limit(0);

if (!Loader::includeModule("shape.answer")) {
	ShowError("Module is not installed");
	return;
}

$arFields = Answer\HLTable::arFields;

$arMetaFields = array(
	"NAME" => Loc::getMessage("SHAPE_ANSWER_FIELDS_NAME"),
	"SECOND_NAME" => Loc::getMessage("SHAPE_ANSWER_FIELDS_SECOND_NAME"),
	"METANAME" => Loc::getMessage("SHAPE_ANSWER_FIELDS_METANAME"),
);

if (($_REQUEST['tabControl_active_tab'] == 'shape_answer_tab_setting' || $_REQUEST['action'] == 'meta_fields') && $REQUEST_METHOD == "POST" /*&& check_bitrix_sessid()*/) {


	$arOption = [];
	$_c = count(array_keys($arFields));
	while ($_c--) {
		$_k = array_keys($arFields)[$_c];
		$obj = $arFields[$_k];
		if (!$obj['HIDE']) {
			if (isset($_POST[$_k])) {
				$arOption[$obj['ID']] = 'Y';
			} else {
				$arOption[$obj['ID']] = '';
			}
		}
	}
	$sOption = serialize($arOption);

	\Bitrix\Main\Config\Option::set("shape.answer", "AUTO", $sOption);

	\CAdminMessage::ShowMessage(array(
		"DETAILS" => 'SHAPE_ANSWER_AUTO_SAVED',//Loc::getMessage("SHAPE_ANSWER_AUTO_SAVED"),
		"HTML" => true,
		"TYPE" => "OK",
	));

	unset($arOption);
}


$APPLICATION->SetTitle('SHAPE_ANSWER_INDEX_TITLE');

if (!$islcl > 0)
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

$arOption = unserialize(\Bitrix\Main\Config\Option::get("shape.answer", "AUTO"));


$tabControl = new \CAdminTabControl("tabControl", $aTabs, true, true);

$tabControl->Begin();
?>
<form method="POST"
      action="<? echo $APPLICATION->GetCurPage() ?>?lang=<? echo LANG ?>&amp;tabControl_active_tab=shape_answer_tab_setting"
      id="form-export-users">
	<? $tabControl->BeginNextTab(); ?>
    <tr class="heading">
        <td colspan="2">SET TITLE..</td>
    </tr>
    <td width="50%">Обязательные поля</td>
    <td><?
		foreach ($arOption as $k => $v) {
			if (!empty($v) || $v != "") {
				$v = "Y";
			}
			// print_r($arFields[$k]);
			?>
            <input type="checkbox" id="<?= $k; ?>" name="<?= $arFields[$k]['ID']; ?>" value=""<?
			if (!empty($v) || $v != ""):?> checked="checked"<?endif; ?> /> <label
                    for="<?= $arFields[$k]['ID']; ?>"><?= $arFields[$k]['NAME']; ?></label><br/>
			<?
		}


		?>            </td>


    <tr>
        <td colspan="2" align="left">
            <input type="hidden" name="action" value="meta_fields"/>
            <input type="submit" id="meta_fields_submit"
                   value="Сохранить<? //=Loc::getMessage("SHAPE_ANSWER_AUTO_SAVE_BT")?>" class="adm-btn-save"/>
        </td>
    </tr>
	<? $tabControl->EndTab(); ?>
</form>

<?
?>

<? $tabControl->End(); ?>

<?
if (!$islcl > 0)
	require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_admin.php");
?>
