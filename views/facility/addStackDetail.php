<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Add fake stack detail';
?>
<div class="site-fake-add">
	<div class="mt-5 offset-lg-3 col-lg-6">
		<h1><?= Html::encode($this->title) ?></h1>

		<p>Please fill out the following fields to create a new fake stack detail:</p>

		<?php $form = ActiveForm::begin(['id' => 'fake-add-form']); ?>

		<?= $form->field($model, 'production_order_id')->textInput()->label("Production order") ?>

		<?= $form->field($model, 'buck_sheet_id')->textInput()->label("Bucksheet number") ?>

		<?= $form->field($model, 'part_number')->textInput()->label("Part number") ?>

		<div class="form-group">
			<?= Html::submitButton('Add', ['class' => 'btn btn-primary', 'name' => 'fake-add-button']) ?>
		</div>

		<?php ActiveForm::end(); ?>
	</div>
</div>
