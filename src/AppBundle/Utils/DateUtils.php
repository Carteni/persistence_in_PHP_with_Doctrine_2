<?php

namespace AppBundle\Utils;

/**
 * Class DateUtils
 * @package AppBundle\Utils
 */
class DateUtils
{
    public static function timeAgo(\DateTime $ago, $full = true)
    {
        $now = new \DateTime;

        $diff = (array) date_diff($now, $ago);

        $diff['w'] = floor($diff['d'] / 7);
        $diff['d'] -= $diff['w'] * 7;

        $string = array(
          'y' => 'year',
          'm' => 'month',
          'w' => 'week',
          'd' => 'day',
          'h' => 'hour',
          'i' => 'minute',
          's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff[$k]) {
                $v = $diff[$k].' '.$v.($diff[$k] > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }

        return $string ? implode(', ', $string).' ago' : 'just now';

        // Versione Flat
        //$diff = date_diff($now, $ago);
        //return $diff->format('%y years, %m months, %d days, %h hours and %i minutes ago');
    }

}