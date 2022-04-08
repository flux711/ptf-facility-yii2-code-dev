<?php

namespace api\modules\fake\models;

use api\modules\fake\common\models\FakeRecord;
use Yii;

class FakeStackDetail extends FakeRecord
{
	public static function tableName()
	{
		return 'fake_stack_detail';
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
			'fake_stack_detail_id' => 'Fake Stack Detail ID',
			'production_order_id' => 'Fake Stack Production Order ID',
			'buck_sheet_id' => 'Fake Stack Bucksheet ID',
			'part_number' => 'Fake Stack Part Number',
		];
	}

	public function getFakeStackImages()
	{
		return $this->hasMany(FakeStackImage::className(), ['fake_stack_detail_id' => 'fake_stack_detail_id']);
	}
}
