<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

Loc::loadMessages(__FILE__);

CModule::IncludeModule('shape.answer');

class CShapeComponent extends CBitrixComponent
{

	protected $parent;
	protected $moduleID = 'shape.answer';
	protected $error;

	public function saveParamsInSession()
	{

	}

	public function getDateInFormat($datetime)
	{
		$formattedDate = FormatDate("x", MakeTimeStamp($datetime));

		return $formattedDate;
	}

	public function getCurrentPageLink()
	{
		$link = $_SERVER['REQUEST_URI'];

		if (strpos($link, '?')) {
			$link = substr($link, 0, strpos($link, '?'));
		}

		return $link;
	}

	public function executeComponent()
	{
		if (!$this->checkParams()) {
			ShowError($this->error);

			return false;
		}
		$this->setDefaultParams();
		$this->getUserInfo();
		$this->setAdditionalParams();


		// if ($this->startResultCache()){

		$this->includeComponentTemplate();
		// }
	}

	public function checkParams()
	{


		return true;
	}

	public function setDefaultParams()
	{

	}

	public function getUserInfo()
	{
		$this->arParams["USER"] = false;

		global $USER;
	}

	public function setAdditionalParams()
	{

	}
}

?>