<?php
/**
 * Created by PhpStorm.
 * User: DUYDUC
 * Date: 17-Oct-18
 * Time: 9:41 AM
 */

namespace Laven;

use GDText\Color;
use Laven\Helpers\Helpers;

class Lasotuvi
{

	public $ngaysinh;

	public $thangsinh;

	public $namsinh;

	public $giosinh;

	public $gioitinh;

	public $duonglich;

	public $timezone;

	public $namXem;

	public $namXemCanChi;

	public $hoten;

	public $diemSoTuVi = 0;

	public $message = [];

	public $menhChinhDieu = false;

	public $dacDia = false;

	public $thanCuQuanLoc = false;

	public $thanCuTaiBach = false;

	public $thanCuThienDi = false;

	public $tuanAnNguTaiMenh = false;

	public $trietAnNguTaiMenh = false;

	public $tuanTrietAnNguTaiMenh = false;

	public $chinhChieuVuongDia = false;

	public $thanMenhDongCung = false;

	public $tuPhuVuTuong = 0;
	public $satPhaLiemTham = 0;

	public $liemTrinhMenhTaiQuan = false;

	public $luanGiaiLaSo = [];

	public $saoLuu = [];

	public $truongSinhSaoID = [];
	public $truongSinhLuan = [];

	public $thaiTueSaoID = [];
	public $thaiTueLuan = [];

	public $draw = [];
	public $drawMenh;

	public $thapNhiCung;
	public $thienBan;

	public function __construct($ngaysinh, $thangsinh, $namsinh, $giosinh, $gioitinh, $hoten, $duonglich = true, $timezone = 7, $namXem)
	{
		$this->ngaysinh = $ngaysinh;
		$this->thangsinh = $thangsinh;
		$this->namsinh = $namsinh;
		$this->giosinh = $giosinh;
		$this->gioitinh = $gioitinh;
		$this->duonglich = $duonglich;
		$this->timezone = $timezone;
		$this->hoten = $hoten;
		$this->namXem = $namXem;

		$this->namXemCanChi = Helpers::tinhCanChiNam($this->namXem);
	}

	public function calculatePoint()
	{

	}

	public function run()
	{
		$lapDiaBan = new lapDiaBan();
		$diaBan = $lapDiaBan->run($this->ngaysinh, $this->thangsinh, $this->namsinh, $this->giosinh, $this->gioitinh, $this->duonglich, $this->timezone);
		$thienBan = new lapThienBan($this->ngaysinh, $this->thangsinh, $this->namsinh, $this->giosinh, $this->gioitinh, $this->hoten, $diaBan, $this->duonglich, $this->timezone);
		return [
			'diaBan' => $diaBan,
			'thienBan' => $thienBan
		];
	}

	public function drawImage()
	{
		$lapDiaBan = new lapDiaBan();
		$diaBan = $lapDiaBan->run($this->ngaysinh, $this->thangsinh, $this->namsinh, $this->giosinh, $this->gioitinh, $this->duonglich, $this->timezone);
		$thienBan = new lapThienBan($this->ngaysinh, $this->thangsinh, $this->namsinh, $this->giosinh, $this->gioitinh, $this->hoten, $diaBan, $this->duonglich, $this->timezone);
		$thapNhiCung = $diaBan->thapNhiCung;
		$this->tinhSaoLuu();

		$this->thapNhiCung = $thapNhiCung;
		$this->thienBan = $thienBan;

		//$this->diaBan = $diaBan;

		//var_dump($this->saoLuu);die;

		$img_width = 720;
		$img_height = 980;

		$im2 = imagecreatetruecolor($img_width, $img_height);
		$backgroundColor = imagecolorallocate($im2, 255, 255, 255);
		imagefill($im2, 0, 0, $backgroundColor);
		$borderTable = imagecolorallocate($im2, 119, 119, 119);

		// =========================== DRAWLER CUNG ===========================
		// +++++++++++++++++ top ++++++++++++++++++
		$cung6 = $this->drawCung($thapNhiCung[6]);
		imagecopy($im2, $cung6, 0, 0, 0, 0, 180, 245);

		$cung7 = $this->drawCung($thapNhiCung[7]);
		imagecopy($im2, $cung7, 180, 0, 0, 0, 180, 245);

		$cung8 = $this->drawCung($thapNhiCung[8]);
		imagecopy($im2, $cung8, 360, 0, 0, 0, 180, 245);

		$cung9 = $this->drawCung($thapNhiCung[9]);
		imagecopy($im2, $cung9, 540, 0, 0, 0, 180, 245);
		// +++++++++++++++++ end top ++++++++++++++++++

		// +++++++++++++++++ left ++++++++++++++++++
		$cung5 = $this->drawCung($thapNhiCung[5]);
		imagecopy($im2, $cung5, 0, 245, 0, 0, 180, 245);

		$cung4 = $this->drawCung($thapNhiCung[4]);
		imagecopy($im2, $cung4, 0, 490, 0, 0, 180, 245);
		// +++++++++++++++++ end left ++++++++++++++++++

		// +++++++++++++++++ right ++++++++++++++++++
		$cung10 = $this->drawCung($thapNhiCung[10]);
		imagecopy($im2, $cung10, 540, 245, 0, 0, 180, 245);

		$cung11 = $this->drawCung($thapNhiCung[11]);
		imagecopy($im2, $cung11, 540, 490, 0, 0, 180, 245);
		// +++++++++++++++++ end right ++++++++++++++++++

		// +++++++++++++++++ bottom ++++++++++++++++++
		$cung3 = $this->drawCung($thapNhiCung[3]);
		imagecopy($im2, $cung3, 0, 735, 0, 0, 180, 245);

		$cung2 = $this->drawCung($thapNhiCung[2]);
		imagecopy($im2, $cung2, 180, 735, 0, 0, 180, 245);

		$cung1 = $this->drawCung($thapNhiCung[1]);
		imagecopy($im2, $cung1, 360, 735, 0, 0, 180, 245);

		$cung12 = $this->drawCung($thapNhiCung[12]);
		imagecopy($im2, $cung12, 540, 735, 0, 0, 180, 245);
		// +++++++++++++++++ end bottom ++++++++++++++++++
		// =========================== DRAWLER CUNG ===========================

		imageline($im2, 0, 245, $img_width, 245, $borderTable);
		imageline($im2, 0, 490, $img_width, 490, $borderTable);
		imageline($im2, 0, 735, $img_width, 735, $borderTable);

		imageline($im2, 0, 0, $img_width, 0, $borderTable); // Top
		imageline($im2, 0, $img_height -1, $img_width, $img_height -1, $borderTable); // bottom

		imageline($im2, 0, 0, 0, $img_height, $borderTable); // Left
		imageline($im2, $img_width -1, 0, $img_width -1, $img_height, $borderTable); // Right

		// CỘT
		imageline($im2, 180, 0, 180, $img_height, $borderTable);
		imageline($im2, 360, 0, 360, $img_height, $borderTable);
		imageline($im2, 540, 0, 540, $img_height, $borderTable);

		// Thiên bàn
		$thienBanImg = $this->drawThienBan($thienBan);
		imagecopy($im2, $thienBanImg, 181, 246, 0, 0, 359, 489);

		ob_start();
		imagepng($im2);
		imagedestroy($im2);
		$imagedata = ob_get_clean();

		return ['img' => '<img src="data:image/png;base64,' . base64_encode($imagedata) . '" />',
			'base64' => base64_encode($imagedata)
		];

	}

	function tinhSaoLuu()
	{
		//$tieuHan = str_replace('tý', 'ti', strtolower($tieuHan));
		//$tieuHanChi = khongdau($tieuHan);
		$namXemChi = $this->namXemCanChi['chi']['name'];
		$namXemCan = $this->namXemCanChi['can']['name'];

//    	if ($tieuHanChi == $namXemChi) {
//		    $this->saoLuu[$tieuHanChi][] = 'L. Thái Tuế';
//	    }

		$chi = ['ti', 'suu', 'dan', 'mao', 'thin', 'ty', 'ngo', 'mui', 'than', 'dau', 'tuat', 'hoi'];

		// Dành tính thiên khốc, thiên hư cung tý tính ở Ngọ đếm xuôi và ngược
		$chiXuoi = ['ngo', 'mui', 'than', 'dau', 'tuat', 'hoi', 'ti', 'suu', 'dan', 'mao', 'thin', 'ty'];
		$chiNguoc = ['ngo', 'ty', 'thin', 'mao', 'dan', 'suu', 'ti', 'hoi', 'tuat', 'dau', 'than', 'mui'];
		// Dành tính thiên khốc, thiên hư cung tý tính ở Ngọ đếm xuôi và ngược

		// Tính lưu lộc tồn lưu, kình dương, lưu đà la
		$thienCan = [
			'giap' => ['dan', 'mao', 'suu'],
			'at' => ['mao', 'thin', 'dan'],
			'binh' => ['ty', 'ngo', 'thin'],
			'mau' => ['ty', 'ngo', 'thin'],
			'dinh' => ['ngo', 'mui', 'ty'],
			'ky' => ['ngo', 'mui', 'ty'],
			'canh' => ['than', 'dau', 'mui'],
			'tan' => ['dau', 'tuat', 'than'],
			'nham' => ['hoi', 'ti', 'tuat'],
			'quy' => ['ti', 'suu', 'hoi'],
		];
		// Tính lưu thiên mã
		$diaChiThienMa = [
			'dan' => 'than',
			'ngo' => 'than',
			'tuat' => 'than',
			'than' => 'dan',
			'ti' => 'dan',
			'thin' => 'dan',
			'ty' => 'hoi',
			'dau' => 'hoi',
			'suu' => 'hoi',
			'hoi' => 'ty',
			'mao' => 'ty',
			'mui' => 'ty',
		];

		$count = count($chi);
		$index = array_search($namXemChi, $chi);
		$indexTangMon = $index + 2;
		if ($indexTangMon > $count - 1) {
			$indexTangMon = $indexTangMon - $count;
		}
		$this->saoLuu[$chi[$indexTangMon]]['xau'][] = [
			'hanh' => 'hanhMoc',
			'name' => 'L. Tang Môn'
		];

		$indexBachHo = $this->dichCung($indexTangMon, 6);
		if ($indexBachHo > 11) {
			$indexBachHo = $indexBachHo - 11;
		}
		$this->saoLuu[$chi[$indexBachHo]]['xau'][] = [
			'hanh' => 'hanhTho',
			'name' => 'L. Bạch Hổ'
		];

		$idTHienKhoc = array_search($namXemChi, $chiNguoc);
		if ($idTHienKhoc > $count - 1) {
			$idTHienKhoc = $idTHienKhoc - $count;
		}
		$this->saoLuu[$chi[$idTHienKhoc]]['xau'][] = [
			'hanh' => 'hanhTho',
			'name' => 'L. Thiên Khốc'
		];

		$idTHienHu = array_search($namXemChi, $chiXuoi);
		if ($idTHienHu > $count - 1) {
			$idTHienHu = $idTHienHu - $count;
		}
		$this->saoLuu[$chi[$idTHienHu]]['xau'][] = [
			'hanh' => 'hanhThuy',
			'name' => 'L. Thiên Hư'
		];

		$thienCanLocTon = $thienCan[$namXemCan];
		$this->saoLuu[$thienCanLocTon[0]]['tot'][] = [
			'hanh' => 'hanhTho',
			'name' => 'L. Lộc Tồn'
		];
		$this->saoLuu[$thienCanLocTon[1]]['xau'][] = [
			'hanh' => 'hanhTho',
			'name' => 'L. Kình Dương'
		];
		$this->saoLuu[$thienCanLocTon[2]]['xau'][] = [
			'hanh' => 'hanhTho',
			'name' => 'L. Đà La'
		];
		$this->saoLuu[$diaChiThienMa[$namXemChi]]['tot'][] = [
			'hanh' => 'hanhHoa',
			'name' => 'L. Thiên Mã'
		];

		return $this;
	}

	function dichCung($cungBanDau, $soCungDich)
	{
		$cungSauKhiDich = floor($cungBanDau);
		$cungSauKhiDich += floor($soCungDich);
		if ($cungSauKhiDich % 12 == 0) {
			return 12;
		} else {
			return $cungSauKhiDich % 12;
		}
	}

	public function drawLineCungMenh() {
		$points = [
			[
				"x"=> 270,
				"y"=> 490
			], [
				"x"=> 90,
				"y"=> 490
			], [
				"x"=> 0,
				"y"=> 488
			], [
				"x"=> 0,
				"y"=> 367.5
			], [
				"x"=> 0,
				"y"=> 122.5
			], [
				"x"=> 0,
				"y"=> 0
			], [
				"x"=> 90,
				"y"=> 0
			], [
				"x"=> 270,
				"y"=> 0
			], [
				"x"=> 358,
				"y"=> 0
			], [
				"x"=> 358,
				"y"=> 122.5
			], [
				"x"=> 358,
				"y"=> 367.5
			], [
				"x"=> 358,
				"y"=> 490
			]
		];
		$pointMenh = $points[$this->drawMenh - 1];
		$arrayLine = [];
		foreach ($this->draw as $item) {
			$point = $points[$item['id']-1];
			$arrayLine[] = [$pointMenh['x'], $pointMenh['y'], $point['x'], $point['y']];
			if ($item['cungChu'] == 'quan-loc' || $item['cungChu'] == 'tai-bach') {
				$arrayLine[5][] = $point['x'];
				$arrayLine[5][] = $point['y'];
			}
		}

		return $arrayLine;
	}

	public function drawThienBan($thienBan) {
		// Thiên bàn
		$thienbanBG = dirname(__DIR__) . '/public/thienban.jpg';
		$thienbanBG = imagecreatefromjpeg($thienbanBG);
		$lineColor = imagecolorallocate($thienbanBG, 195, 195, 195);
		$arrayLine = $this->drawLineCungMenh();
		foreach ($arrayLine as $line) {
			imageline($thienbanBG, $line[0], $line[1], $line[2], $line[3], $lineColor);
		}

		$im = imagecreatetruecolor(359, 489);
		$backgroundColor = imagecolorallocate($im, 239, 255, 245);
		//imagefill($im3, 0, 0, $backgroundColor);
		imagecopy($im, $thienbanBG, 0, 0, 0, 0, 359, 489);

		$box = new BoxLaso($im);
		$fontRegular = dirname(__DIR__) . '/public/fonts/RobotoSlab-Regular.ttf';
		$fontBold = dirname(__DIR__) . '/public/fonts/RobotoSlab-Bold.ttf';
		$box->setFontFace($fontBold);
		$box->setFontSize(14);
		$box->setBox(0, 10, 359, 489);
		$box->setTextAlign('center');
		$box->draw('Năm xem: ' . mb_strtoupper($this->namXem . ' (' . $this->namXemCanChi['can']['title'] . ' ' . $this->namXemCanChi['chi']['title'] . ')'));

		$box->setBox(20, 50, 359, 489);
		$box->setTextAlign('left');
		$box->setFontFace($fontBold);
		$box->draw('Ngày sinh');
		$ngayDuong = $thienBan->ngayDuong . '/' . $thienBan->thangDuong . '/' . $thienBan->namDuong . ' (Dương lịch)';
		$ngayAm = $thienBan->ngayAm . '/' . $thienBan->thangAm . '/' . $thienBan->canNamTen . ' ' . $thienBan->chiNamTen . ' (Âm lịch)';
		//$box->draw($ngayDuong);
		$box->setFontFace($fontRegular);
		$box->setBox(110, 50, 359, 489);
		$box->draw( $ngayDuong);
		$box->setBox(110, 65, 359, 489);
		$box->draw( $ngayAm);

		$box->setFontFace($fontBold);
		$box->setBox(20, 90, 359, 489);
		$box->draw('Âm lịch');

		$amLichtext = 'Năm '. $thienBan->canNamTen . ' ' . $thienBan->chiNamTen . ', tháng ' . $thienBan->canThangTen . ' ' . $thienBan->chiThangTen . ', ngày ' . $thienBan->canNgayTen . ' ' . $thienBan->chiNgayTen .', giờ ' . $thienBan->gioSinh;
		$box->setFontFace($fontRegular);
		$box->setBox(110, 90, 250, 489);
		$box->draw($amLichtext);


		$box->setBox(20, 135, 359, 489);
		$box->setFontFace($fontRegular);
		$box->setTextAlign('left');
		$box->setFontFace($fontBold);
		$box->draw('Tuổi');
		$box->setBox(110, 135, 359, 489);
		$tuoi = $thienBan->amDuongNamSinh . ' ' . $thienBan->namNu . ' ('.$thienBan->amDuongMenh.')';
		$box->setFontFace($fontRegular);
		$box->draw($tuoi);

		$box->setBox(20, 165, 359, 489);
		$box->setFontFace($fontRegular);
		$box->setTextAlign('left');
		$box->setFontFace($fontBold);
		$box->draw('Bản mệnh');
		$box->setBox(110, 165, 359, 489);
		$box->setFontFace($fontRegular);
		$box->draw($thienBan->banMenh);

		$box->setBox(20, 195, 359, 489);
		$box->setFontFace($fontRegular);
		$box->setTextAlign('left');
		$box->setFontFace($fontBold);
		$box->draw('Cục');
		$box->setBox(110, 195, 359, 489);
		$box->setFontFace($fontRegular);
		$box->draw($thienBan->tenCuc);

		$box->setBox(20, 225, 359, 489);
		$box->setFontFace($fontRegular);
		$box->setTextAlign('left');
		$box->setFontFace($fontBold);
		$box->draw('Mệnh chủ');
		$box->setBox(110, 225, 359, 489);
		$box->setFontFace($fontRegular);
		$box->draw($thienBan->menhChu);

		$box->setBox(20, 255, 359, 489);
		$box->setFontFace($fontRegular);
		$box->setTextAlign('left');
		$box->setFontFace($fontBold);
		$box->draw('Thân chủ');
		$box->setBox(110, 255, 359, 489);
		$box->setFontFace($fontRegular);
		$box->draw($thienBan->thanChu);

		$box->setBox(0, 295, 359, 489);
		$box->setFontFace($fontBold);
		$box->setTextAlign('center');
		$box->setFontSize(16);
		$box->setFontFace($fontBold);
		$box->draw($thienBan->sinhKhac);

		$box->setBox(0, 330, 359, 489);
		$box->setFontFace($fontBold);
		$box->setTextAlign('center');
		$box->setFontSize(16);
		$box->setFontFace($fontBold);
		$box->setFontColor(new Color(255,69,0));
		$box->draw('Thăng long đạo quán VN');

		$hanhKim = new Color(128, 0, 128);
		$hanhMoc = new Color(0, 128, 0);
		$hanhTho = new Color( 105, 105, 105);
		$hanhThuy = new Color(70, 130, 180);
		$hanhHoa = new Color(255, 0, 0);
		$black = new Color(0, 0, 0);

		$box->setBox(20, -10, 359, 489);
		$box->setFontFace($fontBold);
		$box->setTextAlign('left', 'bottom');
		$box->setFontColor($black);
		$box->draw('Màu sắc');

		$box->setBox(100, -10, 359, 489);
		$box->setFontFace($fontBold);
		$box->setTextAlign('left', 'bottom');
		$box->setFontColor($hanhKim);
		$box->draw('Kim');

		$box->setBox(140, -10, 359, 489);
		$box->setFontFace($fontBold);
		$box->setTextAlign('left', 'bottom');
		$box->setFontColor($hanhThuy);
		$box->draw('Thủy');

		$box->setBox(190, -10, 359, 489);
		$box->setFontFace($fontBold);
		$box->setTextAlign('left', 'bottom');
		$box->setFontColor($hanhMoc);
		$box->draw('Mộc');

		$box->setBox(230, -10, 359, 489);
		$box->setFontFace($fontBold);
		$box->setTextAlign('left', 'bottom');
		$box->setFontColor($hanhHoa);
		$box->draw('Hỏa');
//
		$box->setBox(270, -10, 359, 489);
		$box->setFontFace($fontBold);
		$box->setTextAlign('left', 'bottom');
		$box->setFontColor($hanhTho);
		$box->draw('Thổ');

		return $im;
	}

	public function drawCung($data)
	{
		$cungChu = khongdau($data->cungChu);
		if (!empty($data->cungR)) {
			if ($data->idThapnhicung == 1) {
				$this->drawMenh = $data->cungSo;
			} else {
				$this->draw[] = [
					'id' => $data->cungSo,
					'cungChu' => $cungChu
				];
			}
		}
		$listSaoThaiTue = range(15, 26);
		$listSaoTruongSinh = range(39, 50);
		$luuThaiTue = false;
		$tieuHan = str_replace('tý', 'ti', mb_strtolower($data->cungTen));
		$tieuHanSlug = khongdau($tieuHan);
		if ($tieuHanSlug == $this->namXemCanChi['chi']['name']) {
			$luuThaiTue = true;
		}

		$im = imagecreatetruecolor(180, 245);
		$hanhKim = new Color(128, 0, 128);
		$hanhMoc = new Color(0, 128, 0);
		$hanhTho = new Color( 105, 105, 105);
		$hanhThuy = new Color(70, 130, 180);
		$hanhHoa = new Color(255, 0, 0);
		$black = new Color(0, 0, 0);
		$backgroundColor = imagecolorallocate($im, 234, 232, 219);

		$fontRegular = dirname(__DIR__) . '/public/fonts/RobotoSlab-Regular.ttf';
		$fontBold = dirname(__DIR__) . '/public/fonts/RobotoSlab-Bold.ttf';

		imagefill($im, 0, 0, $backgroundColor);
		$box = new BoxLaso($im);
		$box->setFontFace($fontRegular);
		$box->setFontSize(14);

		// Top
		$box->setFontColor($black);
		$box->setBox(0, 5, 180, 245);
		$box->setTextAlign('center');
		$text = $data->cungChu;
		if ($data->cungThan) {
			$text .= ' (Thân)';
		}
		$box->setFontSize(12);
		$box->draw(mb_strtoupper($text)); // Cung chủ

		$box->setBox(5, 5, 180, 245);
		$box->setTextAlign('left', 'top');
		$box->setFontColor(${$data->hanhSlug});
		$box->draw($data->cungTen); // Cung tên
		$box->setBox(-5, 5, 180, 245);
		$box->setTextAlign('right', 'top');
		$box->setFontColor($black);
		$box->draw($data->cungDaiHan); // Đại hạn

		if (!empty($data->cungSao)) {
			$chinhTinhPx = 5;
			$phuTinhXauPx = 65;
			$phuTinhTotPx = 65;
			$box->setBox(0, $chinhTinhPx, 180, 245);
			foreach ($data->cungSao as $sao) {
				if ($data->idThapnhicung == 1 && !empty($sao->luanGiai)) {
					$this->luanGiaiLaSo['menh'][] = $sao->luanGiai['global'];
				}
				if ($sao->saoLoai == 1) {
					$this->menhChinhDieu = true;
					if ($data->idThapnhicung == 1 && in_array($sao->saoDacTinh, ['V', 'M', 'Đ'])) {
						$this->dacDia = true;
					}
					if ($data->idThapnhicung == 1 && in_array($sao->saoDacTinh, ['V', 'M'])) {
						$this->chinhChieuVuongDia = true;
					}
					if ($data->idThapnhicung == 1 && $data->trietLo == 1) {
						$this->tuanAnNguTaiMenh = true;
					}
					if ($data->idThapnhicung == 1 && $data->tuanTrung == true) {
						$this->trietAnNguTaiMenh = true;
					}
					// Than menh dong cung
					if ($data->idThapnhicung == 1 && !empty($data->cungThan)) {
						$this->thanMenhDongCung = true;
					}
					// Quan loc
					if ($data->idThapnhicung == 5 && !empty($data->cungThan)) {
						$this->thanCuQuanLoc = true;
					}
					// Thien di
					if ($data->idThapnhicung == 7 && !empty($data->cungThan)) {
						$this->thanCuThienDi = true;
					}
					// Tài bạch
					if ($data->idThapnhicung == 9 && !empty($data->cungThan)) {
						$this->thanCuTaiBach = true;
					}
					// Tu phu vu tuong
					if (in_array($data->idThapnhicung, [1, 5, 7, 9]) && in_array($sao->saoID, [1, 20, 7, 4, 11])) {
						$this->tuPhuVuTuong++;
					}
					// Sat pha liem tham
					if (in_array($data->idThapnhicung, [1, 5, 7, 9]) && in_array($sao->saoID, [2, 13, 14, 9])) {
						$this->satPhaLiemTham++;
					}
					// Liem trinh menh tai quan
					if (in_array($data->idThapnhicung, [5, 9]) && $sao->saoID == 2) {
						$this->liemTrinhMenhTaiQuan = true;
					}

					$chinhTinhPx +=18;

					// chinh tinh
					$box->setFontColor(${$sao->cssSao});
					$box->setTextAlign('center');
					$box->setBox(0, $chinhTinhPx, 180, 245);
					$text = $sao->saoTen;
					$text .= !empty($sao->saoDacTinh) ? '(' . $sao->saoDacTinh . ')' : '';
					$box->draw($text);
				}
				$box->setFontColor($black);

				if (($data->idThapnhicung == 1 || $data->idThapnhicung == 5 || $data->idThapnhicung == 9) && in_array($sao->saoID, $listSaoThaiTue)) {
					//echo $data->idThapnhicung . '---' . $sao->saoID. "<br>";
					$this->thaiTueLuan[] = $sao;
					$this->thaiTueSaoID[] = $sao->saoID;
				}

				// sao tot
				if ($sao->vongTrangSinh === 0 && $sao->saoLoai !== 1 && $sao->saoLoai < 10) {
					if ($data->idThapnhicung == 1 && !empty($sao->luanGiai)) {
						$this->luanGiaiLaSo['sao_tot'][] = $sao;
					}
					$box->setFontColor(${$sao->cssSao});
					$box->setTextAlign('left');
					$box->setBox(5, $phuTinhTotPx, 180, 245);
					$box->draw($sao->saoTen);
					$phuTinhTotPx += 18;
				}
				$box->setFontColor($black);

				// sao xau
				if ($sao->vongTrangSinh === 0 && $sao->saoLoai !== 1 && $sao->saoLoai > 10){
					if ($data->idThapnhicung == 1 && !empty($sao->luanGiai)) {
						$this->luanGiaiLaSo['sao_xau'][] = $sao;
					}
					$box->setFontColor(${$sao->cssSao});
					$box->setTextAlign('right');
					$box->setBox(-5, $phuTinhXauPx, 180, 245);
					$box->draw($sao->saoTen);
					$phuTinhXauPx += 18;
				}
				$box->setFontColor($black);


				// bottom center
				if ($sao->vongTrangSinh == 1) {
					if (($data->idThapnhicung == 1 || $data->idThapnhicung == 5 || $data->idThapnhicung == 7 || $data->idThapnhicung == 9) && in_array($sao->saoID, $listSaoTruongSinh)) {
						$this->truongSinhLuan[] = $sao;
						$this->truongSinhSaoID[] = $sao->saoID;
					}
					$box->setFontColor(${$sao->cssSao});
					$box->setBox(0, -5, 180, 245);
					$box->setTextAlign('center', 'bottom');
					$box->draw($sao->saoTen);
				}

			}
			// bottom left
			$box->setBox(5, -5, 180, 245);
			$box->setTextAlign('left', 'bottom');
			$box->draw($data->cungTieuHan);

			// bottom right
			$dhText = $data->hanhCung;
			$dhText = ($data->cungAmDuong == -1 ? '-' : '+') . $dhText;
			$box->setBox(-5, -5, 180, 245);
			$box->setTextAlign('right', 'bottom');
			$box->draw($dhText);

			$box->setFontColor($black);
			if ($luuThaiTue) {
				$box->setTextAlign('right');
				$box->setBox(-5, $phuTinhXauPx, 180, 245);
				$box->setFontColor($hanhHoa);
				$box->draw('L. Thái Tuế');
				$phuTinhXauPx += 18;
			}
			if (!empty($this->saoLuu[$tieuHanSlug]['tot'])) {
				foreach ($this->saoLuu[$tieuHanSlug]['tot'] as $sao) {
					$box->setTextAlign('left');
					$box->setBox(5, $phuTinhTotPx, 180, 245);
					$box->setFontColor(${$sao['hanh']});
					$box->draw($sao['name']);
					$phuTinhTotPx += 18;
				}
			}
			$box->setFontColor($black);
			if (!empty($this->saoLuu[$tieuHanSlug]['xau'])) {
				foreach ($this->saoLuu[$tieuHanSlug]['xau'] as $sao) {
					$box->setTextAlign('right');
					$box->setBox(-5, $phuTinhXauPx, 180, 245);
					$box->setFontColor(${$sao['hanh']});
					$box->draw($sao['name']);
					$phuTinhXauPx += 18;
				}
			}
		}
		if ($data->trietLo == 1) {
			$box->setBox(5, -30, 180, 245);
			$box->setBackgroundColor(new Color(0,0,0));
			$box->setFontFace($fontBold);
			$box->setTextAlign('center', 'bottom');
			$box->setFontColor(new Color(255, 255, 255));
			$box->draw("Triệt");
		}
		if ($data->tuanTrung == true) {
			$box->setBox(0, -30, 180, 245);
			$box->setBackgroundColor(new Color(217,83,79));
			$box->setFontFace($fontBold);
			$box->setTextAlign('center', 'bottom');
			$box->setFontColor(new Color(255, 255, 255));
			$box->draw("Tuần");
		}
		return $im;
	}

	public function getLaso()
	{
		$lapDiaBan = new lapDiaBan();

		$diaBan = $lapDiaBan->run($this->ngaysinh, $this->thangsinh, $this->namsinh, $this->giosinh, $this->gioitinh, $this->duonglich, $this->timezone);
		$thienBan = new lapThienBan($this->ngaysinh, $this->thangsinh, $this->namsinh, $this->giosinh, $this->gioitinh, $this->hoten, $diaBan, $this->duonglich, $this->timezone);
		$thapNhiCung = $diaBan->thapNhiCung;
		$this->tinhSaoLuu();
		ob_start();
		?>
		<!--<script src="/assets/js/wz_jsgraphics.js"></script>-->
		<div class="laso-wrapper">
			<div class="laso pt-border" id="laso">
				<div class="pt-grid">
					<div class="pt-col pt-col-3">
						<div class="pt-container">
							<div class="pt-grid diaCung pt-border-bottom" cung-id="6"
							     id="cungTy5"><?php $this->cungRender($thapNhiCung[6]); ?></div>
							<div class="pt-grid diaCung pt-border-bottom" cung-id="5"
							     id="cungThin"><?php $this->cungRender($thapNhiCung[5]); ?></div>
							<div class="pt-grid diaCung pt-border-bottom inset-border" cung-id="4"
							     id="cungMao"><?php $this->cungRender($thapNhiCung[4]); ?></div>
							<div class="pt-grid diaCung" cung-id="3"
							     id="cungDan"><?php $this->cungRender($thapNhiCung[3]); ?></div>
						</div>
					</div>
					<div class="pt-col pt-col-6">
						<div class="pt-container">
							<div class="pt-grid">
								<div class="pt-col pt-col-6 diaCung pt-border-left" cung-id="7"
								     id="cungNgo"><?php $this->cungRender($thapNhiCung[7]); ?></div>
								<div class="pt-col pt-col-6 diaCung pt-border-left" cung-id="8"
								     id="cungMui"><?php $this->cungRender($thapNhiCung[8]); ?></div>
							</div>

							<div class="pt-grid thienBan pt-border-top pt-border-left pt-border-bottom pt-border-right"
							     id="thienBan">
								<div class="noidung">
									<div class="pt-header">Năm
										xem: <?= $this->namXem . ' (' . $this->namXemCanChi['can']['title'] . ' ' . $this->namXemCanChi['chi']['title'] . ')'; ?></div>
									<!--<div class="pt-grid">
                                        <div class="pt-col pt-col-3 cotTrai">Họ tên</div>
                                        <div class="pt-col pt-col-9 cotPhai"><?= $thienBan->ten; ?></div>
                                    </div>-->
									<div class="pt-grid">
										<div class="pt-col pt-col-3 cotTrai">Bát tự</div>
										<div class="pt-col pt-col-9 cotPhai">
											Năm <?= $thienBan->canNamTen . ' ' . $thienBan->chiNamTen ?> ,
											tháng <?= $thienBan->canThangTen . ' ' . $thienBan->chiThangTen; ?>,
											ngày <?= $thienBan->canNgayTen . ' ' . $thienBan->chiNgayTen; ?>,
											giờ <?= $thienBan->gioSinh; ?></div>
									</div>

									<div class="pt-grid">
										<div class="pt-col pt-col-3 cotTrai">Tuổi</div>
										<div class="pt-col pt-col-9 cotPhai">
											<?= $thienBan->amDuongNamSinh . ' ' . $thienBan->namNu ?>
											(<?= $thienBan->amDuongMenh; ?>)
										</div>
									</div>

									<div class="pt-grid">
										<div class="pt-col pt-col-3 cotTrai">Ngày sinh</div>
										<div class="pt-col pt-col-9 cotPhai">
											<div>
												<?= $thienBan->ngayAm . '/' . $thienBan->thangAm . '/' . $thienBan->canNamTen . ' ' . $thienBan->chiNamTen ?>
												(Âm lịch)
											</div>
											<div><?= $thienBan->ngayDuong . '/' . $thienBan->thangDuong . '/' . $thienBan->namDuong ?>
												(Dương lịch)
											</div>
										</div>
									</div>

									<div class="pt-grid">
										<div class="pt-col pt-col-3 cotTrai">Bản mệnh</div>
										<div class="pt-col pt-col-9 cotPhai">
											<?= $thienBan->banMenh ?>
										</div>
									</div>

									<div class="pt-grid">
										<div class="pt-col pt-col-3 cotTrai">Cục</div>
										<div class="pt-col pt-col-9 cotPhai">
											<?= $thienBan->tenCuc ?>
										</div>
									</div>

									<div class="pt-grid">
										<div class="pt-col pt-col-3 cotTrai">Mệnh chủ</div>
										<div class="pt-col pt-col-9 cotPhai">
											<?= $thienBan->menhChu ?>
										</div>
									</div>

									<div class="pt-grid">
										<div class="pt-col pt-col-3 cotTrai">Thân chủ</div>
										<div class="pt-col pt-col-9 cotPhai">
											<?= $thienBan->thanChu ?>
										</div>
									</div>

									<div class="pt-grid sinhkhac">
										<?= $thienBan->sinhKhac ?>
									</div>

									<div class="mausac">
										<div class="pt-grid">
											<span class="pt-col pt-col-2">Màu sắc</span>
											<span class="pt-col pt-col-2 hanhKim gioithieuhanh">Kim</span>
											<span class="pt-col pt-col-2 hanhThuy gioithieuhanh">Thủy</span>
											<span class="pt-col pt-col-2 hanhHoa gioithieuhanh">Hỏa</span>
											<span class="pt-col pt-col-2 hanhTho gioithieuhanh">Thổ</span>
											<span class="pt-col pt-col-2 hanhMoc gioithieuhanh">Mộc</span>
										</div>
									</div>
									<div class="ls-copyright">
										<h3 class="cp-name">ThăngLongĐạoQuán</h3>
										<span class="cp-info">(Lá số an theo Tử Vi Ứng Dụng)</span>
									</div>
								</div>
							</div>
							<div class="pt-grid">
								<div class="pt-col pt-col-6 diaCung pt-border-left" cung-id="2" id="cungSuu">
									<?php $this->cungRender($thapNhiCung[2]); ?>
								</div>
								<div class="pt-col pt-col-6 diaCung pt-border-left" cung-id="1" id="cungTy1">
									<?php $this->cungRender($thapNhiCung[1]); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="pt-col pt-col-3">
						<div class="pt-container">
							<div class="pt-grid diaCung pt-border-left pt-border-bottom" cung-id="9"
							     id="cungThan"><?php $this->cungRender($thapNhiCung[9]); ?></div>
							<div class="pt-grid diaCung pt-border-bottom" cung-id="10"
							     id="cungDau"><?php $this->cungRender($thapNhiCung[10]); ?></div>
							<div class="pt-grid diaCung pt-border-bottom" cung-id="11"
							     id="cungTuat"><?php $this->cungRender($thapNhiCung[11]); ?></div>
							<div class="pt-grid diaCung pt-border-left" cung-id="12"
							     id="cungHoi"><?php $this->cungRender($thapNhiCung[12]); ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			function dichCung(cungBanDau, soCungDich) {
				var cungSauKhiDich = Math.floor(cungBanDau);
				cungSauKhiDich += Math.floor(soCungDich);
				if (cungSauKhiDich % 12 == 0) {
					return 12;
				}
				else {
					return cungSauKhiDich % 12;
				}
			}

			jQuery(document).ready(function ($) {
				var i = {
					points: [{
						x: 270,
						y: 490
					}, {
						x: 90,
						y: 490
					}, {
						x: 0,
						y: 488
					}, {
						x: 0,
						y: 367.5
					}, {
						x: 0,
						y: 122.5
					}, {
						x: 0,
						y: 0
					}, {
						x: 90,
						y: 0
					}, {
						x: 270,
						y: 0
					}, {
						x: 358,
						y: 0
					}, {
						x: 358,
						y: 122.5
					}, {
						x: 358,
						y: 367.5
					}, {
						x: 358,
						y: 490
					}]
				};
				var menh = $('.draw.menh').parent().attr('cung-id');
				pointM = i.points[menh - 1];
				console.log(pointM);
				pointA = new Array();
				$('.draw').not('.menh').each(function () {
					pointA.push(i.points[$(this).parent().attr('cung-id') - 1]);
				});
				var t = new jsGraphics('thienBan');
				t.setStroke(1);
				t.setColor("#999");
				$.each(pointA, function (index, value) {
					console.log(value)
					t.drawLine(pointM.x, pointM.y, value.x, value.y);
					t.drawLine(pointM.x, pointM.y, value.x, value.y);
					t.drawLine(pointM.x, pointM.y, value.x, value.y);
				});
				t.paint();
				$("[cung-id]").click(function () {
					$("[cung-id]").removeClass("xungChieu");
					cungid = $(this).attr('cung-id');
					cungXungChieu = dichCung(cungid, 6);
					cungTamHop1 = dichCung(cungid, 4);
					cungTamHop2 = dichCung(cungid, 8);
					console.log(cungXungChieu, cungTamHop1)
					$(this).addClass("xungChieu");
					$("[cung-id=" + cungXungChieu + "]").addClass("xungChieu");
					$("[cung-id=" + cungTamHop1 + "]").addClass("xungChieu");
					$("[cung-id=" + cungTamHop2 + "]").addClass("xungChieu");
				});
			});
		</script>
		<div style="display: none">
			<?= $this->menhChinhDieu ? 'Chính diệu: true' : 'Chính diệu: false'; ?>
			<?= $this->dacDia ? 'Đắc Địa: true' : 'Đắc Địa: false'; ?>
			<?= 'Tử phủ vũ tướng: ' . $this->tuPhuVuTuong ?>
		</div>
		<?php
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

	function cungRender ($data) {
		$label = '';
		$classDraw = !empty($data->cungR) ? 'draw' : '';
		if ($data->cungThan) {
			$label = '<span class="cungThan pt-label">Thân</span>';
		}
		if ($data->idThapnhicung == 1) {
			$classDraw .= ' menh';
		}
		$listSaoThaiTue = range(15,26);
		$listSaoTruongSinh = range(39,50);
		$luuThaiTue = false;
		$tieuHan = str_replace('tý', 'ti', strtolower($data->cungTen));
		$tieuHanSlug = khongdau($tieuHan);
		if ($tieuHanSlug == $this->namXemCanChi['chi']['name']) {
			$luuThaiTue = true;
		}
		?>
		<div class="<?= $classDraw; ?>">
			<div class="pt-grid cung-top">
				<div class="pt-col pt-col-2 tooltips" title="Địa chi cung <?= $data->cungTen ?>">
					<?= $data->cungTen ?>
				</div>
				<div class="pt-col pt-col-8">
					<span class="cungChu"><?= $data->cungChu?></span>
					<?= $label ?>
				</div>
				<div class="pt-col pt-col-2 tooltips" title="Đại hạn <?= $data->cungDaiHan ?> - <?= $data->cungDaiHan + 9 ?>">
					<?= $data->cungDaiHan ?>
				</div>
			</div>
			<div class="pt-grid cung-middle">
				<div class="chinhTinh">
					<?php if (!empty($data->cungSao)) : foreach ($data->cungSao as $sao) :
						if ($data->idThapnhicung == 1 && !empty($sao->luanGiai)) {
							$this->luanGiaiLaSo['menh'][] = $sao->luanGiai['global'];
						}
						//var_dump($sao->saoLoai);
						//var_dump($sao->saoTen);
						?>
						<?php if ($sao->saoLoai == 1) : ?>
						<?php
						$this->menhChinhDieu = true;
						?>
						<?php
						if ($data->idThapnhicung == 1 && in_array($sao->saoDacTinh, ['V', 'M', 'Đ'])) {
							$this->dacDia = true;
						}
						if ($data->idThapnhicung == 1 && in_array($sao->saoDacTinh, ['V', 'M'])) {
							$this->chinhChieuVuongDia = true;
						}
						if ($data->idThapnhicung == 1 && $data->trietLo == 1) {
							$this->tuanAnNguTaiMenh = true;
						}
						if ($data->idThapnhicung == 1 && $data->tuanTrung == true) {
							$this->trietAnNguTaiMenh = true;
						}
						// Than menh dong cung
						if ($data->idThapnhicung == 1 && !empty($data->cungThan)) {
							$this->thanMenhDongCung = true;
						}
						// Quan loc
						if ($data->idThapnhicung == 5 && !empty($data->cungThan)) {
							$this->thanCuQuanLoc = true;
						}
						// Thien di
						if ($data->idThapnhicung == 7 && !empty($data->cungThan)) {
							$this->thanCuThienDi = true;
						}
						// Tài bạch
						if ($data->idThapnhicung == 9 && !empty($data->cungThan)) {
							$this->thanCuTaiBach = true;
						}
						// Tu phu vu tuong
						if (in_array($data->idThapnhicung, [1,5,7,9]) && in_array($sao->saoID, [1, 20, 7, 4, 11])) {
							$this->tuPhuVuTuong++;
						}
						// Sat pha liem tham
						if (in_array($data->idThapnhicung, [1,5,7,9]) && in_array($sao->saoID, [2, 13, 14, 9])) {
							$this->satPhaLiemTham++;
						}
						// Liem trinh menh tai quan
						if (in_array($data->idThapnhicung, [5,9]) && $sao->saoID == 2) {
							$this->liemTrinhMenhTaiQuan = true;
						}
						?>
						<li class="<?= $sao->cssSao ?>">
							<?= $sao->saoTen ?>
							<?= !empty($sao->saoDacTinh) ? '(' . $sao->saoDacTinh .')' : ''; ?>
						</li>
					<?php endif; ?>
					<?php endforeach;endif; ?>
				</div>

				<div class="phuTinh">
					<div class="saotot">
						<?php if (!empty($data->cungSao)) : foreach ($data->cungSao as $sao) : ?>
							<?php if ($sao->vongTrangSinh === 0 && $sao->saoLoai !== 1 && $sao->saoLoai < 10) : ?>
								<?php if ($data->idThapnhicung == 1 && !empty($sao->luanGiai)) : ?>
									<?php $this->luanGiaiLaSo['sao_tot'][] = $sao; ?>
								<?php endif; ?>
								<?php

								if (($data->idThapnhicung == 1 || $data->idThapnhicung == 5 || $data->idThapnhicung == 9) && in_array($sao->saoID, $listSaoThaiTue)) {
									$this->thaiTueLuan[] = $sao;
									$this->thaiTueSaoID[] = $sao->saoID;
								}
								?>
								<div class="pt-grid">
									<div class="pt-col <?= $sao->cssSao ?>">
										<?= $sao->saoTen ?>
										<?= !empty($sao->saoDacTinh) ? '(' . $sao->saoDacTinh . ')' : ''; ?>
									</div>
								</div>
							<?php endif; ?>
						<?php endforeach;endif; ?>
						<?php if (!empty($this->saoLuu[$tieuHanSlug]['tot'])) : ?>
							<?php foreach ($this->saoLuu[$tieuHanSlug]['tot'] as $sao) : ?>
								<div class="pt-grid">
									<div class="pt-col <?=$sao['hanh']?>"><?=$sao['name']?></div>
								</div>
							<?php endforeach;?>
						<?php endif; ?>
					</div>
					<div class="saoxau">
						<?php if (!empty($data->cungSao)) : foreach ($data->cungSao as $sao) : ?>
							<?php if ($sao->vongTrangSinh === 0 && $sao->saoLoai !== 1 && $sao->saoLoai > 10) : ?>
								<?php if ($data->idThapnhicung == 1 && !empty($sao->luanGiai)) : ?>
									<?php $this->luanGiaiLaSo['sao_xau'][] = $sao; ?>
								<?php endif; ?>
								<?php
								if (($data->idThapnhicung == 1 || $data->idThapnhicung == 5 || $data->idThapnhicung == 9) && in_array($sao->saoID, $listSaoThaiTue)) {
									$this->thaiTueLuan[] = $sao;
									$this->thaiTueSaoID[] = $sao->saoID;
								}
								?>
								<div class="pt-grid">
									<div class="pt-col <?= $sao->cssSao ?>">
										<?= $sao->saoTen ?>
										<?= !empty($sao->saoDacTinh) ? '(' . $sao->saoDacTinh . ')' : ''; ?>
									</div>
								</div>
							<?php endif; ?>
						<?php endforeach;endif; ?>
						<?php if ($luuThaiTue) : ?>
							<div class="pt-grid">
								<div class="pt-col hanhHoa">L. Thái Tuế</div>
							</div>
						<?php endif; ?>
						<?php if (!empty($this->saoLuu[$tieuHanSlug]['xau'])) : ?>
							<?php foreach ($this->saoLuu[$tieuHanSlug]['xau'] as $sao) : ?>
								<div class="pt-grid">
									<div class="pt-col <?=$sao['hanh']?>"><?=$sao['name']?></div>
								</div>
							<?php endforeach;?>
						<?php endif; ?>
						<div class="tuanTriet">
							<?php if ($data->trietLo == 1) : ?>
								<span class="pt-label label-triet">Triệt</span>
							<?php endif; ?>
							<?php if ($data->tuanTrung == true) : ?>
								<span class="pt-label label-tuan">Tuần</span>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="pt-grid cung-bottom">
				<div class="pt-col pt-col-3 tooltips" title="Tiểu hạn của năm <?= $data->cungTieuHan ?>"><?= $data->cungTieuHan ?></div>
				<?php if (!empty($data->cungSao)) : foreach ($data->cungSao as $sao) : ?>
					<?php if ($sao->vongTrangSinh == 1) : ?>
						<?php
						if (($data->idThapnhicung == 1 || $data->idThapnhicung == 5 || $data->idThapnhicung == 7 || $data->idThapnhicung == 9) && in_array($sao->saoID, $listSaoTruongSinh)) {
							$this->truongSinhLuan[] = $sao;
							$this->truongSinhSaoID[] = $sao->saoID;
						}
						?>
						<div class="pt-col pt-col-6 <?= $sao->cssSao ?>">
							<?= $sao->saoTen ?>
						</div>
					<?php endif; ?>
				<?php endforeach;endif; ?>
				<div class="pt-col pt-col-3 tooltips" title="Cung (<?= $data->cungAmDuong == -1 ? 'âm' : 'dương'; ?>), ngũ hành <?= $data->hanhCung;?>">
					<?= $data->cungAmDuong == -1 ? '-' : '+'; ?><?= $data->hanhCung ?>
				</div>
			</div>
		</div>
		<?php
	}

	function tinhDiemLaSo()
	{
		if ($this->menhChinhDieu == false) {
			$this->diemSoTuVi = 1;
			$str = 'Mệnh Vô Chính Diệu';
			if ($this->thanMenhDongCung) {
				$this->message[] = $str . ' - Thân Mệnh đồng cung';
				$this->diemSoTuVi = 1.5;
			}
			if ($this->thanCuQuanLoc) {
				$this->message[] = $str . ' - Thân Cư Quan Lộc';
				$this->diemSoTuVi = 1.5;
			}
			if ($this->thanCuTaiBach) {
				$this->message[] = $str . ' - Thân Cư Tài Bạch';
				$this->diemSoTuVi = 1.5;
			}
			if ($this->thanCuThienDi) {
				$this->message[] = $str . ' - Thân cư Thiên Di';
				$this->diemSoTuVi = 1.5;
			}
			if ($this->tuanAnNguTaiMenh && $this->trietAnNguTaiMenh) {
				$this->message[] = $str . ' - Tuần Triệt án ngữ tại Mệnh';
				$this->diemSoTuVi = 1.5;
				if ($this->chinhChieuVuongDia) {
					$this->message[] = $str . ' - Tuần Triệt án ngữ tại Mệnh, Chính Chiếu Vượng Địa';
					$this->diemSoTuVi = 2;
				}
			} else {
				if ($this->trietAnNguTaiMenh) {
					$this->message[] = $str . ' - Triệt án ngữ tại Mệnh';
					$this->diemSoTuVi = 1.75;
				}
				if ($this->tuanAnNguTaiMenh) {
					$this->message[] = $str . ' - Tuần án ngữ tại Mệnh';
					$this->diemSoTuVi = 1.5;
				}
			}
		} else {
			$str = 'Mệnh Chính Diệu';
			if ($this->dacDia) {
				$str .= ' - Đắc Địa';
				$this->diemSoTuVi = 1.5;
				if ($this->trietAnNguTaiMenh) {
					$this->message[] = $str . ' - Triệt án ngữ tại Mệnh';
					$this->diemSoTuVi = 1.75;
				}
				if ($this->tuanAnNguTaiMenh) {
					$this->message[] = $str . ' - Tuần án ngữ tại Mệnh';
					$this->diemSoTuVi = 1;
				}
				if ($this->thanCuQuanLoc) {
					$this->message[] = $str . ' - Thân Cư Quan Lộc';
					$this->diemSoTuVi = 2;
				}
				if ($this->thanCuTaiBach) {
					$this->message[] = $str . ' - Thân Cư Tài Bạch';
					$this->diemSoTuVi = 2;
				}
				if ($this->thanCuThienDi) {
					$this->message[] = $str . ' - Thân cư Thiên Di';
					$this->diemSoTuVi = 2;
				}
			} else {
				$str = 'Mệnh Chính Diệu Hãm Địa/Bình Hòa';
				$this->diemSoTuVi = 1;
				if ($this->trietAnNguTaiMenh) {
					$this->message[] = $str . ' - Triệt án ngữ tại Mệnh';
					$this->diemSoTuVi = 1.75;
				}
				if ($this->tuanAnNguTaiMenh) {
					$this->message[] = $str . ' - Tuần án ngữ tại Mệnh';
					$this->diemSoTuVi = 0.5;
				}
			}
		}
		if ($this->tuPhuVuTuong == 4) {
			$str = 'Tử Phủ Vũ Tướng';
			$this->diemSoTuVi = 1;
			if ($this->dacDia) {
				$str .= ' - Đắc Địa';
				$this->diemSoTuVi = 1.75;
				if ($this->liemTrinhMenhTaiQuan) {
					$this->message[] = $str . ' - Liêm Trinh Mệnh Tài Quan';
					$this->diemSoTuVi = 2;
				}
			}
		}
		if ($this->satPhaLiemTham == 4) {
			$str = 'Sát Phá Liêm Tham';
			$this->diemSoTuVi = 1;
			if ($this->dacDia) {
				$this->message[] = $str . ' - Đắc Địa';
				$this->diemSoTuVi = 1.75;
			} else {
				$this->message[] = $str . ' - Hãm Địa/Bình Hòa';
			}
		}

		return [
			'message' => $this->message,
			'diemtuvi' => $this->diemSoTuVi
		];
	}

	public function luanGiai() {
	    $results = [];
        foreach ($this->thapNhiCung as $index => $data) {
            if ($index == 0) {
                continue;
            }
            $idCung = $data->idThapnhicung;
            if (!empty($data->cungSao)) {
                foreach ($data->cungSao as $sao) {
                    $results[] = isset($sao->luanGiai['cung'][$idCung]) ? $sao->luanGiai['cung'][$idCung] : '';
                }
            }
        }

        return $results;
    }
}