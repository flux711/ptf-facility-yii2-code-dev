<?php

namespace api\modules\fake\models;

use yii\base\Model;

class FakeCodePoolForm extends Model
{
	public $name;
	public $regex;

	const SCENARIO_CREATE = 'create';

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			['name', 'trim'],
			['name', 'required', 'on' => self::SCENARIO_CREATE],
			['name', 'string', 'min' => 1, 'max' => 100],

			['regex', 'trim'],
			['regex', 'required', 'on' => self::SCENARIO_CREATE],
			['regex', 'string', 'min' => 1, 'max' => 100],
		];
	}

	/**
	 * Verifies the content before saving it.
	 *
	 * @return string null when no verification issue occured or a message string
	 */
	public function verify()
	{
		if (!$this->validate()) {
			return "Input validation failed!";
		}

		$codepool = FakeCodePool::find()->where([
			'name' => $this->name
		])->one();
		if ($codepool)
			return "A codepool with this name already exists!";

		return null;
	}

	/**
	 * Adds a new fake codepool.
	 *
	 * @return bool whether the creating new account was successful and email was sent
	 */
	public function create()
	{
		$codepool = new FakeCodePool();
		$codepool->name = $this->name;
		$codepool->regex = $this->regex;

		return $codepool->save();
	}

	/**
	 * Updates an existing fake codepool.
	 *
	 * @return bool whether the creating was successfull or not
	 */
	public function update($config)
	{
		if (!$this->validate()) {
			return false;
		}

		$config->name = $this->name ?: $config->name;
		$config->regex = $this->regex ?: $config->regex;
		return $config->save();
	}

	public function setConfig($config)
	{
		$this->name = $config->name;
		$this->regex = $config->regex;
	}
}