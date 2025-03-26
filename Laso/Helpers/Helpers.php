<?php

namespace Laven\Helpers;

class Helpers {
    protected $pi;

    public function __construct()
    {
        $this->pi = pi();
    }


    public static function getZodiac($jd) {
	    $hours_zodiac_arr = array(
		    "110100101100",
		    "001101001011",
		    "110011010010",
		    "101100110100",
		    "001011001101",
		    "010010110011"
	    );
	    $chiArr          = array(
		    'Tý',
		    'Sửu',
		    'Dần',
		    'Mão',
		    'Thìn',
		    'Tỵ',
		    'Ngọ',
		    'Mùi',
		    'Thân',
		    'Dậu',
		    'Tuất',
		    'Hợi',
	    );
	    $chi_of_day   = ( $jd + 1 ) % 2;
	    $hours_zodiac = $hours_zodiac_arr[ $chi_of_day % 6 ];
	    $result       = '';
	    $count        = 0;
	    for ( $i = 0; $i < 12; $i ++ ) {
		    if ( substr( $hours_zodiac, $i, 1 ) == '1' ) {
			    $result .= $chiArr[ $i ];
			    $result .= ' (' . ( ( $i * 2 + 23 ) % 24 ) . '-' . ( ( $i * 2 + 1 ) % 24 ) . ')';
			    if ( $count ++ < 5 ) {
				    $result .= ', ';
			    }
			    if ( $count == 3 ) {
				    $result .= '';
			    }
		    }
	    }
	    return $result;
    }

	static function convertDayVn($date = null) {
    	if ($date == null) {
    		$date = date('Y-m-d H:i:s');
	    }
		$weekday = date("l", strtotime($date));
		$weekday = strtolower($weekday);
		switch ($weekday) {
			case 'monday':
				$weekday = 'Thứ hai';
				break;
			case 'tuesday':
				$weekday = 'Thứ ba';
				break;
			case 'wednesday':
				$weekday = 'Thứ tư';
				break;
			case 'thursday':
				$weekday = 'Thứ năm';
				break;
			case 'friday':
				$weekday = 'Thứ sáu';
				break;
			case 'saturday':
				$weekday = 'Thứ bảy';
				break;
			default:
				$weekday = 'Chủ nhật';
				break;
		}

		return $weekday;
	}

	static function getGioID ($gio) {
		if ($gio >=1 && $gio <3) {
			return 2; // suu
		}
		if ($gio >=3 && $gio <5) {
			return 3; // dan
		}
		if ($gio >=5 && $gio <7) {
			return 4; // mao
		}
		if ($gio >=7 && $gio <9) {
			return 5; // thin
		}
		if ($gio >=9 && $gio <11) {
			return 6; // tỵ
		}
		if ($gio >=11 && $gio <13) {
			return 7; // ngo
		}
		if ($gio >=13 && $gio <15) {
			return 8; // mui
		}
		if ($gio >=15 && $gio <17) {
			return 9; // than
		}
		if ($gio >=17 && $gio <19) {
			return 10; // dau
		}
		if ($gio >=19 && $gio <21) {
			return 11; // tuat
		}
		if ($gio >=21 && $gio <23) {
			return 12; // hoi
		}

		return 1; // ty
	}

    function INT($d)
    {
        return floor($d);
    }
    function jdFromDate($dd, $mm, $yy)
    {
        $a = $this->INT((14 - $mm) / 12);
        $y = $yy + 4800 - $a;
        $m = $mm + 12 * $a - 3;
        $jd = $dd + $this->INT((153 * $m + 2) / 5) + 365 * $y + $this->INT($y / 4) - $this->INT($y / 100) + $this->INT($y / 400) - 32045;
        if ($jd < 2299161) {
            $jd = $dd + $this->INT((153 * $m + 2) / 5) + 365 * $y + $this->INT($y / 4) - 32083;
        }
        return $jd;
    }
    function jdToDate($jd)
    {
        if ($jd > 2299160) { // After 5/10/1582, Gregorian calendar
            $a = $jd + 32044;
            $b = $this->INT((4 * $a + 3) / 146097);
            $c = $a - $this->INT(($b * 146097) / 4);
        } else {
            $b = 0;
            $c = $jd + 32082;
        }
        $d = $this->INT((4 * $c + 3) / 1461);
        $e = $c - $this->INT((1461 * $d) / 4);
        $m = $this->INT((5 * $e + 2) / 153);
        $day = $e - $this->INT((153 * $m + 2) / 5) + 1;
        $month = $m + 3 - 12 * $this->INT($m / 10);
        $year = $b * 100 + $d - 4800 + $this->INT($m / 10);
        //echo "day = $day, month = $month, year = $year\n";
        return array($day, $month, $year);
    }

    // doi ngay july thành NGAY
    function jdToDateNGAY($jd)
    {
        if ($jd > 2299160) {
            $a = $jd + 32044;
            $b = $this->INT((4 * $a + 3) / 146097);
            $c = $a - $this->INT(($b * 146097) / 4);
        } else {
            $b = 0;
            $c = $jd + 32082;
        }
        $d = $this->INT((4 * $c + 3) / 1461);
        $e = $c - $this->INT((1461 * $d) / 4);
        $M = $this->INT((5 * $e + 2) / 153);
        $Day = $e - $this->INT((153 * $M + 2) / 5) + 1;
        $Month = $M + 3 - 12 * $this->INT($M / 10);
        $Year = $b * 100 + $d - 4800 + $this->INT($M / 10);
        return $Day;
    }

    function jdToDateTHANG($jd)
    {
        if ($jd > 2299160) {
            $a = $jd + 32044;
            $b = $this->INT((4 * $a + 3) / 146097);
            $c = $a - $this->INT(($b * 146097) / 4);
        } else {
            $b = 0;
            $c = $jd + 32082;
        }
        $d = $this->INT((4 * $c + 3) / 1461);
        $e = $c - $this->INT((1461 * $d) / 4);
        $M = $this->INT((5 * $e + 2) / 153);
        $Day = $e - $this->INT((153 * $M + 2) / 5) + 1;
        $Month = $M + 3 - 12 * $this->INT($M / 10);
        $Year = $b * 100 + $d - 4800 + $this->INT($M / 10);
        return $Month;
    }

    function jdToDateNAM($jd)
    {
        if ($jd > 2299160) {
            $a = $jd + 32044;
            $b = $this->INT((4 * $a + 3) / 146097);
            $c = $a - $this->INT(($b * 146097) / 4);
        } else {
            $b = 0;
            $c = $jd + 32082;
        }
        $d = $this->INT((4 * $c + 3) / 1461);
        $e = $c - $this->INT((1461 * $d) / 4);
        $M = $this->INT((5 * $e + 2) / 153);
        $Day = $e - $this->INT((153 * $M + 2) / 5) + 1;
        $Month = $M + 3 - 12 * $this->INT($M / 10);
        $Year = $b * 100 + $d - 4800 + $this->INT($M / 10);
        return $Year;
    }

    function jdToDateTEXT($jd)
    {
        if ($jd > 2299160) {
            $a = $jd + 32044;
            $b = $this->INT((4 * $a + 3) / 146097);
            $c = $a - $this->INT(($b * 146097) / 4);
        } else {
            $b = 0;
            $c = $jd + 32082;
        }
        $d = $this->INT((4 * $c + 3) / 1461);
        $e = $c - $this->INT((1461 * $d) / 4);
        $M = $this->INT((5 * $e + 2) / 153);
        $Day = $e - $this->INT((153 * $M + 2) / 5) + 1;
        $Month = $M + 3 - 12 * $this->INT($M / 10);
        $Year = $b * 100 + $d - 4800 + $this->INT($M / 10);
        return sprintf("%02d", $Day) . '/' . sprintf("%02d", $Month) . '/' . sprintf("%04d", $Year);
    }

    function getNewMoonDay($k, $timeZone)
    {
        $T = $k / 1236.85; // Time in Julian centuries from 1900 January 0.5
        $T2 = $T * $T;
        $T3 = $T2 * $T;
        $pi = pi();
        $dr = $pi / 180;
        $Jd1 = 2415020.75933 + 29.53058868 * $k + 0.0001178 * $T2 - 0.000000155 * $T3;
        $Jd1 = $Jd1 + 0.00033 * sin((166.56 + 132.87 * $T - 0.009173 * $T2) * $dr); // Mean new moon
        $M = 359.2242 + 29.10535608 * $k - 0.0000333 * $T2 - 0.00000347 * $T3; // Sun's mean anomaly
        $Mpr = 306.0253 + 385.81691806 * $k + 0.0107306 * $T2 + 0.00001236 * $T3; // Moon's mean anomaly
        $F = 21.2964 + 390.67050646 * $k - 0.0016528 * $T2 - 0.00000239 * $T3; // Moon's argument of latitude
        $C1 = (0.1734 - 0.000393 * $T) * sin($M * $dr) + 0.0021 * sin(2 * $dr * $M);
        $C1 = $C1 - 0.4068 * sin($Mpr * $dr) + 0.0161 * sin($dr * 2 * $Mpr);
        $C1 = $C1 - 0.0004 * sin($dr * 3 * $Mpr);
        $C1 = $C1 + 0.0104 * sin($dr * 2 * $F) - 0.0051 * sin($dr * ($M + $Mpr));
        $C1 = $C1 - 0.0074 * sin($dr * ($M - $Mpr)) + 0.0004 * sin($dr * (2 * $F + $M));
        $C1 = $C1 - 0.0004 * sin($dr * (2 * $F - $M)) - 0.0006 * sin($dr * (2 * $F + $Mpr));
        $C1 = $C1 + 0.0010 * sin($dr * (2 * $F - $Mpr)) + 0.0005 * sin($dr * (2 * $Mpr + $M));
        if ($T < -11) {
            $deltat = 0.001 + 0.000839 * $T + 0.0002261 * $T2 - 0.00000845 * $T3 - 0.000000081 * $T * $T3;
        } else {
            $deltat = -0.000278 + 0.000265 * $T + 0.000262 * $T2;
        };
        $JdNew = $Jd1 + $C1 - $deltat;
        //echo "JdNew = $JdNew\n";
        return $this->INT($JdNew + 0.5 + $timeZone / 24);
    }

    function getSunLongitude($jdn, $timeZone)
    {
        $T = ($jdn - 2451545.5 - $timeZone / 24) / 36525; // Time in Julian centuries from 2000-01-01 12:00:00 GMT
        $T2 = $T * $T;
        $pi = pi();
        $dr = $pi / 180; // degree to radian
        $M = 357.52910 + 35999.05030 * $T - 0.0001559 * $T2 - 0.00000048 * $T * $T2; // mean anomaly, degree
        $L0 = 280.46645 + 36000.76983 * $T + 0.0003032 * $T2; // mean longitude, degree
        $DL = (1.914600 - 0.004817 * $T - 0.000014 * $T2) * sin($dr * $M);
        $DL = $DL + (0.019993 - 0.000101 * $T) * sin($dr * 2 * $M) + 0.000290 * sin($dr * 3 * $M);
        $L = $L0 + $DL; // true longitude, degree
        //echo "\ndr = $dr, M = $M, T = $T, DL = $DL, L = $L, L0 = $L0\n";
        // obtain apparent longitude by correcting for nutation and aberration
        $omega = 125.04 - 1934.136 * $T;
        $L = $L - 0.00569 - 0.00478 * sin($omega * $dr);
        $L = $L * $dr;
        $L = $L - $pi * 2 * ($this->INT($L / ($pi * 2))); // Normalize to (0, 2*PI)
        return $this->INT($L / $pi * 6);
    }

    function getLunarMonth11($yy, $timeZone)
    {
        $off = $this->jdFromDate(31, 12, $yy) - 2415021;
        $k = $this->INT($off / 29.530588853);
        $nm = $this->getNewMoonDay($k, $timeZone);
        $sunLong = $this->getSunLongitude($nm, $timeZone); // sun longitude at local midnight
        if ($sunLong >= 9) {
            $nm = $this->getNewMoonDay($k - 1, $timeZone);
        }
        return $nm;
    }

    function getLeapMonthOffset($a11, $timeZone)
    {
        $k = $this->INT(($a11 - 2415021.076998695) / 29.530588853 + 0.5);
        $last = 0;
        $i = 1; // We start with the month following lunar month 11
        $arc = $this->getSunLongitude($this->getNewMoonDay($k + $i, $timeZone), $timeZone);
        do {
            $last = $arc;
            $i = $i + 1;
            $arc = $this->getSunLongitude($this->getNewMoonDay($k + $i, $timeZone), $timeZone);
        } while ($arc != $last && $i < 14);
        return $i - 1;
    }

    // tinh kinh ?o mat troi
    function KinhDoMatTroi($gio, $phut, $dd, $mm, $yy)
    {
        $pi = pi();
        $a = $this->INT((14 - $mm) / 12);
        $y = $yy + 4800 - $a;
        $M = $mm + 12 * $a - 3;
        $jdn = $dd + $this->INT(((153 * $M) + 2) / 5) + 365 * $y + $this->INT($y / 4) - $this->INT($y / 100) + $this->INT($y / 400) - 32045;
        if ($jdn < 2299161) {
            $jdn = $dd + $this->INT((153 * $M + 2) / 5) + 365 * $y + $this->INT($y / 4) - 32083;
        }

        $jd = $jdn + (($gio - 12) / 24) + ($phut / 1440) - 7 / 24;
        $T = ($jd - 2451545) / 36525;
        $L0 = 280.46645 + 36000.76983 * $T + 0.0003032 * $T * $T;
        $M = (357.5291 + 35999.0503 * $T - 0.0001559 * $T * $T - 0.00000048 * $T * $T * $T) * $pi / 180;
        $c = ((1.9146 - 0.004817 * $T - 0.000014 * $T * $T) * sin($M)) + (0.01993 - 0.000101 * $T) * sin(2 * $M) + 0.00029 * sin(3 * $M);
        $theta = $L0 + $c;
        $lambda = $theta - 0.00569 - 0.00478 * sin((125.04 - 1934.136 * $T) * $pi / 180);
        $lambda = $lambda - 360 * $this->INT($lambda / 360);
        return $lambda;
    }

    function convertSolar2Lunar($dd, $mm, $yy, $timeZone, $array = false)
    {
        $dayNumber = $this->jdFromDate($dd, $mm, $yy);
        $k = $this->INT(($dayNumber - 2415021.076998695) / 29.530588853);
        $monthStart = $this->getNewMoonDay($k + 1, $timeZone);
        if ($monthStart > $dayNumber) {
            $monthStart = $this->getNewMoonDay($k, $timeZone);
        }
        $a11 = $this->getLunarMonth11($yy, $timeZone);
        $b11 = $a11;
        if ($a11 >= $monthStart) {
            $lunarYear = $yy;
            $a11 = $this->getLunarMonth11($yy - 1, $timeZone);
        } else {
            $lunarYear = $yy + 1;
            $b11 = $this->getLunarMonth11($yy + 1, $timeZone);
        }
        $lunarDay = $dayNumber - $monthStart + 1;
        $diff = $this->INT(($monthStart - $a11) / 29);
        $lunarLeap = 0;
        $lunarMonth = $diff + 11;
        if ($b11 - $a11 > 365) {
            $leapMonthDiff = $this->getLeapMonthOffset($a11, $timeZone);
            if ($diff >= $leapMonthDiff) {
                $lunarMonth = $diff + 10;
                if ($diff == $leapMonthDiff) {
                    $lunarLeap = 1;
                }
            }
        }
        if ($lunarMonth > 12) {
            $lunarMonth = $lunarMonth - 12;
        }
        if ($lunarMonth >= 11 && $diff < 4) {
            $lunarYear -= 1;
        }
        if ($array) {
            return [
                sprintf("%02d", $lunarDay),
                sprintf("%02d", $lunarMonth),
                sprintf("%04d", $lunarYear),
                $lunarLeap
            ];
        }
        return sprintf("%02d", $lunarDay) . '/' . sprintf("%02d", $lunarMonth) . '/' . sprintf("%04d", $lunarYear);
    }

    function THANGNODU($dd, $mm, $yy, $timeZone)
    {
        //THANG NO DU
        $dayNumber = $this->jdFromDate($dd, $mm, $yy);
        $k = $this->INT(($dayNumber - 2415021.07699869) / 29.530588853);
        $monthStart = $this->getNewMoonDay($k + 1, $timeZone);
        if ($monthStart > $dayNumber) {
            $monthStart = $this->getNewMoonDay($k, $timeZone);
        }
        $a11 = $this->getLunarMonth11($yy, $timeZone);
        $b11 = $a11;

        if ($a11 >= $monthStart) {
            $lunarYear = $yy;
            $a11 = $this->getLunarMonth11($yy - 1, $timeZone);
        } else {
            $lunarYear = $yy + 1;
            $b11 = $this->getLunarMonth11($yy + 1, $timeZone);
        }
        $lunarDay = $dayNumber - $monthStart + 1;
        $diff = $this->INT(($monthStart - $a11) / 29);
        $lunarLeap = 0;
        $lunarMonth = $diff + 11;
        if (($b11 - $a11) > 365) {
            $leapMonthDiff = $this->getLeapMonthOffset($a11, $timeZone);
            if ($diff >= $leapMonthDiff) {
                $lunarMonth = $diff + 10;
                if ($diff = $leapMonthDiff) {
                    $lunarLeap = 1;
                }
            }
        }

        if ($lunarMonth > 12) {
            $lunarMonth = $lunarMonth - 12;
        }
        if ($lunarMonth >= 11 && $diff < 4) {
            $lunarYear = $lunarYear - 1;
        }

        return $this->getNewMoonDay($k + 1, $timeZone) - $this->getNewMoonDay($k, $timeZone);
    }

    function THANGNHUAN($dd, $mm, $yy, $timeZone)
    {
        $dayNumber = $this->jdFromDate($dd, $mm, $yy);
        $k = $this->INT(($dayNumber - 2415021.07699869) / 29.530588853);
        $monthStart = $this->getNewMoonDay($k + 1, $timeZone);
        if ($monthStart > $dayNumber) {
            $monthStart = $this->getNewMoonDay($k, $timeZone);
        }
        $a11 = $this->getLunarMonth11($yy, $timeZone);
        $b11 = $a11;

        if ($a11 >= $monthStart) {
            $lunarYear = $yy;
            $a11 = $this->getLunarMonth11($yy - 1, $timeZone);
        } else {
            $lunarYear = $yy + 1;
            $b11 = $this->getLunarMonth11($yy + 1, $timeZone);
        }
        $lunarDay = $dayNumber - $monthStart + 1;
        $diff = $this->INT(($monthStart - $a11) / 29);
        $lunarLeap = 0;
        $lunarMonth = $diff + 11;
        if (($b11 - $a11) > 365) {
            $leapMonthDiff = $this->getLeapMonthOffset($a11, $timeZone);
            return ($leapMonthDiff + 10) / 12;
        }
        return 0;
    }

    function convertLunar2Solar($lunarDay, $lunarMonth, $lunarYear, $lunarLeap, $timeZone)
    {
        if ($lunarMonth < 11) {
            $a11 = $this->getLunarMonth11($lunarYear - 1, $timeZone);
            $b11 = $this->getLunarMonth11($lunarYear, $timeZone);
        } else {
            $a11 = $this->getLunarMonth11($lunarYear, $timeZone);
            $b11 = $this->getLunarMonth11($lunarYear + 1, $timeZone);
        }
        $k = $this->INT(0.5 + ($a11 - 2415021.076998695) / 29.530588853);
        $off = $lunarMonth - 11;
        if ($off < 0) {
            $off += 12;
        }
        if ($b11 - $a11 > 365) {
            $leapOff = $this->getLeapMonthOffset($a11, $timeZone);
            $leapMonth = $leapOff - 2;
            if ($leapMonth < 0) {
                $leapMonth += 12;
            }
            if ($lunarLeap != 0 && $lunarMonth != $leapMonth) {
                return array(0, 0, 0);
            } else if ($lunarLeap != 0 || $off >= $leapOff) {
                $off += 1;
            }
        }
        $monthStart = $this->getNewMoonDay($k + $off, $timeZone);
        return $this->jdToDate($monthStart + $lunarDay - 1);
    }

	function ngayAmLich($dd, $mm, $yy, $timeZone)
	{

		$dayNumber = $this->jdFromDate($dd, $mm, $yy);
		$k = $this->INT(($dayNumber - 2415021.07699869) / 29.530588853);
		$monthStart = $this->getNewMoonDay($k + 1, $timeZone);
		if ($monthStart > $dayNumber) {
			$monthStart = $this->getNewMoonDay($k, $timeZone);
		}
		$a11 = $this->getLunarMonth11($yy, $timeZone);
		$b11 = $a11;

		if ($a11 >= $monthStart) {
			$lunarYear = $yy;
			$a11 = $this->getLunarMonth11($yy - 1, $timeZone);
		} else {
			$lunarYear = $yy + 1;
			$b11 = $this->getLunarMonth11($yy + 1, $timeZone);
		}

		$lunarDay = $dayNumber - $monthStart + 1;

		$diff = $this->INT(($monthStart - $a11) / 29);
		$lunarLeap = 0;
		$lunarMonth = $diff + 11;
		if (($b11 - $a11) > 365) {
			$leapMonthDiff = $this->getLeapMonthOffset($a11, $timeZone);
			if ($diff >= $leapMonthDiff) {
				$lunarMonth = $diff + 10;
				if ($diff = $leapMonthDiff) {
					$lunarLeap = 1;
				}
			}
		}
		if ($lunarMonth > 12) {
			$lunarMonth = $lunarMonth - 12;
		}
		if ($lunarMonth >= 11 && $diff < 4) {
			$lunarYear = $lunarYear - 1;
		}

		return [
			'day' => sprintf("%02d", $lunarDay),
			'month' => sprintf("%02d", $lunarMonth),
			'year' => sprintf("%02d", $lunarYear),
			'leap' => $lunarLeap
		];
	}

    function Ngay($dd, $mm, $yy, $timeZone)
    {

        $dayNumber = $this->jdFromDate($dd, $mm, $yy);
        $k = $this->INT(($dayNumber - 2415021.07699869) / 29.530588853);
        $monthStart = $this->getNewMoonDay($k + 1, $timeZone);
        if ($monthStart > $dayNumber) {
            $monthStart = $this->getNewMoonDay($k, $timeZone);
        }
        $a11 = $this->getLunarMonth11($yy, $timeZone);
        $b11 = $a11;

        if ($a11 >= $monthStart) {
            $lunarYear = $yy;
            $a11 = $this->getLunarMonth11($yy - 1, $timeZone);
        } else {
            $lunarYear = $yy + 1;
            $b11 = $this->getLunarMonth11($yy + 1, $timeZone);
        }

        $lunarDay = $dayNumber - $monthStart + 1;

        $diff = $this->INT(($monthStart - $a11) / 29);
        $lunarLeap = 0;
        $lunarMonth = $diff + 11;
        if (($b11 - $a11) > 365) {
            $leapMonthDiff = $this->getLeapMonthOffset($a11, $timeZone);
            if ($diff >= $leapMonthDiff) {
                $lunarMonth = $diff + 10;
                if ($diff = $leapMonthDiff) {
                    $lunarLeap = 1;
                }
            }
        }
        if ($lunarMonth > 12) {
            $lunarMonth = $lunarMonth - 12;
        }
        if ($lunarMonth >= 11 && $diff < 4) {
            $lunarYear = $lunarYear - 1;
        }

        return $lunarDay;
    }

    function Thang($dd, $mm, $yy, $timeZone)
    {

        $dayNumber = $this->jdFromDate($dd, $mm, $yy);
        $k = $this->INT(($dayNumber - 2415021.07699869) / 29.530588853);
        $monthStart = $this->getNewMoonDay($k + 1, $timeZone);
        if ($monthStart > $dayNumber) {
            $monthStart = $this->getNewMoonDay($k, $timeZone);
        }
        $a11 = $this->getLunarMonth11($yy, $timeZone);
        $b11 = $a11;

        if ($a11 >= $monthStart) {
            $lunarYear = $yy;
            $a11 = $this->getLunarMonth11($yy - 1, $timeZone);
        } else {
            $lunarYear = $yy + 1;
            $b11 = $this->getLunarMonth11($yy + 1, $timeZone);
        }
        $lunarDay = $dayNumber - $monthStart + 1;
        $diff = $this->INT(($monthStart - $a11) / 29);
        $lunarLeap = 0;

        $lunarMonth = $diff + 11;
        if (($b11 - $a11) > 365) {
            $leapMonthDiff = $this->getLeapMonthOffset($a11, $timeZone);
            if ($diff >= $leapMonthDiff) {
                $lunarMonth = $diff + 10;
                if ($diff = $leapMonthDiff) {
                    $lunarLeap = 1;
                }
            }
        }
        if ($lunarMonth > 12) {
            $lunarMonth = $lunarMonth - 12;
        }
        if ($lunarMonth >= 11 && $diff < 4) {
            $lunarYear = $lunarYear - 1;
        }

        return $lunarMonth;
    }

    function Nam($dd, $mm, $yy, $timeZone)
    {

        $dayNumber = $this->jdFromDate($dd, $mm, $yy);
        $k = $this->INT(($dayNumber - 2415021.07699869) / 29.530588853);
        $monthStart = $this->getNewMoonDay($k + 1, $timeZone);
        if ($monthStart > $dayNumber) {
            $monthStart = $this->getNewMoonDay($k, $timeZone);
        }
        $a11 = $this->getLunarMonth11($yy, $timeZone);
        $b11 = $a11;

        if ($a11 >= $monthStart) {
            $lunarYear = $yy;
            $a11 = $this->getLunarMonth11($yy - 1, $timeZone);
        } else {
            $lunarYear = $yy + 1;
            $b11 = $this->getLunarMonth11($yy + 1, $timeZone);
        }
        $lunarDay = $dayNumber - $monthStart + 1;
        $diff = $this->INT(($monthStart - $a11) / 29);
        $lunarLeap = 0;

        $lunarMonth = $diff + 11;
        if (($b11 - $a11) > 365) {
            $leapMonthDiff = $this->getLeapMonthOffset($a11, $timeZone);
            if ($diff >= $leapMonthDiff) {
                $lunarMonth = $diff + 10;
                if ($diff = $leapMonthDiff) {
                    $lunarLeap = 1;
                }
            }
        }
        if ($lunarMonth > 12) {
            $lunarMonth = $lunarMonth - 12;
        }
        if ($lunarMonth >= 11 && $diff < 4) {
            $lunarYear = $lunarYear - 1;
        }

        return $lunarYear;
    }

    function Duongcongkynhat($dd, $mm, $yy, $timeZone)
    {

        $dayNumber = $this->jdFromDate($dd, $mm, $yy);
        $k = $this->INT(($dayNumber - 2415021.07699869) / 29.530588853);
        $monthStart = $this->getNewMoonDay($k + 1, $timeZone);
        if ($monthStart > $dayNumber) {
            $monthStart = $this->getNewMoonDay($k, $timeZone);
        }
        $a11 = $this->getLunarMonth11($yy, $timeZone);
        $b11 = $a11;

        if ($a11 >= $monthStart) {
            $lunarYear = $yy;
            $a11 = $this->getLunarMonth11($yy - 1, $timeZone);
        } else {
            $lunarYear = $yy + 1;
            $b11 = $this->getLunarMonth11($yy + 1, $timeZone);
        }
        $lunarDay = $dayNumber - $monthStart + 1;
        $diff = $this->INT(($monthStart - $a11) / 29);
        $lunarLeap = 0;

        $lunarMonth = $diff + 11;
        if (($b11 - $a11) > 365) {
            $leapMonthDiff = $this->getLeapMonthOffset($a11, $timeZone);
            if ($diff >= $leapMonthDiff) {
                $lunarMonth = $diff + 10;
                if ($diff = $leapMonthDiff) {
                    $lunarLeap = 1;
                }
            }
        }
        if ($lunarMonth > 12) {
            $lunarMonth = $lunarMonth - 12;
        }
        if ($lunarMonth >= 11 && $diff < 4) {
            $lunarYear = $lunarYear - 1;
        }
        $NgayAm = $lunarDay . "/" . $lunarMonth;
        $Duongcongkynhat = "";
        if ($NgayAm == "13/1" || $NgayAm == "11/2" || $NgayAm == "9/3" || $NgayAm == "7/4" || $NgayAm == "5/5" || $NgayAm == "3/6" || $NgayAm == "8/7" || $NgayAm == "29/7" || $NgayAm == "27/8" || $NgayAm == "25/9" || $NgayAm == "23/10" || $NgayAm == "21/11" || $NgayAm == "19/12") {
            $Duongcongkynhat = 1;
        }
        return $Duongcongkynhat;
    }

    function TamNuongSat($dd, $mm, $yy, $timeZone)
    {

        $dayNumber = $this->jdFromDate($dd, $mm, $yy);
        $k = $this->INT(($dayNumber - 2415021.07699869) / 29.530588853);
        $monthStart = $this->getNewMoonDay($k + 1, $timeZone);
        if ($monthStart > $dayNumber) {
            $monthStart = $this->getNewMoonDay($k, $timeZone);
        }
        $a11 = $this->getLunarMonth11($yy, $timeZone);
        $b11 = $a11;

        if ($a11 >= $monthStart) {
            $lunarYear = $yy;
            $a11 = $this->getLunarMonth11($yy - 1, $timeZone);
        } else {
            $lunarYear = $yy + 1;
            $b11 = $this->getLunarMonth11($yy + 1, $timeZone);
        }
        $lunarDay = $dayNumber - $monthStart + 1;
        $diff = $this->INT(($monthStart - $a11) / 29);
        $lunarLeap = 0;

        $lunarMonth = $diff + 11;
        if (($b11 - $a11) > 365) {
            $leapMonthDiff = $this->getLeapMonthOffset($a11, $timeZone);
            if ($diff >= $leapMonthDiff) {
                $lunarMonth = $diff + 10;
                if ($diff = $leapMonthDiff) {
                    $lunarLeap = 1;
                }
            }
        }
        if ($lunarMonth > 12) {
            $lunarMonth = $lunarMonth - 12;
        }
        if ($lunarMonth >= 11 && $diff < 4) {
            $lunarYear = $lunarYear - 1;
        }
        $NgayAm = $lunarDay . "/" . $lunarMonth;
        $TamNuongSat = "";

        if ($lunarDay == 2 || $lunarDay == 7 || $lunarDay == 13 || $lunarDay == 18 || $lunarDay == 22 || $lunarDay == 27) {
            $TamNuongSat = 1;
        }
        return $TamNuongSat;
    }

    function NgayNguyetKy($dd, $mm, $yy, $timeZone)
    {

        $dayNumber = $this->jdFromDate($dd, $mm, $yy);
        $k = $this->INT(($dayNumber - 2415021.07699869) / 29.530588853);
        $monthStart = $this->getNewMoonDay($k + 1, $timeZone);
        if ($monthStart > $dayNumber) {
            $monthStart = $this->getNewMoonDay($k, $timeZone);
        }
        $a11 = $this->getLunarMonth11($yy, $timeZone);
        $b11 = $a11;

        if ($a11 >= $monthStart) {
            $lunarYear = $yy;
            $a11 = $this->getLunarMonth11($yy - 1, $timeZone);
        } else {
            $lunarYear = $yy + 1;
            $b11 = $this->getLunarMonth11($yy + 1, $timeZone);
        }
        $lunarDay = $dayNumber - $monthStart + 1;
        $diff = $this->INT(($monthStart - $a11) / 29);
        $lunarLeap = 0;

        $lunarMonth = $diff + 11;
        if (($b11 - $a11) > 365) {
            $leapMonthDiff = $this->getLeapMonthOffset($a11, $timeZone);
            if ($diff >= $leapMonthDiff) {
                $lunarMonth = $diff + 10;
                if ($diff = $leapMonthDiff) {
                    $lunarLeap = 1;
                }
            }
        }
        if ($lunarMonth > 12) {
            $lunarMonth = $lunarMonth - 12;
        }
        if ($lunarMonth >= 11 && $diff < 4) {
            $lunarYear = $lunarYear - 1;
        }
        $NgayAm = $lunarDay . "/" . $lunarMonth;
        $NgayNguyetKy = "";

        if ($lunarDay == 5 || $lunarDay == 14 || $lunarDay == 23) {
            $NgayNguyetKy = 1;
        }
        return $NgayNguyetKy;
    }

    function searchForId($id, $array, $column)
    {
        foreach ($array as $key => $val) {
            if ($val[$column] === $id) {
                return $key;
            }
        }
        return null;
    }

    function getKDIndex($array, $value)
    {
        $num = count($array);
        for ($i = 1; $i <= $num; $i++) {
            if ($value == $array[$i]['kinhdo']) {
                return $array[$i];
            }
            if ($value == $array[$num]['kinhdo']) {
                return $array[$num];
            }
            if (isset($array[$i + 1]['kinhdo']) && $value > $array[$i]['kinhdo'] && $value < $array[$i + 1]['kinhdo']) {
                return $array[$i];
            }
            if (!isset($array[$i + 1])) {
                return $array[$i];
            }
        }
    }

    function fix12($n) {
	    $r = $n % 12;
	    if ($r < 0)
	    {
		    $r += 12;
	    }
	    return $r;
    }

    function fix10($n) {
	    $r = $n % 10;
	    if ($r < 0)
	    {
		    $r += 10;
	    }
	    return $r;
    }

    function ngayThangNam($nn, $tt, $nnnn, $duongLich=true, $timeZone=7) {
        /*Summary
        Args=>
            nn (TYPE)=> ngay
            tt (TYPE)=> thang
            nnnn (TYPE)=> nam
            duongLich (bool, optional)=> bool
            timeZone (int, optional)=> +7 Vietnam

        Returns=>
            TYPE=> Description

        Raises=>
            Exception=> Description
        */
        $thangNhuan = 0;
        # if nnnn > 1000 and nnnn < 3000 and nn > 0 and \
        if ( $nn > 0 && $nn < 32 && $tt < 13 && $tt > 0):
            if ($duongLich) {
                return $this->convertSolar2Lunar($nn, $tt, $nnnn, $timeZone, true);
            }
            return [$nn, $tt, $nnnn, $thangNhuan];
        else:
            return "Ngày, tháng, năm không chính xác.";
        endif;
    }

    function canChiNgay($nn, $tt, $nnnn, $duongLich=true, $timeZone=7, $thangNhuan= false) {
        /*Summary

        Args=>
            nn (int)=> ngày
            tt (int)=> tháng
            nnnn (int)=> năm
            duongLich (bool, optional)=> True nếu là dương lịch, false âm lịch
            timeZone (int, optional)=> Múi giờ
            thangNhuan (bool, optional)=> Có phải là tháng nhuận không?

        Returns=>
            TYPE=> Description
        */

        if (!$duongLich) {
            $l2s = $this->convertLunar2Solar($nn, $tt, $nnnn, $thangNhuan, $timeZone);
            $nn = $l2s[0];
            $tt = $l2s[1];
            $nnnn = $l2s[2];
        }
        $jd = $this->jdFromDate($nn, $tt, $nnnn);
        # print jd
        $canNgay = $this->fix10(($jd + 9) % 10) + 1;
        $chiNgay = $this->fix12(($jd + 1) % 12) + 1;
        return [$canNgay, $chiNgay];
    }

    function canChiGio($canNgay, $gio) {

    }

    function ngayThangNamCanChi($nn, $tt, $nnnn, $duongLich=true, $timeZone=7) {
        /* chuyển đổi năm, tháng âm/dương lịch sang Can, Chi trong tiếng Việt.
        Không tính đến can ngày vì phải chuyển đổi qua lịch Julius.

        Hàm tìm can ngày là hàm canChiNgay(nn, tt, nnnn, duongLich=True,\
                                        timeZone=7, thangNhuan=false)

        Args=>
            nn (int)=> Ngày
            tt (int)=> Tháng
            nnnn (int)=> Năm

        Returns=>
            TYPE=> Description
        */
        if ($duongLich) {
            $ngaythangnam = $this->ngayThangNam($nn, $tt, $nnnn, $timeZone);
            if (is_array($ngaythangnam)) {
                list($nn, $tt, $nnnn, $thangNhuan) = $ngaythangnam;
            }
        }
        # Can của tháng
        $canThang = ($nnnn * 12 + $tt + 3) % 10 + 1;
        # Can chi của năm
        $canNamSinh = ($nnnn + 6) % 10 + 1;
        $chiNam = ($nnnn + 8) % 12 + 1;

        return [$canThang, $canNamSinh, $chiNam];
    }

    function nguHanh($tenHanh) {
        /*
        Args=>
            tenHanh (string)=> Tên Hành trong ngũ hành, Kim hoặc K, Moc hoặc M,
            Thuy hoặc T, Hoa hoặc H, Tho hoặc O

        Returns=>
            Dictionary=> ID của Hành, tên đầy đủ của Hành, số Cục của Hành

        Raises=>
            Exception=> Description
        */
        switch ($tenHanh) {
            case "Kim":
            case "K":
                return ["id" => 1, "tenHanh" => "Kim", "cuc" => 4, "tenCuc" => "Kim tứ Cục", "css" => "hanhKim"];
            case "Moc":
            case "M":
                return ["id" => 2, "tenHanh" => "Mộc", "cuc" => 3, "tenCuc" => "Mộc tam Cục", "css" => "hanhMoc"];
            case "Thuy":
            case "T":
                return ["id" => 3, "tenHanh" => "Thủy", "cuc" => 2, "tenCuc" => "Thủy nhị Cục", "css" => "hanhThuy"];
            case "Hoa":
            case "H":
                return ["id" => 4, "tenHanh" => "Hỏa", "cuc" => 6, "tenCuc" => "Hỏa lục Cục", "css" => "hanhHoa"];
            case "Tho":
            case "O":
                return ["id" => 5, "tenHanh" => "Thổ", "cuc" => 5, "tenCuc" => "Thổ ngũ Cục", "css" => "hanhTho"];

            default:
                return ["id" => 0, "tenHanh" => "", "cuc" => 0, "tenCuc" => "", "css" => ""];
        }
    }

    function sinhKhac($hanh1, $hanh2) {
        /*
        Args=>
            hanh1 (TYPE)=> Description
            hanh2 (TYPE)=> Description

        Returns=>
            TYPE=> Description
        */
        $matranSinhKhac = [
            ['', '', '', '', '', ''],
            ['', 0, -1, 1, -2, 2],
            ['', -2, 0, 2, 1, -1],
            ['', 2, 1, 0, 1, -2],
            ['', -1, 2, -2, 0, 1],
            ['', 1, -2, -1, 2, 0]
        ];

        return $matranSinhKhac[$hanh1][$hanh2];
    }

    function nguHanhNapAm($diaChi, $thienCan, $xuatBanMenh= false) {
        /*Sử dụng Ngũ Hành nạp âm để tính Hành của năm.

        Args=>
            diaChi (integer)=> Số thứ tự của địa chi (Tý=1, Sửu=2,...)
            thienCan (integer)=> Số thứ tự của thiên can (Giáp=1, Ất=2,...)

        Returns=>
            Trả về chữ viết tắt Hành của năm (K, T, H, O, M)
        */
        $banMenh = [
            "K1"=> "HẢI TRUNG KIM",
            "T1"=> "GIÁNG HẠ THỦY",
            "H1"=> "TÍCH LỊCH HỎA",
            "O1"=> "BÍCH THƯỢNG THỔ",
            "M1"=> "TANG ÐỐ MỘC",
            "T2"=> "ÐẠI KHÊ THỦY",
            "H2"=> "LƯ TRUNG HỎA",
            "O2"=> "THÀNH ÐẦU THỔ",
            "M2"=> "TÒNG BÁ MỘC",
            "K2"=> "KIM BẠCH KIM",
            "H3"=> "PHÚ ÐĂNG HỎA",
            "O3"=> "SA TRUNG THỔ",
            "M3"=> "ÐẠI LÂM MỘC",
            "K3"=> "BẠCH LẠP KIM",
            "T3"=> "TRƯỜNG LƯU THỦY",
            "K4"=> "SA TRUNG KIM",
            "T4"=> "THIÊN HÀ THỦY",
            "H4"=> "THIÊN THƯỢNG HỎA",
            "O4"=> "LỘ BÀN THỔ",
            "M4"=> "DƯƠNG LIỄU MỘC",
            "T5"=> "TRUYỀN TRUNG THỦY",
            "H5"=> "SƠN HẠ HỎA",
            "O5"=> "ÐẠI TRẠCH THỔ",
            "M5"=> "THẠCH LỰU MỘC",
            "K5"=> "KIẾM PHONG KIM",
            "H6"=> "SƠN ÐẦU HỎA",
            "O6"=> "ỐC THƯỢNG THỔ",
            "M6"=> "BÌNH ÐỊA MỘC",
            "K6"=> "XOA XUYẾN KIM",
            "T6"=> "ÐẠI HẢI THỦY"];
        $matranNapAm = [
            [0, "G", "Ất", "Bính", "Đinh", "Mậu", "Kỷ", "Canh", "Tân", "N", "Q"],
            [1, "K1", false, "T1", false, "H1", false, "O1", false, "M1", false],
            [2, false, "K1", false, "T1", false, "H1", false, "O1", false, "M1"],
            [3, "T2", false, "H2", false, "O2", false, "M2", false, "K2", false],
            [4, false, "T2", false, "H2", false, "O2", false, "M2", false, "K2"],
            [5, "H3", false, "O3", false, "M3", false, "K3", false, "T3", false],
            [6, false, "H3", false, "O3", false, "M3", false, "K3", false, "T3"],
            [7, "K4", false, "T4", false, "H4", false, "O4", false, "M4", false],
            [8, false, "K4", false, "T4", false, "H4", false, "O4", false, "M4"],
            [9, "T5", false, "H5", false, "O5", false, "M5", false, "K5", false],
            [10, false, "T5", false, "H5", false, "O5", false, "M5", false, "K5"],
            [11, "H6", false, "O6", false, "M6", false, "K6", false, "T6", false],
            [12, false, "H6", false, "O6", false, "M6", false, "K6", false, "T6"]
        ];
        try {
	        $diaChi = abs($diaChi);
	        $thienCan = abs($thienCan);
            $nh = $matranNapAm[$diaChi][$thienCan];
            if (in_array($nh[0], ["K", "M", "T", "H", "O"])) {
                if ($xuatBanMenh) {
                    return $banMenh[$nh];
                } else {
                    return $nh[0];
                }
            }
        } catch (Exception $e) {
            return "";
        }
    }

    function dichCung($cungBanDau, $args, $menh = false) {
        $cungSauKhiDich = $this->INT($cungBanDau);
        foreach ($args as $soCungDich) {
            $cungSauKhiDich += $this->INT($soCungDich);
        }
        if ($this->fix12($cungSauKhiDich % 12) == 0) {
            return 12;
        }
        return $this->fix12($cungSauKhiDich % 12);
    }

    function khoangCachCung($cung1, $cung2, $chieu=1) {
        if ($chieu == 1) {  # Con trai, chiều dương
            return ($cung1 - $cung2 + 12) % 12;
        }
        return $this->fix12(($cung2 - $cung1 + 12) % 12);
    }

    function timCuc($viTriCungMenhTrenDiaBan, $canNamSinh) {
        $canThangGieng = $this->fix10(($canNamSinh * 2 + 1) % 10);
        $vt1 = $this->fix12(($viTriCungMenhTrenDiaBan - 3) % 12);
        $canThangMenh = $this->fix10((($vt1 + $canThangGieng) % 10));
        if ($canThangMenh == 0)
            $canThangMenh = 10;
        $nap = $this->nguHanhNapAm($viTriCungMenhTrenDiaBan, $canThangMenh);

        return $nap;
    }

    function timTuVi($cuc, $ngaySinhAmLich) {
        /*Tìm vị trí của sao Tử vi

        Args:
            cuc (TYPE): Description
            ngaySinhAmLich (TYPE): Description

        Returns:
            TYPE: Description

        Raises:
            Exception: Description
        */
        $ngaySinhAmLich = (int)$ngaySinhAmLich;
        $cungDan = 3;  # Vị trí cung Dần ban đầu là 3
        $cucBanDau = $cuc;
        if (!in_array($cuc,[2, 3, 4, 5, 6])) {
            return "Số cục phải là 2, 3, 4, 5, 6";
        }
        while ($cuc < $ngaySinhAmLich) {
            $cuc += $cucBanDau;
            $cungDan += 1;  # Dịch vị trí cung Dần
        }
        $saiLech = $cuc - $ngaySinhAmLich;
        if ($saiLech % 2 == 1) {
            $saiLech = -$saiLech;  # Nếu sai lệch là chẵn thì tiến, lẻ thì lùi
        }
        return $this->dichCung($cungDan, [$saiLech]);
    }

    function timTrangSinh($cucSo) {
        /*Tìm vị trí của Tràng sinh
        Theo thứ tự cục số
        vị trí Tràng sinh sẽ là Dần, Tỵ, Thân hoặc Hợi

        *LƯU Ý* Theo cụ Thiên Lương: Nam -> Thuận, Nữ -> Nghịch

        Args:
            cucSo (int): số cục (2, 3, 4, 5, 6)

        Returns:
            int: Vị trí sao Tràng sinh

        Raises:
            Exception: Description
        */
        if ($cucSo == 6) :  # Hỏa lục cục
            return 3;  # Tràng sinh ở Dần
        elseif ($cucSo == 4) :  # Kim tứ cục
            return 6;  # Tràng sinh ở Tỵ
        elseif ($cucSo == 2 || $cucSo == 5) :  # Thủy nhị cục, Thổ ngũ cục
            return 9;  # Tràng sinh ở Thân
        elseif ($cucSo == 3) :  # Mộc tam cục
            return 12;  # Tràng sinh ở Hợi
        else:
            return "Không tìm được cung an sao Trường sinh";
        endif;
    }

    function timHoaLinh($chiNamSinh, $gioSinh, $gioiTinh, $amDuongNamSinh) {
        if (in_array($chiNamSinh, [3, 7, 11])) {
            $khoiCungHoaTinh = 2;
            $khoiCungLinhTinh = 4;
        } elseif (in_array($chiNamSinh, [1, 5, 9])) {
            $khoiCungHoaTinh = 3;
            $khoiCungLinhTinh = 11;
        } elseif (in_array($chiNamSinh, [6, 10, 2])) {
            $khoiCungHoaTinh = 11;
            $khoiCungLinhTinh = 4;
        } elseif (in_array($chiNamSinh, [12, 4, 8])) {
            $khoiCungHoaTinh = 10;
            $khoiCungLinhTinh = 11;
        } else {
            return "Không thể khởi cung tìm Hỏa-Linh";
        }
        # print khoiCungHoaTinh, khoiCungLinhTinh
        $viTriHoaTinh = $viTriLinhTinh = 0;
        if (($gioiTinh * $amDuongNamSinh) == -1) {
            $viTriHoaTinh = $this->dichCung($khoiCungHoaTinh + 1, [(-1) * $gioSinh]);
            $viTriLinhTinh = $this->dichCung($khoiCungLinhTinh - 1, [$gioSinh]);
        } elseif(($gioiTinh * $amDuongNamSinh) == 1) {
            $viTriHoaTinh = $this->dichCung($khoiCungHoaTinh - 1, [$gioSinh]);
            $viTriLinhTinh = $this->dichCung($khoiCungLinhTinh + 1, [(-1) * $gioSinh]);
        }

        return [$viTriHoaTinh, $viTriLinhTinh];
    }

    function timThienKhoi($canNam) {
        $khoiViet = ['', 2, 1, 12, 10, 8, 1, 8, 7, 6, 4];
        if (array_key_exists($canNam, $khoiViet)) {
            return $khoiViet[$canNam];
        }
        return "Không tìm được vị trí Khôi-Việt";
    }

    function timThienQuanThienPhuc($canNam) {
        # Giáp dương Nhâm khuyển Ất long nghi
        # Mậu thổ Canh chư Quý mã thượng
        # Kỳ nhân quý hiển khả tiên tri
        $thienQuan = ['', 8, 5, 6, 3, 4, 10, 12, 10, 11, 7];

        # Giáp ái kim kê Ất ái hầu
        # Đinh chư Bính thử Kỷ hổ đầu
        # Tân quý phùng xà phúc lộc nhiêu
        $thienPhuc = ['', 10, 9, 1, 12, 4, 3, 7, 6, 7, 6];
        try {
            return [$thienQuan[$canNam] , $thienPhuc[$canNam]];
        } catch (Exception $e) {
            return "Không tìm được Quan-Phúc";
        }
    }

    function timCoThan($chiNam) {
        if (in_array($chiNam, [12, 1, 2])) {
            return 3;
        } elseif (in_array($chiNam, [3, 4, 5])) {
            return 6;
        } elseif (in_array($chiNam, [6, 7, 8])) {
            return 9;
        } else {
            return 12;
        }
    }

    function timThienMa($chiNam) {
        $demNghich = $chiNam % 4;
        switch ($demNghich) {
            case 1:
                return 3;
            case 2:
                return 12;
            case 3:
                return 9;
            case 0:
                return 6;
            default:
                return "Không tìm được Thiên mã";
        }
    }

    function timPhaToai($chiNam) {
        $demNghich = $chiNam % 3;
        switch ($demNghich) {
            case 0:
                return 6;
            case 1:
                return 10;
            case 2:
                return 2;
            default:
                return "Không tìm được Phá toái";
        }
    }

    function timTriet($canNam) {
        // Giáp Kỷ, Thân Dậu cung
        if (in_array($canNam, [1, 6])) {
            return [9, 10];
        } elseif (in_array($canNam, [2, 7])) { // Ất Canh, Ngọ Mùi cung
            return [7, 8];
        } elseif (in_array($canNam, [3, 8])) { // Bính Tân, Thìn Tị cung
            return [5, 6];
        } elseif (in_array($canNam, [4, 9])) { // Đinh Nhâm, Dần Mão cung
            return [3, 4];
        } elseif (in_array($canNam, [5, 10])) { // Mậu Quý, Tý Sửu cung
            return [1, 2];
        } else {
            return "Không tìm được Triệt";
        }
    }

    function timLuuTru($canNam) {
        $maTranLuuHa = ['', 10, 11, 8, 5, 6, 7, 9, 4, 12, 3];
        $maTranThienTru = ['', 6, 7, 1, 6, 7, 9, 3, 7, 10, 11];
        try {
            return [$maTranLuuHa[$canNam], $maTranThienTru[$canNam]];
        } catch (Exception $e) {
            return "Không tìm được Lưu - Trù";
        }
    }

    function dacTinhSao($viTriDiaBan, $sao) {
        $saoId = $sao->saoID;
        $maTranDacTinh = [
            1 => ["Tử vi", "B", "Đ", "M", "B", "V", "M", "M", "Đ", "M", "B", "V", "B"],
            2 => ["Liêm trinh", "V", "Đ", "V", "H", "M", "H", "V", "Đ", "V", "H", "M", "H"],
            3 => ["Thiên đồng", "V", "H", "M", "Đ", "H", "Đ", "H", "H", "M", "H", "H", "Đ"],
            4 => ["Vũ khúc", "V", "M", "V", "Đ", "M", "H", "V", "M", "V", "Đ", "M", "H"],
            5 => ["Thái dương", "H", "Đ", "V", "V", "V", "M", "M", "Đ", "H", "H", "H", "H"],
            6 => ["Thiên cơ", "Đ", "Đ", "H", "M", "M", "V", "Đ", "Đ", "V", "M", "M", "H"],
            8 => ["Thái âm", "V", "Đ", "H", "H", "H", "H", "H", "Đ", "V", "M", "M", "M"],
            9 => ["Tham lang", "H", "M", "Đ", "H", "V", "H", "H", "M", "Đ", "H", "V", "H"],
            10 => ["Cự môn", "V", "H", "V", "M", "H", "H", "V", "H", "Đ", "M", "H", "Đ"],
            11 => ["Thiên tướng", "V", "Đ", "M", "H", "V", "Đ", "V", "Đ", "M", "H", "V", "Đ"],
            12 => ["Thiên lương", "V", "Đ", "V", "V", "M", "H", "M", "Đ", "V", "H", "M", "H"],
            13 => ["Thất sát", "M", "Đ", "M", "H", "H", "V", "M", "Đ", "M", "H", "H", "V"],
            14 => ["Phá quân", "M", "V", "H", "H", "Đ", "H", "M", "V", "H", "H", "Đ", "H"],
            51 => ["Đà la", "H", "Đ", "H", "H", "Đ", "H", "H", "Đ", "H", "H", "Đ", "H"],
            52 => ["Kình dương", "H", "Đ", "H", "H", "Đ", "H", "H", "Đ", "H", "H", "Đ", "H"],
            55 => ["Linh tinh", "H", "H", "Đ", "Đ", "Đ", "Đ", "Đ", "H", "H", "H", "H", "H"],
            56 => ["Hỏa tinh", "H", "H", "Đ", "Đ", "Đ", "Đ", "Đ", "H", "H", "H", "H", "H"],
            57 => ["Văn xương", "H", "Đ", "H", "Đ", "H", "Đ", "H", "Đ", "H", "H", "Đ", "Đ"],
            58 => ["Văn khúc", "H", "Đ", "H", "Đ", "H", "Đ", "H", "Đ", "H", "H", "Đ", "Đ"],
            53 => ["Địa không", "H", "H", "Đ", "H", "H", "Đ", "H", "H", "Đ", "H", "H", "Đ"],
            54 => ["Địa kiếp", "H", "H", "Đ", "H", "H", "Đ", "H", "H", "Đ", "H", "H", "Đ"],
            95 => ["Hóa kỵ", "None", "Đ", "None", "None", "Đ", "None", "None", "Đ", "None", "None", "Đ", "None"],
            36 => ["Đại hao", "None", "None", "Đ", "Đ", "None", "None", "None", "None", "Đ", "Đ", "None", "None"],
            30 => ["Tiểu Hao", "None", "None", "Đ", "Đ", "None", "None", "None", "None", "Đ", "Đ", "None", "None"],
            69 => ["Thiên khốc", "Đ", "Đ", "None", "Đ", "None", "None", "Đ", "Đ", "None", "Đ", "None", "None"],
            70 => ["Thiên hư", "Đ", "Đ", "None", "Đ", "None", "None", "Đ", "Đ", "None", "Đ", "None", "None"],
            98 => ["Thiên mã", "None", "None", "Đ", "None", "None", "Đ", "None", "None", "None", "None", "None", "None"],
            73 => ["Thiên Hình", "None", "None", "Đ", "Đ", "None", "None", "None", "None", "Đ", "Đ", "None", "None"],
            74 => ["Thiên riêu", "None", "None", "Đ", "Đ", "None", "None", "None", "None", "None", "Đ", "Đ", "None"]
        ];
        if (in_array($saoId, array_keys($maTranDacTinh))) {
            if (in_array($maTranDacTinh[$saoId][$viTriDiaBan], ["M", "V", "Đ", "B", "H"])) {
                $sao->anDacTinh($maTranDacTinh[$saoId][$viTriDiaBan]);
            }
        }
        return $sao;
    }

    function tinhGioXuatHanh ($ngayAm, $thangAm) {
		$arrayH = [
			['gio' => '23h-01h và 11h-13h', 'khac'=>1],
			['gio' => '01h-03h và 13h-15h', 'khac'=>2],
			['gio' => '03h-05h và 15h-17h', 'khac'=>3],
			['gio' => '05h-07h và 17h-19h', 'khac'=>4],
			['gio' => '07h-09h và 19h-21h', 'khac'=>5],
			['gio' => '09h-11h và 21h-23h', 'khac'=>6],
		];
		$arrayInfo = [
			1 => ['name' => 'Giờ Đại An', 'stt' => 'Tốt', 'ynghia' => 'Mọi việc đều tốt lành, cầu tài đi hướng Tây Nam sẽ có kết quả tốt, nhà cửa yên  ấm, hạnh phúc. Người xuất hành đều bình yên.'],
			2 => ['name' => 'Giờ Tốc Hỷ', 'stt' => 'Tốt', 'ynghia' => 'Tin vui sắp tới, cầu tài đi hướng Nam. Công việc gặp gỡ đối tác gặp nhiều may mắn, chăn nuôi đều thuận, người đi làm ăn xa có tin vui về.'],
			3 => ['name' => 'Giờ Lưu Niên', 'stt' => 'Xấu', 'ynghia' => 'Sự nghiệp khó thành, cầu tài mờ mịt, kiện cáo nên hoãn lại. Đi giờ này nên phòng ngừa cãi cọ. Ngoài ra nếu xuất hành vào giờ Lưu Niên thì người đi không có tin về, dễ bị mất của, công việc tiến triển chậm chạp, lời nói không có trọng lượng.'],
			4 => ['name' => 'Giờ Xích Khẩu', 'stt' => 'Xấu', 'ynghia' => 'Giờ này chủ về việc mâu thuẫn, cãi cọ, kiện tụng, làm ăn không tốt, có thể dẫn đến hao hụt tiền bạc, không thu lại được lợi nhuận, phải đề phòng tiểu nhân hay có người nguyền rủa, nói xấu sau lưng, cần chú ý hơn về sức khỏe. Nếu có ý định đi đâu mà không quan trọng thì nên hoãn lại. Nếu bắt buộc phải xuất hành để đi hội họp, tranh biện hay có công việc quan trọng không thể dời đi ngày khác thì nên tránh xuất phát vào giờ Xích Khẩu. Đặc biệt cần phải chú ý giữ mồm miệng để tránh tai bay vạ gió.'],
			5 => ['name' => 'Giờ Tiểu Các(Hay Tiểu Cát)', 'stt' => 'Tốt', 'ynghia' => 'Rất tốt lành. Xuất hành gặp may mắn, buôn bán có lợi, nếu là phụ nữ thì sẽ có tin mừng, người nhà đi xa sắp về. Mọi việc đều hòa hợp, có bệnh cầu sẽ khỏi, người nhà đều mạnh khoẻ. Công việc làm ăn kinh doanh mang lại nhiều tài lộc, thuận buồm xuôi gió'],
			6 => ['name' => 'Giờ Tuyết Lộ', 'stt' => 'Xấu', 'ynghia' => 'Cầu tài không có lợi hay bị trái ý không được như mong muốn, nếu xuất hành hay gặp nạn. Muốn mọi việc hanh thông thì việc quan phải nịnh, gặp ma quỷ phải cúng lễ mới qua.'],
			0 => ['name' => 'Giờ Tuyết Lộ', 'stt' => 'Xấu', 'ynghia' => 'Cầu tài không có lợi hay bị trái ý không được như mong muốn, nếu xuất hành hay gặp nạn. Muốn mọi việc hanh thông thì việc quan phải nịnh, gặp ma quỷ phải cúng lễ mới qua.'],
		];
		$results = [];
		foreach ($arrayH as $key => $h) {
			$num = ($ngayAm + $thangAm + $h['khac'] -2) % 6;
                        $results[$key]['canh'] = $h['gio'];
			if (isset($arrayInfo[$num])) {
                            $results[$key]['name'] = $arrayInfo[$num]['name'];
                            $results[$key]['status'] = $arrayInfo[$num]['stt'];
                            $results[$key]['y_nghia'] = $arrayInfo[$num]['ynghia'];
                        }
		}

		return $results;
    }

    static function tinhCanChiNam($namXem) {
	    $canArr = [
		    [
			    'name' => 'canh',
			    'title' => 'Canh',
			    'nguhanh' => 'Kim',
			    'thanggieng' => 'Mậu',
		    ],
		    [
			    'name' => 'tan',
			    'title' => 'Tân',
			    'nguhanh' => 'Kim',
			    'thanggieng' => 'Canh',
		    ],
		    [
			    'name' => 'nham',
			    'title' => 'Nhâm',
			    'nguhanh' => 'Thủy',
			    'thanggieng' => 'Nhâm',

		    ],
		    [
			    'name' => 'quy',
			    'title' => 'Quý',
			    'nguhanh' => 'Thủy',
			    'thanggieng' => 'Giáp',

		    ],
		    [
			    'name' => 'giap',
			    'title' => 'Giáp',
			    'nguhanh' => 'Mộc',
			    'thanggieng' => 'Bính',

		    ],
		    [
			    'name' => 'at',
			    'title' => 'Ất',
			    'nguhanh' => 'Mộc',
			    'thanggieng' => 'Mậu',

		    ],
		    [
			    'name' => 'binh',
			    'title' => 'Bính',
			    'nguhanh' => 'Hỏa',
			    'thanggieng' => 'Canh',
		    ],
		    [
			    'name' => 'dinh',
			    'title' => 'Đinh',
			    'nguhanh' => 'Hỏa',
			    'thanggieng' => 'Nhâm',
		    ],
		    [
			    'name' => 'mau',
			    'title' => 'Mậu',
			    'nguhanh' => 'Thổ',
			    'thanggieng' => 'Giáp',
		    ],
		    [
			    'name' => 'ky',
			    'title' => 'Kỷ',
			    'nguhanh' => 'Thổ',
			    'thanggieng' => 'Bính',
		    ],
	    ];
	    $chiArr = [
		    [
			    'name' => 'than',
			    'title' => 'Thân',
			    'menh' => 'Dương',
			    'nguhanh' => 'Kim',
		    ],
		    [
			    'name' => 'dau',
			    'title' => 'Dậu',
			    'menh' => 'Âm',
			    'nguhanh' => 'Kim',
		    ],
		    [
			    'name' => 'tuat',
			    'title' => 'Tuất',
			    'menh' => 'Dương',
			    'nguhanh' => 'Thổ',
		    ],
		    [
			    'name' => 'hoi',
			    'title' => 'Hợi',
			    'menh' => 'Âm',
			    'nguhanh' => 'Thủy',
		    ],
		    [
			    'name' => 'ti',
			    'title' => 'Tí',
			    'menh' => 'Dương',
			    'nguhanh' => 'Thủy',
		    ],
		    [
			    'name' => 'suu',
			    'title' => 'Sửu',
			    'menh' => 'Âm',
			    'nguhanh' => 'Thổ',
		    ],
		    [
			    'name' => 'dan',
			    'title' => 'Dần',
			    'menh' => 'Dương',
			    'nguhanh' => 'Mộc',
		    ],
		    [
			    'name' => 'mao',
			    'title' => 'Mão',
			    'menh' => 'Âm',
			    'nguhanh' => 'Mộc',
		    ],
		    [
			    'name' => 'thin',
			    'title' => 'Thìn',
			    'menh' => 'Dương',
			    'nguhanh' => 'Thổ',
		    ],
		    [
			    'name' => 'ty',
			    'title' => 'Tỵ',
			    'menh' => 'Âm',
			    'nguhanh' => 'Hỏa',
		    ],
		    [
			    'name' => 'ngo',
			    'title' => 'Ngọ',
			    'menh' => 'Dương',
			    'nguhanh' => 'Hỏa',
		    ],
		    [
			    'name' => 'mui',
			    'title' => 'Mùi',
			    'menh' => 'Âm',
			    'nguhanh' => 'Thổ',
		    ],
	    ];

	    $du = $namXem % 12;
	    $last = substr($namXem, -1);

	    return ['can' => $canArr[$last], 'chi' => $chiArr[$du]];
    }
}
?>