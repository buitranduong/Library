<?php
/**
 * Created by PhpStorm.
 * User: DUYDUC
 * Date: 16-Oct-18
 * Time: 5:04 PM
 */
namespace Laven;

use Laven\Helpers\Helpers;

class Sao {

    public $saoID;
    public $saoTen;
    public $saoNguHanh;
    public $saoLoai;
    public $saoPhuongVi;
    public $saoAmDuong;
    public $vongTrangSinh;
    public $saoDacTinh;
    public $cssSao;
    public $saoViTriCung;
    public $luanGiai;

    public function __construct($saoID, $saoTen, $saoNguHanh, $saoLoai=2, $saoPhuongVi="", $saoAmDuong="", $vongTrangSinh=0)
    {
        $this->saoID = $saoID;
        $this->saoTen = $saoTen;
        $this->saoNguHanh = $saoNguHanh;
        $this->saoLoai = $saoLoai;
        $this->saoPhuongVi = $saoPhuongVi;
        $this->saoAmDuong = $saoAmDuong;
        $this->vongTrangSinh = $vongTrangSinh;
        $this->cssSao = (new Helpers())->nguHanh($saoNguHanh)['css'];
        $this->saoDacTinh = '';
    }
    function anDacTinh($dacTinh) {
        $dt = [
            "V" => "vuongDia",
            "M" => "mieuDia",
            "Đ" => "dacDia",
            "B" => "binhHoa",
            "H" => "hamDia",
        ];
        $this->saoDacTinh = $dacTinh;
    }
    function anCung($saoViTriCung) {
        /*Summary

            Returns:
                TYPE: Description
        */
        $this->saoViTriCung = $saoViTriCung;
    }

    function amLuanGiai($content) {
    	$this->luanGiai = $content;

    	return $this;
    }
}