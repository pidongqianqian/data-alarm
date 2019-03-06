<?php 
namespace DataAlarm;

class Trial
{	
	public $rules;
	public $value;
	public $field;
	public $times; //已触发次数
	public $records;

	public function __construct(array $rules = [], $value, $field = '', $times = 0)
	{
		if (count($rules) === 0) {
			throw new \InvalidArgumentException("rules doesn't exist");
		}
		$this->rules = $rules;
		if (empty($value)) {
			throw new \InvalidArgumentException("value doesn't exist");
		}

		$this->value = $value;
		$this->field = $field;
		$this->times = $times;
	}

	public function judge($value='')
	{
		if (empty($this->field)) {
			$rules = [$rules[1]];
		}

		foreach ($rules as $key => $rule) {
			if ($this->compare($rule['sign'], $value)) {
				$this->times++;
				$this->records[] = [$rule, $value, $rule['sign'], $this->times];
			}
		}

		return $this->records;
	}

	public function compare($sign, $StandValue, $value)
	{
		switch ($sign) {
			case '>':
				return $value > $StandValue; 
				break;
			case '>=':
				return $value >= $StandValue;
				break;
			case '<':
				return $value < $StandValue;
				break;
			case '<=':
				return $value <= $StandValue;	
				break;
			case '=':
				return $value === $StandValue;
				break;
			default:
				throw new \InvalidArgumentException("sign is invalid");
				break;
		}
	}


}
