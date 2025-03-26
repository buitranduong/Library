<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Laven;

/**
 * Description of TinhHopHoa
 *
 * @author DUYDUC
 */
class TinhHopHoa {
    
    static function biKhac($value) {
        $array = [
            'moc' => 'kim',
            'kim' => 'hoa',
            'hoa' => 'thuy',
            'thuy' => 'tho',
            'tho' => 'moc'
        ];

        return isset($array[$value]) ? $array[$value] : [];
    }

    public static function run($canChi1, $canChi2) {
        $diaChiHoa = [];
        $diaChiHop = false;
        $diachiLucHop = [
            ['can' => ['ky', 'mau'], 'chi' => 'suu', 'chi2' => 'ti', 'text' => 'Hóa thổ', 'number' => 5],
            ['can' => ['giap', 'at'], 'chi' => 'dan', 'chi2' => 'hoi', 'text' => 'Hóa mộc', 'number' => 3],
            ['can' => ['binh', 'dinh'], 'chi' => 'tuat', 'chi2' => 'mao', 'text' => 'Hóa hỏa', 'number' => 4],
            ['can' => ['tan', 'canh'], 'chi' => 'dau', 'chi2' => 'thin', 'text' => 'Hóa kim', 'number' => 1],
            ['can' => ['quy', 'nham'], 'chi' => 'ty', 'chi2' => 'than', 'text' => 'Hóa thủy', 'number' => 2],
            ['can' => ['ky', 'mau'], 'chi' => 'mui', 'chi2' => 'ngo', 'text' => 'Hóa thổ', 'number' => 5],
        ];
        foreach ($diachiLucHop as $lucHop) {
            if (($canChi1['chi_slug'] == $lucHop['chi'] && $canChi2['chi_slug'] == $lucHop['chi2']) || 
                    ($canChi2['chi_slug'] == $lucHop['chi'] && $canChi1['chi_slug'] == $lucHop['chi2'])) {
                if (in_array($canChi1['can_slug'], $lucHop['can']) || in_array($canChi2['can_slug'], $lucHop['can'])) {
                    $diaChiHoa = ['id' => $lucHop['number'], 'text' => $lucHop['text']];
                } else {
                    $diaChiHop = true;
                }
            }
        }

        // ban tam hop
        $diachiBanTamHop = [
            ['can' => ['quy', 'at'], 'chi' => ['hoi', 'mao'], 'text' => 'Hóa mộc', 'number' => 3],
            ['can' => ['giap', 'binh'], 'chi' => ['dan', 'ngo'], 'text' => 'Hóa hỏa', 'number' => 4],
            ['can' => ['dinh', 'tan'], 'chi' => ['ty', 'dau'], 'text' => 'Hóa kim', 'number' => 1],
            ['can' => ['canh', 'nham'], 'chi' => ['than', 'ti'], 'text' => 'Hóa thủy', 'number' => 2],
        ];

        foreach ($diachiBanTamHop as $tamHop) {
            if (in_array($canChi1['chi_slug'], $tamHop['chi']) && in_array($canChi2['chi_slug'], $tamHop['chi']) && $canChi1['chi_slug'] != $canChi2['chi_slug']) {
                if ((in_array($canChi1['can_slug'], $tamHop['can']) || in_array($canChi2['can_slug'], $tamHop['can']))) {
                    $diaChiHoa = ['id' => $tamHop['number'], 'text' => $tamHop['text']];
                } else {
                    $diaChiHop = true;
                }
            }
        }

        // tam mo
        $diachiBanTamMo = [
            ['can' => ['at', 'ky'], 'chi' => ['mao', 'mui'], 'text' => 'Hóa mộc', 'number' => 3],
            ['can' => ['binh', 'mau'], 'chi' => ['ngo', 'tuat'], 'text' => 'Hóa hỏa', 'number' => 4],
            ['can' => ['tan', 'ky'], 'chi' => ['dau', 'suu'], 'text' => 'Hóa kim', 'number' => 1],
            ['can' => ['nham', 'mau'], 'chi' => ['ti', 'thin'], 'text' => 'Hóa thủy', 'number' => 2],
        ];
        foreach ($diachiBanTamMo as $tamHop) {
            if (in_array($canChi1['chi_slug'], $tamHop['chi']) && in_array($canChi2['chi_slug'], $tamHop['chi']) && $canChi1['chi_slug'] != $canChi2['chi_slug']) {
                if ((in_array($canChi1['can_slug'], $tamHop['can']) || in_array($canChi2['can_slug'], $tamHop['can']))) {
                    $diaChiHoa = ['id' => $tamHop['number'], 'text' => $tamHop['text']];
                } else {
                    $diaChiHop = true;
                }
            }
        }

        $thienCanHoa = [];
        $thienCanHop = false;
        // GIAP KY
        if (($canChi1['can_slug'] == 'giap' && $canChi2['can_slug'] == 'ky') ||
                ($canChi1['can_slug'] == 'ky' && $canChi2['can_slug'] == 'giap')) {
            /**
             * Chính Hóa
             * 2 trụ có chi là Thổ
             * Thiên can Ngày không được xung với thiên can Tháng
             */
            // 
            if (($canChi1['chiInfo']['name'] != self::biKhac($canChi2['chiInfo']['name']) ||
                    $canChi2['chiInfo']['name'] != self::biKhac($canChi1['chiInfo']['name']))) {
                if ($canChi1['chiInfo']['name'] == 'tho' || $canChi2['chiInfo']['name'] == 'tho') {
                    $thienCanHoa = ['id' => 5, 'text' => 'Hóa thổ'];
                }
                if ($canChi1['chiInfo']['name'] == 'moc' || $canChi2['chiInfo']['name'] == 'moc') {
                    $thienCanHoa = ['id' => 3, 'text' => 'Hóa mộc'];
                }
            }
            // ----------------------------------- Xét địa chi hợp hóa -----------------------------------
            // 1: kim, 2: thuy, 3: moc, 4: hoa, 5: tho
            // ----- Tam hop -----
            // Nếu ngũ hành hóa của địa chi không phải là Mộc, Thổ thì thiên can ko xét hóa
            if (!empty($diaChiHoa) && in_array($diaChiHoa['id'], [3, 5])) {
                $thienCanHoa = $diaChiHoa;
            } elseif (!empty($diaChiHoa)) {
                $thienCanHoa = '';
            }
            if (empty($thienCanHoa)) {
                $thienCanHop = true;
            }
        }
        // AT VS CANH hóa KIM, MỘC
        if (($canChi1['can_slug'] == 'at' && $canChi2['can_slug'] == 'canh') ||
                ($canChi1['can_slug'] == 'canh' && $canChi2['can_slug'] == 'at')) {
            if (($canChi1['chiInfo']['name'] != self::biKhac($canChi2['chiInfo']['name']) ||
                    $canChi2['chiInfo']['name'] != self::biKhac($canChi1['chiInfo']['name']))) {
                if ($canChi1['chiInfo']['name'] == 'kim' || $canChi2['chiInfo']['name'] == 'kim') {
                    $thienCanHoa = ['id' => 1, 'text' => 'Hóa kim'];
                }
                if ($canChi1['chiInfo']['name'] == 'moc' || $canChi2['chiInfo']['name'] == 'moc') {
                    $thienCanHoa = ['id' => 3, 'text' => 'Hóa mộc'];
                }
            }
            // ----------------------------------- Xét địa chi hợp hóa -----------------------------------
            // 1: kim, 2: thuy, 3: moc, 4: hoa, 5: tho
            // ----- Tam hop -----
            // Nếu ngũ hành hóa của địa chi không phải là Kim Mộc thì thiên can ko xét hóa
            if (!empty($diaChiHoa) && in_array($diaChiHoa['id'], [1, 3])) {
                $thienCanHoa = $diaChiHoa;
            } elseif (!empty($diaChiHoa)) {
                $thienCanHoa = '';
            }
            if (empty($thienCanHoa)) {
                $thienCanHop = true;
            }
        }
        // BINH VS TAN hóa THỦY, KIM HỎA
        if (($canChi1['can_slug'] == 'binh' && $canChi2['can_slug'] == 'tan') ||
                ($canChi1['can_slug'] == 'tan' && $canChi2['can_slug'] == 'binh')) {
            if (($canChi1['chiInfo']['name'] != self::biKhac($canChi2['chiInfo']['name']) ||
                    $canChi2['chiInfo']['name'] != self::biKhac($canChi1['chiInfo']['name']))) {
                if ($canChi1['chiInfo']['name'] == 'thuy' || $canChi2['chiInfo']['name'] == 'thuy') {
                    $thienCanHoa = ['id' => 2, 'text' => 'Hóa thủy'];
                }
                if ($canChi1['chiInfo']['name'] == 'kim' || $canChi2['chiInfo']['name'] == 'kim') {
                    $thienCanHoa = ['id' => 1, 'text' => 'Hóa kim'];
                }
                if ($canChi1['chiInfo']['name'] == 'hoa' || $canChi2['chiInfo']['name'] == 'hoa') {
                    $thienCanHoa = ['id' => 4, 'text' => 'Hóa hỏa'];
                }
            }
            // ----------------------------------- Xét địa chi hợp hóa -----------------------------------
            // 1: kim, 2: thuy, 3: moc, 4: hoa, 5: tho
            // ----- Tam hop -----
            // Nếu ngũ hành hóa của địa chi không phải là THỦY, KIM HỎA thì thiên can ko xét hóa
            if (!empty($diaChiHoa) && in_array($diaChiHoa['id'], [1, 2, 4])) {
                $thienCanHoa = $diaChiHoa;
            } elseif (!empty($diaChiHoa)) {
                $thienCanHoa = '';
            }
            if (empty($thienCanHoa)) {
                $thienCanHop = true;
            }
        }
        // ĐINH VS NHÂM hóa MỘC HỎA THỦY
        if (($canChi1['can_slug'] == 'dinh' && $canChi2['can_slug'] == 'nham') ||
                ($canChi1['can_slug'] == 'nham' && $canChi2['can_slug'] == 'dinh')) {
            if (($canChi1['chiInfo']['name'] != self::biKhac($canChi2['chiInfo']['name']) ||
                    $canChi2['chiInfo']['name'] != self::biKhac($canChi1['chiInfo']['name']))) {
                if ($canChi1['chiInfo']['name'] == 'moc' || $canChi2['chiInfo']['name'] == 'moc') {
                    $thienCanHoa = ['id' => 3, 'text' => 'Hóa mộc'];
                }
                if ($canChi1['chiInfo']['name'] == 'thuy' || $canChi2['chiInfo']['name'] == 'thuy') {
                    $thienCanHoa = ['id' => 2, 'text' => 'Hóa thủy'];
                }
                if ($canChi1['chiInfo']['name'] == 'hoa' || $canChi2['chiInfo']['name'] == 'hoa') {
                    $thienCanHoa = ['id' => 4, 'text' => 'Hóa hỏa'];
                }
            }
            // ----------------------------------- Xét địa chi hợp hóa -----------------------------------
            // 1: kim, 2: thuy, 3: moc, 4: hoa, 5: tho
            // ----- Tam hop -----
            // Nếu ngũ hành hóa của địa chi không phải là MỘC HỎA THỔ thì thiên can ko xét hóa
            if (!empty($diaChiHoa) && in_array($diaChiHoa['id'], [2, 3, 4])) {
                $thienCanHoa = $diaChiHoa;
            } elseif (!empty($diaChiHoa)) {
                $thienCanHoa = '';
            }
            if (empty($thienCanHoa)) {
                $thienCanHop = true;
            }
        }
        // MAU VS QUY hóa HỎA, THỦY THỔ
        if (($canChi1['can_slug'] == 'mau' && $canChi2['can_slug'] == 'quy') ||
                ($canChi1['can_slug'] == 'quy' && $canChi2['can_slug'] == 'mau')) {
            if (($canChi1['chiInfo']['name'] != self::biKhac($canChi2['chiInfo']['name']) ||
                    $canChi2['chiInfo']['name'] != self::biKhac($canChi1['chiInfo']['name']))) {
                if ($canChi1['chiInfo']['name'] == 'tho' || $canChi2['chiInfo']['name'] == 'tho') {
                    $thienCanHoa = ['id' => 5, 'text' => 'Hóa thổ'];
                }
                if ($canChi1['chiInfo']['name'] == 'thuy' || $canChi2['chiInfo']['name'] == 'thuy') {
                    $thienCanHoa = ['id' => 2, 'text' => 'Hóa thủy'];
                }
                if ($canChi1['chiInfo']['name'] == 'hoa' || $canChi2['chiInfo']['name'] == 'hoa') {
                    $thienCanHoa = ['id' => 4, 'text' => 'Hóa hỏa'];
                }
            }
            // ----------------------------------- Xét địa chi hợp hóa -----------------------------------
            // 1: kim, 2: thuy, 3: moc, 4: hoa, 5: tho
            // ----- Tam hop -----
            // Nếu ngũ hành hóa của địa chi không phải là HỎA, THỦY THỔ thì thiên can ko xét hóa
            if (!empty($diaChiHoa) && in_array($diaChiHoa['id'], [2, 4, 5])) {
                $thienCanHoa = $diaChiHoa;
            } elseif (!empty($diaChiHoa)) {
                $thienCanHoa = '';
            }
            if (empty($thienCanHoa)) {
                $thienCanHop = true;
            }
        }
        
        return [
            'thiencan' => ['hop' => $thienCanHop, 'hoa' => $thienCanHoa],
            'diachi' => ['hop' => $diaChiHop, 'hoa' => $diaChiHoa],
        ];
    }

}
