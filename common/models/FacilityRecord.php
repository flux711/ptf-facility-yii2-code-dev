<?php

namespace flux711\yii2\facility_code_dev\common\models;

use Yii;
use yii\db\ActiveRecord;

class FacilityRecord extends ActiveRecord
{
	public static function getDb()
	{
		return Yii::$app->db_testlog;
	}
}
