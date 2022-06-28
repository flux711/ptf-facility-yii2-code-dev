<?php

namespace flux711\yii2\facility_code_dev;

class Module extends \yii\base\Module implements \yii\base\BootstrapInterface
{

	public $controllerNamespace = 'flux711\yii2\facility_code_dev\controllers';

	public function bootstrap($app)
	{
		$app->getUrlManager()->addRules([
			$this->id => 'facility/facility/index',
			$this->id.'/<action:[\w\-]+>' => 'facility/facility/<action>',

			$this->id.'/stack/add' => 'facility/facility/add-stack-detail',
			$this->id.'/stack/edit/<id:[\w\-]+>' => 'facility/facility/edit-stack-detail',

			$this->id.'/codepool/add' => 'facility/facility/add-codepool',
			$this->id.'/codepool/edit/<id:[\w\-]+>' => 'facility/facility/edit-codepool',

			$this->id.'/stack/<id:[\w\-]+>/image' => 'facility/facility/image',
			$this->id.'/stack/<id:[\w\-]+>/image/add' => 'facility/facility/add-stack-image',
			$this->id.'/image/edit/<id:[\w\-]+>' => 'facility/facility/edit-stack-image',

			$this->id.'/codepool/<code:[\w\-]+>/poolid/<poolid:[\w\-]+>' => 'facility/facility/code-valid',

			$this->id.'/stack/<id:[\w\-]+>/' => 'facility/facility/fetch-stack-details',
			$this->id.'/stack/<id:[\w\-]+>/images' => 'facility/facility/fetch-stack-images',
		], false);
	}
}
