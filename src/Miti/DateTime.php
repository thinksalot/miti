<?php

namespace Miti;

/**
 * Class that adds additional functionality to PHP's DateTime class 
 * 
 * @uses \DateTime
 * @author Aalok Thapa <thapa.aalok@gmail.com> 
 */
class DateTime extends \DateTime{

    /**
     * Converts a given value to datetime object
     * 
     * @static
     * @param    \DateTime|integer|string   $dateTime   The date time object
     * @access   public
     * @return   DateTime   The date time object
     */
    public static function create( $dateTime ){

        # if unix timestamp
        if( is_numeric( $dateTime ) ){

            $timestamp = (int) $dateTime;
            $instance  = new DateTime();
            $instance->setTimestamp( $timestamp );

            return $instance;
        }

        # if DateTime object
        if( $dateTime instanceof \DateTime ){

            $instance = new DateTime();
            $instance->setTimestamp( $dateTime->getTimestamp() );

            return $instance;
        }

        # else must be a supported string format
        return new DateTime( $dateTime );
    }

    /**
     * Checks whether this datetime falls within a given range
     * 
     * @param     \DateTime|integer|string    $rangeStart    The start range
     * @param     \DateTime|integer|string    $rangeEnd      The end range
     * @access    public
     * @return    boolean
     */
    public function between( $rangeStart, $rangeEnd ){

        $start = self::create( $rangeStart );
        $end   = self::create( $rangeEnd   );

        return $this >= $start && $this <= $end;
    }
}
