<?php

namespace flux711\yii2\facility_code_dev;

class Module extends \yii\base\Module implements \yii\base\BootstrapInterface
{

	public $controllerNamespace = 'flux711\yii2\facility_code_dev\controllers';

	public function bootstrap($app)
	{
		$app->getUrlManager()->addRules([
			$this->id => $this->id.'/facility/index',
			'facility/<action:[\w\-]+>' => 'facility/facility/<action>'
		], false);
	}
}
