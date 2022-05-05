<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Add facility code pool';
?>
<div class="site-facility-add">
	<div class="mt-5 offset-lg-3 col-lg-6">
		<h1><?= Html::encode($this->title) ?></h1>

		<p>Please fill out the following fields to create a new facility code pool:</p>

		<?php $form = ActiveForm::begin(['id' => 'facility-add-form']); ?>

		<?= $form->field($model, 'name')->textInput()->label("Name") ?>

		<?= $form->field($model, 'regex')->textInput()->label("Regex") ?>

		<div class="form-group">
			<?= Html::submitButton('Add', ['class' => 'btn btn-primary', 'name' => 'facility-add-button']) ?>
		</div>

		<?php ActiveForm::end(); ?>
	</div>
</div>
