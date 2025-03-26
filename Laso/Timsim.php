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
class Timsim {

    const STORE_ID = '3920';
    const STORE_ID_SALE = '4297';

    //const API = 'http://103.143.142.223:9200/khoso/sim/_search';
    public static $api = 'http://192.168.168.223:9200/khoso/sim/_search';
    public static $api_msearch = 'http://192.168.168.223:9200/khoso/sim/_msearch';


    public $dungThanId;
    public $hyThanId;
    public $menhAmDuong;
    public $params = [];
    public $sId;

    public function __construct($params = []) {
        $this->dungThanId = isset($params['dungThanId']) ? $params['dungThanId'] : false;
        $this->hyThanId = isset($params['hyThanId']) ? $params['hyThanId'] : [];
        $this->menhAmDuong = isset($params['menhAmDuong']) ? $params['menhAmDuong'] : false;
        $this->params = $params;
        if ($_SERVER['SERVER_NAME'] != 'thanglongdaoquan.vn') {
            self::$api = 'http://103.143.142.223:9200/khoso/sim/_search';
            self::$api_msearch = 'http://103.143.142.223:9200/khoso/sim/_msearch';
        }
        if (!empty($params['sId'])) {
            $this->sId = $params['sId'];
        }
    }

    public function getSimByCondition() {
        
        $price = '';
		$dauso = '';
		$telco = '';
		$storeSale = self::STORE_ID_SALE;
        if (!empty($this->params['price']) && $this->params['price'] != '0_0') {
            $priceArr = explode('_', $this->params['price']);
            $priceMin = isset($priceArr[0]) ? $priceArr[0] * 1000000 : 0;
            $priceMax = isset($priceArr[1]) ? $priceArr[1] * 1000000 : 0;

            $price = ',{"range":{"p": {"gte": ' . $priceMin . ', "lte": ' . $priceMax . '}}}';
            if ($priceMin == 0) {
                $price = ',{"range":{"p": {"lte": ' . $priceMax . '}}}';
            }
            if ($priceMax == 0) {
                $price = ',{"range":{"p": {"gte": ' . $priceMin . '}}}';
            }
			if (in_array($this->params['price'], ['0_0.5', '0.5_1'])) {
				$storeSale = '4248';
			}
        } elseif ($this->params['ctv']) { // thầy PT công tác viên
            $price = ',{"range":{"p": {"gte": 2000000}}}';
        }
        if (!empty($this->sId)) {
            $storeSale = $this->sId;
        }
        $elatic_str = '';
        //Từ khóa
        $keyword = isset($this->params['keyword']) ? $this->params['keyword'] : '';
        if (!is_array($keyword)) {
            if ($keyword != '') {
                if (strpos($keyword, '*') !== false) {

                } else
                    $keyword = '*' . $keyword;
                $elatic_str .= '{"wildcard": { "i": "' . $keyword . '" }},';
                //echo $elatic_str;
            }
        }
        else {
            $strSearch = '';
            foreach ($keyword as $key) {
                $strSearch .= '{"wildcard": { "i": "*' . $key . '" }},';
            }

            $strSearch = substr($strSearch, 0, -1);

            $elatic_str .= '
		{ "bool":  {
		  "should": [
			' . $strSearch . '
		  ]
		}},';
        }
        if (!empty($this->params['dauso']) && is_array($this->params['dauso'])) {
            $elatic_dauso = '';
            foreach ($this->params['dauso'] as $value) {
                $elatic_dauso .= '{"wildcard": { "i": "' . $value . '*" }},';
            }
            $elatic_str .= '
			{ "bool":  {
			  "should": [
				' . rtrim($elatic_dauso, ',') . '
			  ]
			}},';
        }
        if (isset($this->params['cate']) && is_array($this->params['cate'])) {
            $elatic_mang_ds = '';
            foreach ($this->params['cate'] as $value) {
                $elatic_mang_ds .= '{"term": { "c2": "' . $value . '"}},';
            }

            $elatic_str .= '
				{ "bool":  {
				  "should": [
					' . rtrim($elatic_mang_ds, ',') . '
				  ]
				}},';
        }

        //tránh
        if (isset($this->params['tranh']) && is_array($this->params['tranh'])) {
            $elatic_tranh = '';
            foreach ($this->params['tranh'] as &$value) {
                $elatic_tranh .= '{"wildcard": { "e": "*' . $value . '*" }},';
            }
            $elatic_str .= '
			{ "bool":  {
			  "must_not": [
				' . rtrim($elatic_tranh, ',') . '
			  ]
			}},';
        }
        if (isset($this->params['telco']) && is_array($this->params['telco'])) {
            $elatic_mang_ds = '';
            foreach ($this->params['telco'] as &$value) {
                $elatic_mang_ds .= '{"term": { "t": "' . $value . '"}},';
            }

            $elatic_str .= '
				{ "bool":  {
				  "should": [
					' . rtrim($elatic_mang_ds, ',') . '
				  ]
				}},';
        }
        $elatic_query = rtrim($elatic_str, ',');
        if (!empty($elatic_query)) {
            $elatic_query = ',' . $elatic_query;
        }
        $cachePath = WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'es' . DIRECTORY_SEPARATOR;
//        if (!file_exists($cachePath)) {
//            mkdir($cachePath, 0777);
//        }
        //die;

        $cache_file = $cachePath . md5(serialize($this->params));
        if (file_exists($cache_file) && (filemtime($cache_file) > (time() - 60 * 60 ))) {
            $cache = file_get_contents($cache_file);
            $arrayResults = json_decode($cache, true);
            //return $arrayResults;
        }

        //$daban = !$all ? ',{ "term": { "d": "true" }}' : '';
        $daban = '{"term":{"d":"true"}}';
		$time60 = strtotime('-30 day');
        $elastr = '{"query":{ "bool":{ "must":[{"range": {"l.sec": {"gt": "'.$time60.'"}}},{"terms":{"s3":[' . self::STORE_ID_SALE . ']}}' . $price . $telco .$dauso. '],"must_not":[' . $daban . ']}},"from":0,"size":2000,"sort":[{"pt":{"order":"desc"}}]}';
		//echo $elastr;
        if(isset($this->params['source']) && $this->params['source'] == 'mobifone'){
			$json = $this->curl("https://mobifonehanoi.vn/api/products/all?constraints={%22product_type%22:%22sim%22}");			
			$jsonDecode = json_decode($json, true);			
			$arrayResults['hits']['hits'] = $jsonDecode['data'];			
		}else{
			$json = $this->curl(self::$api, $elastr, true);
			$arrayResults = json_decode($json, true);
		}

        // update
        $elastr = '{"query":{ "bool":{ "must":[{"terms":{"s3":['.$storeSale.']}}' . $price . $elatic_query. '],"must_not":[' . $daban . ']}},"from":0,"size":2000,"sort":[{"pt": {"order": "desc"}}]}';

        $elastr2 = '{"query":{ "bool":{ "must":[{"terms":{"s3":[' . $storeSale . ']}}' . $price . $elatic_query. '],"must_not":[' . $daban . ']}},"from":0,"size":2000,"sort":[{"pt":{"order":"desc"}}]}';


        $str = "{}\n" . str_replace(["\n", "\r"], ['', ''], $elastr) . "\n{}\n" . str_replace(["\n", "\r"], ['', ''], $elastr2). "\n";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, self::$api_msearch);
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
        // update

        $arrayItem = [];
		$arrayItemViettel = [];
        $arrayItemVina = [];
        $arrayItemMobi = [];
        $arrayItemItel = [];
        $arrayResults = [
            'hits' => [
                'hits' => []
            ]
        ];
        if (!empty($response)) {
            $resultObj = json_decode($response, true);
            //var_dump($resultObj);die;
            $responseArr = $resultObj['responses'];
            if (!empty($responseArr)) {
                foreach ($responseArr as $index => $listItem) {
                    if (!empty($listItem['hits']['hits'])) {
                        $arrayResults['hits']['hits'] = array_merge($arrayResults['hits']['hits'], $listItem['hits']['hits']);
                    }

                }
            }
        }

        // update

        if (!empty($arrayResults['hits']['hits'])) {
            foreach ($arrayResults['hits']['hits'] as $index => $item) {
			
				if(isset($this->params['source']) && $this->params['source'] == 'mobifone'){
					$item['_source'] = $item;
					$item['_source']['i'] = $item['name'];
				}
                $dienGiai = [];
                $tinhDiemSim = new TinhDiemSim($item['_source']['i']);
                $doVuongSim = $tinhDiemSim->tinhDoVuongSim();
                $amDuong = $tinhDiemSim->tinhamduong();
                $quedich = $tinhDiemSim->tinhquedich();
                $duNien = $tinhDiemSim->tinhDuNien();
                $dienGiai[] = $amDuong['re'];
                if (in_array('sinh_thien_dien', $duNien['title'])) {
                    $dienGiai[] = '-Số Sim này có chứa những cặp số thuộc Năng lượng Sinh Diên Niên, nên mệnh sim được Đắc đại cát, ngoài việc bổ trợ về kinh doanh phát đạt và có những mối quan hệ cát lành, thì năg lượng sinh diên niên còn hóa giải được những chủ sự phạm phải ngũ quỷ trong bát trạch, kết hôn, số CMTND số nhà, số xe bị phạm ngũ quỷ.';
                }
                if (in_array('sinh_dien', $duNien['title']) || in_array('sinh_sinh', $duNien['title']) || in_array('sinh_phuc', $duNien['title'])) {
                    $dienGiai[] = '-Số Sim này có chứa những cặp số thuộc Năng lượng Sinh Diên, nên mệnh sim được Đắc đại cát, ngoài việc bổ trợ về kinh doanh phát đạt và có những mối quan hệ cát lành, thì năg lượng sinh diên còn hóa giải được, những chủ sự phạm phải họa hại (thị phi phiền toái) trong bát trạch, kết hôn, số CMTND số nhà, số xe bị phạm họa hại (thị phi phiền toái).';
                }
                if (in_array('sinh_khi', $duNien['title'])) {
                    $dienGiai[] = '-Sim này có chứa những cặp số thuộc năng lượng sinh khí, nên mệnh sim được Đắc Sinh Khí bảo trợ Sức khỏe, Thúc đẩy quan hệ hợp tác, gặp gỡ được Qúy nhân.';
                }
                if (in_array('dien_nien', $duNien['title'])) {
                    $dienGiai[] = '-Số Sim này có chứa những cặp số thuộc năng lượng diên niên, nên mệnh sim được Tọa Phúc Đức Ân Duệ thúc đẩy Công danh để Thăng quan tiến chức, tinh thần thoải mái và gia đạo được êm ấm.';
                }
                if (in_array('thien_y', $duNien['title'])) {
                    $dienGiai[] = '-Số Sim này có chứa những cặp số thuộc năng lượng thiên y, nên mệnh sim được Vượng Thiên Y kích Tài sinh Lộc, Củng cố Địa vị và gia tăng May mắn.';
                }
                if (in_array('phuc_vi', $duNien['title'])) {
                    $dienGiai[] = '-Số Sim này có chứa những cặp số thuộc năng lượng phục vị, nên mệnh sim được Trợ Phục Vị Viên Mãn giúp Sự nghiệp, Tiền Bạc và Tình cảm được bền vững,Gia đình bình an, tính toán thuận lợi.';
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

                if ($diem < 3) {
                   // continue;
                }
                $total = array_sum(str_split($item['_source']['i']));
                if ($diem < 5.5) {
                    continue;
                }
                $arrayItem[$index] = $item['_source'];
                $arrayItem[$index]['diem'] = $diem > 8.5 ? 10 : round($diem,2);
                $arrayItem[$index]['dien_giai'] = $dienGiai;
                $arrayItem[$index]['ngu_hanh_sim'] = ['slug' => $doVuongSim['ngu_hanh_sim']['slug'], 'text' => $doVuongSim['ngu_hanh_sim']['text']];
				$arrayItem[$index]['sale'] = true;
                $arrayItem[$index]['total'] = $total;
                $arrayItem[$index]['point'] = $total % 10;
                $arrayItem[$index]['quedich'] = $quedich;
                if ($diem > 5.5) {
                    if (count($arrayItemViettel) <= 3 && $item['_source']['t'] == 1) {
                        $arrayItemViettel[$index] = $arrayItem[$index];
						unset($arrayItem[$index]);
                    }
                    if (count($arrayItemVina) <= 3 && $item['_source']['t'] == 2) {
                        $arrayItemVina[$index] = $arrayItem[$index];
						unset($arrayItem[$index]);
                    }
                    if (count($arrayItemMobi) <= 3 && $item['_source']['t'] == 3) {
                        $arrayItemMobi[$index] = $arrayItem[$index];
						unset($arrayItem[$index]);
                    }
					if (count($arrayItemItel) <= 3 && $item['_source']['t'] == 8) {
                        $arrayItemItel[$index] = $arrayItem[$index];
						unset($arrayItem[$index]);
                    }
					
                }
            }
        }
        $limit = 30;
        $offsets = isset($this->params['paged_current_page']) ? ($this->params['paged_current_page'] - 1) * $limit : 0;
        // echo '$paged_current_page: ' . $paged_current_page;
        // echo '$limit: ' . $limit;
        // echo '$offsets: ' . $offsets;

        $arrayItem = array_merge($arrayItemItel, $arrayItemViettel, $arrayItemVina, $arrayItemMobi , $arrayItem);
		//var_dump($arrayItem);die;
//        usort($arrayItem, function($a, $b) {
//            return $b['diem'] > $a['diem'] ? 1 : -1;
//        });

        $arrayItem = array_slice($arrayItem, $offsets, $limit);
		
		//var_dump(count($arrayItem));die;
		//shuffle($arrayItem);

        // usort($arrayItem, function($a, $b) {
            // return $a['diem'] < $b['diem'];
        // });

        file_put_contents($cache_file, json_encode($arrayItem), LOCK_EX);

        return $arrayItem;
    }

    public function checkStoreSale($storeOrigin) {
        $storeSaleArr = explode(',', static::STORE_ID_SALE);
        foreach ($storeSaleArr as $store) {
            if (in_array($store, $storeOrigin)) {
                return true;
            }
        }

        return false;
    }


    public function getSimDetail($sim) {
        $cachePath = WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'es' . DIRECTORY_SEPARATOR;
        $cache_file = $cachePath . '_sim_' . $sim;
        if (file_exists($cache_file) && (filemtime($cache_file) > (time() - 60 * 60 ))) {
            $cache = file_get_contents($cache_file);
            $arrayResults = json_decode($cache, true);
            return $arrayResults;
        }

        $daban = '{"term":{"d": "true"}}';
        $elastr = '{"query":{"bool":{"must": [{"term":{"i":"' . $sim . '"}},{"terms":{"s3":[' . self::STORE_ID . ']}}], "must_not":[' . $daban . ']}}, "from":0,"size": 100,"sort":[{"pt":{"order":"desc"}}]}';
        $json = $this->curl(self::$api, $elastr, true);
        $arrayResults = json_decode($json, true);
        if ($arrayResults['hits']['total'] > 0) {
            file_put_contents($cache_file, json_encode($arrayResults['hits']['hits'][0]['_source']), LOCK_EX);

            return $arrayResults['hits']['hits'][0]['_source'];
        }

        return [];
    }

    function moveElement(&$array, $a, $b) {
        $p1 = array_splice($array, $a, 1);
        $p2 = array_splice($array, 0, $b);
        $array = array_merge($p2,$p1,$array);
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
