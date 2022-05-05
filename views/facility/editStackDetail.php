<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Edit '.$model->part_number;
?>
<div class="site-facility-edit">
	<div class="mt-5 offset-lg-3 col-lg-6">
		<h1><?= Html::encode($this->title) ?></h1>

		<p>Please change following fields of the facility stack detail:</p>

		<?php $form = ActiveForm::begin(['id' => 'facility-edit-form']); ?>

		<?= $form->field($model, 'production_order_id')->textInput()->label("Production order") ?>

		<?= $form->field($model, 'buck_sheet_id')->textInput()->label("Bucksheet number") ?>

		<?= $form->field($model, 'part_number')->textInput()->label("Part number") ?>

		<div class="form-group">
			<?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'facility-edit-button']) ?>
		</div>

		<?php ActiveForm::end(); ?>
	</div>
</div>
