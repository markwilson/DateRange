<?php

namespace MarkWilson\DateRange;

/**
 * Group of date ranges
 *
 * @package MarkWilson\DateRange
 * @author  Mark Wilson <mark@89allport.co.uk>
 */
class DateRangeGroup
{
    /**
     * Date ranges
     *
     * @var DateRange[]
     */
    private $ranges;

    /**
     * Constructor.
     *
     * @param DateRange $range1 Date range 1
     */
    public function __construct(DateRange $range1)
    {
        $ranges = func_get_args();
        $this->validateRanges($ranges);

        $this->ranges = $ranges;
    }

    /**
     * Check if the group covers the provided date
     *
     * @param \DateTime $date Date to check
     *
     * @return boolean
     */
    public function covers(\DateTime $date)
    {
        foreach ($this->ranges as $range) {
            if ($range->covers($date)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Validate the date ranges
     *
     * @param array $ranges Date ranges
     *
     * @return void
     *
     * @throws \InvalidArgumentException If an invalid date range is provided
     */
    private function validateRanges(array $ranges)
    {
        foreach ($ranges as $range) {
            if (!$range instanceof DateRange) {
                throw new \InvalidArgumentException('Expected DateRange');
            }
        }
    }
}
