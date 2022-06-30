<?php

namespace rhea\facility\controllers;

use rhea\facility\CodePool;
use rhea\facility\CodePoolForm;
use rhea\facility\StackDetail;
use rhea\facility\StackDetailForm;
use rhea\facility\StackImage;
use rhea\facility\StackImageForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\Response;

class FacilityController extends Controller
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					// allow everything to users who meet the requirements of the hasAccess() method
					[
						'allow' => true,
						'roles' => ['@'],
						'matchCallback' => function() {
							return self::hasAccess();
						}
					],
					// everything else is denied
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	public static function hasAccess()
	{
		return !Yii::$app->user->isGuest && Yii::$app->user->getIdentity()->hasDevelopmentPermission();
	}

	/**
	 * Displays homepage.
	 *
	 * @return mixed
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionStack()
	{
		$payload = [];
		$query = StackDetail::find();
		$provider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => 20,
			],
		]);
		$payload['provider'] = $provider;

		return $this->render('stack', $payload);
	}

	public function actionImage()
	{
		$request = Yii::$app->request;
		$id = $request->queryParams['id'];

		$query = StackImage::find();
		$provider = new ActiveDataProvider([
			'query' => $query->filterWhere(
				['facility_stack_detail_id' => $id]
			),
			'pagination' => [
				'pageSize' => 20,
			],
		]);
		$payload['provider'] = $provider;
		$payload['facility_stack_detail_id'] = $id;

		return $this->render('image', $payload);
	}

	public function actionCodepool()
	{
		$query = CodePool::find();
		$provider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => 20,
			],
		]);
		$payload['provider'] = $provider;

		return $this->render('code', $payload);
	}


	public function actionAddStackDetail()
	{
		$model = new StackDetailForm();
		if ($model->load(Yii::$app->request->post())) {
			$verification = $model->verify();
			if ($verification)
				Yii::$app->session->setFlash('error', $verification);
			if (!$verification and $model->create()) {
				Yii::$app->session->setFlash('success', 'Stack added!');
				return $this->redirect(['/facility/stack']);
			}
		}

		return $this->render('addStackDetail', ['model' => $model]);
	}

	public function actionEditStackDetail()
	{
		$request = Yii::$app->request;
		$id = $request->queryParams['id'];
		$config = StackDetail::findOne($id);

		$model = new StackDetailForm();

		if ($request->post('StackDetailForm') && $model->load($request->post()) && $model->update($config)) {
			Yii::$app->session->setFlash('success', 'Stack updated!');
			return $this->redirect(['/facility/stack']);
		}

		$model->setConfig($config);

		return $this->render('editStackDetail', ['model' => $model]);
	}

	public function actionAddStackImage()
	{
		$request = Yii::$app->request;
		$id = $request->queryParams['id'];
		$model = new StackImageForm();

		$model->facility_stack_detail_id = $id;
		if ($model->load($request->post())) {
			$verification = $model->verify();
			if ($verification)
				Yii::$app->session->setFlash('error', $verification);
			if (!$verification and $model->create()) {
				Yii::$app->session->setFlash('success', 'Stack image added!');
				return $this->redirect(['/facility/stack/'.$model->facility_stack_detail_id.'/image']);
			}
		}

		return $this->render('addStackImage', ['model' => $model]);
	}

	public function actionEditStackImage()
	{
		$request = Yii::$app->request;
		$id = $request->queryParams['id'];
		$config = StackImage::findOne($id);

		$model = new StackImageForm();

		if ($request->post('StackImageForm') && $model->load($request->post()) && $model->update($config)) {
			Yii::$app->session->setFlash('success', 'Stack image updated!');
			return $this->redirect(['/facility/stack/'.$config->facility_stack_detail_id.'/image']);
		}

		$model->setConfig($config);

		return $this->render('editStackImage', ['model' => $model, 'stackdetail' => $config]);
	}

	public function actionAddCodepool()
	{
		$request = Yii::$app->request;
		$model = new CodePoolForm();

		if ($model->load($request->post())) {
			$verification = $model->verify();
			if ($verification)
				Yii::$app->session->setFlash('error', $verification);
			if (!$verification and $model->create()) {
				Yii::$app->session->setFlash('success', 'Stack image added!');
				return $this->redirect(['/facility/codepool']);
			}
		}

		return $this->render('addCodepool', ['model' => $model]);
	}

	public function actionEditCodepool()
	{
		$request = Yii::$app->request;
		$id = $request->queryParams['id'];
		$config = CodePool::findOne($id);

		$model = new CodePoolForm();

		if ($request->post('CodePoolForm') && $model->load($request->post()) && $model->update($config)) {
			Yii::$app->session->setFlash('success', 'Code pool updated!');
			return $this->redirect(['/facility/codepool']);
		}

		$model->setConfig($config);

		return $this->render('editCodepool', ['model' => $model]);
	}

	public function actionFetchStackImages()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$request = Yii::$app->request;

		$id = $request->queryParams['id'];

		$stack = StackDetail::getByStack($id);
		if (!$stack)
			throw new BadRequestHttpException("No stack for this bucksheet found!");

		$images = [];
		foreach($stack->images as $image) {
			array_push($images, [
				"Articlenumber" => $image->part_number,
				"Referenz" => $image->reference
			]);
		}

		$result['Result']['Rows'] = $images;
		return $result;
	}

	public function actionFetchStackDetails()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$request = Yii::$app->request;

		$id = $request->queryParams['id'];

		$stack = StackDetail::getByStack($id);
		if (!$stack)
			throw new BadRequestHttpException("No stack for this bucksheet found!");
		$details = [
			"StackOpenQuantity" => 100000,
			"Articlenumber" => $stack->part_number,
			"ProductionOrdersNumber" => $stack->production_order_id,
			"StackOpen" => true,
			"StackTest" => true
		];

		$result['Result']['Rows'] = $details;
		return $result;
	}

}
