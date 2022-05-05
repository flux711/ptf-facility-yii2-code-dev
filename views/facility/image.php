<?php

/* @var $this yii\web\View */

use yii\bootstrap4\Html;
use yii\bootstrap4\Progress;
use yii\grid\GridView;

$this->title = 'Facility Stack Image';
?>
<div class="site-result">
	<div class="body-content">
		<div class="row">
			<?php
			echo yii\grid\GridView::widget([
				'dataProvider' => $provider,
				'columns' => [
					'part_number',
					'reference',
					[
						'attribute' => 'creation_date',
						'format' => ['datetime', \Yii::$app->params['dateControlDisplay']['datetime']]
					],
					[
						'attribute' => 'alteration_date',
						'format' => ['datetime', \Yii::$app->params['dateControlDisplay']['datetime']]
					],
					[
						'label' => 'Action',
						'format' => 'raw',
						'value' => function($provider) {
							if (!Yii::$app->user->isGuest && Yii::$app->user->getIdentity()->hasDevelopmentPermission()) {
								$id = $provider->facility_stack_image_id;
								return Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['facility/image/edit/'.$id], ['title' => 'edit', 'class' => 'btn btn-success']);
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
					echo Html::a('<span class="glyphicon glyphicon-pencil"></span> Add', ['facility/stack/'.$facility_stack_detail_id.'/image/add'], ['title' => 'add', 'class' => 'btn btn-success']);
				}
				?>
			</div>
		</div>
	</div>
</div>
