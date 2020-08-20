<?php
/**install
 * Copyright (c) 2020. . https://github.com/mrBannyJo
 *
 * Standard bitrix variables
 *
 * @global CMain     $APPLICATION
 * @global CUser     $USER
 */

   
use Bitrix\Main\Localization\Loc,
Bitrix\Main\ModuleManager,
Bitrix\Main\Entity,
Bitrix\Main\Loader;

Loc::loadMessages(__FILE__);


/**
 * Class SHAPE_ANSWER
 */
class Shape_Answer extends CModule
{
    public $MODULE_ID = "shape.answer";
	public $MODULE_VERSION;
	public $MODULE_VERSION_DATE;
	public $MODULE_NAME;
	public $MODULE_DESCRIPTION;
	public $PARTNER_NAME;
	public $PARTNER_URI;
    /**
     * Конструктор инсталлятора модуля
     */
    public function __construct()
    {
        $arModuleVersion = [];

        include __DIR__ . '/version.php';

        $this->MODULE_ID = 'shape.answer';
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];

        $this->MODULE_NAME = Loc::getMessage('SHAPE_ANSWER_INSTALL_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('SHAPE_ANSWER_INSTALL_DESCRIPTION');
        $this->PARTNER_NAME = Loc::getMessage('SHAPE_ANSWER_PARTNER');
        $this->PARTNER_URI = Loc::getMessage('SHAPE_ANSWER_PARTNER_URI');
    }

    public function DoInstall()
    {
        global $APPLICATION;
        ModuleManager::registerModule($this->MODULE_ID);
			$this->InstallDB();
			$this->InstallFiles();
    }

    public function DoUninstall()
    {
        global $APPLICATION;
        ModuleManager::UnRegisterModule($this->MODULE_ID);
        $this->UnInstallDB();
        $this->UnInstallFiles();
    }
    
    public function installDB()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
                    try {
                        $ob = \ShapeTable::getEntity();
                        $ob->createDbTable();
                    
                        
                    } catch (Exception $e) {
                        $this->showException($e);
                        // return false;
                    }
                    
                    return true;
        }
    }

    public function uninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
            $connection = Application::getInstance()->getConnection();
            $connection->dropTable(\ShapeTable::getTableName());
        }
    }    
    
    public function InstallFiles()
    {
        
    }
    
    public function UnInstallFiles()
    {
        
    }
}

class ShapeTable extends Entity\DataManager
{

    /*
    Дата (дата добавления/обновления пользовательского согласия) — Тип для хранения времени
    ID согласия — Число
    Имя — Текст
    Телефон — Текст
    IP — Текст
    URL — Текст
    */

	public static function getFilePath()
	{
		return __FILE__;
	}

	public static function getTableName()
	{
		return 'a_shape_answer';
	}

	public static function getMap()
	{
		return array(
			'ID' => array(
				'data_type' => 'integer',
				'primary' => true,
				'autocomplete' => true,
				'title' => Loc::getMessage('SHAPE_ANSWER_ENTITY_ID_FIELD'),
			),
			'ID_AGREE' => array(
				'data_type' => 'integer',
				'required' => true,
				'title' => Loc::getMessage('SHAPE_ANSWER_ENTITY_ID_AGREE_FIELD'),
			),
			'NAME' => array(
				'data_type' => 'text',
				'default_value' => '',
				'title' => Loc::getMessage('SHAPE_ANSWER_ENTITY_NAME_FIELD'),
			),
			'PHONE' => array(
				'data_type' => 'text',
				'default_value' => '',
				'validation' => array(__CLASS__, 'validatePhone'),
				'title' => Loc::getMessage('SHAPE_ANSWER_ENTITY_PHONE_FIELD'),
			),
			'DATE' => array(
				'data_type' => 'datetime',
				'default_value' => '',
				'title' => Loc::getMessage('SHAPE_ANSWER_ENTITY_DATE_FIELD'),
			),
			'IP' => array(
				'data_type' => 'text',
				'default_value' => '',
				'title' => Loc::getMessage('SHAPE_ANSWER_ENTITY_IP_FIELD'),
			),
			'URL' => array(
				'data_type' => 'text',
				'default_value' => '',
				'title' => Loc::getMessage('SHAPE_ANSWER_ENTITY_URL_FIELD'),
			),
			'SORT' => array(
				'data_type' => 'integer',
				'default_value' => 500,
				'title' => Loc::getMessage('SHAPE_ANSWER_ENTITY_SORT_FIELD'),
			),
		);
	}

	public static function validatePhone()
	{
		return array(
			new Entity\Validator\Length(null, 255),
		);
	}
}

