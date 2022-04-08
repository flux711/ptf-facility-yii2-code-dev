<?php

namespace api\modules\fake\models;

use yii\base\Model;

class FakeStackImageForm extends Model
{
	public $fake_stack_detail_id;
	public $part_number;
	public $reference;

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			['fake_stack_detail_id', 'trim'],
			['fake_stack_detail_id', 'required'],
			['fake_stack_detail_id', 'integer', 'min' => 1, 'max' => 10],
			['fake_stack_detail_id', 'exist',
				'targetClass' => FakeStackDetail::class,
				'targetAttribute' => ['fake_stack_detail_id' => 'fake_stack_detail_id'],
				'message' => 'Fake stack detail ID {value} does not exist.'
			],

			['part_number', 'trim'],
			['part_number', 'required'],
			['part_number', 'string', 'min' => 2, 'max' => 250],

			['reference', 'trim'],
			['reference', 'required'],
			['reference', 'string', 'min' => 2, 'max' => 50],
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

		$stackimage = FakeStackImage::find()->where(
			['and',
				['fake_stack_detail_id' => $this->fake_stack_detail_id],
				['part_number' => $this->part_number]
			])->one();
		if ($stackimage)
			return "A fake image with part ".$this->part_number." already exists for this stack";

		return null;
	}

	/**
	 * Adds a new configuration.
	 *
	 * @return bool whether the creating was successful or not
	 */
	public function create()
	{
		$stackimage = new FakeStackImage();
		$stackimage->fake_stack_detail_id = $this->fake_stack_detail_id;
		$stackimage->part_number = $this->part_number;
		$stackimage->reference = $this->reference;

		return $stackimage->save();
	}

	/**
	 * Adds a new fake stack detail.
	 *
	 * @return bool whether the update was successful or not
	 */
	public function update($config)
	{
		if (!$this->validate()) {
			return false;
		}

		$config->part_number = $this->part_number;
		$config->reference = $this->reference;
		return $config->save();
	}

	public function setConfig($config)
	{
		$this->fake_stack_detail_id = $config->fake_stack_detail_id;
		$this->part_number = $config->part_number;
		$this->reference = $config->reference;
	}

}