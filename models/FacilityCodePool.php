<?php

namespace api\modules\facility\models;

use api\modules\facility\common\models\FacilityRecord;
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
