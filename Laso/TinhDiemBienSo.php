<?php

/**
 * Created by PhpStorm.
 * User: DUYDUC
 * Date: 10-Jan-19
 * Time: 1:53 PM
 */

namespace Laven;

use Laven\Constants\Constants;

/**
 * This is the class "TinhDiemSim".
 *
 * @property string         $sim
 * @property int            $dungThanId
 * @property int            $hyThanId
 * @property array          $simSplit
 */
class TinhDiemBienSo {

    public $bienSo;
    public $dungThanId;
    public $hyThanId;
    public $bienSoSplit;
    public $amduongChar = [
        'duong' => [
            'a' => 5,
            'c' => 7,
            'e' => 5,
            'u' => 5,
            'o' => 5,
            'l' => 9,
            'h' => 1,
            'm' => 1,
            'k' => 3,
            'q' => 7,
            's' => 7,
            'f' => 1
        ],
        'am' => [
            'y' => 2,
            'i' => 8,
            'd' => 9,
            'n' => 9,
            't' => 9,
            'v' => 9,
            'b' => 1,
            'p' => 1,
            'g' => 4,
            'r' => 6,
            'x' => 6,
            'z' => 6
        ],
    ];

    /**
     * {@inheritdoc}
     * 0(Thủy) 8(Thổ) 3(Mộc) 3(Mộc) 6(Kim) 6(Kim) 9(Hỏa) 9(Hỏa) 9(Hỏa) 9(Hỏa)
     */
    public $nguHanhInfo = [
        1 => ['id' => 1, 'slug' => 'kim', 'text' => 'Kim', 'number' => [6, 7, 'c', 'q', 'r', 's', 'x', 'z'], 'cung_phe' => 5, 'sinh' => 2, 'bi_khac' => 4, 'khac' => 3],
        2 => ['id' => 2, 'slug' => 'thuy', 'text' => 'Thủy', 'number' => [0, 1, 'Đ', 'b', 'p', 'h', 'm', 'f'], 'cung_phe' => 1, 'sinh' => 3, 'bi_khac' => 5, 'khac' => 4],
        3 => ['id' => 3, 'slug' => 'moc', 'text' => 'Mộc', 'number' => [3, 4, 'g', 'k'], 'cung_phe' => 2, 'sinh' => 4, 'bi_khac' => 1, 'khac' => 5],
        4 => ['id' => 4, 'slug' => 'hoa', 'text' => 'Hỏa', 'number' => [9, 'd', 'l', 'n', 't', 'v'], 'cung_phe' => 3, 'sinh' => 5, 'bi_khac' => 2, 'khac' => 1],
        5 => ['id' => 5, 'slug' => 'tho', 'text' => 'Thổ', 'number' => [2, 5, 8, 'a', 'y', 'e', 'u', 'o', 'i'], 'cung_phe' => 4, 'sinh' => 1, 'bi_khac' => 3, 'khac' => 2],
    ];

    public function __construct($bienso, $dungThanId = null, $hyThanId = null) {
        $bienso = str_replace(' ', '', $bienso);
        $this->bienSo = strtolower($bienso);
        $this->bienSoSplit = str_split($this->bienSo);
        $this->dungThanId = $dungThanId;
        $this->hyThanId = $hyThanId;
    }

    function tinhamduong() {
        $am = $duong = 0;
        $arr = array();
        foreach ($this->bienSoSplit as $num) {
            $amduong = true; // duong
            if (is_numeric($num)) {
                $amduong = $num % 2 == 0 ? false : true;
            } else {
                if (array_key_exists($num, $this->amduongChar['am'])) {
                    $amduong = false;
                } elseif (array_key_exists($num, $this->amduongChar['duong'])) {
                    $amduong = true;
                }
            }
            if ($amduong) {
                $duong++;
                $arr['day_so'][] = ['number' => $num, 'text' => '+', 'color' => '#bfffd4'];
            } else {
                $am++;
                $arr['day_so'][] = ['number' => $num, 'text' => '-', 'color' => '#ffb7b7'];
            }
        }
        $arr['am'] = $am;
        $arr['duong'] = $duong;
        $arr['menh'] = 'ok';
        if (($am >= 7 && $am <= 9) || ($duong >= 7 && $duong <= 9)) {
            $arr['diem'] = 1;
            $arr['re'] = 'Số lượng số mang vận âm và dương chênh lệch nhiều.';
        } else if ($am == 6 || $duong == 6) {
            $arr['diem'] = 0.5;
            $arr['menh'] = $duong == 6 ? 1 : 0;
            $arr['re'] = 'Số lượng số mang vận âm dương chênh lệch không nhiều, số đạt được hoà hợp âm dương, tốt.';
        } else if (4 <= $am && $am <= 5) {
            $arr['diem'] = 1;
            $arr['re'] = 'Số lượng số mang vận âm dương hoàn toàn cân bằng, số đạt được hoà hợp âm dương, rất tốt.';
        } else {
            $arr['diem'] = 0;
            $arr['re'] = 'Số lượng số mang vận âm và dương chênh lệch nhiều.';
        }
        return $arr;
    }

    public function tinhquedich() {
        global $arrquedich;
        $bienso = preg_replace("/[^0-9]/", "", $this->bienSo);
        $thuong = substr($bienso, 0, 5);
        $ha = substr($bienso, 5, strlen($bienso));
        $arrthuong = str_split($thuong);
        $arrha = str_split($ha);
        $totalthuong = array_sum($arrthuong);
        $totalha = array_sum($arrha);
        $thuongque = 0;
        $haque = 0;
        if ($totalthuong % 8 == 0) {
            $thuongque = 8;
        } else {
            $thuongque = $totalthuong % 8;
        }
        if ($totalha % 8 == 0) {
            $haque = 8;
        } else {
            $haque = $totalha % 8;
        }
        return $arrquedich[$haque][$thuongque];
    }

    public function tinhDuNien() {
        $duNien = [
            'sinh_khi' => ['cap_so' => [67, 14, 82, 39, 41, 93, 28, 76], 'title' => 'Sinh Khí'],
            'thien_y' => ['cap_so' => [68, 13, 86, 31, 49, 94, 27, 72], 'title' => 'Thiên Y'],
            'dien_nien' => ['cap_so' => [62, 19, 87, 34, 43, 91, 26, 78], 'title' => 'Diên Niên'],
            'phuc_vi' => ['cap_so' => [66, 11, 88, 33, 44, 99, 22, 77, 00, 15, 25, 35, 45, 55, 65, 75, 85, 95], 'title' => 'Phục Vị'],
            'sinh_thien_dien' => ['cap_so' => [1491, 3943, 4134, 9319, 2862, 6726, 7687, 2878], 'title' => 'Sinh Thiên Diên'],
            'sinh_dien' => ['cap_so' => [419, 391, 762, 826], 'title' => 'Sinh Diên'],
            'sinh_phuc' => ['cap_so' => [415, 395, 765, 825], 'title' => 'Sinh Phục'],
            'sinh_sinh' => ['cap_so' => [414, 393, 767, 828], 'title' => 'Sinh Sinh'],
            'hung' => [69, 96, 12, 21, 37, 73, 48, 84, 29, 92, 16, 61, 83, 38, 47, 74, 36, 63, 79, 97, 24, 42, 18, 81, 89, 98, 23, 32, 17, 71, 46, 64],
        ];
        $results = [];
        $flagSinhkhi = $flagThienY = $flagDienNien = $flagPhucvi = false;
        $countHung = 0;


        for ($i = 0; $i < count($this->bienSoSplit); $i++) {
            foreach ($duNien as $key => $val) {
                if (isset($this->bienSoSplit[$i + 1])) {
                    $ss = $this->bienSoSplit[$i] . $this->bienSoSplit[$i + 1];
                    if ($key != 'hung' && in_array($ss, $val['cap_so'])) {
                        $results['cap_so'][strlen($ss)][] = $ss;
                        $results['cap_so2'][] = $ss;
                        $results['title'][] = $key;
                    }
                    if ($key == 'hung') {
                        $countHung++;
                    }
                }
            }
        }
        $diem = $count2 = $count3 = $count4 = 0;
        if (!empty($results['cap_so'][2])) {
            $count2 = count($results['cap_so'][2]);
            if ($count2 >= 5) {
                $diem += 1;
            } else {
                $diem += $count2 * 0.1;
            }
        }
        if (!empty($results['cap_so'][3])) {
            $count3 = count($results['cap_so'][3]);
            if ($count3 >= 3) {
                $diem += 1;
            } else {
                $diem += $count3 * 0.2;
            }
        }
        if (!empty($results['cap_so'][4])) {
            $count4 = count($results['cap_so'][4]);
            if ($count4 >= 2) {
                $diem += 1;
            } else {
                $diem += 0.4;
            }
        }
        if ($countHung >= 5) {
            $diem = 0;
        } else {
            $diem -= 0.1;
        }
        return [
            'total' => $count2 + $count3 + $count4,
            'cap_so' => $results['cap_so2'],
            'title' => array_unique($results['title']),
            'diem' => $diem > 1 ? 1 : $diem,
        ];
    }

    function cmp($a, $b) {
        if (count($a) == count($b)) {
            return 0;
        }
        return ($a < $b) ? 1 : -1;
    }

    function sinhkhac($s1, $s2) { // kim / moc/ thuy hoa tho
        $arr = array();
        switch ($s1) {
            case 'kim':
                if ($s2 == 'moc')
                    $arr['khac'] = 1;
                else if ($s2 == 'thuy')
                    $arr['sinh'] = 1;
                else {
                    
                }

                break;
            case 'moc':
                if ($s2 == 'tho')
                    $arr['khac'] = 1;
                else if ($s2 == 'hoa')
                    $arr['sinh'] = 1;
                else {
                    
                }
                break;
            case 'thuy':
                if ($s2 == 'hoa')
                    $arr['khac'] = 1;
                else if ($s2 == 'moc')
                    $arr['sinh'] = 1;
                else {
                    
                }
                break;
            case 'hoa':
                if ($s2 == 'kim')
                    $arr['khac'] = 1;
                else if ($s2 == 'tho')
                    $arr['sinh'] = 1;
                else {
                    
                }
                break;
            case 'tho':
                if ($s2 == 'thuy')
                    $arr['khac'] = 1;
                else if ($s2 == 'kim')
                    $arr['sinh'] = 1;
                else {
                    
                }
                break;
        }
        return $arr;
    }

    public function tinhDoVuong() {
        $result = [];
        $list = [];
        $nguHanhSim = 0;
        foreach ($this->bienSoSplit as $index => $element) {
            foreach ($this->nguHanhInfo as $key => $val) {
                if (in_array($element, $val['number'])) { // Thủy
                    $result['ngu_hanh'][$key][] = $element;
                    $result['cung_phe'][$key][] = $element;
                    $result['cung_phe'][$val['sinh']][] = $element;
                    $list[] = [
                        'number' => $element,
                        'nguhanh' => $val['text'],
                        'slug' => $val['slug'],
                        'id' => $key,
                        'index' => $index
                    ];
                }
            }
        }
        $nguHanh = [];
        if ((isset($result['ngu_hanh'][1]) && count($result['ngu_hanh'][1]) >= 3 && ((isset($result['ngu_hanh'][5]) && count($result['ngu_hanh'][5]) >= 1) || (isset($result['ngu_hanh'][4]) && count($result['ngu_hanh'][4]) <= 1))) || (isset($result['ngu_hanh'][1]) && count($result['ngu_hanh'][1]) >= 4)) {
            $nguHanh[] = 1;
        }
        if ((isset($result['ngu_hanh'][2]) && count($result['ngu_hanh'][2]) >= 3 && ((isset($result['ngu_hanh'][1]) && count($result['ngu_hanh'][1]) >= 1) || (isset($result['ngu_hanh'][5]) && count($result['ngu_hanh'][5]) <= 1))) || (isset($result['ngu_hanh'][2]) && count($result['ngu_hanh'][2]) >= 4)) {
            $nguHanh[] = 2;
        }
        if ((isset($result['ngu_hanh'][3]) && count($result['ngu_hanh'][3]) >= 3 && ((isset($result['ngu_hanh'][2]) && count($result['ngu_hanh'][2]) >= 1) || (isset($result['ngu_hanh'][1]) && count($result['ngu_hanh'][1]) <= 1))) || (isset($result['ngu_hanh'][3]) && count($result['ngu_hanh'][3]) >= 4)) {
            $nguHanh[] = 3;
        }
        if ((isset($result['ngu_hanh'][4]) && count($result['ngu_hanh'][4]) >= 3 && ((isset($result['ngu_hanh'][3]) && count($result['ngu_hanh'][3]) >= 1) || (isset($result['ngu_hanh'][2]) && count($result['ngu_hanh'][2]) <= 1))) || (isset($result['ngu_hanh'][4]) && count($result['ngu_hanh'][4]) >= 4)) {
            $nguHanh[] = 4;
        }
        if ((isset($result['ngu_hanh'][5]) && count($result['ngu_hanh'][5]) >= 3 && ((isset($result['ngu_hanh'][4]) && count($result['ngu_hanh'][4]) >= 1) || (isset($result['ngu_hanh'][3]) && count($result['ngu_hanh'][3]) <= 1))) || (isset($result['ngu_hanh'][5]) && count($result['ngu_hanh'][5]) >= 4)) {
            $nguHanh[] = 5;
        }
        $countNguHanh = count($nguHanh);
        // Chỉ xét khi ngũ hành tối đa là 2 nếu > 2 coi như sim đó không phải sim phong thủy
        if ($countNguHanh == 2) {
            $nguHanh0 = $nguHanh[0];
            $nguHanh1 = $nguHanh[1];
            $cungPhe0 = isset($result['cung_phe'][$nguHanh0]) ? count($result['cung_phe'][$nguHanh0]) : 0;
            $cungPhe1 = isset($result['cung_phe'][$nguHanh1]) ? count($result['cung_phe'][$nguHanh1]) : 0;
            $nguHanhDuoisim = end($list)['id'];
            //echo $nguHanh[0] . ': ' . $cungPhe0 .'---'. $nguHanh[1] . ': ' . $cungPhe1 .'$nguHanhDuoisim:' . $nguHanhDuoisim. '<br>';
            // Đuôi số trùng lặp 3 số trở lên
            $pattern = "/(000|111|222|333|444|555|666|777|888|999)$/"; //Tam hoa
            if (preg_match($pattern, $this->bienSo)) {

                // -- Xét nếu là tam hoa, ngũ hành đuôi nhỏ hơn 1 đơn vị thì xét theo ngũ hành sinh khắc
                if (($cungPhe0 > 0 && $cungPhe1 > 0) && (($nguHanh0 == $nguHanhDuoisim && ($cungPhe0 + 1) == $cungPhe1) ||
                        ($nguHanh1 == $nguHanhDuoisim && ($cungPhe1 + 1) == $cungPhe0))) {
                    //die("xxx");
                    $nguHanhSim = $this->tinhSinhTroKhacHao($nguHanh0, $nguHanh1);
                } elseif ($cungPhe0 > $cungPhe1) {
                    $nguHanhSim = $nguHanh0;
                } elseif ($cungPhe1 < $cungPhe0) {
                    $nguHanhSim = $nguHanh1;
                }
            } else {
                // Cân nhau xet đến đầu số
                if ($cungPhe0 == $cungPhe1) {
                    $nguHanhDauSo = $list[2];
                    if ($nguHanhDauSo == $this->nguHanhInfo[$nguHanh0]['cung_phe'] || $nguHanhDauSo == $this->nguHanhInfo[$nguHanh1]['khac']) {
                        $nguHanhSim = $nguHanh0;
                    } elseif ($nguHanhDauSo == $this->nguHanhInfo[$nguHanh1]['cung_phe'] || $nguHanhDauSo == $this->nguHanhInfo[$nguHanh0]['khac']) {
                        $nguHanhSim = $nguHanh1;
                    } else {
                        // Cân nhau xét theo hội
                        // -- Sinh lấy theo được sinh
                        // -- Khắc lấy đi khắc
                        $nguHanhSim = $this->tinhSinhTroKhacHao($nguHanh0, $nguHanh1);
                    }
                } elseif ($cungPhe0 > $cungPhe1) {
                    $nguHanhSim = $nguHanh0;
                } elseif ($cungPhe0 < $cungPhe1) {
                    $nguHanhSim = $nguHanh1;
                }
            }
        } elseif ($countNguHanh == 1) {
            $nguHanhSim = $nguHanh[0];
        }
        $thuanMenh = count($result['ngu_hanh']) <= 3 ? true : false;
        $diem = 0;
        if ($thuanMenh) {
            $diem = 2;
        } elseif (!$thuanMenh && !empty($nguHanh)) {
            $diem = 1;
        }
        return [
            'so_sim' => $this->bienSo,
            'ngu_hanh_sim' => isset($this->nguHanhInfo[$nguHanhSim]) ? $this->nguHanhInfo[$nguHanhSim] : NULL,
            'ngu_hanh' => $result['ngu_hanh'],
            'cung_phe' => $result['cung_phe'],
            'list' => $list,
            'thuan_menh' => $thuanMenh,
            'diem' => $diem
        ];
    }

    public function tinhSinhTroKhacHao($nguHanh0, $nguHanh1) {
        $nguHanhSim = 0;
        if ($nguHanh0 == $this->nguHanhInfo[$nguHanh1]['sinh'] || // được sinh
                $nguHanh0 == $this->nguHanhInfo[$nguHanh1]['cung_phe'] || // Cùng phe
                $nguHanh1 == $this->nguHanhInfo[$nguHanh0]['khac'] || // đi khắc
                $nguHanh1 == $this->nguHanhInfo[$nguHanh0]['bi_khac']) { // bị khắc
            $nguHanhSim = $nguHanh0;
        }
        if ($nguHanh1 == $this->nguHanhInfo[$nguHanh0]['sinh'] || // được sinh
                $nguHanh1 == $this->nguHanhInfo[$nguHanh0]['cung_phe'] || // Cùng phe
                $nguHanh0 == $this->nguHanhInfo[$nguHanh1]['khac'] || // đi khắc
                $nguHanh0 == $this->nguHanhInfo[$nguHanh1]['bi_khac']) {
            $nguHanhSim = $nguHanh1;
        }

        return $nguHanhSim;
    }

}
