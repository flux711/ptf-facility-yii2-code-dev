<?php

namespace api\modules\fake\common\models;

use Yii;
use yii\db\ActiveRecord;

class FakeRecord extends ActiveRecord
{
	public static function getDb()
	{
		return Yii::$app->db_fake;
	}
}