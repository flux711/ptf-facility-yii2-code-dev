<?php

/* @var $this yii\web\View */

use yii\bootstrap4\Html;
use yii\bootstrap4\Progress;
use yii\grid\GridView;

$this->title = 'Fake Stack Detail';
?>
<div class="site-result">
	<div class="body-content">
		<div class="row">
			<?php
			echo yii\grid\GridView::widget([
				'dataProvider' => $provider,
				'columns' => [
					'production_order_id',
					'buck_sheet_id',
					'part_number',
					[
						'attribute' => 'creation_date',
						'format' => ['datetime', \Yii::$app->params['dateControlDisplay']['datetime']]
					],
					[
						'attribute' => 'alteration_date',
						'format' => ['datetime', \Yii::$app->params['dateControlDisplay']['datetime']]
					],
					[
						'label' => 'Image(s)',
						'format' => 'raw',
						'value' => function($provider) {
							$id = $provider->fake_stack_detail_id;
							return Html::a(Html::submitButton('Go', ['class' => 'btn btn-primary']), ['fake/stack/'.$id.'/image'], ['title' => 'go to images', 'class' => 'profile-link']);
						},
					],
					[
						'label' => 'Action',
						'format' => 'raw',
						'value' => function($provider) {
							if (!Yii::$app->user->isGuest && Yii::$app->user->getIdentity()->hasDevelopmentPermission()) {
								$id = $provider->fake_stack_detail_id;
								return Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['fake/stack/edit/'.$id], ['title' => 'edit', 'class' => 'btn btn-success']);
							}
							return "-";
						},
					],
				],
			]);
			?>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<?php
				if (!Yii::$app->user->isGuest && Yii::$app->user->getIdentity()->hasDevelopmentPermission()) {
					echo Html::a('<span class="glyphicon glyphicon-pencil"></span> Add', ['fake/stack/add'], ['title' => 'add', 'class' => 'btn btn-success']);
				}
				?>
			</div>
		</div>
	</div>
</div>
