<?php

namespace api\modules\facility\controllers;

use api\modules\facility\models\FacilityCodePool;
use api\modules\facility\models\FacilityCodePoolForm;
use api\modules\facility\models\FacilityStackDetailForm;
use api\modules\facility\models\FacilityStackImageForm;
use api\modules\facility\models\FacilityStackDetail;
use api\modules\facility\models\FacilityStackImage;
use Yii;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\Response;

class FacilityController extends Controller
{
	public function actionGetStacks()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;

		$facilitydetails = FacilityStackDetail::find()->all();

		for($i = 0; $i < sizeof($facilitydetails); $i++) {
			$facilitydetails[$i] = $this->formatStackData($facilitydetails[$i]);
		}
		return $facilitydetails;
	}

	public function actionGetStackById()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$request = Yii::$app->request;

		if (!$request->get('id'))
			throw new BadRequestHttpException("Stack ID is missing!");

		$facilitydetail = FacilityStackDetail::find()->where([
			'facility_stack_detail_id' => $request->get('id')
		])->one();

		return $this->formatStackData($facilitydetail);
	}

	public function actionGetImages()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;

		$facilityimages = FacilityStackImage::find()->all();
		return $facilityimages;
	}

	public function actionGetImageById()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$request = Yii::$app->request;

		if (!$request->get('id'))
			throw new BadRequestHttpException("Image ID is missing!");

		$facilityimage = FacilityStackImage::find()->where([
			'facility_stack_image_id' => $request->get('id')
		])->one();
		return $facilityimage;
	}

	public function actionGetCodepools()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;

		$codepools = FacilityCodePool::find()->all();
		return $codepools;
	}

	public function actionGetCodepoolById()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$request = Yii::$app->request;

		if (!$request->get('id'))
			throw new BadRequestHttpException("Codepool ID is missing!");

		$codepool = FacilityCodePool::find()->where([
			'facility_stack_detail_id' => $request->get('id')
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

		$model = new FacilityStackDetailForm();

		if ($model->load($request->post(), '')) {
			$model->scenario = FacilityStackDetailForm::SCENARIO_CREATE;
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

		$config = FacilityStackDetail::findOne($request->queryParams['id']);
		$model = new FacilityStackDetailForm();

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

		$model = new FacilityStackImageForm();
		$model->facility_stack_detail_id = $request->post('id');

		if ($model->load($request->post(), '')) {
			$model->scenario = FacilityStackImageForm::SCENARIO_CREATE;
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

		$config = FacilityStackImage::findOne($request->queryParams['id']);
		$model = new FacilityStackImageForm();

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

		$model = new FacilityCodePoolForm();

		if ($model->load($request->post(), '')) {
			$model->scenario = FacilityCodePoolForm::SCENARIO_CREATE;
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

		$config = FacilityCodePool::findOne($request->queryParams['id']);
		$model = new FacilityCodePoolForm();

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
