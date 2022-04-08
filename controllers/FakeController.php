<?php

namespace api\modules\rhea\controllers;

use api\modules\rhea\models\FakeCodePool;
use api\modules\rhea\models\FakeCodePoolForm;
use api\modules\rhea\models\FakeStackDetailForm;
use api\modules\rhea\models\FakeStackImageForm;
use api\modules\rhea\models\FakeStackDetail;
use api\modules\rhea\models\FakeStackImage;
use api\modules\rhea\models\RheaSettings;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\rest\Controller;

class FakeController extends Controller
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

	public function actionAddStackDetail()
	{
		$model = new FakeStackDetailForm();
		if ($model->load(Yii::$app->request->post())) {
			$verification = $model->verify();
			if ($verification)
				Yii::$app->session->setFlash('error', $verification);
			if (!$verification and $model->create()) {
				Yii::$app->session->setFlash('success', 'Stack added!');
				return $this->redirect('/fake/stack');
			}
		}

	}

	public function actionEditStackDetail()
	{
		$request = Yii::$app->request;
		$id = $request->queryParams['id'];
		$config = FakeStackDetail::findOne($id);

		$model = new FakeStackDetailForm();

		if ($request->post('FakeEditStackDetailForm') && $model->load($request->post()) && $model->update($config)) {
			Yii::$app->session->setFlash('success', 'Stack updated!');
			return $this->redirect('/fake/stack');
		}
	}

	public function actionAddStackImage()
	{
		$request = Yii::$app->request;
		$id = $request->queryParams['id'];
		$model = new FakeStackImageForm();

		$model->fake_stack_detail_id = $id;
		if ($model->load($request->post())) {
			$verification = $model->verify();
			if ($verification)
				Yii::$app->session->setFlash('error', $verification);
			if (!$verification and $model->create()) {
				Yii::$app->session->setFlash('success', 'Stack image added!');
				return $this->redirect('/fake/stack/'.$model->fake_stack_detail_id.'/image');
			}
		}
	}

	public function actionEditStackImage()
	{
		$request = Yii::$app->request;
		$id = $request->queryParams['id'];
		$config = FakeStackImage::findOne($id);

		$model = new FakeStackImageForm();

		if ($request->post('FakeStackImageForm') && $model->load($request->post()) && $model->update($config)) {
			Yii::$app->session->setFlash('success', 'Stack image updated!');
			return $this->redirect('/fake/stack/'.$config->fake_stack_detail_id.'/image');
		}

	}

	public function actionAddCodepool()
	{
		$request = Yii::$app->request;
		$model = new FakeCodePoolForm();

		if ($model->load($request->post())) {
			$verification = $model->verify();
			if ($verification)
				Yii::$app->session->setFlash('error', $verification);
			if (!$verification and $model->create()) {
				Yii::$app->session->setFlash('success', 'Stack image added!');
				return $this->redirect('/fake/codepool');
			}
		}

	}

	public function actionEditCodepool()
	{
		$request = Yii::$app->request;
		$id = $request->queryParams['id'];
		$config = FakeCodePool::findOne($id);

		$model = new FakeCodePoolForm();

		if ($request->post('FakeCodePoolForm') && $model->load($request->post()) && $model->update($config)) {
			Yii::$app->session->setFlash('success', 'Code pool updated!');
			return $this->redirect('/fake/codepool');
		}

		return null;
	}

}