# Date Ranges

## Usage

````
<?php

use MarkWilson\DateRange\DateRange;
use MarkWilson\DateRange\DateRangeGroup;

$dateRange = DateRange::createFromStrings('today', '+1 week');
$dateRange->covers(new DateTime('tomorrow'));  // true
$dateRange->covers(new DateTime('yesterday')); // false

$dateRangeGroup = new DateRangeGroup($dateRange); // or ($dateRange1, $dateRange2, ...)
$dateRangeGroup->covers(new DateTime('tomorrow'));  // true
$dateRangeGroup->covers(new DateTime('yesterday')); // false
````
