<?php
namespace App\Helpers;

use Carbon\Carbon;

class TimeHelper{
 public static function generateHoursList($start_hour, $end_hour){
  $start = Carbon::createFromTime($start_hour, 0);
  $end = Carbon::createFromTime($end_hour, 0);
  $times = [];

  while ($start->lessThanOrEqualTo($end)) {
   $times[] = $start->format('H:i:s');
   $start->addHour();
  }

  return $times;
 }
}