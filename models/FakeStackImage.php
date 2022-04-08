<?php

namespace api\modules\fake\models;

use api\modules\fake\common\models\FakeRecord;
use Yii;

class FakeStackImage extends FakeRecord
{
	public static function tableName()
	{
		return 'fake_stack_image';
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
			'fake_stack_image_id' => 'Fake Stack Image ID',
			'part_number' => 'Fake Stack Image Part Number',
			'reference' => 'Fake Stack Image Reference',
		];
	}
}
