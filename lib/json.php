<?php
/** options
 * Copyright (c) 2020. . https://github.com/mrBannyJo
 */

namespace Shape\Answer;


use \Bitrix\Main\Config
	, Exception;

class Json
{

	public $storages = [];

	public static function getTableName()
	{
		return "a_shape_answer";
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

	public static function getOption()
	{
		/*	input: 	["EMAIL"]
		output:	["email"]				
		type output 
			{key1:value1,key2:value2}
			{value1,value2}
		*/
		$arOption = unserialize(Config\Option::get("shape.answer", "AUTO"));

		$_c = count($arOption);
		$_a = array_keys($arOption);
		$arJOption = [];
		while ($_c--) {
			if (1) {
				if (!empty($arOption[$_a[$_c]])) {
					$arJOption[] = mb_strtolower($_a[$_c], 'UTF-8');
				}
			} else {
				$arJOption[mb_strtolower($_a[$_c], 'UTF-8')] = $arOption[$_a[$_c]];
			}
		}
		return $arJOption;


	}

	public static function stripErrorsAnswer($ans = [])
	{
		/*	input: 	["bla bla UF_EMAIL"]
			output:	["email"]				*/

		$arFields = HLTable::arFields;
		foreach (array_keys($arFields) as $k => $v) {
			$_c = count($ans);
			while ($_c--) {
				if (strpos($ans[$_c], $v) !== false) {
					$ans[$_c] = mb_strtolower($v, 'UTF-8');
				}
			}
		}
		return $ans;

	}
}
