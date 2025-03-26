<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Laven;

/**
 * Description of LasoBatTrach
 *
 * @author DUYDUC
 */
class LasoBatTrach {

    public $cuuVanInfo = [];
    public $cuuDieuInfo = [];
    public $bat_trach;
    public $menh_quai;
    public $huongItem;
    public $namXemInfo;
    public $soTrachQuai;
    public $huong2;
    public $tamNguyenVan;
    public $hoangTuyen = null;
    public $sonName;
    public $huongName;
    public $phiTinh;
    public $soTinhDo = [];
    public $params;
    public $bangPhiTinh = [
        'thuan' => [
            1 => [2, 3, 4, 5, 6, 7, 8, 9],
            2 => [3, 4, 5, 6, 7, 8, 9, 1],
            3 => [4, 5, 6, 7, 8, 9, 1, 2],
            4 => [5, 6, 7, 8, 9, 1, 2, 3],
            5 => [6, 7, 8, 9, 1, 2, 3, 4],
            6 => [7, 8, 9, 1, 2, 3, 4, 5],
            7 => [8, 9, 1, 2, 3, 4, 5, 6],
            8 => [9, 1, 2, 3, 4, 5, 6, 7],
            9 => [1, 2, 3, 4, 5, 6, 7, 8],
        ],
        'nghich' => [
            1 => [9, 8, 7, 6, 5, 4, 3, 2],
            2 => [1, 9, 8, 7, 6, 5, 4, 3],
            3 => [2, 1, 9, 8, 7, 6, 5, 4],
            4 => [3, 2, 1, 9, 8, 7, 6, 5],
            5 => [4, 3, 2, 1, 9, 8, 7, 6],
            6 => [5, 4, 3, 2, 1, 9, 8, 7],
            7 => [6, 5, 4, 3, 2, 1, 9, 8],
            8 => [7, 6, 5, 4, 3, 2, 1, 9],
            9 => [8, 7, 6, 5, 4, 3, 2, 1],
        ]
    ];
    public $diaChi = [
        'ti' => 1,
        'suu' => 8,
        'dan' => 8,
        'mao' => 3,
        'thin' => 4,
        'ty' => 4,
        'ngo' => 9,
        'mui' => 2,
        'than' => 2,
        'dau' => 7,
        'tuat' => 6,
        'hoi' => 6,
    ];
    public $cung = [
        'can' => ['hoi', 'tuat', 'can'],
        'kham' => ['quy', 'ti', 'nham', 'kham'],
        'can2' => ['suu', 'can2', 'dan'],
        'chan' => ['giap', 'mao', 'at', 'chan'],
        'ton' => ['thin', 'ton', 'ty'],
        'ly' => ['binh', 'ngo', 'dinh', 'ly'],
        'khon' => ['mui', 'khon', 'than'],
        'doai' => ['canh', 'dau', 'tan', 'doai']
    ];
//    public $sonHuong = [
//        'nham' => '',
//        'ti' => '',
//        'quy' => '',
//        'suu' => '',
//        'can2' => '',
//        'dan' => '',
//        'giap' => '',
//        'mao' => '',
//        'at' => '',
//        'thin' => '',
//        'ton' => '',
//        'ty' => '',
//        'binh' => '',
//        'ngo' => '',
//        'dinh' => '',
//        'mui' => '',
//        'khon' => '',
//        'than' => '',
//        'canh' => '',
//        'dau' => '',
//        'tan' => '',
//        'tuat' => '',
//        'can' => '',
//        'hoi' => '',
//    ];

    public $rotate = 0;
    // son huong

    protected $huong = [
        'dong' => [
            // Sơn khảm hướng ly
            'kham' => [
                'son' => 'kham',
                'huong' => 'ly',
                'huong2' => [
                    'nham_binh' => ['nham', 'binh', 'Hoàng Tuyền', 105],
                    'ti_ngo' => ['ti', 'ngo', '', 90],
                    'quy_dinh' => ['quy', 'dinh', 'Hoàng Tuyền', 75],
                ],
                'sat' => 'thin',
                'sat_pos' => [50, 220],
                'rotate' => 90,
            ],
            // Sơn ly hướng khảm
            'ly' => [
                'son' => 'ly',
                'huong' => 'kham',
                'huong2' => [
                    'binh_nham' => ['binh', 'nham', 'Hoàng Tuyền', 285],
                    'ngo_ti' => ['ngo', 'ti', '', 270],
                    'dinh_quy' => ['dinh', 'quy', 'Hoàng Tuyền', 255],
                ],
                'sat' => 'hoi',
                'sat_pos' => [540, 690],
                'rotate' => 270,
            ],
            // Sơn đoài hướng chấn
            'doai' => [
                'son' => 'doai',
                'huong' => 'chan',
                'huong2' => [
                    'canh_giap' => ['canh', 'giap', 'Hoàng Tuyền', 195],
                    'dau_mao' => ['dau', 'mao', '', 180],
                    'tan_at' => ['tan', 'at', 'Hoàng Tuyền', 165],
                ],
                'sat' => 'ty',
                'sat_pos' => [190, 120],
                'rotate' => 180,
            ],
            // Sơn càn hướng tốn
            'can' => [
                'son' => 'can',
                'huong' => 'ton',
                'huong2' => [
                    'tuat_thin' => ['tuat', 'thin', '', 150],
                    'can_ton' => ['can', 'ton', '', 135],
                    'hoi_ty' => ['hoi', 'ty', '', 120],
                ],
                'sat' => 'ngo',
                'sat_pos' => [370, 120],
                'rotate' => 135,
            ],
        ],
        'tay' => [
            // Sơn khôn hướng cấn
            'khon' => [
                'son' => 'khon',
                'huong' => 'can2',
                'sdfsf' => 'xxx',
                'huong2' => [
                    'mui_suu' => ['mui', 'suu', '', 240],
                    'khon_can2' => ['khon', 'can2', '', 225],
                    'than_dan' => ['than', 'dan', '', 210],
                ],
                'sat' => 'mao',
                'sat_pos' => [80, 400],
                'rotate' => 225,
            ],
            // Sơn cấn hướng khôn
            'can2' => [
                'son' => 'can2',
                'huong' => 'khon',
                'huong2' => [
                    'suu_mui' => ['suu', 'mui', '', 60],
                    'can2_khon' => ['can2', 'khon', '', 45],
                    'dan_than' => ['dan', 'than', '', 30],
                ],
                'sat' => 'dan',
                'sat_pos' => [80, 570],
                'rotate' => 45,
            ],
            // Sơn chấn hướng đoài
            'chan' => [
                'son' => 'chan',
                'huong' => 'doai',
                'huong2' => [
                    'giap_canh' => ['giap', 'canh', 'Hoàng Tuyền', 15],
                    'mao_dau' => ['mao', 'dau', '', 0],
                    'at_tan' => ['at', 'tan', 'Hoàng Tuyền', 345],
                ],
                'sat' => 'than',
                'sat_pos' => [620, 270],
                'rotate' => 0,
            ],
            // Sơn tốn hướng càn
            'ton' => [
                'son' => 'ton',
                'huong' => 'can',
                'huong2' => [
                    'thin_tuat' => ['thin', 'tuat', '', 330],
                    'ton_can' => ['ton', 'can', '', 315],
                    'ty_hoi' => ['ty', 'hoi', '', 300],
                ],
                'sat' => 'dau',
                'sat_pos' => [620, 395],
                'rotate' => 315,
            ],
        ],
    ];
    protected $thaiTuePos = [
        'ti' => [
            'pos' => [370, 720],
            'tue_pha' => 'ngo'
        ],
        'suu' => [
            'pos' => [200, 720],
            'tue_pha' => 'mui'
        ],
        'dan' => [
            'pos' => [80, 610],
            'tue_pha' => 'than'
        ],
        'mao' => [
            'pos' => [80, 460],
            'tue_pha' => 'dau'
        ],
        'thin' => [
            'pos' => [80, 290],
            'tue_pha' => 'tuat'
        ],
        'ty' => [
            'pos' => [190, 140],
            'tue_pha' => 'hoi'
        ],
        'ngo' => [
            'pos' => [365, 140],
            'tue_pha' => 'ti'
        ],
        'mui' => [
            'pos' => [535, 140],
            'tue_pha' => 'suu'
        ],
        'than' => [
            'pos' => [640, 270],
            'tue_pha' => 'dan'
        ],
        'dau' => [
            'pos' => [610, 420],
            'tue_pha' => 'mao'
        ],
        'tuat' => [
            'pos' => [610, 570],
            'tue_pha' => 'thin'
        ],
        'hoi' => [
            'pos' => [535, 710],
            'tue_pha' => 'ty'
        ]
    ];
    public $nguyenLong = [
        'nham' => ['id' => 1, 'ad' => 'duong', 'stt' => 'nhan', 'vitri' => 4],
        'ti' => ['id' => 1, 'ad' => 'am', 'stt' => 'thien', 'vitri' => 4],
        'quy' => ['id' => 1, 'ad' => 'am', 'stt' => 'dia', 'vitri' => 4],
        'kham' => ['id' => 1, 'ad' => 'am', 'stt' => 'dia', 'vitri' => 4, 'stt2' => true],
        'suu' => ['id' => 8, 'ad' => 'am', 'stt' => 'nhan', 'vitri' => 2],
        'can2' => ['id' => 8, 'ad' => 'duong', 'stt' => 'thien', 'vitri' => 2],
        'dan' => ['id' => 8, 'ad' => 'duong', 'stt' => 'dia', 'vitri' => 2],
        'giap' => ['id' => 3, 'ad' => 'duong', 'stt' => 'nhan', 'vitri' => 6],
        'mao' => ['id' => 3, 'ad' => 'am', 'stt' => 'thien', 'vitri' => 6],
        'at' => ['id' => 3, 'ad' => 'am', 'stt' => 'dia', 'vitri' => 6],
        'chan' => ['id' => 3, 'ad' => 'am', 'stt' => 'dia', 'vitri' => 6, 'stt2' => true],
        'thin' => ['id' => 4, 'ad' => 'am', 'stt' => 'nhan', 'vitri' => 7],
        'ton' => ['id' => 4, 'ad' => 'duong', 'stt' => 'thien', 'vitri' => 7],
        'ty' => ['id' => 4, 'ad' => 'duong', 'stt' => 'dia', 'vitri' => 7],
        'binh' => ['id' => 9, 'ad' => 'duong', 'stt' => 'nhan', 'vitri' => 3],
        'ngo' => ['id' => 9, 'ad' => 'am', 'stt' => 'thien', 'vitri' => 3],
        'dinh' => ['id' => 9, 'ad' => 'am', 'stt' => 'dia', 'vitri' => 3],
        'ly' => ['id' => 9, 'ad' => 'am', 'stt' => 'dia', 'vitri' => 3, 'stt2' => true],
        'mui' => ['id' => 2, 'ad' => 'am', 'stt' => 'nhan', 'vitri' => 5],
        'khon' => ['id' => 2, 'ad' => 'duong', 'stt' => 'thien', 'vitri' => 5],
        'than' => ['id' => 2, 'ad' => 'duong', 'stt' => 'dia', 'vitri' => 5],
        'canh' => ['id' => 7, 'ad' => 'duong', 'stt' => 'nhan', 'vitri' => 1],
        'dau' => ['id' => 7, 'ad' => 'am', 'stt' => 'thien', 'vitri' => 1],
        'tan' => ['id' => 7, 'ad' => 'am', 'stt' => 'dia', 'vitri' => 1],
        'doai' => ['id' => 7, 'ad' => 'am', 'stt' => 'dia', 'vitri' => 1, 'stt2' => true],
        'tuat' => ['id' => 6, 'ad' => 'am', 'stt' => 'nhan', 'vitri' => 0],
        'can' => ['id' => 6, 'ad' => 'duong', 'stt' => 'thien', 'vitri' => 0],
        'hoi' => ['id' => 6, 'ad' => 'duong', 'stt' => 'dia', 'vitri' => 0],
    ];

    public function __construct($params) {
        $this->params = $params;
        $this->cuuVanInfo = $params['cuuVanInfo'];
        $this->cuuDieuInfo = $params['cuuDieuInfo'];

        $this->bat_trach = $params['bat_trach'];
        $this->menh_quai = $params['menh_quai'];

        $this->namXemInfo = $params['namXemInfo'];

        $this->huong2 = !empty($params['huong2']) ? $params['huong2'] : '';
        $this->tamNguyenVan = !empty($params['tamNguyenVan']) ? $params['tamNguyenVan'] : [];
        $this->namXem = !empty($params['namXem']) ? $params['namXem'] : date('Y');

        $this->soTrachQuai = $this->diaChi[$this->namXemInfo['chi']['name']];
        // echo 'bat trach:' . $this->bat_trach . '<br>';
        // echo 'menh_quai:' . $this->menh_quai . '<br>';

        foreach (['dong', 'tay'] as $huong) {
            if ($this->menh_quai == $huong) {
                if (isset($this->huong[$this->bat_trach])) {
                    $this->rotate = $this->huong[$this->bat_trach]['rotate'];
                    $this->huongItem = $this->huong[$this->bat_trach];
                } else {
                    $huongItem = $this->array_search_by_key($this->huong[$huong], 'huong', $this->bat_trach);
                    if (isset($huongItem)) {
                        $this->rotate = $huongItem['rotate'];
                        $this->huongItem = $huongItem;
                    }
                }
                $this->sonName = isset($this->huongItem['son']) ? $this->huongItem['son'] : '';
                $this->huongName = isset($this->huongItem['huong']) ? $this->huongItem['huong'] : '';
            }
        }
        if (!empty($this->huong2)) {
            foreach ($this->huong as $value) {
                foreach ($value as $val) {
                    if (isset($val['huong2'][$this->huong2['son'] . '_' . $this->huong2['huong']])) {
                        $huong2 = $val['huong2'][$this->huong2['son'] . '_' . $this->huong2['huong']];
                        $this->rotate = $huong2[3];
                        $this->hoangTuyen = $huong2[2];
                        $this->sonName = $this->huong2['son'];
                        $this->huongName = $this->huong2['huong'];
                        break;
                    }
                }
            }
        }
        // Tính Phi Tinh sơn
        $ptSon = isset($this->nguyenLong[$this->sonName]) ? $this->nguyenLong[$this->sonName] : 1;
        $this->soTinhDo['son'] = $this->cuuVanInfo['so'][$ptSon['vitri']];
        $rotate = 'thuan';
        // vi tri trung cung
        if ($this->soTinhDo['son'] == 5) {
            foreach ($this->nguyenLong as $key => $value) {
                if (isset($value[$this->sonName]) && $value[$this->sonName]['ad'] == 'am') {
                    $rotate = 'nghich';
                    break;
                }
            }
        } else {
            $tinhDoCoBan = $this->array_search_by_key($this->nguyenLong, 'id', $this->soTinhDo['son'], true);
            if (!empty($tinhDoCoBan) && !empty($ptSon)) {
                foreach ($tinhDoCoBan as $key => $value) {
                    if ($value['stt'] == $ptSon['stt'] && $value['ad'] == 'am') {
                        $rotate = 'nghich';
                        break;
                    }
                }
            }
        }
        $this->phiTinh['son'] = $this->bangPhiTinh[$rotate][$this->soTinhDo['son']];
        
        // Tính Phi tinh Hướng
        $ptHuong = isset($this->nguyenLong[$this->huongName]) ? $this->nguyenLong[$this->huongName] : 1;
        $this->soTinhDo['huong'] = $this->cuuVanInfo['so'][$ptHuong['vitri']];
        $rotate = 'thuan';
        if ($this->soTinhDo['huong'] == 5) {
            foreach ($this->nguyenLong as $key => $value) {
                if (isset($value[$this->huongName]) && $value[$this->huongName]['ad'] == 'am') {
                    $rotate = 'nghich';
                    break;
                }
            }
        } else {
            $tinhDoCoBan = $this->array_search_by_key($this->nguyenLong, 'id', $this->soTinhDo['huong'], true);
            if (!empty($tinhDoCoBan) && !empty($ptHuong)) {
                foreach ($tinhDoCoBan as $key => $value) {
                    if ($value['stt'] == $ptHuong['stt'] && $value['ad'] == 'am') {
                        $rotate = 'nghich';
                        break;
                    }
                }
            }
        }
        $this->phiTinh['huong'] = $this->bangPhiTinh[$rotate][$this->soTinhDo['huong']];

        //$this->huongItem = $this->huong['tay']['ton'];
        //$this->namXemInfo['chi']['name'] = 'ti';
        //var_dump( $this->huongItem);
    }

    function array_search_by_key($array, $key, $value, $push = false) {
        if (!is_array($array)) {
            return [];
        }
        $results = [];
        foreach ($array as $index => $element) {
            if (isset($element[$key]) && $element[$key] == $value) {
                if ($push) {
                    $results[$index] = $element;
                } else {
                    $results = $element;
                }
            }
        }
        return $results;
    }

    /**
     * function drawImage
     * @param bool $permalinks create Image link
     * @description create image
     * * */
    function drawImage($permalinks = false) {
        
        $fileName = md5(serialize($this->params)) . '.png';
        $fileUrl = '/wp-content/uploads/bat_trach/' . $fileName;
        if ($permalinks == true && $_SERVER["DOCUMENT_ROOT"] . file_exists($fileUrl)) {
            return $fileName;
        }
        
        $imageWidth = 810;
        $imageHeight = 810;
        $image = imagecreatetruecolor($imageWidth, $imageHeight);
        $vangNhat = imagecolorallocate($image, 255, 250, 220);
        $blue = imagecolorallocate($image, 0, 0, 255);
        $green = imagecolorallocate($image, 0, 255, 0);
        $white = imagecolorallocate($image, 255, 255, 255);
        $gray = imagecolorallocate($image, 180, 180, 180);
        $borderTable = imagecolorallocate($image, 105, 165, 224);
        $black = imagecolorallocate($image, 0, 0, 0);
        $fontRegular = dirname(__DIR__) . '/public/fonts/RobotoSlab-Regular.ttf';
        $kim = $canh = $tan = $than = $dau = imagecolorallocate($image, 128, 0, 128);
        $moc = $giap = $at = $dan = $mao = $green = imagecolorallocate($image, 0, 128, 0);
        $tho = $mau = $ky = $tuat = $suu = $thin = $mui = imagecolorallocate($image, 105, 105, 105);
        $thuy = $nham = $quy = $hoi = $ti = imagecolorallocate($image, 70, 130, 180);
        $red = $hoa = $binh = $dinh = $ty = $ngo = imagecolorallocate($image, 255, 0, 0);

        imagefill($image, 0, 0, $vangNhat);
        imagearc($image, $imageWidth / 2, $imageHeight / 2, 160, 160, 0, 360, $gray);

        // Căn tâm
        imageline($image, 80, 0, $imageWidth - 80, $imageHeight, $borderTable);
        imageline($image, 230, 0, $imageWidth - 230, $imageHeight, $red); // Border cung
        imageline($image, 350, 0, $imageWidth - 347, $imageHeight, $borderTable);
        imageline($image, 458, 0, $imageWidth - 455, $imageHeight, $borderTable);
        imageline($image, 572, 0, $imageWidth - 568, $imageHeight, $red); // Border cung
        imageline($image, 715, 0, $imageWidth - 710, $imageHeight, $borderTable);
        imageline($image, 0, 100, $imageWidth, $imageHeight - 100, $borderTable);
        imageline($image, 0, 240, $imageWidth, $imageHeight - 240, $red); // Border cung
        imageline($image, 0, 360, $imageWidth, $imageHeight - 355, $borderTable);
        imageline($image, 0, 470, $imageWidth, $imageHeight - 465, $borderTable);
        imageline($image, 0, 582, $imageWidth, $imageHeight - 578, $red); // Border cung
        imageline($image, 0, 725, $imageWidth, $imageHeight - 720, $borderTable);

        // fill text
        imagettftext($image, 16, 0, $imageWidth / 2 - 25, 25, $red, $fontRegular, "Nam");
        imagettftext($image, 16, 0, $imageWidth / 2 - 15, 50, $ngo, $fontRegular, "LY");
        imagettftext($image, 16, 0, $imageWidth / 2 - 25, 75, $ngo, $fontRegular, "NGỌ");
        imagettftext($image, 14, 0, $imageWidth / 2 - 15, 100, $ngo, $fontRegular, 180);

        imagettftext($image, 16, 0, $imageWidth - 55, $imageHeight / 2, $kim, $fontRegular, "Tây");
        imagettftext($image, 14, 0, $imageWidth - 110, $imageHeight / 2, $red, $fontRegular, 270);

        imagettftext($image, 16, 0, $imageWidth - 60, $imageHeight / 2 - 25, $dau, $fontRegular, "DẬU");
        imagettftext($image, 16, 0, $imageWidth - 65, $imageHeight / 2 + 25, $kim, $fontRegular, "ĐOÀI");


        imagettftext($image, 16, 0, $imageWidth / 2 - 15, $imageHeight - 15, $ti, $fontRegular, "Bắc");
        imagettftext($image, 16, 0, $imageWidth / 2 - 30, $imageHeight - 45, $ti, $fontRegular, "KHẢM");
        imagettftext($image, 16, 0, $imageWidth / 2 - 10, $imageHeight - 75, $ti, $fontRegular, "TÝ");
        imagettftext($image, 14, 0, $imageWidth / 2, $imageHeight - 95, $red, $fontRegular, "0");


        imagettftext($image, 16, 0, 10, $imageHeight / 2 + 15, $moc, $fontRegular, "Đông");
        imagettftext($image, 14, 0, 100, $imageHeight / 2 + 15, $red, $fontRegular, 90);
        imagettftext($image, 16, 0, 10, $imageHeight / 2 - 10, $moc, $fontRegular, "MÃO");
        imagettftext($image, 16, 0, 10, $imageHeight / 2 + 40, $moc, $fontRegular, "CHẤN");

        imagettftext($image, 14, 0, 10, 40, $moc, $fontRegular, "Đông Nam");
        imagettftext($image, 14, 0, 10, 70, $moc, $fontRegular, "TỐN");
        imagettftext($image, 14, 0, 150, 180, $red, $fontRegular, 135);

        imagettftext($image, 14, 0, $imageWidth - 90, 40, $tho, $fontRegular, "Tây Nam");
        imagettftext($image, 14, 0, $imageWidth - 90, 65, $tho, $fontRegular, "KHÔN");
        imagettftext($image, 14, 0, $imageWidth - 185, 180, $red, $fontRegular, 225);

        imagettftext($image, 14, 0, $imageWidth - 80, $imageHeight - 25, $kim, $fontRegular, "Tây Bắc");
        imagettftext($image, 14, 0, $imageWidth - 80, $imageHeight - 50, $kim, $fontRegular, "CÀN");
        imagettftext($image, 14, 0, $imageWidth - 180, $imageHeight - 170, $red, $fontRegular, 315);

        imagettftext($image, 14, 0, 10, $imageHeight - 25, $tho, $fontRegular, "Đông Bắc");
        imagettftext($image, 14, 0, 10, $imageHeight - 50, $tho, $fontRegular, "CẤN");
        imagettftext($image, 14, 0, 160, $imageHeight - 170, $red, $fontRegular, 45);

//con giap
        imagettftext($image, 16, 0, $imageWidth / 2 - 105, $imageHeight - 75, $quy, $fontRegular, "QUÝ");
        imagettftext($image, 14, 0, $imageWidth / 2 - 90, $imageHeight - 95, $red, $fontRegular, "15");
        imagettftext($image, 16, 0, 200, $imageHeight - 75, $suu, $fontRegular, "SỬU");
        imagettftext($image, 14, 0, 220, $imageHeight - 95, $red, $fontRegular, "30");
        imagettftext($image, 16, 0, 10, $imageHeight - 170, $dan, $fontRegular, "DẦN");
        imagettftext($image, 14, 0, 100, $imageHeight / 2 + 185, $red, $fontRegular, 60);
        imagettftext($image, 16, 0, 10, $imageHeight - 285, $giap, $fontRegular, "GIÁP");
        imagettftext($image, 14, 0, 100, $imageHeight / 2 + 95, $red, $fontRegular, 75);
        imagettftext($image, 16, 0, 10, $imageHeight / 2 - 90, $at, $fontRegular, "ẤT");
        imagettftext($image, 14, 0, 100, $imageHeight / 2 - 65, $red, $fontRegular, 105);
        imagettftext($image, 16, 0, 10, $imageHeight / 2 - 210, $thin, $fontRegular, "THÌN");
        imagettftext($image, 14, 0, 100, $imageHeight / 2 - 160, $red, $fontRegular, 120);
        imagettftext($image, 14, 0, 190, 75, $ty, $fontRegular, "TỴ");
        imagettftext($image, 14, 0, 200, 100, $red, $fontRegular, 150);
        imagettftext($image, 14, 0, 285, 75, $binh, $fontRegular, "BÍNH");
        imagettftext($image, 14, 0, 305, 100, $red, $fontRegular, 165);
        imagettftext($image, 14, 0, $imageWidth / 2 + 65, 75, $dinh, $fontRegular, "ĐINH");
        imagettftext($image, 14, 0, $imageWidth / 2 + 70, 100, $red, $fontRegular, 195);
        imagettftext($image, 14, 0, $imageWidth / 2 + 180, 75, $mui, $fontRegular, "MÙI");
        imagettftext($image, 14, 0, $imageWidth / 2 + 165, 100, $red, $fontRegular, 210);
        imagettftext($image, 14, 0, $imageWidth - 70, $imageHeight / 2 - 200, $than, $fontRegular, "THÂN");
        imagettftext($image, 14, 0, $imageWidth - 110, $imageHeight / 2 - 175, $red, $fontRegular, 240);
        imagettftext($image, 14, 0, $imageWidth - 70, $imageHeight / 2 - 100, $canh, $fontRegular, "CANH");

        imagettftext($image, 14, 0, $imageWidth - 110, $imageHeight / 2 - 80, $red, $fontRegular, 255);
        imagettftext($image, 14, 0, $imageWidth - 55, $imageHeight / 2 + 100, $tan, $fontRegular, "TÂN");
        imagettftext($image, 14, 0, $imageWidth - 110, $imageHeight / 2 + 90, $red, $fontRegular, 285);
        imagettftext($image, 14, 0, $imageWidth - 65, $imageHeight / 2 + 220, $tuat, $fontRegular, "TUẤT");
        imagettftext($image, 14, 0, $imageWidth - 110, $imageHeight / 2 + 180, $red, $fontRegular, 300);
        imagettftext($image, 14, 0, $imageWidth / 2 + 60, $imageHeight - 75, $nham, $fontRegular, "NHÂM");
        imagettftext($image, 14, 0, $imageWidth / 2 + 70, $imageHeight - 95, $red, $fontRegular, 345);
        imagettftext($image, 14, 0, $imageWidth / 2 + 180, $imageHeight - 75, $hoi, $fontRegular, "HỢI");
        imagettftext($image, 14, 0, $imageWidth / 2 + 170, $imageHeight - 95, $red, $fontRegular, 330);


// la ban
        $im2 = imagecreatefrompng(dirname(dirname(__DIR__)) . '/images/battrach/laban.png');
        imagecopy($image, $im2, $imageWidth / 2 - 150, $imageHeight / 2 - 150, 0, 0, imagesx($im2), imagesy($im2));
// bảng
        $bang = imagecreatefrompng(dirname(dirname(__DIR__)) . '/images/battrach/bang_4.png');
        imagecopy($image, $bang, $imageWidth / 2 - imagesx($bang) / 2, $imageHeight / 2 - imagesy($bang) / 2, 0, 0, imagesx($bang), imagesy($bang));

// ============== SAO NIÊN VẬN ==============
        $im2 = imagecreatefrompng(dirname(dirname(__DIR__)) . '/images/battrach/hourse.png');
        $im2 = imagerotate($im2, $this->rotate, imagecolorallocatealpha($im2, 0, 0, 0, 127));
        imagecopy($image, $im2, $imageWidth / 2 - imagesx($im2) / 2, $imageHeight / 2 - imagesy($im2) / 2, 0, 0, imagesx($im2), imagesy($im2));


// ============== 3 Cái bảng Tranparent ==============
        $bangTran1 = imagecreatefrompng(dirname(dirname(__DIR__)) . '/images/battrach/bang_5.png');
        $bangx = imagesx($bangTran1);
        $bangy = imagesy($bangTran1);

        // Chính Đông
        imagettftext($bangTran1, 32, 0, $bangx / 2 - 10, $bangx / 2, $red, $fontRegular, $this->cuuVanInfo['so'][6]);  // cửu vận 7
        imagettftext($bangTran1, 22, 0, 5, $bangy - 5, $black, $fontRegular, $this->phiTinh['son'][6]); // Phi tinh sơn
        imagettftext($bangTran1, 22, 0, $bangx - 20, $bangy - 40, $black, $fontRegular, $this->cuuDieuInfo['chinhDong']['id']); // Cửu diệu
        imagettftext($bangTran1, 22, 0, $bangx - 20, $bangy - 5, $black, $fontRegular, $this->phiTinh['huong'][6]); // Phi tinh hướng
        imagecopy($image, $bangTran1, $imageWidth / 2 - $bangx / 2 - 125, $imageHeight / 2 - $bangy / 2, 0, 0, $bangx, $bangy);

        // Trung Cung
        $bangTran2 = imagecreatefrompng(dirname(dirname(__DIR__)) . '/images/battrach/bang_5.png');
        imagettftext($bangTran2, 32, 0, $bangx / 2 - 10, $bangx / 2, $red, $fontRegular, $this->cuuVanInfo['id']); // cửu vận
        imagettftext($bangTran2, 22, 0, 5, $bangy - 5, $black, $fontRegular, $this->soTinhDo['son']); // Phi tinh sơn
        imagettftext($bangTran2, 22, 0, $bangx - 20, $bangy - 40, $black, $fontRegular, $this->cuuDieuInfo['chinhCung']['id']); // Cửu diệu
        imagettftext($bangTran2, 22, 0, $bangx - 20, $bangy - 5, $black, $fontRegular, $this->soTinhDo['huong']); // Phi tinh sơn
        imagecopy($image, $bangTran2, $imageWidth / 2 - $bangx / 2, $imageHeight / 2 - $bangy / 2, 0, 0, $bangx, $bangy);

        // Chính tây
        $bangTran3 = imagecreatefrompng(dirname(dirname(__DIR__)) . '/images/battrach/bang_5.png');
        imagettftext($bangTran3, 32, 0, $bangx / 2 - 10, $bangx / 2, $red, $fontRegular, $this->cuuVanInfo['so'][1]); // cửu vận Tây
        imagettftext($bangTran3, 22, 0, 5, $bangy - 5, $black, $fontRegular, $this->phiTinh['son'][1]); // Phi tinh sơn
        imagettftext($bangTran3, 22, 0, $bangx - 20, $bangy - 5, $black, $fontRegular, $this->phiTinh['huong'][1]); // Phi tinh hướng
        imagettftext($bangTran3, 22, 0, $bangx - 20, $bangy - 40, $black, $fontRegular, $this->cuuDieuInfo['chinhTay']['id']); // Cửu diệu
        imagecopy($image, $bangTran3, $imageWidth / 2 - $bangx / 2 + 125, $imageHeight / 2 - $bangy / 2, 0, 0, $bangx, $bangy);
// ============== END 3 Cái bảng Tranparent ==============
// ============== Ảnh Các Góc ==============
        $imgGoc = imagecreatetruecolor(100, 70);
        imagesavealpha($imgGoc, true);
        $color = imagecolorallocatealpha($imgGoc, 0, 0, 0, 127);
        imagefill($imgGoc, 0, 0, $color);
        $imgGoc2 = imagecrop($imgGoc, array('x' => 0, 'y' => 0, 'width' => imagesx($imgGoc), 'height' => imagesy($imgGoc)));
        $imgGoc3 = imagecrop($imgGoc, array('x' => 0, 'y' => 0, 'width' => imagesx($imgGoc), 'height' => imagesy($imgGoc)));
        $imgGoc4 = imagecrop($imgGoc, array('x' => 0, 'y' => 0, 'width' => imagesx($imgGoc), 'height' => imagesy($imgGoc)));
        $imgGoc5 = imagecrop($imgGoc, array('x' => 0, 'y' => 0, 'width' => imagesx($imgGoc), 'height' => imagesy($imgGoc)));
        $imgGoc6 = imagecrop($imgGoc, array('x' => 0, 'y' => 0, 'width' => imagesx($imgGoc), 'height' => imagesy($imgGoc)));

        // Đông Nam
        imagettftext($imgGoc, 32, 0, $bangx / 2 - 10, $bangx / 2, $red, $fontRegular, $this->cuuVanInfo['so'][7]);  // cửu vận 8
        imagettftext($imgGoc, 22, 0, 5, $bangy - 5, $black, $fontRegular, $this->phiTinh['son'][7]); // Phi tinh sơn
        imagettftext($imgGoc, 22, 0, $bangx - 20, $bangy - 40, $black, $fontRegular, $this->cuuDieuInfo['dongNam']['id']); // Cửu diệu
        imagettftext($imgGoc, 22, 0, $bangx - 20, $bangy - 5, $black, $fontRegular, $this->phiTinh['huong'][7]); // Phi tinh hướng
        imagecopy($image, $imgGoc, $imageWidth / 2 - 175, $imageHeight / 2 - 205, 0, 0, $bangx, $bangy);

        // Chính Nam
        imagettftext($imgGoc2, 32, 0, $bangx / 2 - 10, $bangx / 2, $red, $fontRegular, $this->cuuVanInfo['so'][3]);  // cửu vận 4
        imagettftext($imgGoc2, 22, 0, 5, $bangy - 5, $black, $fontRegular, $this->phiTinh['son'][3]); // Phi tinh sơn
        imagettftext($imgGoc2, 22, 0, $bangx - 20, $bangy - 40, $black, $fontRegular, $this->cuuDieuInfo['chinhNam']['id']); // Cửu diệu
        imagettftext($imgGoc2, 22, 0, $bangx - 20, $bangy - 5, $black, $fontRegular, $this->phiTinh['huong'][3]); // Phi tinh hướng
        imagecopy($image, $imgGoc2, $imageWidth / 2 - 50, $imageHeight / 2 - 205, 0, 0, $bangx, $bangy);

        // Tây Nam
        imagettftext($imgGoc3, 32, 0, $bangx / 2 - 10, $bangx / 2, $red, $fontRegular, $this->cuuVanInfo['so'][5]);  // cửu vận 6
        imagettftext($imgGoc3, 22, 0, 5, $bangy - 5, $black, $fontRegular, $this->phiTinh['son'][5]); // Phi Tinh sơn
        imagettftext($imgGoc3, 22, 0, $bangx - 20, $bangy - 40, $black, $fontRegular, $this->cuuDieuInfo['tayNam']['id']); // Cửu diệu
        imagettftext($imgGoc3, 22, 0, $bangx - 20, $bangy - 5, $black, $fontRegular, $this->phiTinh['huong'][5]); // Phi tinh hướng
        imagecopy($image, $imgGoc3, $imageWidth / 2 + 75, $imageHeight / 2 - 205, 0, 0, $bangx, $bangy);

        // Đông Bắc
        imagettftext($imgGoc4, 32, 0, $bangx / 2 - 10, $bangx / 2, $red, $fontRegular, $this->cuuVanInfo['so'][2]); // cửu vận 3
        imagettftext($imgGoc4, 22, 0, 5, $bangy - 5, $black, $fontRegular, $this->phiTinh['son'][2]); // Phi tinh sơn
        imagettftext($imgGoc4, 22, 0, $bangx - 20, $bangy - 40, $black, $fontRegular, $this->cuuDieuInfo['dongBac']['id']); // Cửu diệu
        imagettftext($imgGoc4, 22, 0, $bangx - 20, $bangy - 5, $black, $fontRegular, $this->phiTinh['huong'][2]); // Phi tinh hướng
        imagecopy($image, $imgGoc4, $imageWidth / 2 - 175, $imageHeight / 2 + 130, 0, 0, $bangx, $bangy);

        // Chính Bắc
        imagettftext($imgGoc5, 32, 0, $bangx / 2 - 10, $bangx / 2, $red, $fontRegular, $this->cuuVanInfo['so'][4]);  // cửu vận 5
        imagettftext($imgGoc5, 22, 0, 5, $bangy - 5, $black, $fontRegular, $this->phiTinh['son'][4]); // Phi tinh sơn
        imagettftext($imgGoc5, 22, 0, $bangx - 20, $bangy - 40, $black, $fontRegular, $this->cuuDieuInfo['chinhBac']['id']); // Cửu diệu
        imagettftext($imgGoc5, 22, 0, $bangx - 20, $bangy - 5, $black, $fontRegular, $this->phiTinh['huong'][4]); // Phi tinh hướng
        imagecopy($image, $imgGoc5, $imageWidth / 2 - 50, $imageHeight / 2 + 130, 0, 0, $bangx, $bangy);

        // Tây Bắc
        imagettftext($imgGoc6, 32, 0, $bangx / 2 - 10, $bangx / 2, $red, $fontRegular, $this->cuuVanInfo['so'][0]); // cửu vận 1
        imagettftext($imgGoc6, 22, 0, 5, $bangy - 5, $black, $fontRegular, $this->phiTinh['son'][0]); // Phi tinh sơn
        imagettftext($imgGoc6, 22, 0, $bangx - 20, $bangy - 40, $black, $fontRegular, $this->cuuDieuInfo['tayBac']['id']); // Cửu diệu
        imagettftext($imgGoc6, 22, 0, $bangx - 20, $bangy - 5, $black, $fontRegular, $this->phiTinh['huong'][0]); // Phi tinh hướng
        imagecopy($image, $imgGoc6, $imageWidth / 2 + 75, $imageHeight / 2 + 130, 0, 0, $bangx, $bangy);

        // ============== SAO NIÊN VẬN ==============
        $text = $this->cuuDieuInfo['chinhTay']['name'];
        $textLen = mb_strlen($text);
        $length = $textLen >= 17 ? $imageWidth - 190 : $imageWidth - 190 + $textLen * 3.5;
        if ($textLen <= 6) {
            $length = $imageWidth - 190 + $textLen * 3.5;
        }
        imagettftext($image, 16, 0, $length, $imageHeight / 2 - 60, $thuy, $fontRegular, $text);

        $text = $this->cuuDieuInfo['dongNam']['name'];
        $textLen = mb_strlen($text);
        $length = $textLen >= 17 ? 40 : 50 + $textLen * 3.5;
        if ($textLen <= 6) {
            $length = 70 + $textLen * 3.5;
        }
        imagettftext($image, 16, 0, $length, 150, $thuy, $fontRegular, $text);


        $text = 'Tuế Phá';
        $textLen = mb_strlen($text);
        $fontSize = $textLen >= 11 ? 12 : 14;
        //imagettftext($image, $fontSize, 0, $length, 120, $blue, $fontRegular, $text);
        $tuePha = $this->thaiTuePos[$this->namXemInfo['chi']['name']]['tue_pha'];
        imagettftext($image, $fontSize, 0, $this->thaiTuePos[$tuePha]['pos'][0], $this->thaiTuePos[$tuePha]['pos'][1], $blue, $fontRegular, $text);

        $text = $this->cuuDieuInfo['tayNam']['name'];
        $textLen = mb_strlen($text);
        $length = $textLen >= 17 ? $imageWidth - 225 : $imageWidth - 215 + $textLen * 3.5;
        if ($textLen <= 6) {
            $length = $imageWidth - 175;
        }
        imagettftext($image, 16, 0, $length, 150, $thuy, $fontRegular, $text);

        $text = 'Hoàng Tuyền';
        if (!empty($this->hoangTuyen)) {
            if (in_array($this->huong2['huong'], ['canh', 'dinh'])) {
                imagettftext($image, 11, 0, 680, 90, $blue, $fontRegular, $text);  // canh, đinh
            }
            if (in_array($this->huong2['huong'], ['binh', 'at'])) {
                imagettftext($image, 11, 0, 30, 100, $blue, $fontRegular, $text); // binhs aat
            }
            if (in_array($this->huong2['huong'], ['quy', 'giap'])) {
                imagettftext($image, 11, 0, 70, 700, $blue, $fontRegular, $text); // quy giap
            }
            if (in_array($this->huong2['huong'], ['nham', 'tan'])) {
                imagettftext($image, 11, 0, 700, 730, $blue, $fontRegular, $text); // nham tan
            }
        }

        $text = $this->cuuDieuInfo['tayBac']['name'];
        $textLen = mb_strlen($text);
        $length = $textLen >= 17 ? $imageWidth - 225 : $imageWidth - 210 + $textLen * 3.5;
        if ($textLen <= 6) {
            $length = $imageWidth - 170;
        }
        imagettftext($image, 16, 0, $length, $imageHeight - 140, $thuy, $fontRegular, $text);

        $text = $this->cuuDieuInfo['chinhBac']['name'];
        $textLen = mb_strlen($text);
        $length = $textLen >= 17 ? $imageWidth / 2 - 85 : $imageWidth / 2 - 70 + $textLen * 3.5;
        if ($textLen <= 6) {
            $length = $imageWidth / 2 - 30;
        }
        imagettftext($image, 16, 0, $length, $imageHeight - 140, $thuy, $fontRegular, $text);

        $text = 'Thái Tuế';
        $textLen = mb_strlen($text);
        $length = $textLen >= 11 ? 200 : 175 + $textLen * 3;
        $fontSize = $textLen >= 11 ? 9 : 14;
        imagettftext($image, $fontSize, 0, $this->thaiTuePos[$this->namXemInfo['chi']['name']]['pos'][0], $this->thaiTuePos[$this->namXemInfo['chi']['name']]['pos'][1], $blue, $fontRegular, $text);

        $text = $this->cuuDieuInfo['dongBac']['name'];
        $textLen = mb_strlen($text);
        $length = $textLen >= 17 ? 55 : 60 + $textLen * 3.5;
        if ($textLen <= 6) {
            $length = 115;
        }
        imagettftext($image, 16, 0, $length, $imageHeight - 140, $thuy, $fontRegular, $text);

        $text = 'Bát sát';
        $textLen = mb_strlen($text);
        $length = $textLen >= 11 ? 90 : 60 + $textLen * 3;
        $fontSize = $textLen >= 11 ? 12 : 14;
        imagettftext($image, 16, 0, $this->huongItem['sat_pos'][0], $this->huongItem['sat_pos'][1], $blue, $fontRegular, $text);

        $text = $this->cuuDieuInfo['chinhNam']['name'];
        $textLen = mb_strlen($text);
        $length = $textLen >= 11 ? $imageWidth / 2 - 90 : $imageWidth / 2 - 60 + $textLen * 3;
        $fontSize = $textLen >= 11 ? 12 : 14;
        //imagettftext($image, $fontSize, 0, $length, $imageHeight / 2 - 5, $blue, $fontRegular, $text);
        imagettftext($image, $fontSize, 0, $length, 150, $thuy, $fontRegular, $text);

        $text = $this->cuuDieuInfo['chinhDong']['name'];
        $textLen = mb_strlen($text);
        $length = $textLen >= 11 ? $textLen : 50;
        $fontSize = $textLen >= 11 ? 12 : 14;
        imagettftext($image, $fontSize, 0, $length, $imageHeight / 2 - 40, $thuy, $fontRegular, $text);

        if ($this->cuuDieuInfo['chinhTay']['id'] == 5) {
            imagettftext($image, 14, 0, 50, $imageHeight / 2 - 100, $thuy, $fontRegular, 'Đích sát');
        }
        if ($this->cuuDieuInfo['chinhDong']['id'] == 5) {
            imagettftext($image, 14, 0, $imageWidth - 80, $imageHeight / 2 - 120, $thuy, $fontRegular, 'Đích sát');
        }
        if ($this->cuuDieuInfo['tayNam']['id'] == 5) {
            imagettftext($image, 14, 0, 60, $imageHeight - 80, $thuy, $fontRegular, 'Đích sát');
        }
        if ($this->cuuDieuInfo['dongBac']['id'] == 5) {
            imagettftext($image, 14, 0, $imageWidth - 150, 120, $thuy, $fontRegular, 'Đích sát');
        }
        if ($this->cuuDieuInfo['chinhBac']['id'] == 5) {
            imagettftext($image, 14, 0, $imageWidth / 2 - 35, 130, $thuy, $fontRegular, "Đích sát");
        }
        if ($this->cuuDieuInfo['chinhNam']['id'] == 5) {
            imagettftext($image, 14, 0, $imageWidth / 2 - 35, $imageHeight - 115, $thuy, $fontRegular, "Đích sát");
        }
        if ($this->cuuDieuInfo['dongNam']['id'] == 7) {
            imagettftext($image, 14, 0, $imageWidth - 150, $imageHeight - 100, $thuy, $fontRegular, "Đích sát");
        }
        if ($this->cuuDieuInfo['tayBac']['id'] == 5) {
            imagettftext($image, 14, 0, 50, 100, $thuy, $fontRegular, "Đích sát");
        }
        if ($this->cuuDieuInfo['chinhDong']['id'] == $this->soTrachQuai) {
            imagettftext($image, 12, 0, 80, $imageHeight / 2 + 50, $blue, $fontRegular, 'Thái Tuế PT');
            imagettftext($image, 12, 0, $imageWidth - 200, $imageHeight / 2 + 5, $blue, $fontRegular, 'Tuế Phá PT');
        }
        if ($this->cuuDieuInfo['chinhTay']['id'] == $this->soTrachQuai) {
            imagettftext($image, 12, 0, $imageWidth - 200, $imageHeight / 2 + 5, $blue, $fontRegular, 'Thái Tuế PT');
            imagettftext($image, 12, 0, 80, $imageHeight / 2 + 50, $blue, $fontRegular, 'Tuế Phá PT');
        }
        if ($this->cuuDieuInfo['chinhNam']['id'] == $this->soTrachQuai) {
            imagettftext($image, 12, 0, $imageWidth / 2 - 45, 135, $blue, $fontRegular, 'Thái Tuế PT');
            imagettftext($image, 12, 0, $imageWidth / 2 - 65, $imageHeight - 170, $blue, $fontRegular, 'Tuế Phá PT');
        }
        if ($this->cuuDieuInfo['chinhBac']['id'] == $this->soTrachQuai) {
            imagettftext($image, 12, 0, $imageWidth / 2 - 65, $imageHeight - 170, $blue, $fontRegular, 'Thái Tuế PT');
            imagettftext($image, 12, 0, $imageWidth / 2 - 45, 135, $blue, $fontRegular, 'Tuế Phá PT');
        }
        if ($this->cuuDieuInfo['dongBac']['id'] == $this->soTrachQuai) {
            imagettftext($image, 12, 0, 60, $imageHeight - 80, $blue, $fontRegular, 'Thái Tuế PT');
            imagettftext($image, 12, 0, $imageWidth - 150, 120, $blue, $fontRegular, 'Tuế Phá PT');
        }
        if ($this->cuuDieuInfo['tayNam']['id'] == $this->soTrachQuai) {
            imagettftext($image, 12, 0, $imageWidth - 150, 120, $blue, $fontRegular, 'Thái Tuế PT');
            imagettftext($image, 12, 0, 60, $imageHeight - 80, $blue, $fontRegular, 'Tuế Phá PT');
        }
        if ($this->cuuDieuInfo['dongNam']['id'] == $this->soTrachQuai) {
            imagettftext($image, 12, 0, 50, 100, $blue, $fontRegular, 'Thái Tuế PT');
            imagettftext($image, 12, 0, $imageWidth - 150, $imageHeight - 100, $blue, $fontRegular, 'Tuế Phá PT');
        }
        if ($this->cuuDieuInfo['tayBac']['id'] == $this->soTrachQuai) {
            imagettftext($image, 12, 0, $imageWidth - 150, $imageHeight - 100, $blue, $fontRegular, 'Thái Tuế PT');
            imagettftext($image, 12, 0, 50, 100, $blue, $fontRegular, 'Tuế Phá PT');
        }
        if ($permalinks) {
            imagepng($image, $_SERVER["DOCUMENT_ROOT"] . $fileUrl);
            return $fileName;
        }
        ob_start();
        imagepng($image);
        imagedestroy($image);
        $imagedata = ob_get_clean();
        
        return ['img' => '<img src="data:image/png;base64,' . base64_encode($imagedata) . '" />',
            'base64' => base64_encode($imagedata)
            ];
    }

}
