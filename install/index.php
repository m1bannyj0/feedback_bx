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
Bitrix\Main\Loader,
Bitrix\Main\Application,
\Bitrix\Main\IO,
\Shape\Answer\HLTable;;

Loc::loadMessages(__FILE__);

if (class_exists("Shape_Answer"))
	return;
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
		$this->HL_NAME = 'FeedbackForm';
		$this->HL_TABLE = 'a_shape_answer';
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];

        $this->MODULE_NAME = Loc::getMessage('SHAPE_ANSWER_INSTALL_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('SHAPE_ANSWER_INSTALL_DESCRIPTION');
        $this->PARTNER_NAME = Loc::getMessage('SHAPE_ANSWER_PARTNER');
        $this->PARTNER_URI = Loc::getMessage('SHAPE_ANSWER_PARTNER_URI');
		$this->excludeAdminFiles=['..','.','backup'];
    }

    public function DoInstall()
    {
        global $APPLICATION;
        ModuleManager::registerModule($this->MODULE_ID);

		$this->InstallFiles();
		$this->installHLDB();
		$arOption = array(
		"NAME"=>"",
		"PHONE"=>"",
		"EMAIL"=>"",
		"COLOR"=>"",
		"ID_AGREE"=>"Y",
		);
		$sOption = serialize($arOption);

		\Bitrix\Main\Config\Option::set("shape.answer", "AUTO", $sOption);
    }

    public function DoUninstall()
    {
        global $APPLICATION;
		$this->uninstallHLDB();
        // $this->UnInstallDB();
        ModuleManager::UnRegisterModule($this->MODULE_ID);
        $this->UnInstallFiles();
		\Bitrix\Main\Config\Option::delete($this->MODULE_ID);
    }
    
    public function installDB()
    {
		/*create with ORM */
        if (false || Loader::includeModule($this->MODULE_ID))
        {
                    try {
                        $ob = \EntityTable::getEntity();
                        $ob->createDbTable();
                    } catch (Exception $e) {
                        // $this->showException($e);
                        return false;
                    }
                    return true;
        }
    }
	

    public function uninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
            $connection = Application::getInstance()->getConnection();
			/* drop with ORM  */
            // $connection->dropTable(\EntityTable::getTableName());
        }
    }    

	public function uninstallHLDB()
    {
		/*create with HL */
		if (Loader::includeModule($this->MODULE_ID))
		{
			$_hl=new Shape\Answer\HLTable;
			$id_hl = $_hl ->getHLid($this->HL_TABLE);
			if ((int)$id_hl>0)
			{
				return $_hl->deleteHL($id_hl);
			}
		}
       
    }

	public function installHLDB()
    {
		/*create with HL */
		if (Loader::includeModule($this->MODULE_ID))
		{
			$_hl=new Shape\Answer\HLTable;
			$id_hl = $_hl ->getHLid($this->HL_TABLE);
			if ((int)$id_hl<1)
			{
				return $_hl->createHL($this->HL_TABLE,$this->HL_NAME);
			}
		}
       
    }
	
	function InstallFiles()
	{
		$path = $this->GetPath()."/install/components";

		if (\Bitrix\Main\IO\Directory::isDirectoryExists($path)){
			CopyDirFiles($path, $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);
		}

		if (\Bitrix\Main\IO\Directory::isDirectoryExists($path = $this->GetPath().'/admin')){
			CopyDirFiles($this->GetPath()."/install/admin/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin");
			if ($dir = opendir($path)){
				while (false !== $item = readdir($dir)){
					if (in_array($item, $this->excludeAdminFiles))
						continue;
					file_put_contents($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.$item,
						'<'.'? require($_SERVER["DOCUMENT_ROOT"]."'.$this->GetPath(true).'/admin/'.$item.'");?'.'>');
					
				}
				closedir($dir);
			}
		}


	}

	function UnInstallFiles()
	{
		
		\Bitrix\Main\IO\Directory::deleteDirectory($_SERVER["DOCUMENT_ROOT"].'/bitrix/components/shape/');

		if (\Bitrix\Main\IO\Directory::isDirectoryExists($path = $this->GetPath().'/admin')){
			DeleteDirFiles($_SERVER["DOCUMENT_ROOT"].$this->GetPath().'/install/admin/', $_SERVER["DOCUMENT_ROOT"].'/bitrix/admin');
			if ($dir = opendir($path)){
				while (false !== $item = readdir($dir)){
					if (in_array($item, $this->excludeAdminFiles))
						continue;
					\Bitrix\Main\IO\File::deleteFile($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.$item);
				}
				closedir($dir);
			}
		}
	}

		function GetPath($notDocumentRoot = false){
		$tdir=dirname(__DIR__);
		
		if ($notDocumentRoot){
			return str_ireplace(Application::getDocumentRoot(), '', $tdir);
		}else{
			return $tdir;
		}
	}
}

