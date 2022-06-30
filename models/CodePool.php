<?php

namespace rhea\facility;

use rhea\facility\common\models\FacilityRecord;
use Yii;

class CodePool extends FacilityRecord
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

	public static function checkCode($code, $pool)
	{
		$codepool = CodePool::find()->where([
			'facility_code_pool_id' => $pool,
		])->one();
		if (!$codepool)
			return ['valid' => false];
		preg_match("/".$codepool->regex."/", $code, $matches);
		return ['valid' => count($matches) > 0];
	}
}
