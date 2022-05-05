<?php

namespace flux711\yii2\facility_code_dev\models;

use yii\base\Model;

class FacilityStackImageForm extends Model
{
	public $facility_stack_detail_id;
	public $part_number;
	public $reference;

	const SCENARIO_CREATE = 'create';

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			['facility_stack_detail_id', 'trim'],
			['facility_stack_detail_id', 'required', 'on' => self::SCENARIO_CREATE],
			['facility_stack_detail_id', 'integer', 'min' => 1, 'max' => 10],
			['facility_stack_detail_id', 'exist',
				'targetClass' => FacilityStackDetail::class,
				'targetAttribute' => ['facility_stack_detail_id' => 'facility_stack_detail_id'],
				'message' => 'Facility stack detail ID {value} does not exist.'
			],

			['part_number', 'trim'],
			['part_number', 'required', 'on' => self::SCENARIO_CREATE],
			['part_number', 'string', 'min' => 2, 'max' => 250],

			['reference', 'trim'],
			['reference', 'required', 'on' => self::SCENARIO_CREATE],
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

		$stackimage = FacilityStackImage::find()->where(
			['and',
				['facility_stack_detail_id' => $this->facility_stack_detail_id],
				['part_number' => $this->part_number]
			])->one();
		if ($stackimage)
			return "A facility image with part ".$this->part_number." already exists for this stack";

		return null;
	}

	/**
	 * Adds a new configuration.
	 *
	 * @return bool whether the creating was successful or not
	 */
	public function create()
	{
		$stackimage = new FacilityStackImage();
		$stackimage->facility_stack_detail_id = $this->facility_stack_detail_id;
		$stackimage->part_number = $this->part_number;
		$stackimage->reference = $this->reference;

		return $stackimage->save();
	}

	/**
	 * Adds a new facility stack detail.
	 *
	 * @return bool whether the update was successful or not
	 */
	public function update($config)
	{
		if (!$this->validate()) {
			return false;
		}

		$config->part_number = $this->part_number ?: $config->part_number;
		$config->reference = $this->reference ?: $config->reference;
		return $config->save();
	}

	public function setConfig($config)
	{
		$this->facility_stack_detail_id = $config->facility_stack_detail_id;
		$this->part_number = $config->part_number;
		$this->reference = $config->reference;
	}

}
