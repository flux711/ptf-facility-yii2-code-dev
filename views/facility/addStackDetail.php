<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Add facility stack detail';
?>
<div class="site-facility-add">
	<div class="mt-5 offset-lg-3 col-lg-6">
		<h1><?= Html::encode($this->title) ?></h1>

		<p>Please fill out the following fields to create a new facility stack detail:</p>

		<?php $form = ActiveForm::begin(['id' => 'facility-add-form']); ?>

		<?= $form->field($model, 'production_order_id')->textInput()->label("Production order") ?>

		<?= $form->field($model, 'buck_sheet_id')->textInput()->label("Bucksheet number") ?>

		<?= $form->field($model, 'part_number')->textInput()->label("Part number") ?>

		<div class="form-group">
			<?= Html::submitButton('Add', ['class' => 'btn btn-primary', 'name' => 'facility-add-button']) ?>
		</div>

		<?php ActiveForm::end(); ?>
	</div>
</div>
