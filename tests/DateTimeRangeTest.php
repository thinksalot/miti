<?php

/**
 * Tests for DateTimeRange class 
 * 
 * @uses PHPUnit_Framework_TestCase
 * @author Aalok Thapa <thapa.aalok@gmail.com> 
 */
class DateTimeRangeTest extends PHPUnit_Framework_TestCase{

	/**
	 * When two ranges arent overlapping, method should return FALSE
	 * 
	 * @access public
	 */
	public function testNotOverlappingRange(){

		$rangeOne = new Miti\DateTimeRange(
			date( '2014-01-01' ),
			date( '2014-12-31' )
		);

		$rangeTwo = new Miti\DateTimeRange(
			date( '2015-02-12' ),
			date( '2015-04-23' )
		);

		$this->assertFalse( $rangeOne->overlaps( $rangeTwo ) );
	}

	/**
	 * When two ranges overlap, the method should return TRUE
	 * 
	 * @access public
	 */
	public function testOverlappingRange(){

		$rangeOne = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-12-31' )
		);

		$rangeTwo = new Miti\DateTimeRange(
			date( 'Y-02-12' ),
			date( 'Y-04-23' )
		);

		$this->assertTrue( $rangeOne->overlaps( $rangeTwo ) );
	}

	/**
	 * When two ranges are same, method should return TRUE
	 * 
	 * @access public
	 */
	public function testOverlappingSameRange(){

		$rangeOne = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-12-31' )
		);

		$rangeTwo = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-12-31' )
		);

		$this->assertTrue( $rangeOne->overlaps( $rangeTwo ) );
	}

	/**
	 * When start & end date of given ranges are same, they are
	 * considered overlapping
	 * 
	 * @access public
	 */
	public function testOverlappingSameEndStartDate(){

		$rangeOne = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-06-01' )
		);

		$rangeTwo = new Miti\DateTimeRange(
			date( 'Y-06-01' ),
			date( 'Y-12-31' )
		);

		$this->assertTrue( $rangeOne->overlaps( $rangeTwo ) );
	}

	/**
	 * When two ranges are not equal, equals method should return FALSE
	 * 
	 * @access public
	 */
	public function testNotEqualRange(){

		$firstRange = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-12-30' )
		);

		$secondRange = new Miti\DateTimeRange(
			date( 'Y-06-01' ),
			date( 'Y-12-30' )
		);

		$this->assertFalse( $firstRange->equals ( $secondRange ) );
		$this->assertFalse( $secondRange->equals( $firstRange  ) );
	}

	/**
	 * When two ranges are equal, equals method should return TRUE
	 * 
	 * @access public
	 */
	public function testEqualRange(){

		$firstRange = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-12-30' )
		);

		$secondRange = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-12-30' )
		);

		$this->assertTrue( $firstRange->equals ( $secondRange ) );
		$this->assertTrue( $secondRange->equals( $firstRange  ) );
	}

	/**
	 * When a range doesnt enclose another, method should return FALSE
	 * 
	 * @access public
	 */
	public function testNotEnclosingRange(){

		$firstRange = new Miti\DateTimeRange(
			date( 'Y-03-01' ),
			date( 'Y-06-30' )
		);

		$secondRange = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-12-30' )
		);

		$this->assertFalse( $firstRange->encloses( $secondRange ) );
	}

	/**
	 * When start dates are same, method should return TRUE
	 * 
	 * @access public
	 */
	public function testNotEnclosingStartSame(){

		$firstRange = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-12-30' )
		);

		$secondRange = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-06-30' )
		);

		$this->assertTrue( $firstRange->encloses( $secondRange ) );
	}

	/**
	 * When end dates are same, method should return TRUE
	 * 
	 * @access public
	 */
	public function testNotEnclosingEndSame(){

		$firstRange = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-12-30' )
		);

		$secondRange = new Miti\DateTimeRange(
			date( 'Y-06-01' ),
			date( 'Y-12-30' )
		);

		$this->assertTrue( $firstRange->encloses( $secondRange ) );
	}

	/**
	 * When start & end dates for both ranges are same, method should
	 * return TRUE
	 *
	 * @access public
	 */
	public function testEqualEnclosing(){

		$firstRange = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-12-30' )
		);

		$secondRange = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-12-30' )
		);

		$this->assertTrue( $firstRange->encloses( $secondRange ) );
	}

	/**
	 * When a range encloses another, method should return TRUE
	 * 
	 * @access public
	 */
	public function testEnclosingRange(){

		$firstRange = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-12-30' )
		);

		$secondRange = new Miti\DateTimeRange(
			date( 'Y-01-02' ),
			date( 'Y-6-30'  )
		);

		$this->assertTrue( $firstRange->encloses( $secondRange ) );
	}

	/**
	 * When given date is in range, contains method should return TRUE
	 * 
	 * @access public
	 */
	public function testContains(){

		$range = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-12-30' )
		);

		$this->assertTrue( $range->contains( date( 'Y-06-01' ) ) );
	}

	/**
	 * When given date is same as range start date, method should return TRUE
	 * 
	 * @access public
	 */
	public function testContainsStartDate(){

		$range = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-12-30' )
		);

		$this->assertTrue( $range->contains( date( 'Y-01-01' ) ) );
	}

	/**
	 * When given date is same as range end date, method should return TRUE
	 * 
	 * @access public
	 */
	public function testContainsEndDate(){

		$range = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-12-30' )
		);

		$this->assertTrue( $range->contains( date( 'Y-12-30' ) ) );
	}

	/**
	 * When given date is not in range, contains method should return FALSE
	 * 
	 * @access public
	 */
	public function testNotContains(){

		$range = new Miti\DateTimeRange(
			'2014-01-01',
			'2014-12-30'
		);

		$this->assertFalse( $range->contains( date( '2015-06-01' ) ) );
	}

	/**
	 * When a range appears right after another without gaps, consecutiveTo
	 * check should return TRUE
	 *
	 * @access public
	 */
	public function testConsecutive(){

		$firstRange = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-06-t', strtotime( date( 'Y-06-01' ) ) )
		);

		$secondRange = new Miti\DateTimeRange(
			date( 'Y-07-01' ),
			date( 'Y-12-t', strtotime( date( 'Y-12-01' ) ) )
		);

		$this->assertTrue( $secondRange->consecutiveTo( $firstRange ) );
	}

	/**
	 * When ranges have a gap in between, the consecutiveTo
	 * check should return FALSE
	 *
	 * @access public
	 */
	public function testNotConsecutive(){

		$firstRange = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-06-t', strtotime( date( 'Y-06-01' ) ) )
		);

		$secondRange = new Miti\DateTimeRange(
			date( 'Y-07-02' ),
			date( 'Y-12-t', strtotime( date( 'Y-12-01' ) ) )
		);

		$this->assertFalse( $secondRange->consecutiveTo( $firstRange ) );
	}

	/**
	 * When two ranges overlap over a single day, they are not consecutive
	 * 
	 * @access public
	 */
	public function testSameEndDateNotConsecutive(){

		$firstRange = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-06-t', strtotime( date( 'Y-06-01' ) ) )
		);

		$secondRange = new Miti\DateTimeRange(
			date( 'Y-06-t', strtotime( date( 'Y-06-01' ) ) ),
			date( 'Y-12-t', strtotime( date( 'Y-12-01' ) ) )
		);

		$this->assertFalse( $secondRange->consecutiveTo( $firstRange ) );
	}

	/**
	 * When both ranges are same, they are not consecutive
	 * 
	 * @access public
	 */
	public function testSameRangeNotConsecutive(){

		$firstRange = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-06-t', strtotime( date( 'Y-06-01' ) ) )
		);

		$secondRange = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-06-t', strtotime( date( 'Y-06-01' ) ) )
		);

		$this->assertFalse( $firstRange->consecutiveTo( $secondRange ) );
		$this->assertFalse( $secondRange->consecutiveTo( $firstRange ) );

	}

	/**
	 * If method is called on a range that appears before the check range,
	 * method should return FALSE
	 *
	 * @access public
	 */
	public function testInverseCallNotConsecutive(){

		$firstRange = new Miti\DateTimeRange(
			date( 'Y-01-01' ),
			date( 'Y-06-t', strtotime( date( 'Y-06-01' ) ) )
		);

		$secondRange = new Miti\DateTimeRange(
			date( 'Y-06-t', strtotime( date( 'Y-06-01' ) ) ),
			date( 'Y-12-t', strtotime( date( 'Y-12-01' ) ) )
		);

		$this->assertFalse( $firstRange->consecutiveTo( $secondRange ) );
	}
}
