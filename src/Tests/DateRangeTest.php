<?php

namespace MarkWilson\DateRange\Tests;

use MarkWilson\DateRange\DateRange;

/**
 * Tests DateRange
 *
 * @package MarkWilson\DateRange\Tests
 * @author  Mark Wilson <mark@89allport.co.uk>
 */
class DateRangeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getCreateFromStringFixtures
     */
    public function testCreateFromString($expectedStartString, $expectedEndString, $startDateString, $intervalString)
    {
        $range = DateRange::createFromStrings($startDateString, $intervalString);

        $this->assertEquals($expectedStartString, $range->getStartDate()->format('Y-m-d H:i:s'));
        $this->assertEquals($expectedEndString, $range->getEndDate()->format('Y-m-d H:i:s'));
    }

    public function getCreateFromStringFixtures()
    {
        $todayString = date('Y-m-d');

        return array(
            array($todayString . ' 10:20:00', $todayString . ' 10:30:00', '10:20', 'PT10M'),
            array($todayString . ' 15:00:00', $todayString . ' 15:10:00', '15:00', 'PT10M')
        );
    }

    /**
     * @dataProvider getCoversFixtures
     */
    public function testCovers($expectedResult, DateRange $dateRange, \DateTime $date)
    {
        $this->assertEquals($expectedResult, $dateRange->covers($date));
    }

    public function getCoversFixtures()
    {
        $startDate = new \DateTime('today');
        $endDate   = new \DateTime('next week');

        $dateRange = new DateRange($startDate, $endDate);

        return array(
            'tomorrow'   => array(true, $dateRange, new \DateTime('tomorrow')),
            'yesterday'  => array(false, $dateRange, new \DateTime('yesterday')),
            'start date' => array(true, $dateRange, $startDate),
            'end date'   => array(false, $dateRange, $endDate) // this should be false because we perform a < not <= for end dates
        );
    }
}
