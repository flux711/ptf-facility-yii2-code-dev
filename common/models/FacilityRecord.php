<?php

namespace rhea\facility\common\models;

use Yii;
use yii\db\ActiveRecord;

class FacilityRecord extends ActiveRecord
{
	public static function getDb()
	{
		return Yii::$app->db_facility;
	}
}
