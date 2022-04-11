<?php

namespace api\modules\fake\models;

use yii\base\Model;

class FakeStackDetailForm extends Model
{
	public $production_order_id;
	public $buck_sheet_id;
	public $part_number;

	const SCENARIO_CREATE = 'create';

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			['production_order_id', 'trim'],
			['production_order_id', 'required', 'on' => self::SCENARIO_CREATE],
			['production_order_id', 'string', 'min' => 2, 'max' => 10],

			['buck_sheet_id', 'trim'],
			['buck_sheet_id', 'required', 'on' => self::SCENARIO_CREATE],
			['buck_sheet_id', 'string', 'min' => 2, 'max' => 10],

			['part_number', 'trim'],
			['part_number', 'required', 'on' => self::SCENARIO_CREATE],
			['part_number', 'string', 'min' => 2, 'max' => 250],
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

		$stackdetail = FakeStackDetail::find()->where([
			'buck_sheet_id' => $this->buck_sheet_id,
		])->one();
		if ($stackdetail != null)
			return "A fake stack for this bucksheet already exists";

		return null;
	}

	/**
	 * Adds a new fake stack detail.
	 *
	 * @return bool whether the creating was successful or not
	 */
	public function create()
	{
		$stackdetail = new FakeStackDetail();
		$stackdetail->production_order_id = $this->production_order_id;
		$stackdetail->buck_sheet_id = $this->buck_sheet_id;
		$stackdetail->part_number = $this->part_number;

		return $stackdetail->save();
	}

	/**
	 * Updates an existing fake stack detail.
	 *
	 * @return bool whether the update was successful or not
	 */
	public function update($config)
	{
		if (!$this->validate()) {
			return false;
		}

		$config->production_order_id = $this->production_order_id ?: $config->production_order_id;
		$config->buck_sheet_id = $this->buck_sheet_id ?: $config->buck_sheet_id;
		$config->part_number = $this->part_number ?: $config->part_number;

		return $config->save();
	}

	public function setConfig($config)
	{
		$this->production_order_id = $config->production_order_id;
		$this->buck_sheet_id = $config->buck_sheet_id;
		$this->part_number = $config->part_number;
	}

}