<?php

namespace flux711\yii2\facility_code_dev;

class Module extends \yii\base\Module
{

	public $controllerNamespace = 'flux711\yii2\facility_code_dev\controllers';

	public function bootstrap($app)
	{
		$app->getUrlManager()->addRules([
			$this->id => $this->id.'/index',
			$this->id.'/<controller:[\w\-]+>/<action:[\w\-]+>' => $this->id.'/<controller>/<action>',
		], false);
	}
}
