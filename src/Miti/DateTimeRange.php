<?php

namespace Miti;

/**
 * Represents a date time range 
 * 
 * @author Aalok Thapa <thapa.aalok@gmail.com> 
 */
class DateTimeRange{

	/**
	 * The start range 
	 * 
	 * @var DateTime
	 * @access public
	 */
	public $start = NULL;

	/**
	 * The end range 
	 * 
	 * @var DateTime
	 * @access public
	 */
	public $end = NULL;

	/**
	 * Compares this range with specified range based on start range
	 * 
	 * @static
	 * @param     DateTimeRange    $first   The first range
	 * @param     DateTimeRange    $second   The second range
	 * @access    public
	 * @return    integer   Returns an integer less than, equal to, or greater than zero
	 *                      if this range's start date is respectively less than, equal to,
	 *                      or greater than given range
	 */
	public static function compare( DateTimeRange $first, DateTimeRange $second ){

		if( $first->start < $second->start ){
			return -1;
		}

		if( $first->start == $second->start ){
			return 0;
		}

		return 1;
	}

	/**
	 * Constructor
	 * 
	 * @param     DateTime|integer|string    $rangeStart   The start date time
	 * @param     DateTime|integer|string    $rangeEnd     The end date time
	 * @access    public
	 */
	public function __construct( $rangeStart, $rangeEnd ){

		$this->start = DateTime::create( $rangeStart );
		$this->end   = DateTime::create( $rangeEnd   );
	}

	/**
	 * Checks whether this range contains a given date
	 * 
	 * @param     DateTime|string|NULL    $date    The date/time
	 * @access    public
	 * @return    boolean
	 */
	public function contains( $date ){

		$dateTime = DateTime::create( $date );
		return $dateTime >= $this->start && $dateTime <= $this->end;
	}

	/**
	 * Checks if this range equals given range
	 * 
	 * @param     DateTimeRange    $range   The range to check for equality
	 * @access    public
	 * @return    boolean
	 */
	public function equals( DateTimeRange $range ){
		return $this->start == $range->start && $this->end == $range->end;
	}

	/**
	 * Checks if this range overlaps with specified range
	 * 
	 * @param     DateTimeRange    $range    The range to check agains
	 * @access    public
	 * @return    boolean
	 */
	public function overlaps( DateTimeRange $range ){

		if( ( $this->start <= $range->end ) && ( $this->end >= $range->start ) ){
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * Checks whether this range encloses given range
	 *
	 * Criteria for a range to enclose another:
	 *     - If start/end dates equals given range
	 *     - If start date less than & end date greater
	 *       than given range
	 *
	 * @param     DateTimeRange    $range   The range
	 * @access    public
	 * @return    boolean
	 */
	public function encloses( DateTimeRange $range ){
		return ( $this->start <= $range->start ) && ( $this->end >= $range->end );
	}

	/**
	 * Checks whether this range immediately follows a given range
	 * 
	 * @param    DateTimeRange   $range   The range
	 * @access   public
	 * @return   boolean
	 */
	public function consecutiveTo( DateTimeRange $range ){

		$isBefore = $range->start < $this->start && $range->end < $this->end;
		$diff     = $range->end->diff( $this->start );

		return $isBefore && ( $diff->days == 1 && $diff->invert == 0 );
	}
}
