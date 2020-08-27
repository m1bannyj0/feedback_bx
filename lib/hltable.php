<?php
/** options
 * Copyright (c) 2020. . https://github.com/mrBannyJo
 */

namespace Shape\Answer;


use Bitrix\Highloadblock as HL;
use Bitrix\Main\Type\Date;

\Bitrix\Main\Loader::includeModule('highloadblock');

class HLTable
{

	public $MODULE_ID = "shape.answer";

	public $storages = [];

	public function __construct($arIncm = [])
	{
		$this->storages = [
			'AA' => '10000000',
			'BB' => '00000001',
			'CC' => '11111111',
			'DD' => '12345678'
		];
	}

	public function deleteHL($ID = 0)
	{
		if (!$ID) {
			return false;
		}
		$result = HL\HighloadBlockTable::delete($ID);
		if (!$result->isSuccess()) {
			$errors = $result->getErrorMessages(); // получаем сообщения об ошибках
		}
		return true;
	}

	public function getHLid($nameHL = '')
	{
		if (empty($nameHL)) {
			return false;
		}

		$result = HL\HighloadBlockTable::getList(array('filter' => array('=TABLE_NAME' => $nameHL)));
		if ($row = $result->fetch()) {
			return $row["ID"];
		} else {
			return false;
		}

	}

	function makeCode($str = "")
	{
		$str = mb_strtoupper($str, "utf-8");
		$str = preg_replace("/[^A-Za-z0-9 ]/", '', $str);
		return $str;
	}

	public function createHL($HLt = 'a_shape_answer', $nameHL = 'FeedbackForm')
	{
		/*
		Дата (дата добавления/обновления пользовательского согласия) — Тип для хранения времени
		ID согласия — Число
		Имя — Текст
		Телефон — Текст
		IP — Текст
		URL — Текст
		*/
		$tables = array(
			$HLt => array(
				'name' => $nameHL,
				'fields' => array(
					array(
						'FIELD_NAME' => 'UF_ID_AGREE',
						'USER_TYPE_ID' => 'double',
						'DEF' => '1',
						'XML_ID' => 'UF_ID_AGREE'
					),
					array(
						'FIELD_NAME' => 'UF_NAME',
						'USER_TYPE_ID' => 'string',
						'EDIT_IN_LIST' => 'Y',
						'XML_ID' => 'UF_NAME'
					),
					array(
						'FIELD_NAME' => 'UF_PHONE',
						'USER_TYPE_ID' => 'string',
						'MANDATORY' => 'Y',
						'XML_ID' => 'UF_PHONE'
					),
					array(
						'FIELD_NAME' => 'UF_EMAIL',
						'USER_TYPE_ID' => 'string',
						'MANDATORY' => 'Y',
						'XML_ID' => 'UF_EMAIL'
					),
					array(
						'FIELD_NAME' => 'UF_DATE',
						'USER_TYPE_ID' => 'datetime',
						'XML_ID' => 'UF_DATE'
					),
					array(
						'FIELD_NAME' => 'UF_IP',
						'USER_TYPE_ID' => 'string',
						'XML_ID' => 'UF_IP'
					),
					array(
						'FIELD_NAME' => 'UF_URL',
						'USER_TYPE_ID' => 'string',
						'XML_ID' => 'UF_URL'
					),
					array(
						'FIELD_NAME' => 'UF_SORT',
						'USER_TYPE_ID' => 'double',
						'SHOW_IN_LIST' => 'N',
						'XML_ID' => 'UF_SORT'
					),
					array(
						'FIELD_NAME' => 'UF_MSG',
						'USER_TYPE_ID' => 'string',
						'SHOW_IN_LIST' => 'N',
						'XML_ID' => 'UF_MSG'
					)
				),
				'values' => $example_data = []
			)
		);


		foreach ($tables as $tableName => &$table) {

			$res = HL\HighloadBlockTable::getList(
				array(
					'filter' => array(
						'NAME' => $table['name'],
						'TABLE_NAME' => $tableName
					)
				)
			);
			if (!$res->fetch()) {
				$result = HL\HighloadBlockTable::add(array(
					'NAME' => $table['name'],
					'TABLE_NAME' => $tableName
				));
				if ($result->isSuccess()) {
					$sort = 100;
					$tableId = $result->getId();
					// add fields
					$userField = new \CUserTypeEntity;
					foreach ($table['fields'] as $field) {
						$field['ENTITY_ID'] = 'HLBLOCK_' . $tableId;
						$res = \CUserTypeEntity::getList(
							array(),
							array(
								'ENTITY_ID' => $field['ENTITY_ID'],
								'FIELD_NAME' => $field['FIELD_NAME']
							)
						);
						if (!$res->Fetch()) {
							$field['SORT'] = $sort;
							$userField->Add($field);
							$sort += 100;
						}
					}
					// add data
					$hldata = HL\HighloadBlockTable::getById($tableId)->fetch();
					$hlentity = HL\HighloadBlockTable::compileEntity($hldata);
					$entityClass = $hlentity->getDataClass();
					foreach ($table['values'] as $item) {
						$entityClass::add($item);
					}
				}
			}
		}


	}

}

