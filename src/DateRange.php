<?php

namespace MarkWilson\DateRange;

/**
 * A date range
 *
 * @package MarkWilson\DateRange
 * @author  Mark Wilson <mark@89allport.co.uk>
 */
class DateRange
{
    /**
     * Date range start
     *
     * @var \DateTime
     */
    private $startDate;

    /**
     * Date range end
     *
     * @var \DateTime
     */
    private $endDate;

    /**
     * Create a DateRange from start and interval string
     *
     * @param string $dateStartString    Date start
     * @param string $dateIntervalString Range interval
     *
     * @return self
     */
    static public function createFromStrings($dateStartString, $dateIntervalString)
    {
        $startDate = new \DateTime($dateStartString);
        $dateInterval = new \DateInterval($dateIntervalString);

        $endDate = clone $startDate;
        $endDate = $endDate->add($dateInterval);

        return new self($startDate, $endDate);
    }

    /**
     * Constructor.
     *
     * @param \DateTime $startDate Start date
     * @param \DateTime $endDate   End date
     */
    public function __construct(\DateTime $startDate, \DateTime $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * Check if the range covers the provided date
     *
     * @param \DateTime $date Date to check
     *
     * @return boolean
     */
    public function covers(\DateTime $date)
    {
        return ($this->getStartDate() <= $date && $date < $this->getEndDate());
    }

    /**
     * Get start date
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Get end date
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
}
