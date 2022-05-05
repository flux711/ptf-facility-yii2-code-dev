<?php

/* @var $this yii\web\View */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Progress;
use yii\grid\GridView;

$this->title = 'Facility Production Orders';
?>
<div class="site-result">
	<div class="body-content">
		<div class="row">
			<div class="col-lg-5">
				<h2>Facility Stack</h2>
				<p>Show, add and edit facility stacks and images.</p>
				<div class="form-group">
					<?php echo Html::a(Html::submitButton('Go', ['class' => 'btn btn-primary']), ['facility/stack'], ['class' => 'profile-link']); ?>
				</div>
			</div>
			<div class="col-lg-2"></div>
			<div class="col-lg-5">
				<h2>Facility Code Pool</h2>
				<p>Show, add and edit facility code pools.</p>
				<div class="form-group">
					<?php echo Html::a(Html::submitButton('Go', ['class' => 'btn btn-primary']), ['facility/codepool'], ['class' => 'profile-link']); ?>
				</div>
			</div>
		</div>
	</div>
</div>
