<?php

namespace api\modules\fake\models;

use api\modules\fake\common\models\FakeRecord;
use Yii;

class FakeCodePool extends FakeRecord
{
	public static function tableName()
	{
		return 'fake_code_pool';
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
			'fake_code_pool_id' => 'Fake Code Pool ID',
			'name' => 'Code name',
			'regex' => 'Code regex',
		];
	}
}
