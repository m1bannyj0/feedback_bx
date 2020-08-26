<?php

namespace Shape\Answer;

use Exception;

class Read
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


}

