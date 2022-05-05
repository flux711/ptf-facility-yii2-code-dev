<?php

namespace flux711\yii2\facility_code_dev\models;

use flux711\yii2\facility_code_dev\common\models\FacilityRecord;
use Yii;

class FacilityCodePool extends FacilityRecord
{
	public static function tableName()
	{
		return 'facility_code_pool';
	}

	public function rules()
	{
		return [
			[
				[
					'name',
					'regex',
				],
				'required'
			],
			[
				[
					'name',
					'regex',
				],
				'string',
				'max' => 100
			],
		];
	}

	public function attributeLabels()
	{
		return [
			'facility_code_pool_id' => 'Facility Code Pool ID',
			'name' => 'Code name',
			'regex' => 'Code regex',
		];
	}
}
