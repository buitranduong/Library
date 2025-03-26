<?php
/**
 * Created by PhpStorm.
 * User: DUYDUC
 * Date: 17-Oct-18
 * Time: 9:24 AM
 */

namespace Laven;


use Laven\Constants\Constants;
use Laven\Helpers\Helpers;
class lapThienBan {

    public $gioiTinh;
    public $namNu;
    public $chiGioSinh;
    public $canGioSinh;
    public $gioSinh;
    public $timeZone;
    public $today;
    public $ngayDuong;
    public $thangDuong;
    public $namDuong;

    public $ngayAm;
    public $thangAm;
    public $namAm;
    public $thangNhuan;

    public $ten;

    public function __construct($nn, $tt, $nnnn, $gioSinh, $gioiTinh, $ten, $diaBan, $duongLich=true, $timeZone=7)
    {
        $helper = new Helpers();
        $diaChi = Constants::$diaChi;
        $thienCan = Constants::$thienCan;
        $this->gioiTinh = $gioiTinh == 1 ? 1 : -1;
        $this->namNu = $gioiTinh == 1? "Nam" : "Nữ";
        $this->chiGioSinh = $diaChi[$gioSinh];
        $this->canGioSinh = (($helper->jdFromDate($nn, $tt, $nnnn) - 1) * 2 % 10 + $gioSinh) % 10;
        if ($this->canGioSinh == 0) {
            $this->canGioSinh = 10;
        }
        $this->gioSinh = $thienCan[$this->canGioSinh]['tenCan'] . ' ' . $this->chiGioSinh['tenChi'];
        $this->timeZone = $timeZone;
        $this->today = strftime('%d/%m/%Y', time());
        $this->ngayDuong = $nn;
        $this->thangDuong = $tt;
        $this->namDuong = $nnnn;
        $this->ten = $ten;
        if ($duongLich) {
            $amlich = $helper->ngayThangNam($this->ngayDuong, $this->thangDuong, $this->namDuong, true, $timeZone);
            $this->ngayAm = (int)$amlich[0];
            $this->thangAm = (int)$amlich[1];
            $this->namAm = (int)$amlich[2];
            $this->thangNhuan = (int)$amlich[3];
        } else {
            $this->ngayAm = (int)$this->ngayDuong;
            $this->thangAm = (int)$this->thangDuong;
            $this->namAm = (int)$this->namDuong;
        }
        $ngaythangnamchanchi = $helper->ngayThangNamCanChi($this->ngayAm, $this->thangAm, $this->namAm, false, $timeZone);
        $this->canThang = $ngaythangnamchanchi[0];
        $this->canNam = $ngaythangnamchanchi[1];
        $this->chiNam = $ngaythangnamchanchi[2];
        $this->chiThang = $this->thangAm;
        $this->canThangTen = $thienCan[$this->canThang]['tenCan'];
        $this->canNamTen = $thienCan[$this->canNam]['tenCan'];
        $chiThangId = $this->fix12($this->thangAm + 2);
        $this->chiThangTen = $diaChi[$chiThangId]['tenChi'];
        $this->chiNamTen = $diaChi[$this->chiNam]['tenChi'];
        $canChiNgay = (new Helpers())->canChiNgay($this->ngayDuong, $this->thangDuong, $this->namDuong, $duongLich, $timeZone, false);
        $this->canNgay = $canChiNgay[0];
        $this->chiNgay = $canChiNgay[1];
        $this->canNgayTen = $thienCan[$this->canNgay]['tenCan'];
        $this->chiNgayTen = $diaChi[$this->chiNgay]['tenChi'];
        $cungAmDuong = $diaBan->cungMenh % 2 == 1 ? 1 : -1;
        $this->amDuongNamSinh = $this->chiNam % 2 == 1 ? 'Dương' : 'Âm';
        if ($cungAmDuong * $this->gioiTinh == 1) {
            $this->amDuongMenh = 'Âm dương thuận lý';
        } else {
            $this->amDuongMenh = 'Âm dương nghịch lý';
        }
        $cuc = $helper->timCuc($diaBan->cungMenh, $this->canNam);
        $this->hanhCuc = $helper->nguHanh($cuc)['id'];
        $this->tenCuc = $helper->nguHanh($cuc)['tenCuc'];

        $this->menhChu = $diaChi[$this->canNam]['menhChu'];
        $this->thanChu = $diaChi[$this->canNam]['thanChu'];

        $this->menh = $helper->nguHanhNapAm($this->chiNam, $this->canNam);
        $menhId = $helper->nguHanh($this->menh)['id'];
        $menhCuc = $helper->sinhKhac($menhId, $this->hanhCuc);
        switch ($menhCuc) {
            case 1:
                $this->sinhKhac = 'Bản Mệnh sinh Cục';
                break;
            case -1:
                $this->sinhKhac = 'Bản Mệnh khắc Cục';
                break;
            case -2:
                $this->sinhKhac = 'Cục khắc Bản Mệnh';
                break;
            case 2:
                $this->sinhKhac = 'Cục sinh Bản mệnh';
                break;
            default:
                $this->sinhKhac = 'Cục hòa Bản Mệnh';
                break;
        }
        $this->banMenh = $helper->nguHanhNapAm($this->chiNam, $this->canNam, true);
    }

	function fix12($n) {
		while ($n > 12) {
			$n = $n - 12;
		}
		while ($n <= 0) {
			$n = $n + 12;
		}
		return $n;
	}
}