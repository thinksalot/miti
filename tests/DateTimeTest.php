<?php

/**
 * Tests for DateTime class 
 * 
 * @uses PHPUnit_Framework_TestCase
 * @author Aalok Thapa <thapa.aalok@gmail.com> 
 */
class DateTimeTest extends PHPUnit_Framework_TestCase{

	/**
	 * It should be possible to create a instance by passing a
	 * timestamp to the create method
	 * 
	 * @access public
	 */
	public function testCreateFromTimestamp(){

		$timestamp = strtotime( '-5 days' );

		$dt = Miti\DateTime::create( $timestamp );
		$this->assertEquals( $timestamp, $dt->getTimestamp() );
		$this->assertEquals( date( 'Y-m-d', $timestamp ), $dt->format( 'Y-m-d' ) );
	}

	/**
	 * It should be possible to create a instance by passing
	 * PHP's DateTime object to the create method
	 * 
	 * @access public
	 */
	public function testCreateFromDateTime(){

		$dateTime = new DateTime();
		$dateTime->modify( '-5 days' );

		$dt = Miti\DateTime::create( $dateTime );

		$this->assertEquals( $dateTime->getTimestamp()   , $dt->getTimestamp() );
		$this->assertEquals( $dateTime->format( 'Y-m-d' ), $dt->format( 'Y-m-d' ) );
	}

	/**
	 * It should be possible to create a instance by passing
	 * string format supported by strtotime()
	 * 
	 * @access public
	 */
	public function testCreateFromString(){

		$format    = '-5 days';
		$timestamp = strtotime( $format );

		$dt = Miti\DateTime::create( $format );
		$this->assertEquals( $timestamp, $dt->getTimestamp() );
		$this->assertEquals( date( 'Y-m-d', $timestamp ), $dt->format( 'Y-m-d' ) );
	}

	/**
	 * When date is in range of given values, range check should
	 * return TRUE
	 * 
	 * @access public
	 */
	public function testBetweenShouldReturnTrue(){

		$dt = new Miti\DateTime( date( 'Y-02-15' ) );
		$this->assertTrue( $dt->between( date( 'Y-01-01' ), date( 'Y-12-31' ) ) );
	}

	/**
	 * When date is out of range, rangecheck should return false
	 * 
	 * @access public
	 */
	public function testOutOfRangeReturnFalse(){
		
		$dt = new Miti\DateTime( date( 'Y-02-15' ) );
		$this->assertFalse( $dt->between( date( 'Y-03-01' ), date( 'Y-12-31' ) ) );
	}

	/**
	 * When date is same as start date of range, between method should return TRUE
	 * 
	 * @access public
	 */
	public function testDateEqualsStartRange(){
		$dt = new Miti\DateTime( date( 'Y-02-15' ) );
		$this->assertTrue( $dt->between( date( 'Y-02-01' ), date( 'Y-12-31' ) ) );
	}

	/**
	 * When date is same as end date of range, between method should return TRUE
	 * 
	 * @access public
	 */
	public function testDateEqualsEndRange(){
		$dt = new Miti\DateTime( date( 'Y-12-31' ) );
		$this->assertTrue( $dt->between( date( 'Y-02-01' ), date( 'Y-12-31' ) ) );
	}
}
