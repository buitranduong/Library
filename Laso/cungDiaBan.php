<?php
/**
 * Created by PhpStorm.
 * User: DUYDUC
 * Date: 17-Oct-18
 * Time: 9:17 AM
 */
namespace Laven;

use Laven\Constants\Constants;
use Laven\Helpers\Helpers;
class cungDiaBan {
    public $cungID;
    public $cungSo;
    public $hanhCung;
    public $cungSao;
    public $cungAmDuong;
    public $cungTen;
    public $cungThan;
    public $cungChu;
    public $cungDaiHan;
    public $cungTieuHan;
    public $tuanTrung;
    public $diaChi;
    public $trietLo;
    public $cungR = null;
    public $idThapnhicung = 0;

    public function __construct($cungID)
    {

        $hanhCung = ["None", "Thủy", "Thổ", "Mộc", "Mộc", "Thổ", "Hỏa", "Hỏa", "Thổ", "Kim", "Kim", "Thổ", "Thủy"];
        $this->cungSo = $cungID;
        $this->hanhCung = $hanhCung[$cungID];
        $this->hanhSlug = 'hanh' . ucfirst(khongdau($this->hanhCung));
        $this->cungSao = [];
        $this->cungAmDuong = $this->cungSo % 2 == 0 ? -1 : 1;
        $diaChi = Constants::$diaChi;
        $this->diaChi = $diaChi;
        $this->cungTen = $diaChi[$this->cungSo]['tenChi'];
        $this->cungThan = false;
    }
    public function themSao($sao) {
        $sao = (new Helpers())->dacTinhSao($this->cungSo, $sao);
        $this->cungSao[] = $sao;
    }
    public function cungChu($tenCungChu) {
        $this->cungChu = $tenCungChu;
    }
    public function setcungR($bool) {
        $this->cungR = $bool;
    }

    public function setThapNhiCung($cungId) {
        $this->idThapnhicung = $cungId;
    }

    public function daiHan($daiHan) {
        $this->cungDaiHan = $daiHan;
    }
    public function tieuHan($tieuHan) {
        $this->cungTieuHan = $this->diaChi[$tieuHan + 1]['tenChi'];
    }
    public function anCungThan() {
        $this->cungThan = true;
    }
    public function anTuan() {
        $this->tuanTrung = true;
    }
    public function anTriet() {
        $this->trietLo = true;
    }
}