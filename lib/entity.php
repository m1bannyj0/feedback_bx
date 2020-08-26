<?php
/** options
 * Copyright (c) 2020. . https://github.com/mrBannyJo
 */
namespace Shape\Answer;


use Bitrix\Main\ORM\Data;
use Bitrix\Main\ORM\Fields;
use Bitrix\Main\Localization\Loc;
use Exception;

class EntityTable extends Data\DataManager
{

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
			'UF_ID_AGREE' => array(
				'data_type' => 'integer',
				'required' => true,
				'title' => Loc::getMessage('SHAPE_ANSWER_ENTITY_ID_AGREE_FIELD'),
			),
			'UF_NAME' => array(
				'data_type' => 'text',
				'default_value' => '',
				'title' => Loc::getMessage('SHAPE_ANSWER_ENTITY_NAME_FIELD'),
			),
			'UF_PHONE' => array(
				'data_type' => 'text',
				'default_value' => '',
				'title' => Loc::getMessage('SHAPE_ANSWER_ENTITY_PHONE_FIELD'),
			),
			'UF_EMAIL' => array(
				'data_type' => 'text',
				'default_value' => '',
				'title' => Loc::getMessage('SHAPE_ANSWER_ENTITY_EMAIL_FIELD'),
			),
			'UF_DATE' => array(
				'data_type' => 'datetime',
				'default_value' => '',
				'title' => Loc::getMessage('SHAPE_ANSWER_ENTITY_DATE_FIELD'),
			),
			'UF_IP' => array(
				'data_type' => 'text',
				'default_value' => '',
				'title' => Loc::getMessage('SHAPE_ANSWER_ENTITY_IP_FIELD'),
			),
			'UF_URL' => array(
				'data_type' => 'text',
				'default_value' => '',
				'title' => Loc::getMessage('SHAPE_ANSWER_ENTITY_URL_FIELD'),
			),
			'UF_SORT' => array(
				'data_type' => 'integer',
				'default_value' => 500,
				'title' => Loc::getMessage('SHAPE_ANSWER_ENTITY_SORT_FIELD'),
			),
			'UF_MSG' => array(
				'data_type' => 'text',
				'default_value' => '',
				'title' => Loc::getMessage('SHAPE_ANSWER_ENTITY_MSG_FIELD'),
			),
		);


	}


}

// $ret=new State;
// print_r(bindec('100001')."\n");
// print_r(decbin('33')."\n");
// print_r($ret);
// print_r($ret::langDec('NEW'));
// print_r($ret::setCODE(54720,'NEW'));
// print_r("\n");