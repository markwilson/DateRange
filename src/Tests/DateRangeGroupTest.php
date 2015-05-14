<?php

namespace MarkWilson\DateRange\Tests;

use MarkWilson\DateRange\DateRange;
use MarkWilson\DateRange\DateRangeGroup;

/**
 * Tests DateRangeGroup
 *
 * @package MarkWilson\DateRange\Tests
 * @author  Mark Wilson <mark@89allport.co.uk>
 */
class DateRangeGroupTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getCoversFixtures
     */
    public function testCovers($expectedResult, array $ranges, \DateTime $date)
    {
        $reflector = new \ReflectionClass('\MarkWilson\DateRange\DateRangeGroup');

        /** @var DateRangeGroup $range */
        $range = $reflector->newInstanceArgs($ranges);

        $this->assertEquals($expectedResult, $range->covers($date));
    }

    public function getCoversFixtures()
    {
        $dateRange1 = new DateRange(
            new \DateTime('today'),
            new \DateTime('+2 days')
        );
        $dateRange2 = new DateRange(
            new \DateTime('+4 days'),
            new \DateTime('+6 days')
        );

        $ranges = array($dateRange1, $dateRange2);

        return array(
            'tomorrow' => array(true, $ranges, new \DateTime('tomorrow')),
            'yesterday' => array(false, $ranges, new \DateTime('yesterday')),
            'start date 1' => array(true, $ranges, $dateRange1->getStartDate()),
            'end date 1' => array(false, $ranges, $dateRange1->getEndDate()),
            'start date 2' => array(true, $ranges, $dateRange2->getStartDate()),
            'end date 2' => array(false, $ranges, $dateRange2->getEndDate()),
            'between ranges' => array(false, $ranges, new \DateTime('+3 days')),
            'after' => array(false, $ranges, new \DateTime('+7 days')),
        );
    }
}
