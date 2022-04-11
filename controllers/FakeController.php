<?php

namespace api\modules\fake\controllers;

use api\modules\fake\models\FakeCodePool;
use api\modules\fake\models\FakeCodePoolForm;
use api\modules\fake\models\FakeStackDetailForm;
use api\modules\fake\models\FakeStackImageForm;
use api\modules\fake\models\FakeStackDetail;
use api\modules\fake\models\FakeStackImage;
use Yii;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\Response;

class FakeController extends Controller
{
	public function actionGetStacks()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;

		$fakedetails = FakeStackDetail::find()->all();

		for($i = 0; $i < sizeof($fakedetails); $i++) {
			$fakedetails[$i] = $this->formatStackData($fakedetails[$i]);
		}
		return $fakedetails;
	}

	public function actionGetStackById()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$request = Yii::$app->request;

		if (!$request->get('id'))
			throw new BadRequestHttpException("Stack ID is missing!");

		$fakedetail = FakeStackDetail::find()->where([
			'fake_stack_detail_id' => $request->get('id')
		])->one();

		return $this->formatStackData($fakedetail);
	}

	public function actionGetImages()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;

		$fakeimages = FakeStackImage::find()->all();
		return $fakeimages;
	}

	public function actionGetImageById()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$request = Yii::$app->request;

		if (!$request->get('id'))
			throw new BadRequestHttpException("Image ID is missing!");

		$fakeimage = FakeStackImage::find()->where([
			'fake_stack_image_id' => $request->get('id')
		])->one();
		return $fakeimage;
	}

	public function actionGetCodepools()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;

		$codepools = FakeCodePool::find()->all();
		return $codepools;
	}

	public function actionGetCodepoolById()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$request = Yii::$app->request;

		if (!$request->get('id'))
			throw new BadRequestHttpException("Codepool ID is missing!");

		$codepool = FakeCodePool::find()->where([
			'fake_stack_detail_id' => $request->get('id')
		])->one();
		return $codepool;
	}

	public function actionAddStackDetail()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$request = Yii::$app->request;

		if (!$request->post('production_order_id'))
			throw new BadRequestHttpException("Productionorder ID is missing!");
		if (!$request->post('buck_sheet_id'))
			throw new BadRequestHttpException("Bucksheet ID is missing!");
		if (!$request->post('part_number'))
			throw new BadRequestHttpException("Partnumber is missing!");

		$model = new FakeStackDetailForm();

		if ($model->load($request->post(), '')) {
			$model->scenario = FakeStackDetailForm::SCENARIO_CREATE;
			$verification = $model->verify();
			if ($verification)
				throw new BadRequestHttpException($verification);
			if (!$verification and $model->create()) {
				Yii::$app->response->statusCode = 201;
				return;
			}
		}
		throw new BadRequestHttpException("Unable to add stack!");
	}

	public function actionEditStackDetail()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$request = Yii::$app->request;

		if (!$request->queryParams['id'])
			throw new BadRequestHttpException("Stack ID is missing!");

		$config = FakeStackDetail::findOne($request->queryParams['id']);
		$model = new FakeStackDetailForm();

		if ($model->load($request->bodyParams, '') && $model->update($config)) {
			Yii::$app->response->statusCode = 200;
			return;
		}
		throw new BadRequestHttpException("Unable to edit stack!");
	}

	public function actionAddStackImage()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$request = Yii::$app->request;

		if (!$request->post('id'))
			throw new BadRequestHttpException("Image ID is missing!");
		if (!$request->post('part_number'))
			throw new BadRequestHttpException("Partnumber is missing!");
		if (!$request->post('reference'))
			throw new BadRequestHttpException("Reference is missing!");

		$model = new FakeStackImageForm();
		$model->fake_stack_detail_id = $request->post('id');

		if ($model->load($request->post(), '')) {
			$model->scenario = FakeStackImageForm::SCENARIO_CREATE;
			$verification = $model->verify();
			if ($verification)
				throw new BadRequestHttpException($verification);
			if (!$verification and $model->create()) {
				Yii::$app->response->statusCode = 201;
				return;
			}
		}
		throw new BadRequestHttpException("Unable to add image!");
	}

	public function actionEditStackImage()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$request = Yii::$app->request;

		if (!$request->queryParams['id'])
			throw new BadRequestHttpException("Image ID is missing!");

		$config = FakeStackImage::findOne($request->queryParams['id']);
		$model = new FakeStackImageForm();

		if ($model->load($request->bodyParams, '') && $model->update($config)) {
			Yii::$app->response->statusCode = 200;
			return;
		}
		throw new BadRequestHttpException("Unable to edit image!");
	}

	public function actionAddCodepool()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$request = Yii::$app->request;

		if (!$request->post('name'))
			throw new BadRequestHttpException("Name is missing!");
		if (!$request->post('regex'))
			throw new BadRequestHttpException("Regex is missing!");

		$model = new FakeCodePoolForm();

		if ($model->load($request->post(), '')) {
			$model->scenario = FakeCodePoolForm::SCENARIO_CREATE;
			$verification = $model->verify();
			if ($verification)
				throw new BadRequestHttpException($verification);
			if (!$verification and $model->create()) {
				Yii::$app->response->statusCode = 201;
				return;
			}
		}
		throw new BadRequestHttpException("Unable to add codepool!");
	}

	public function actionEditCodepool()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$request = Yii::$app->request;

		if (!$request->queryParams['id'])
			throw new BadRequestHttpException("Codepool ID is missing!");

		$config = FakeCodePool::findOne($request->queryParams['id']);
		$model = new FakeCodePoolForm();

		if ($model->load($request->bodyParams, '') && $model->update($config)) {
			Yii::$app->response->statusCode = 200;
			return;
		}
		throw new BadRequestHttpException("Unable to edit codepool!");
	}

	private function formatStackData($stack)
	{
		$images = [];
		foreach($stack->image as $image) {
			array_push($images, $image);
		}

		$stack = ArrayHelper::toArray($stack);
		$stack['images'] = $images;
		return $stack;
	}

}