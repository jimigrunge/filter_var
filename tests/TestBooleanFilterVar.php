<?php
require_once 'simpletest/autorun.php';

if(version_compare(PHP_VERSION, '5.2.0', '<')) {
	require_once '../filter_var.php';
}

class TestBooleanFilterVar extends UnitTestCase
{
	public function testValidateTrueBoolean()
	{
		$this->assertTrue(filter_var('true', FILTER_VALIDATE_BOOLEAN) === TRUE, 'The "boolean" filter is fialing for "true"');
		$this->assertTrue(filter_var('1', FILTER_VALIDATE_BOOLEAN) === TRUE, 'The "boolean" filter is failing for "1"');
		$this->assertTrue(filter_var('on', FILTER_VALIDATE_BOOLEAN) === TRUE, 'The "boolean" filter is failing for "on"');
		$this->assertTrue(filter_var('yes', FILTER_VALIDATE_BOOLEAN) === TRUE, 'The "boolean" filter is failing for "yes"');
	}

	public function testValidateFalseBoolean()
	{
		$this->assertTrue(filter_var('bogus', FILTER_VALIDATE_BOOLEAN) === FALSE, 'The "boolean" filter is failing for "bogus"');
		$this->assertTrue(filter_var('false', FILTER_VALIDATE_BOOLEAN) === FALSE, 'The "boolean" filter is failing for FALSE');
		$this->assertTrue(filter_var('0', FILTER_VALIDATE_BOOLEAN) === FALSE, 'The "boolean" filter is failing for "0"');
		$this->assertTrue(filter_var('off', FILTER_VALIDATE_BOOLEAN) === FALSE, 'The "boolean" filter is failing for "off"');
		$this->assertTrue(filter_var('no', FILTER_VALIDATE_BOOLEAN) === FALSE, 'The "boolean" filter is failing for "no"');
	}

	public function testValidateFalseBooleanReturnNULL()
	{
		$this->assertTrue(filter_var('false', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === FALSE, 'The "boolean" filter is failing for FALSE');
		$this->assertTrue(filter_var('0', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === FALSE, 'The "boolean" filter is failing for "0"');
		$this->assertTrue(filter_var('off', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === FALSE, 'The "boolean" filter is failing for "off"');
		$this->assertTrue(filter_var('no', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === FALSE, 'The "boolean" filter is failing for "no"');
		$this->assertTrue(filter_var(FALSE, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === NULL, 'The "boolean" filter is not returning FALSE.');
		$this->assertTrue(filter_var('testing', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === NULL, 'The "boolean" filter is not returning NULL.');
	}
}//end class TestBooleanFilterVar