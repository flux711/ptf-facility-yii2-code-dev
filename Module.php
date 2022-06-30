<?php

namespace rhea\facility;

use rhea\facility\models\FacilityCodePool;

class Module extends \yii\base\Module implements \yii\base\BootstrapInterface
{

	public $controllerNamespace = 'rhea\facility\controllers';

	public function bootstrap($app)
	{
		$app->getUrlManager()->addRules([
			$this->id => $this->id.'/'.$this->id.'/'.'index',
			$this->id.'/<action:[\w\-]+>' => $this->id.'/'.$this->id.'/'.'<action>',

			$this->id.'/stack/add' => $this->id.'/'.$this->id.'/'.'add-stack-detail',
			$this->id.'/stack/edit/<id:[\w\-]+>' => $this->id.'/'.$this->id.'/'.'edit-stack-detail',

			$this->id.'/codepool/add' => $this->id.'/'.$this->id.'/'.'add-codepool',
			$this->id.'/codepool/edit/<id:[\w\-]+>' => $this->id.'/'.$this->id.'/'.'edit-codepool',

			$this->id.'/stack/<id:[\w\-]+>/image' => $this->id.'/'.$this->id.'/'.'image',
			$this->id.'/stack/<id:[\w\-]+>/image/add' => $this->id.'/'.$this->id.'/'.'add-stack-image',
			$this->id.'/image/edit/<id:[\w\-]+>' => $this->id.'/'.$this->id.'/'.'edit-stack-image',

			$this->id.'/codepool/<code:[\w\-]+>/poolid/<poolid:[\w\-]+>' => $this->id.'/'.$this->id.'/'.'code-valid',

			$this->id.'/stack/<id:[\w\-]+>/' => $this->id.'/'.$this->id.'/'.'fetch-stack-details',
			$this->id.'/stack/<id:[\w\-]+>/images' => $this->id.'/'.$this->id.'/'.'fetch-stack-images',
		], false);
	}
}
