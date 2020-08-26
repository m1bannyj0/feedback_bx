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
\Bitrix\Main\IO;

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
		Option::delete($this->MODULE_ID);
    }
    
    public function installDB()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
                    try {
                        $ob = \ShapeTable::getEntity();
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
            $connection->dropTable(\ShapeTable::getTableName());
        }
    }    
    
	function InstallFiles()
	{
		/*CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/shape.answer/install/admin", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin", true);
		$path = $this->GetPath()."/install/components";

		if (\Bitrix\Main\IO\Directory::isDirectoryExists($path)){
			CopyDirFiles($path, $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);
		}*/
		// CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/shape.answer/install/tools", $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/$this->MODULE_ID", true);

		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/admin'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					CopyDirFiles($p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.$item, $ReWrite = True, $Recursive = True);
				}
				closedir($dir);
				
			}
		}
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/components'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					CopyDirFiles($p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/'.$item, $ReWrite = True, $Recursive = True);
				}
				closedir($dir);
			}
		}
		return true;
	}

	function UnInstallFiles()
	{
		// DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/shape.answer/install/admin/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin");
		// IO\Directory::deleteDirectory($_SERVER["DOCUMENT_ROOT"].'/bitrix/components/'.$this->MODULE_ID.'/');


		// DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/shape.answer/install/tools/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/$this->MODULE_ID");

		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/admin'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					unlink($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.$this->MODULE_ID.'_'.$item);
				}
				closedir($dir);
			}
		}
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/components'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || !is_dir($p0 = $p.'/'.$item))
						continue;

					$dir0 = opendir($p0);
					while (false !== $item0 = readdir($dir0))
					{
						if ($item0 == '..' || $item0 == '.')
							continue;
						DeleteDirFilesEx('/bitrix/components/'.$item.'/'.$item0);
					}
					closedir($dir0);
				}
				closedir($dir);
			}
		}
		return true;
	}

}

