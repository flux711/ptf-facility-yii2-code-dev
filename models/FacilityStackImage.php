<?php

namespace flux711\yii2\facility_code_dev\models;

use flux711\yii2\facility_code_dev\common\models\FacilityRecord;
use Yii;

class FacilityStackImage extends FacilityRecord
{
	public static function tableName()
	{
		return 'facility_stack_image';
	}

	public function rules()
	{
		return [
			[
				[
					'part_number',
					'reference',
				],
				'required'
			],
			[
				[
					'part_number',
				],
				'string',
				'max' => 250
			],
			[
				[
					'reference',
				],
				'string',
				'max' => 50
			],
		];
	}

	public function attributeLabels()
	{
		return [
			'facility_stack_image_id' => 'Facility Stack Image ID',
			'part_number' => 'Facility Stack Image Part Number',
			'reference' => 'Facility Stack Image Reference',
		];
	}
}
