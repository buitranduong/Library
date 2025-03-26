<?php
/**
 * Created by PhpStorm.
 * User: DUYDUC
 * Date: 17-Oct-18
 * Time: 9:18 AM
 */

namespace Laven;

use Laven\Helpers\Helpers;
class diaBan {

    public $thapNhiCung;
    public $thangSinhAmLich;
    public $gioSinhAmLich;
    public $cungThan;
    public $cungMenh;
    public $cungNoboc;
    public $cungTatAch;

    public function __construct($thangSinhAmLich, $gioSinhAmLich)
    {
        $this->thangSinhAmLich = $thangSinhAmLich;
        $this->gioSinhAmLich = $gioSinhAmLich;
        for ($i = 0; $i<=12; $i++) {
            $this->thapNhiCung[] = new cungDiaBan($i);
        }
        //$this->thapNhiCung = [cungDiaBan(i) for i in range(13)];
        $this->nhapCungChu();
        $this->nhapCungThan();
    }

    public function cungChu($thangSinhAmLich, $gioSinhAmLich) {
        $helper = new Helpers();
        $this->cungThan = $helper->dichCung(3, [$thangSinhAmLich - 1, $gioSinhAmLich - 1]);
        $this->cungMenh = $helper->dichCung(3, [$thangSinhAmLich - 1, -$gioSinhAmLich + 1]);
        $cungPhuMau = $helper->dichCung($this->cungMenh,[1]);
        $cungPhucDuc = $helper->dichCung($this->cungMenh, [2]);
        $cungDienTrach = $helper->dichCung($this->cungMenh, [3]);
        $cungQuanLoc = $helper->dichCung($this->cungMenh, [4]);
        $this->cungNoboc = $helper->dichCung($this->cungMenh, [5]);  # Để an sao Thiên thương
        $cungThienDi = $helper->dichCung($this->cungMenh, [6]);
        $this->cungTatAch = $helper->dichCung($this->cungMenh, [7]);  # an sao Thiên sứ
        $cungTaiBach = $helper->dichCung($this->cungMenh, [8]);
        $cungTuTuc = $helper->dichCung($this->cungMenh, [9]);
        $cungTheThiep = $helper->dichCung($this->cungMenh, [10]);
        $cungHuynhDe = $helper->dichCung($this->cungMenh, [11]);

        $cungChuThapNhiCung = [
            [
                'cungId' => 1,
                'tenCung' => "Mệnh",
                'cungSoDiaBan' => $this->cungMenh,
                'cungR' => true
            ],
            [
                'cungId' => 2,
                'tenCung' => "Phụ mẫu",
                'cungSoDiaBan' => $cungPhuMau

            ],
            [
                'cungId' => 3,
                'tenCung' => "Phúc đức",
                'cungSoDiaBan' => $cungPhucDuc

            ],
            [
                'cungId' => 4,
                'tenCung' => "Điền trạch",
                'cungSoDiaBan' => $cungDienTrach

            ],
            [
                'cungId' => 5,
                'tenCung' => "Quan lộc",
                'cungSoDiaBan' => $cungQuanLoc,
                'cungR' => true

            ],
            [
                'cungId' => 6,
                'tenCung' => "Nô bộc",
                'cungSoDiaBan' => $this->cungNoboc

            ],
            [
                'cungId' => 7,
                'tenCung' => "Thiên di",
                'cungSoDiaBan' => $cungThienDi,
                'cungR' => true

            ],
            [
                'cungId' => 8,
                'tenCung' => "Tật Ách",
                'cungSoDiaBan' => $this->cungTatAch

            ],
            [
                'cungId' => 9,
                'tenCung' => "Tài Bạch",
                'cungSoDiaBan' => $cungTaiBach,
                'cungR' => true

            ],
            [
                'cungId' => 10,
                'tenCung' => "Tử tức",
                'cungSoDiaBan' => $cungTuTuc

            ],
            [
                'cungId' => 11,
                'tenCung' => "Phu thê",
                'cungSoDiaBan' => $cungTheThiep

            ],
            [
                'cungId' => 12,
                'tenCung' => "Huynh đệ",
                'cungSoDiaBan' => $cungHuynhDe

            ]
        ];

        return $cungChuThapNhiCung;
    }

    public function nhapCungChu() {
        foreach ($this->cungChu($this->thangSinhAmLich, $this->gioSinhAmLich) as $cung) {
            $cungchu = $this->thapNhiCung[$cung['cungSoDiaBan']];
            $cungchu->cungChu($cung['tenCung']);
            $bool = !empty($cung['cungR']) ? true : false;
            $cungchu->setcungR($bool);
            $cungchu->setThapNhiCung($cung['cungId']);

        }
        return $this;
    }
    public function nhapDaiHan($cucSo, $gioiTinh) {
        /*Nhap dai han

                Args:
                    cucSo (TYPE): Description
                    gioiTinh (TYPE): Description

                Returns:
                    TYPE: Description
                */
        foreach ($this->thapNhiCung as $cung) {
            $khoangCach = (new Helpers())->khoangCachCung($cung->cungSo, $this->cungMenh, $gioiTinh);
            $cung->daiHan($cucSo + $khoangCach * 10);
        }
        return $this;
    }
    public function nhapTieuHan($khoiTieuHan, $gioiTinh, $chiNam) {
        $helper = new Helpers();
        # Vị trí khởi tiểu Hạn là của năm sinh theo chi
        # vì vậy cần phải tìm vị trí cung Tý của năm đó
        $viTriCungTy1 = $helper->dichCung($khoiTieuHan, [-$gioiTinh * ($chiNam - 1)]);

        # Tiếp đó là nhập hạn
        foreach ($this->thapNhiCung as $cung) {
            $khoangCach = $helper->khoangCachCung($cung->cungSo, $viTriCungTy1, $gioiTinh);
            $cung->tieuHan($khoangCach);
        }
        return $this;
    }
    public function nhapCungThan() {
        $this->thapNhiCung[$this->cungThan]->anCungThan();
    }
    public function nhapSao($cungSo, $args) {
        $cungSo = $cungSo;
        foreach ($args as $sao) {
            if (!empty($this->thapNhiCung[$cungSo])) {
                $this->thapNhiCung[$cungSo]->themSao($sao);
            }
        }
        return $this;
    }
    public function nhapTuan($args) {
        foreach ($args as $cung) {
            $this->thapNhiCung[$cung]->anTuan();
        }
        return $this;
    }
    public function nhapTriet($args) {
        foreach ($args as $cung) {
            $this->thapNhiCung[$cung]->anTriet();
        }
        return $this;
    }
}