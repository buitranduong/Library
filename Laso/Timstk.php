<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Laven;

/**
 * This is the class "TinhDiemSim".
 *
 * @property int            $dungThanId
 * @property int            $hyThanId
 * @property int            $menhAmDuong
 */
class Timstk {

    public $dungThanId;
    public $hyThanId;
    public $menhAmDuong;
    public $params = [];

    static $array_telco = [
        'mbbank' => [
            'name' => 'MB BANK',
            'store_id' => 4063,
            'image' => 'mbbank'
        ],
        'agribank' => [
            'name' => 'AGRIBANK',
            'store_id' => 4081,
            'image' => 'agribank'
        ],
        'shb' => [
            'name' => 'SHB',
            'store_id' => 4082,
            'image' => 'shb'
        ],
        'vietcombank' => [
            'name' => 'VIETCOMBANK',
            'store_id' => 4085,
            'image' => 'vietcombank'
        ],
        'vietinbank' => [
            'name' => 'VIETINBANK',
            'store_id' => 4086,
            'image' => 'vietinbank'
        ],
        'vib' => [
            'name' => 'VIB',
            'store_id' => 4087,
            'image' => 'vib'
        ],
    ];

    const STORE_ID = '3962';
    public static $STORE_ID_SALE = '4063,4081,4082,4085,4086,4087';


    public function __construct($params = []) {
        $this->dungThanId = isset($params['dungThanId']) ? $params['dungThanId'] : false;
        $this->hyThanId = isset($params['hyThanId']) ? $params['hyThanId'] : [];
        $this->menhAmDuong = isset($params['menhAmDuong']) ? $params['menhAmDuong'] : false;
        $this->params = $params;

        if (!empty($params['store']) && static::$array_telco[$params['store']]['store_id']) {
            static::$STORE_ID_SALE = static::$array_telco[$params['store']]['store_id'];
        }
    }

    public function getSimByCondition() {
        $cachePath = WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'stk' . DIRECTORY_SEPARATOR;
//        if (!file_exists($cachePath)) {
//            mkdir($cachePath, 0777);
//        }
        //die;
        $cache_file = $cachePath . 'stk_' . md5(serialize($this->params));
        if (file_exists($cache_file) && (filemtime($cache_file) > (time() - 60 * 60 ))) {
            $cache = file_get_contents($cache_file);
            $arrayResults = json_decode($cache, true);

            //return $arrayResults;
        }
        $tkList = $this->getStkES();
        $arrayItem = [];
        $arrayItemSale = [];
        if (!empty($tkList)) {
            foreach ($tkList as $index => $item) {
                //echo $item;die;
                $dienGiai = [];
                //var_dump($item->sotk);die;
                $tinhDiemSim = new TinhDiemSim($item->_source->i);
                $doVuongSim = $tinhDiemSim->tinhDoVuongSim();
                $amDuong = $tinhDiemSim->tinhamduong();
                $quedich = $tinhDiemSim->tinhquedichSoTk();
                $duNien = $tinhDiemSim->tinhDuNien();
                if ($amDuong['diem'] == 1) {
                    $dienGiai[] = $amDuong['re'];
                }
                if (in_array('sinh_thien_dien', $duNien['title'])) {
                    $dienGiai[] = '-Số Tài khoản có chứa những cặp số thuộc Năng lượng Sinh Diên Niên, nên mệnh sim được Đắc đại cát, ngoài việc bổ trợ về kinh doanh phát đạt và có những mối quan hệ cát lành, thì năg lượng sinh diên niên còn hóa giải được những chủ sự phạm phải ngũ quỷ trong bát trạch, kết hôn, số CMTND số nhà, số xe bị phạm ngũ quỷ.';
                }
                if (in_array('sinh_dien', $duNien['title']) || in_array('sinh_sinh', $duNien['title']) || in_array('sinh_phuc', $duNien['title'])) {
                    $dienGiai[] = '-Số Tài khoản có chứa những cặp số thuộc Năng lượng Sinh Diên, nên mệnh sim được Đắc đại cát, ngoài việc bổ trợ về kinh doanh phát đạt và có những mối quan hệ cát lành, thì năg lượng sinh diên còn hóa giải được, những chủ sự phạm phải họa hại (thị phi phiền toái) trong bát trạch, kết hôn, số CMTND số nhà, số xe bị phạm họa hại (thị phi phiền toái).';
                }
                if (in_array('sinh_khi', $duNien['title'])) {
                    $dienGiai[] = '-Số tài khoản  có chứa những cặp số thuộc năng lượng sinh khí, nên mệnh sim được Đắc Sinh Khí bảo trợ Sức khỏe, Thúc đẩy quan hệ hợp tác, gặp gỡ được Qúy nhân.';
                }
                if (in_array('dien_nien', $duNien['title'])) {
                    $dienGiai[] = '-Số Tài khoản có chứa những cặp số thuộc năng lượng diên niên, nên mệnh sim được Tọa Phúc Đức Ân Duệ thúc đẩy Công danh để Thăng quan tiến chức, tinh thần thoải mái và gia đạo được êm ấm.';
                }
                if (in_array('thien_y', $duNien['title'])) {
                    $dienGiai[] = '-Số Tài khoản có chứa những cặp số thuộc năng lượng thiên y, nên mệnh sim được Vượng Thiên Y kích Tài sinh Lộc, Củng cố Địa vị và gia tăng May mắn.';
                }
                if (in_array('phuc_vi', $duNien['title'])) {
                    $dienGiai[] = '-Số Tài khoản có chứa những cặp số thuộc năng lượng phục vị, nên mệnh sim được Trợ Phục Vị Viên Mãn giúp Sự nghiệp, Tiền Bạc và Tình cảm được bền vững,Gia đình bình an, tính toán thuận lợi.';
                }
                $dienGiai[] = $quedich['tengoi'] . ' Quẻ này là quẻ ' . $quedich['status'];
                $diem = 0;
                if ($doVuongSim['ngu_hanh_sim']['id'] == $this->dungThanId) {
                    $diem += 5;
                } elseif (in_array($doVuongSim['ngu_hanh_sim']['id'], $this->hyThanId)) {
                    $diem += 5;
                }
//                if ($item['_source']['i'] == '0879904499') {
//                    echo 'Vượng sim so vs ng: ' . $diem . '<br>';
//                }

                $diem += $duNien['diem'];
                $diem += $amDuong['diem'];
//                if ($item['_source']['i'] == '0877614114') {
//                    echo '$amDuong diem: ' . $amDuong['diem'] . '<br>';
//                    echo '$duNien diem: ' . $duNien['diem']  . '<br>';
//                }
                if (($this->menhAmDuong == 0 && $amDuong['menh'] === 1) || ($this->menhAmDuong == 1 && $amDuong['menh'] === 0)) {
                    $diem += 1;
                    //if ($item['_source']['i'] == '0877614114') echo 'menhAmDuong diem: +1' . '<br>';
                }
                if (is_numeric($amDuong['menh']) && $this->menhAmDuong == $amDuong['menh']) {
                    $diem -= 1;
                    //if ($item['_source']['i'] == '0877614114') echo 'menhAmDuong diem: -111' . '<br>';
                }


                $arrs = [];
                $count = count($doVuongSim['list']);
                for ($i = 0; $i < $count; $i++) {
                    if (isset($doVuongSim['list'][$i + 1]['slug']))
                        $arrs[] = ($tinhDiemSim->sinhkhac($doVuongSim['list'][$i]['slug'], $doVuongSim['list'][$i + 1]['slug']));
                }
                $dems = 0;
                $demk = 0;
                foreach ($arrs as $v) {
                    if (isset($v['sinh'])) {
                        $dems++;
                    } elseif (isset($v['khac'])) {
                        $demk++;
                    }
                }
                if ($dems > 0 && $demk == 0) {
                    $diem += 1;
//                    if ($item['_source']['i'] == '0879904499') {
//                        echo 'sinh khac: +1'  . '<br>';
//                    }
                } elseif ($dems > 0 && $demk > 0) {
                    $diem += 0.5;
//                    if ($item['_source']['i'] == '0879904499') {
//                        echo 'sinh khac: +0.5'  . '<br>';
//                    }
                }
                if (($dems - $demk) <= -2) {
                    $diem -= 0.25;
//                    if ($item['_source']['i'] == '0879904499') {
//                        echo 'sinh khac: -0.25' . '<br>';
//                    }
                }
                $diem += $quedich['diem'];
//                if ($item['_source']['i'] == '0879904499') {
//                    echo 'que dich:' . $quedich['diem'] . '<br>';
//                }
                $pattern = "/(00000|11111|22222|33333|44444|55555|66666|77777|88888|99999)$/"; // Ngũ quy
                if (preg_match($pattern, $item->_source->i)) {
                    $diem += 2;
                }
                if ($diem < 6) {
                    //continue;
                }
                $arrayItem[$index]['sotk'] = $item->_source->i;
                $arrayItem[$index]['diem'] = $diem > 8.5 ? 10 : round($diem,2);
                $arrayItem[$index]['s3'] = $item->_source->s3;
                $arrayItem[$index]['price'] = $item->_source->p;
                $arrayItem[$index]['dien_giai'] = $dienGiai;
                $arrayItem[$index]['ngu_hanh_sim'] = ['slug' => $doVuongSim['ngu_hanh_sim']['slug'], 'text' => $doVuongSim['ngu_hanh_sim']['text']];
                $arrayItem[$index]['giaban'] = $item->_source->pn;
                if ($diem > 8.5 && count($arrayItemSale) < 20) {
                    $arrayItemSale[$index] = $arrayItem[$index];
                    $arrayItemSale[$index]['sale'] = true;
                    $firstItem = !empty($item->_source->s3[0]) ? $item->_source->s3[0] : null;
                    if ($firstItem) {
                        $telcoItem = $this->findByStorid(static::$array_telco, $firstItem);
                        $arrayItemSale[$index]['image'] = isset($telcoItem['image']) ? $telcoItem['image'] : null;
                    }
                    unset($arrayItem[$index]);
                } elseif(in_array(static::$STORE_ID_SALE, $item->_source->s3)) {
					unset($arrayItem[$index]);
				}
            }
        }
        usort($arrayItem, function($a, $b) {
            return $b['diem'] > $a['diem'] ? 1 : -1;
        });
        usort($arrayItemSale, function($a, $b) {
            return $b['diem'] > $a['diem'] ? 1 : -1;
        });
        $arrayItem = array_merge($arrayItemSale, $arrayItem);
        $this->moveElement($arrayItem, 0, 3);
		$this->moveElement($arrayItem, 0, 3);
		$this->moveElement($arrayItem, 0, 3);
//        echo '<pre>';
//        var_dump($arrayItem);die;
        file_put_contents($cache_file, json_encode($arrayItem), LOCK_EX);

        return $arrayItem;
    }

    function findByStorid($stores, $store_id) {
        $item = null;
        foreach($stores as $index => $value) {
            if($value['store_id'] == $store_id) {
                $item = $value;
                break;
            }
        }
        return $item;
    }

    function moveElement(&$array, $a, $b) {
        $p1 = array_splice($array, $a, 1);
        $p2 = array_splice($array, 0, $b);
        $array = array_merge($p2,$p1,$array);
    }

    function getStkES () {
        $dungThanIdEs = convertESID($this->dungThanId);
        $hyThanConvert = array_map('convertESID', $this->hyThanId);
        $hyThanIdEs = implode(',', $hyThanConvert);
        $enpointES = 'http://127.0.0.1:9200/khostk/sim/_search';
        if ($_SERVER['SERVER_NAME'] != 'thanglongdaoquan.vn') {
            $enpointES = 'http://103.143.142.224:9200/khostk/sim/_search';
        }
        $jsonQuery = '{"query": {"bool": {"must": [{"terms":{"s3":[' . static::$STORE_ID_SALE . ']}},{"terms": {"c": ['.$dungThanIdEs.','.$hyThanIdEs.']}}],"must_not": [{"term": {"d": "true"}}],"should":[{"terms":{"c":[' . $dungThanIdEs . ']}}]}},"from": 0,"size": 200,"sort": [],"aggs": {}}';

        //echo $jsonQuery;die;

        $responseEs = self::curl($enpointES, $jsonQuery, true);
        $results = [];
        if ($responseEs) {
            $responseEsJson = json_decode($responseEs);
            $results = $responseEsJson->hits->hits;
        }

        return $results;
    }
	

    function getDataMutilSearch () {
        $dungThanIdEs = convertESID($this->dungThanId);
        $hyThanConvert = array_map('convertESID', $this->hyThanId);
        $hyThanIdEs = implode(',', $hyThanConvert);
        $enpointES = 'http://127.0.0.1:9200/khostk/sim/_msearch';
        if ($_SERVER['SERVER_NAME'] != 'thanglongdaoquan.vn') {
            $enpointES = 'http://103.143.142.224:9200/khostk/sim/_msearch';
        }
        $elastr = '{"query": {"bool": {"must": [{"terms":{"s3":['.static::STORE_ID.']}},{"terms": {"c": ['.$dungThanIdEs.','.$hyThanIdEs.']}}],"must_not": [{"term": {"d": "true"}}],"should":[{"terms":{"c":[' . $dungThanIdEs . ']}}]}},"from": 0,"size": 500,"sort": [],"aggs": {}}';
        $elastr2 = '{"query": {"bool": {"must": [{"terms":{"s3":['.static::$STORE_ID_SALE.']}},{"terms": {"c": ['.$dungThanIdEs.','.$hyThanIdEs.']}}],"must_not": [{"term": {"d": "true"}}],"should":[{"terms":{"c":[' . $dungThanIdEs . ']}}]}},"from": 0,"size": 500,"sort": [],"aggs": {}}';
$elastr = '{}';
        $str = "{}\n" . str_replace(["\n", "\r"], ['', ''], $elastr) . "\n{}\n" . str_replace(["\n", "\r"], ['', ''], $elastr2). "\n";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $enpointES);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $str);



        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $arrayResults = [
            'hits' => [
                'hits' => []
            ]
        ];
        if (!empty($response)) {
            $resultObj = json_decode($response, true);
            $responseArr = $resultObj['responses'];
            if (!empty($responseArr)) {
                foreach ($responseArr as $index => $listItem) {
                    if (!empty($listItem['hits']['hits'])) {
                        //var_dump(array_values($listItem['hits']['hits']));die;
                        $arrayResults['hits']['hits'] = array_merge($arrayResults['hits']['hits'], $listItem['hits']['hits']);
//                            foreach ($listItem['hits']['hits'] as $it) {
//                                $arrayResults['hits']['hits'][] = $it;
//                            }
                    }

                }
            }
        }


        return $arrayResults;
    }

    public static function getStkDetail($sotk) {
	    $enpointES = 'http://103.143.142.224:9200/khostk/sim/_search';
	    $jsonQuery = '{"_source": ["i","f","p","pb","d","d2","h","hg"],"query": {"bool": {"must": [{"match":{"i":"'.$sotk.'"}}],"must_not": [{"term": {"d": "true"}}],"should": []}},"from": 0,"size": 1,"sort": [],"aggs": {}}';
	    $responseEs = self::curl($enpointES, $jsonQuery, true);
	    $results = [];
	    if ($responseEs) {
		    $responseEsJson = json_decode($responseEs);
		    if (count($responseEsJson->hits->hits)) {
			    $results = $responseEsJson->hits->hits[0]->_source;
		    }
	    }

	    return $results;
    }

    public static function curl($url, $data = null, $json = false) {
        $ch = @curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $head[] = "Connection: keep-alive";
        $head[] = "Keep-Alive: 300";
        $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
        $head[] = "Accept-Language: en-us,en;q=0.5";
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        if ($data != null) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        if ($json) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        }
        $page = curl_exec($ch);
        curl_close($ch);
        return $page;
    }

}
