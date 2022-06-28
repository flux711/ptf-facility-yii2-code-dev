<?php

namespace flux711\yii2\facility_code_dev\models;

use flux711\yii2\facility_code_dev\common\models\FacilityRecord;
use Yii;

class FacilityStackDetail extends FacilityRecord
{
	public static function tableName()
	{
		return 'facility_stack_detail';
	}

	public function rules()
	{
		return [
			[
				[
					'production_order_id',
					'buck_sheet_id',
					'part_number',
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
		];
	}

	public function attributeLabels()
	{
		return [
			'facility_stack_detail_id' => 'Facility Stack Detail ID',
			'production_order_id' => 'Facility Stack Production Order ID',
			'buck_sheet_id' => 'Facility Stack Bucksheet ID',
			'part_number' => 'Facility Stack Part Number',
		];
	}

	public function getByStack($id)
	{
		return self::find()->where([
			'buck_sheet_id' => $id,
		])->one();
	}

	public function getImages()
	{
		return $this->hasMany(FacilityStackImage::className(), ['facility_stack_detail_id' => 'facility_stack_detail_id']);
	}
}
