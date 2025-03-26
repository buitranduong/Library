<?php

/**
 * Created by PhpStorm.
 * User: DUYDUC
 * Date: 16-Oct-18
 * Time: 4:53 PM
 */

namespace Laven\Constants;

class Constants {

    public static $ngayInfoArr = [
        'giap-ti' => ["name" => "Giáp Tí", "id" => "2", "hythan" => "Đông Bắc", "id2" => "4", "taithan" => "Đông Nam", "id3" => "4", "hacthan_huonghung" => "Đông Nam", "khongvong_gio_hung" => ["Ngọ", "Hợi"], "giokiet" => ["Tí", "Sửu", "Dần", "Mùi"], "tuoixung" => ["Mậu Ngọ", "Nhâm Ngọ"]],
        'at-suu' => ["name" => "Ất Sửu", "id" => "8", "hythan" => "Tây Bắc", "id2" => "4", "taithan" => "Đông Nam", "id3" => "4", "hacthan_huonghung" => "Đông Nam", "khongvong_gio_hung" => ["Mùi", "Tỵ"], "giokiet" => ["Mão", "Sửu", "Dần", "Thân"], "tuoixung" => ["Kỷ Mùi", "Quý Mùi"]],
        'binh-dan' => ["name" => "Bính Dần", "id" => "6", "hythan" => "Tây Nam", "id2" => "7", "taithan" => "Chính Tây", "id3" => "7", "hacthan_huonghung" => "Chính Tây", "khongvong_gio_hung" => ["Thân", "Hợi"], "giokiet" => ["Tí", "Ngọ", "Mão", "Dậu"], "tuoixung" => ["Canh Thân", "Nhâm Dần"]],
        'dinh-mao' => ["name" => "Đinh Mão", "id" => "5", "hythan" => "Chính Nam", "id2" => "7", "taithan" => "Chính Tây", "id3" => "5", "hacthan_huonghung" => "Chính Nam", "khongvong_gio_hung" => ["Dậu", "Hợi"], "giokiet" => ["Dần", "Mão", "Ngọ", "Mùi"], "tuoixung" => ["Tân Dậu", "Quý Dậu"]],
        'mau-thin' => ["name" => "Mậu Thìn", "id" => "4", "hythan" => "Đông Nam", "id2" => "1", "taithan" => "Chính Bắc", "id3" => "5", "hacthan_huonghung" => "Chính Nam", "khongvong_gio_hung" => ["Tuất", "Hợi"], "giokiet" => ["Sửu", "Mão", "Tỵ", "Thân"], "tuoixung" => ["Nhâm Tuất", "Bính Tuất"]],
        'ky-ty' => ["name" => "Kỷ Tỵ", "id" => "2", "hythan" => "Đông Bắc", "id2" => "1", "taithan" => "Chính Bắc", "id3" => "5", "hacthan_huonghung" => "Chính Nam", "khongvong_gio_hung" => ["Tuất", "Hợi"], "giokiet" => ["Dần", "Ngọ", "Mùi", "Thân"], "tuoixung" => ["Quý Hợi", "Đinh Hợi"]],
        'canh-ngo' => ["name" => "Canh Ngọ", "id" => "8", "hythan" => "Tây Bắc", "id2" => "3", "taithan" => "Chính Đông", "id3" => "5", "hacthan_huonghung" => "Chính Nam", "khongvong_gio_hung" => ["Tí", "Hợi"], "giokiet" => ["Sửu", "Dần", "Ngọ", "Thân"], "tuoixung" => ["Giáp Tí", "Bính Tí"]],
        'tan-mui' => ["name" => "Tân Mùi", "id" => "6", "hythan" => "Tây Nam", "id2" => "3", "taithan" => "Chính Đông", "id3" => "6", "hacthan_huonghung" => "Tây Nam", "khongvong_gio_hung" => ["Sửu", "Hợi"], "giokiet" => ["Dần", "Mão", "Tỵ", "Thân"], "tuoixung" => ["Ất Sửu", "Đinh Sửu"]],
        'nham-than' => ["name" => "Nhâm Thân", "id" => "5", "hythan" => "Chính Nam", "id2" => "5", "taithan" => "Chính Nam", "id3" => "6", "hacthan_huonghung" => "Tây Nam", "khongvong_gio_hung" => ["Dần", "Hợi"], "giokiet" => ["Tí", "Sửu", "Thìn", "Tỵ"], "tuoixung" => ["Bính Dần", "Canh Dần"]],
        'quy-dau' => ["name" => "Quý Dậu", "id" => "4", "hythan" => "Đông Nam", "id2" => "5", "taithan" => "Chính Nam", "id3" => "6", "hacthan_huonghung" => "Tây Nam", "khongvong_gio_hung" => ["Mão", "Hợi"], "giokiet" => ["Dần", "Tỵ", "Ngọ", "Thìn"], "tuoixung" => ["Đinh Mão", "Tân Mão"]],
        'giap-tuat' => ["name" => "Giáp Tuất", "id" => "2", "hythan" => "Đông Bắc", "id2" => "6", "taithan" => "Tây Nam", "id3" => "6", "hacthan_huonghung" => "Tây Nam", "khongvong_gio_hung" => ["Thìn", "Dậu"], "giokiet" => ["Mão", "Sửu", "Tỵ", "Mùi"], "tuoixung" => ["Mậu Thìn", "Canh Thìn"]],
        'at-hoi' => ["name" => "Ất Hợi", "id" => "8", "hythan" => "Tây Bắc", "id2" => "4", "taithan" => "Đông Nam", "id3" => "6", "hacthan_huonghung" => "Tây Nam", "khongvong_gio_hung" => ["Tỵ", "Dậu"], "giokiet" => ["Tí", "Sửu", "Dần", "Mão"], "tuoixung" => ["Kỷ Tỵ", "Tân Tỵ"]],
        'binh-ti' => ["name" => "Bính Tí", "id" => "6", "hythan" => "Tây Nam", "id2" => "7", "taithan" => "Chính Tây", "id3" => "6", "hacthan_huonghung" => "Tây Nam", "khongvong_gio_hung" => ["Ngọ", "Dậu"], "giokiet" => ["Tí", "Sửu", "Tuất", "Hợi"], "tuoixung" => ["Canh Ngọ", "Mậu Ngọ"]],
        'dinh-suu' => ["name" => "Đinh Sửu", "id" => "5", "hythan" => "Chính Nam", "id2" => "7", "taithan" => "Chính Tây", "id3" => "7", "hacthan_huonghung" => "Chính Tây", "khongvong_gio_hung" => ["Thân", "Dậu"], "giokiet" => ["Sửu", "Mão", "Tỵ", "Ngọ"], "tuoixung" => ["Tân Mùi", "Kỷ Mùi"]],
        'mau-dan' => ["name" => "Mậu Dần", "id" => "4", "hythan" => "Đông Nam", "id2" => "1", "taithan" => "Chính Bắc", "id3" => "7", "hacthan_huonghung" => "Chính Tây", "khongvong_gio_hung" => ["Thân", "Dậu"], "giokiet" => ["Sửu", "Thìn", "Tỵ", "Mùi"], "tuoixung" => ["Nhâm Thân", "Giáp Thân"]],
        'ky-mao' => ["name" => "Kỷ Mão", "id" => "2", "hythan" => "Đông Bắc", "id2" => "1", "taithan" => "Chính Bắc", "id3" => "7", "hacthan_huonghung" => "Chính Tây", "khongvong_gio_hung" => ["Thân", "Dậu"], "giokiet" => ["Tí", "Ngọ", "Hợi", "Mùi"], "tuoixung" => ["Quý Dậu", "Ất Dậu"]],
        'canh-thin' => ["name" => "Canh Thìn", "id" => "8", "hythan" => "Tây Bắc", "id2" => "3", "taithan" => "Chính Đông", "id3" => "7", "hacthan_huonghung" => "Chính Tây", "khongvong_gio_hung" => ["Dậu", "Tuất"], "giokiet" => ["Sửu", "Dần", "Thìn", "Ngọ"], "tuoixung" => ["Giáp Tuất", "Mậu Tuất"]],
        'tan-ty' => ["name" => "Tân Tỵ", "id" => "6", "hythan" => "Tây Nam", "id2" => "3", "taithan" => "Chính Đông", "id3" => "7", "hacthan_huonghung" => "Chính Tây", "khongvong_gio_hung" => ["Dậu", "Tuất"], "giokiet" => ["Sửu", "Mão", "Ngọ", "Mùi"], "tuoixung" => ["Ất Hợi", "Kỷ Hợi"]],
        'nham-ngo' => ["name" => "Nhâm Ngọ", "id" => "5", "hythan" => "Chính Nam", "id2" => "5", "taithan" => "Chính Nam", "id3" => "8", "hacthan_huonghung" => "Tây Bắc", "khongvong_gio_hung" => ["Tí", "Dậu"], "giokiet" => ["Sửu", "Mão", "Ngọ", "Mùi"], "tuoixung" => ["Bính Tí", "Canh Tí"]],
        'quy-mui' => ["name" => "Quý Mùi", "id" => "4", "hythan" => "Đông Nam", "id2" => "5", "taithan" => "Chính Nam", "id3" => "8", "hacthan_huonghung" => "Tây Bắc", "khongvong_gio_hung" => ["Sửu", "Dậu"], "giokiet" => ["Dần", "Mão", "Thìn", "Tỵ"], "tuoixung" => ["Đinh Sửu", "Tân Sửu"]],
        'giap-than' => ["name" => "Giáp Thân", "id" => "2", "hythan" => "Đông Bắc", "id2" => "4", "taithan" => "Đông Nam", "id3" => "8", "hacthan_huonghung" => "Tây Bắc", "khongvong_gio_hung" => ["Dần", "Mùi"], "giokiet" => ["Tí", "Sửu", "Thìn", "Tỵ"], "tuoixung" => ["Mậu ngọ", "Bính Dần"]],
        'at-dau' => ["name" => "Ất Dậu", "id" => "8", "hythan" => "Tây Bắc", "id2" => "4", "taithan" => "Đông Nam", "id3" => "8", "hacthan_huonghung" => "Tây Bắc", "khongvong_gio_hung" => ["Mão", "Mùi"], "giokiet" => ["Tí", "Sửu", "Dần", "Dậu"], "tuoixung" => ["Kỷ Mão", "Đinh Mão"]],
        'binh-tuat' => ["name" => "Bính Tuất", "id" => "6", "hythan" => "Tây Nam", "id2" => "7", "taithan" => "Chính Tây", "id3" => "8", "hacthan_huonghung" => "Tây Bắc", "khongvong_gio_hung" => ["Thìn", "Mùi"], "giokiet" => ["Tí", "Sửu", "Thìn", "Tỵ"], "tuoixung" => ["Canh Thìn", "Nhâm Thìn"]],
        'dinh-hoi' => ["name" => "Đinh Hợi", "id" => "5", "hythan" => "Chính Nam", "id2" => "7", "taithan" => "Chính Tây", "id3" => "8", "hacthan_huonghung" => "Tây Bắc", "khongvong_gio_hung" => ["Tỵ", "Mùi"], "giokiet" => ["Sửu", "Thìn", "Dậu", "Tuất"], "tuoixung" => ["Tân Tỵ", "Quý Tỵ"]],
        'mau-ti' => ["name" => "Mậu Tí", "id" => "5", "hythan" => "Chính Nam", "id2" => "1", "taithan" => "Chính Bắc", "id3" => "1", "hacthan_huonghung" => "Chính Bắc", "khongvong_gio_hung" => ["Ngọ", "Mùi"], "giokiet" => ["Sửu", "Mão", "Tỵ", "Thân"], "tuoixung" => ["Nhâm Ngọ", "Mậu ngọ"]],
        'ky-suu' => ["name" => "Kỷ Sửu", "id" => "2", "hythan" => "Đông Bắc", "id2" => "1", "taithan" => "Chính Bắc", "id3" => "1", "hacthan_huonghung" => "Chính Bắc", "khongvong_gio_hung" => ["Ngọ", "Mùi"], "giokiet" => ["Tí", "Sửu", "Dần", "Tỵ"], "tuoixung" => ["Quý Mùi", "Ất Mùi"]],
        'canh-dan' => ["name" => "Canh Dần", "id" => "8", "hythan" => "Tây Bắc", "id2" => "3", "taithan" => "Chính Đông", "id3" => "1", "hacthan_huonghung" => "Chính Bắc", "khongvong_gio_hung" => ["Mùi", "Thân"], "giokiet" => ["Tí", "Sửu", "Thìn", "Tỵ"], "tuoixung" => ["Giáp Thân", "Mậu Thân"]],
        'tan-mao' => ["name" => "Tân Mão", "id" => "6", "hythan" => "Tây Nam", "id2" => "3", "taithan" => "Chính Đông", "id3" => "1", "hacthan_huonghung" => "Chính Bắc", "khongvong_gio_hung" => ["Mùi", "Dậu"], "giokiet" => ["Tí", "Dần", "Mão", "Tỵ"], "tuoixung" => ["Ất Dậu", "Kỷ Dậu"]],
        'nham-thin' => ["name" => "Nhâm Thìn", "id" => "5", "hythan" => "Chính Nam", "id2" => "5", "taithan" => "Chính Nam", "id3" => "1", "hacthan_huonghung" => "Chính Bắc", "khongvong_gio_hung" => ["Mùi", "Tuất"], "giokiet" => ["Sửu", "Dần", "Thìn", "Tỵ"], "tuoixung" => ["Bính Tuất", "Giáp Tuất"]],
        'quy-ty' => ["name" => "Quý Tỵ", "id" => "4", "hythan" => "Đông Nam", "id2" => "5", "taithan" => "Chính Nam", "id3" => "0", "hacthan_huonghung" => "Tại Thiên", "khongvong_gio_hung" => ["Mùi", "Hợi"], "giokiet" => ["Sửu", "Mão", "Thìn", "Tỵ"], "tuoixung" => ["Đinh Hợi", "Ất Hợi"]],
        'giap-ngo' => ["name" => "Giáp Ngọ", "id" => "2", "hythan" => "Đông Bắc", "id2" => "4", "taithan" => "Đông Nam", "id3" => "0", "hacthan_huonghung" => "Tại Thiên", "khongvong_gio_hung" => ["Tí", "Thìn"], "giokiet" => ["Dần", "Mão", "Ngọ", "Mùi"], "tuoixung" => ["Mậu Tí", "Nhâm Tí"]],
        'at-mui' => ["name" => "Ất Mùi", "id" => "8", "hythan" => "Tây Bắc", "id2" => "4", "taithan" => "Đông Nam", "id3" => "0", "hacthan_huonghung" => "Tại Thiên", "khongvong_gio_hung" => ["Sửu", "Thìn"], "giokiet" => ["Dần", "Mão", "Ngọ", "Thân"], "tuoixung" => ["Kỷ Sửu", "Quý Sửu"]],
        'binh-than' => ["name" => "Bính Thân", "id" => "6", "hythan" => "Tây Nam", "id2" => "7", "taithan" => "Chính Tây", "id3" => "0", "hacthan_huonghung" => "Tại Thiên", "khongvong_gio_hung" => ["Dần", "Thìn"], "giokiet" => ["Tí", "Sửu", "Dần", "Ngọ"], "tuoixung" => ["Canh Dần", "Nhâm Dần"]],
        'dinh-dau' => ["name" => "Đinh Dậu", "id" => "5", "hythan" => "Chính Nam", "id2" => "7", "taithan" => "Chính Tây", "id3" => "0", "hacthan_huonghung" => "Tại Thiên", "khongvong_gio_hung" => ["Mão", "Thìn"], "giokiet" => ["Tí", "Sửu", "Dần", "Ngọ"], "tuoixung" => ["Tân Mão", "Quý Mão"]],
        'mau-tuat' => ["name" => "Mậu Tuất", "id" => "4", "hythan" => "Đông Nam", "id2" => "1", "taithan" => "Chính Bắc", "id3" => "0", "hacthan_huonghung" => "Tại Thiên", "khongvong_gio_hung" => ["Thìn", "Tỵ"], "giokiet" => ["Dần", "Mão", "Mùi", "Thân"], "tuoixung" => ["Nhâm Thìn", "Bính Thìn"]],
        'ky-hoi' => ["name" => "Kỷ Hợi", "id" => "2", "hythan" => "Đông Bắc", "id2" => "1", "taithan" => "Chính Bắc", "id3" => "0", "hacthan_huonghung" => "Tại Thiên", "khongvong_gio_hung" => ["Tỵ", "Hợi"], "giokiet" => ["Tí", "Sửu", "Dần", "Ngọ"], "tuoixung" => ["Quý Tỵ", "Đinh Tỵ"]],
        'canh-ti' => ["name" => "Canh Tí", "id" => "8", "hythan" => "Tây Bắc", "id2" => "3", "taithan" => "Chính Đông", "id3" => "0", "hacthan_huonghung" => "Tại Thiên", "khongvong_gio_hung" => ["Thìn", "Ngọ"], "giokiet" => ["Tí", "Sửu", "Mão", "Thân"], "tuoixung" => ["Giáp Ngọ", "Bính Ngọ"]],
        'tan-suu' => ["name" => "Tân Sửu", "id" => "6", "hythan" => "Tây Nam", "id2" => "3", "taithan" => "Chính Đông", "id3" => "0", "hacthan_huonghung" => "Tại Thiên", "khongvong_gio_hung" => ["Thìn", "Mùi"], "giokiet" => ["Dần", "Mão", "Thân", "Hợi"], "tuoixung" => ["Ất Mùi", "Đinh Mùi"]],
        'nham-dan' => ["name" => "Nhâm Dần", "id" => "5", "hythan" => "Chính Nam", "id2" => "5", "taithan" => "Chính Nam", "id3" => "0", "hacthan_huonghung" => "Tại Thiên", "khongvong_gio_hung" => ["Thìn", "Thân"], "giokiet" => ["Tí", "Sửu", "Ngọ", "Mùi"], "tuoixung" => ["Canh Thân", "Bính Thân"]],
        'quy-mao' => ["name" => "Quý Mão", "id" => "4", "hythan" => "Đông Nam", "id2" => "5", "taithan" => "Chính Nam", "id3" => "0", "hacthan_huonghung" => "Tại Thiên", "khongvong_gio_hung" => ["Thìn", "Dậu"], "giokiet" => ["Dần", "Mão", "Tỵ", "Ngọ"], "tuoixung" => ["Tân Dậu", "Đinh Dậu"]],
        'giap-thin' => ["name" => "Giáp Thìn", "id" => "2", "hythan" => "Đông Bắc", "id2" => "4", "taithan" => "Đông Nam", "id3" => "0", "hacthan_huonghung" => "Tại Thiên", "khongvong_gio_hung" => ["Dần", "Tuất"], "giokiet" => ["Tí", "Sửu", "Ngọ", "Thân"], "tuoixung" => ["Mậu Tuất", "Canh Tuất"]],
        'at-ty' => ["name" => "Ất Tỵ", "id" => "8", "hythan" => "Tây Bắc", "id2" => "4", "taithan" => "Đông Nam", "id3" => "0", "hacthan_huonghung" => "Tại Thiên", "khongvong_gio_hung" => ["Dần", "Hợi"], "giokiet" => ["Tí", "Sửu", "Thân", "Tuất"], "tuoixung" => ["Kỷ Hợi", "Tân Hợi"]],
        'binh-ngo' => ["name" => "Bính Ngọ", "id" => "6", "hythan" => "Tây Nam", "id2" => "7", "taithan" => "Chính Tây", "id3" => "0", "hacthan_huonghung" => "Tại Thiên", "khongvong_gio_hung" => ["Tí", "Dần"], "giokiet" => ["Sửu", "Ngọ", "Thân", "Dậu"], "tuoixung" => ["Mậu Tí", "Canh Tí"]],
        'dinh-mui' => ["name" => "Đinh Mùi", "id" => "5", "hythan" => "Chính Nam", "id2" => "7", "taithan" => "Chính Tây", "id3" => "0", "hacthan_huonghung" => "Tại Thiên", "khongvong_gio_hung" => ["Sửu", "Dần"], "giokiet" => ["Tỵ", "Ngọ", "Thân", "Dậu"], "tuoixung" => ["Kỷ Sửu", "Tân Sửu"]],
        'mau-than' => ["name" => "Mậu Thân", "id" => "4", "hythan" => "Đông Nam", "id2" => "1", "taithan" => "Chính Bắc", "id3" => "0", "hacthan_huonghung" => "Tại Thiên", "khongvong_gio_hung" => ["Dần", "Mão"], "giokiet" => ["Tí", "Sửu", "Thìn", "Tỵ"], "tuoixung" => ["Nhâm Dần", "Giáp Dần"]],
        'ky-dau' => ["name" => "Kỷ Dậu", "id" => "2", "hythan" => "Đông Bắc", "id2" => "1", "taithan" => "Chính Bắc", "id3" => "2", "hacthan_huonghung" => "Đông Bắc", "khongvong_gio_hung" => ["Dần", "Mão"], "giokiet" => ["Tí", "Ngọ", "Mùi", "Thân"], "tuoixung" => ["Quý Mão", "Ất Mão"]],
        'canh-tuat' => ["name" => "Canh Tuất", "id" => "8", "hythan" => "Tây Bắc", "id2" => "3", "taithan" => "Chính Đông", "id3" => "2", "hacthan_huonghung" => "Đông Bắc", "khongvong_gio_hung" => ["Dần", "Thìn"], "giokiet" => ["Sửu", "Tỵ", "Ngọ", "Thân"], "tuoixung" => ["Giáp Thìn", "Mậu Thìn"]],
        'tan-hoi' => ["name" => "Tân Hợi", "id" => "6", "hythan" => "Tây Nam", "id2" => "3", "taithan" => "Chính Đông", "id3" => "2", "hacthan_huonghung" => "Đông Bắc", "khongvong_gio_hung" => ["Mão", "Tỵ"], "giokiet" => ["Sửu", "Ngọ", "Mùi", "Thân"], "tuoixung" => ["Ất Tỵ", "Kỷ Tỵ"]],
        'nham-ti' => ["name" => "Nhâm Tí", "id" => "5", "hythan" => "Chính Nam", "id2" => "5", "taithan" => "Chính Nam", "id3" => "2", "hacthan_huonghung" => "Đông Bắc", "khongvong_gio_hung" => ["Dần", "Ngọ"], "giokiet" => ["Tí", "Sửu", "Ngọ", "Mùi"], "tuoixung" => ["Bính Ngọ", "Canh Ngọ"]],
        'quy-suu' => ["name" => "Quý Sửu", "id" => "4", "hythan" => "Đông Nam", "id2" => "5", "taithan" => "Chính Nam", "id3" => "2", "hacthan_huonghung" => "Đông Bắc", "khongvong_gio_hung" => ["Dần", "Mùi"], "giokiet" => ["Tí", "Sửu", "Thìn", "Tỵ"], "tuoixung" => ["Đinh Mùi", "Tân Mùi"]],
        'giap-dan' => ["name" => "Giáp Dần", "id" => "2", "hythan" => "Đông Bắc", "id2" => "4", "taithan" => "Đông Nam", "id3" => "2", "hacthan_huonghung" => "Đông Bắc", "khongvong_gio_hung" => ["Tí", "Thân"], "giokiet" => ["Sửu", "Dần", "Mùi", "Tuất"], "tuoixung" => ["Mậu Thân", "Bính Thân"]],
        'at-mao' => ["name" => "Ất Mão", "id" => "8", "hythan" => "Tây Bắc", "id2" => "4", "taithan" => "Đông Nam", "id3" => "3", "hacthan_huonghung" => "Chính Đông", "khongvong_gio_hung" => ["Tỵ", "Dậu"], "giokiet" => ["Tí", "Ngọ", "Mão", "Thân"], "tuoixung" => ["Kỷ Dậu", "Đinh Dậu"]],
        'binh-thin' => ["name" => "Bính Thìn", "id" => "6", "hythan" => "Tây Nam", "id2" => "7", "taithan" => "Chính Tây", "id3" => "3", "hacthan_huonghung" => "Chính Đông", "khongvong_gio_hung" => ["Tí", "Tuất"], "giokiet" => ["Tí", "Dần", "Thân", "Dậu"], "tuoixung" => ["Canh Tuất", "Nhâm Tuất"]],
        'dinh-ty' => ["name" => "Đinh Tỵ", "id" => "5", "hythan" => "Chính Nam", "id2" => "7", "taithan" => "Chính Tây", "id3" => "3", "hacthan_huonghung" => "Chính Đông", "khongvong_gio_hung" => ["Dậu", "Hợi"], "giokiet" => ["Thìn", "Tỵ", "Ngọ", "Mùi"], "tuoixung" => ["Tân Hợi", "Quý Hợi"]],
        'mau-ngo' => ["name" => "Mậu Ngọ", "id" => "4", "hythan" => "Đông Nam", "id2" => "1", "taithan" => "Chính Bắc", "id3" => "3", "hacthan_huonghung" => "Chính Đông", "khongvong_gio_hung" => ["Tí", "Sửu"], "giokiet" => ["Mão", "Ngọ", "Mùi", "Thân"], "tuoixung" => ["Nhâm Tí", "Giáp Tí"]],
        'ky-mui' => ["name" => "Kỷ Mùi", "id" => "2", "hythan" => "Đông Bắc", "id2" => "1", "taithan" => "Chính Bắc", "id3" => "3", "hacthan_huonghung" => "Chính Đông", "khongvong_gio_hung" => ["Tí", "Sửu"], "giokiet" => ["Dần", "Mão", "Tỵ", "Ngọ"], "tuoixung" => ["Quý Sửu", "Ất Sửu"]],
        'canh-than' => ["name" => "Canh Thân", "id" => "2", "hythan" => "Đông Bắc", "id2" => "3", "taithan" => "Chính Đông", "id3" => "4", "hacthan_huonghung" => "Đông Nam", "khongvong_gio_hung" => ["Tí", "Dần"], "giokiet" => ["Thìn", "Tỵ", "Mùi", "Thân"], "tuoixung" => ["Giáp Dần", "Mậu Dần"]],
        'tan-dau' => ["name" => "Tân Dậu", "id" => "6", "hythan" => "Tây Nam", "id2" => "3", "taithan" => "Chính Đông", "id3" => "4", "hacthan_huonghung" => "Đông Nam", "khongvong_gio_hung" => ["Tí", "Mão"], "giokiet" => ["Dần", "Tỵ", "Ngọ", "Mùi"], "tuoixung" => ["Ất Mão", "Kỹ Mão"]],
        'nham-tuat' => ["name" => "Nhâm Tuất", "id" => "5", "hythan" => "Chính Nam", "id2" => "5", "taithan" => "Chính Nam", "id3" => "4", "hacthan_huonghung" => "Đông Nam", "khongvong_gio_hung" => ["Tí", "Thìn"], "giokiet" => ["Tỵ", "Ngọ", "Mùi", "Thân"], "tuoixung" => ["Bính Thìn", "Giáp Thìn"]],
        'quy-hoi' => ["name" => "Quý Hợi", "id" => "4", "hythan" => "Đông Nam", "id2" => "5", "taithan" => "Chính Nam", "id3" => "4", "hacthan_huonghung" => "Đông Nam", "khongvong_gio_hung" => ["Tí", "Tỵ"], "giokiet" => ["Mão", "Thìn", "Ngọ", "Mùi"], "tuoixung" => ["Đinh Tỵ", "Ất Tỵ"]]
    ];
    public static $chiArr = array('Tí', 'Sửu', 'Dần', 'Mão', 'Thìn', 'Tỵ', 'Ngọ', 'Mùi', 'Thân', 'Dậu', 'Tuất', 'Hợi',);
    public static $ngayXuatHanh = [
        ['name' => 'Hảo Thương', 'thang' => [1, 4, 7, 10], 'stt' => 'Tốt', 'ngay' => [6, 12, 18, 24, 30], 'ynghia' => 'Xuất hành thuận lợi, gặp người lớn vừa lòng, làm việc việc như ý muốn, áo phẩm vinh quy.'],
        ['name' => 'Đạo Tặc', 'thang' => [1, 4, 7, 10], 'stt' => 'Xấu', 'ngay' => [5, 11, 17, 23, 29], 'ynghia' => 'Rất xấu. Xuất hành bị hại, mất của.'],
        ['name' => 'Thuần Dương', 'thang' => [1, 4, 7, 10], 'stt' => 'Tốt', 'ngay' => [4, 10, 16, 22, 28], 'ynghia' => 'Xuất hành tốt, lúc về cũng tốt, nhiều thuận lợi, được người tốt giúp đỡ, cầu tài được như ý muốn, tranh luận thường thắng lợi.'],
        ['name' => 'Đường Phong', 'thang' => [1, 4, 7, 10], 'stt' => 'Tốt', 'ngay' => [1, 7, 13, 19, 25], 'ynghia' => 'Rất tốt, xuất hành thuận lợi, cầu tài được như ý muốn, gặp quý nhân phù trợ.'],
        ['name' => 'Kim Thổ', 'thang' => [1, 4, 7, 10], 'stt' => 'Xấu', 'ngay' => [2, 8, 14, 20, 26], 'ynghia' => 'Ra đi nhỡ tàu, nhỡ xe, cầu tài không được, trên đường đi mất của, bất lợi.'],
        ['name' => 'Kim Dương', 'thang' => [1, 4, 7, 10], 'stt' => 'Tốt', 'ngay' => [3, 9, 15, 21, 27], 'ynghia' => 'Xuất hành tốt, có quý nhân phù trợ, tài lộc thông suốt, thưa kiện có nhiều lý phải'],
        ['name' => 'Thiên Đạo', 'thang' => [2, 5, 8, 11], 'stt' => 'Xấu', 'ngay' => [1, 9, 17, 25], 'ynghia' => 'Xuất hành cầu tài nên tránh, dù được cũng rất tốn kém, thất lý mà thua.'],
        ['name' => 'Thiên Thương', 'thang' => [2, 5, 8, 11], 'stt' => 'Tốt', 'ngay' => [8, 16, 24, 30], 'ynghia' => 'Xuất hành để gặp cấp trên thì tuyệt vời, cầu tài thì được tài. Mọi việc đều thuận lợi.'],
        ['name' => 'Thiên Hầu', 'thang' => [2, 5, 8, 11], 'stt' => 'Xấu', 'ngay' => [7, 15, 23], 'ynghia' => 'Xuất hành dầu ít hay nhiều cũng cãi cọ, phải tránh xẩy ra tai nạn chảy máu, máu sẽ khó cầm.'],
        ['name' => 'Thiên Dương', 'thang' => [2, 5, 8, 11], 'stt' => 'Tốt', 'ngay' => [6, 14, 22], 'ynghia' => 'Xuất hành tốt, cầu tài được tài. Hỏi vợ được vợ. Mọi việc đều như ý muốn.'],
        ['name' => 'Thiên Môn', 'thang' => [2, 5, 8, 11], 'stt' => 'Tốt', 'ngay' => [2, 10, 18, 26], 'ynghia' => 'Xuất hành làm mọi việc đều vừa ý, cầu được ước thấy mọi việc đều thành đạt.'],
        ['name' => 'Thiên Đường', 'thang' => [2, 5, 8, 11], 'stt' => 'Tốt', 'ngay' => [3, 11, 19, 27], 'ynghia' => 'Xuất hành tốt, quý nhân phù trợ, buôn bán may mắn, mọi việc đều như ý.'],
        ['name' => 'Thiên Tài', 'thang' => [2, 5, 8, 11], 'stt' => 'Tốt', 'ngay' => [4, 12, 20, 28], 'ynghia' => 'Nên xuất hành, cầu tài thắng lợi. Được người tốt giúp đỡ. Mọi việc đều thuận.'],
        ['name' => 'Thiên Tặc', 'thang' => [2, 5, 8, 11], 'stt' => 'Xấu', 'ngay' => [5, 13, 21, 29], 'ynghia' => 'Xuất hành xấu, cầu tài không được. Đi đường dễ mất cắp. Mọi việc đều rất xấu.'],
        ['name' => 'Bạch Hổ Đầu', 'thang' => [3, 6, 9, 12], 'stt' => 'Tốt', 'ngay' => [2, 10, 18, 26], 'ynghia' => 'Xuất hành, cầu tài đều được. Đi đâu đều thông đạt cả.'],
        ['name' => 'Bạch Hổ Kiếp', 'thang' => [3, 6, 9, 12], 'stt' => 'Tốt', 'ngay' => [3, 11, 19, 27], 'ynghia' => 'Xuất hành, cầu tài được như ý muốn, đi hướng Nam và Bắc rất thuận lợi.'],
        ['name' => 'Bạch Hổ Túc', 'thang' => [3, 6, 9, 12], 'stt' => 'Xấu', 'ngay' => [4, 12, 20, 28], 'ynghia' => 'Đi xa không nên, xuất hành xấu, tài lộc không có. Kiện cáo cũng đuối lý.'],
        ['name' => 'Huyền Vũ', 'thang' => [3, 6, 9, 12], 'stt' => 'Xấu', 'ngay' => [5, 13, 21, 29], 'ynghia' => 'Xuất hành thường gặp cãi cọ, gặp việc xấu, không nên đi.'],
        ['name' => 'Chu Tước', 'thang' => [3, 6, 9, 12], 'stt' => 'Xấu', 'ngay' => [1, 9, 17], 'ynghia' => 'Xuất hành, cầu tài đều xấu. Hay mất của, kiện cáo thua vì đuối lý.'],
        ['name' => 'Thanh Long Túc', 'thang' => [3, 6, 9, 12], 'stt' => 'Xấu', 'ngay' => [8, 16, 24, 30], 'ynghia' => 'Đi xa không nên, xuất hành xấu, tài lộc không có. Kiện cáo cũng đuối lý.'],
        ['name' => 'Thanh Long Kiếp', 'thang' => [3, 6, 9, 12], 'stt' => 'Tốt', 'ngay' => [7, 15, 25, 23], 'ynghia' => 'Xuất hành 4 phương, 8 hướng đều tốt, trăm sự được như ý.'],
        ['name' => 'Thanh Long Đầu', 'thang' => [3, 6, 9, 12], 'stt' => 'Tốt', 'ngay' => [6, 14, 22], 'ynghia' => 'Xuất hành nên đi vào sáng sớm. Cỗu tài thắng lợi. Mọi việc như ý.'],
    ];
    public static $ngayHoangDao = [
        1 => ['Tí', 'Sửu', 'Tỵ', 'Mùi'],
        2 => ['Dần', 'Mão', 'Mùi', 'Dậu'],
        3 => ['Thìn', 'Tỵ', 'Dậu', 'Hợi'],
        4 => ['Ngọ', 'Mùi', 'Hợi', 'Sửu'],
        5 => ['Thân', 'Dậu', 'Sửu', 'Mão'],
        6 => ['Tuất', 'Hợi', 'Mão', 'Tỵ'],
        7 => ['Tí', 'Sửu', 'Tỵ', 'Mùi'],
        8 => ['Dần', 'Mão', 'Mùi', 'Dậu'],
        9 => ['Thìn', 'Tỵ', 'Dậu', 'Hợi'],
        10 => ['Ngọ', 'Mùi', 'Hợi', 'Sửu'],
        11 => ['Thân', 'Dậu', 'Dần', 'Mão'],
        12 => ['Tuất', 'Hợi', 'Mão', 'Tỵ']
    ];
    public static $ngayHacDao = [
        1 => ['Ngọ', 'Mão', 'Hợi', 'Dậu'],
        2 => ['Thân', 'Tỵ', 'Hợi', 'Sửu'],
        3 => ['Tuất', 'Mùi', 'Mão', 'Sửu'],
        4 => ['Tỵ', 'Dậu', 'Mão', 'Tỵ'],
        5 => ['Dần', 'Hợi', 'Mùi', 'Tỵ'],
        6 => ['Thìn', 'Sửu', 'Mùi', 'Dậu'],
        7 => ['Ngọ', 'Mão', 'Hợi', 'Dậu'],
        8 => ['Thân', 'Tỵ', 'Hợi', 'Sửu'],
        9 => ['Tuất', 'Mùi', 'Mão', 'Sửu'],
        10 => ['Tí', 'Dậu', 'Mão', 'Tỵ'],
        11 => ['Dần', 'Hợi', 'Mùi', 'Tỵ'],
        12 => ['Thìn', 'Sửu', 'Mùi', 'Dậu'],
    ];
    public static $canchi = [
        0 => ['can' => 'Giáp', 'chi' => 'Tí', 'gio' => '23h-1h', 'mod' => -1],
        1 => ['can' => 'Ất', 'chi' => 'Sửu', 'gio' => '1h-3h', 'mod' => 0],
        2 => ['can' => 'Bính', 'chi' => 'Dần', 'gio' => '3h-5h', 'mod' => 1],
        3 => ['can' => 'Đinh', 'chi' => 'Mão', 'gio' => '5h-7h', 'mod' => 2],
        4 => ['can' => 'Mậu', 'chi' => 'Thìn', 'gio' => '7h-9h', 'mod' => 3],
        5 => ['can' => 'Kỷ', 'chi' => 'Tỵ', 'gio' => '9h-11h', 'mod' => 4],
        6 => ['can' => 'Canh', 'chi' => 'Ngọ', 'gio' => '11h-13h', 'mod' => 5],
        7 => ['can' => 'Tân', 'chi' => 'Mùi', 'gio' => '13h-15h', 'mod' => 6],
        8 => ['can' => 'Nhâm', 'chi' => 'Thân', 'gio' => '15h-17h', 'mod' => 7],
        9 => ['can' => 'Quý', 'chi' => 'Dậu', 'gio' => '17h-19h', 'mod' => 8],
        10 => ['can' => '', 'chi' => 'Tuất', 'gio' => '19h-21h', 'mod' => 9],
        11 => ['can' => '', 'chi' => 'Hợi', 'gio' => '21h-23h', 'mod' => 10],
    ];
	public static $menh = [
		1 => ['can' => 'Giáp', 'chi' => 'Tí', 'ten' => 'Giáp Tí', 'menh' => 'Kim', 'diengiai' => 'Hải Trung Kim (Vàng trong biển)',
			'ynghia' => ' Ngày Giáp Tý - Ất Sửu: Các vị thần đều hạ phàm nếu gia chủ làm cỗ chay lễ Phật, cầu Thần, cầu tự, cầu phúc thì sẽ nhận được nhiều phúc lộc.',
		],
		2 => ['can' => 'Ất',
			'chi' => 'Sửu',
			'ten' => 'Ất Sửu',
			'menh' => 'Kim',
			'diengiai' => 'Hải Trung Kim (Vàng trong biển)',
			'ynghia' => ' Ngày Giáp Tý - Ất Sửu: Các vị thần đều hạ phàm nếu gia chủ làm cỗ chay lễ Phật, cầu Thần, cầu tự, cầu phúc thì sẽ nhận được nhiều phúc lộc.'],
		3 => ['can' => 'Bính',
			'chi' => 'Dần',
			'ten' => 'Bính Dần',
			'menh' => 'Hỏa',
			'diengiai' => 'Lư Trung Hỏa (Lửa trong lò)',
			'ynghia' => 'Ngày Bính Dần: Nhật như tại Thiên (Thần ở trên trời) nếu vào ngày này gia chủ làm lễ bái cầu phúc, tế tự thấn núi sông, chiêu hồn, thay mệnh thì dễ gặp tai họa không nên thực hiện.'],
		4 => ['can' => 'Đinh',
			'chi' => 'Mão',
			'ten' => 'Đinh Mão',
			'menh' => 'Hỏa',
			'diengiai' => 'Lư Trung Hỏa (Lửa trong lò)',
			'ynghia' => 'Ngày Đinh Mão, Mậu Thìn, Kỷ Tỵ: Bách thần ở dưới trần gian ba ngày này. Nên sẽ rất tốt nếu gia chủ làm lễ bái, thượng biểu (dâng sớ), tế tự, chiêu hồn, bái mệnh, lập đàn, làm chay cầu con cái. Tất cả mọi việc đều thuận lợi, hanh thông như mong muốn.'],
		5 => ['can' => 'Mậu',
			'chi' => 'Thìn',
			'ten' => 'Mậu Thìn',
			'menh' => 'Mộc',
			'diengiai' => 'Đại Lâm Mộc (Gỗ rừng già)',
			'ynghia' => 'Ngày Đinh Mão, Mậu Thìn, Kỷ Tỵ: Bách thần ở dưới trần gian ba ngày này. Nên sẽ rất tốt nếu gia chủ làm lễ bái, thượng biểu (dâng sớ), tế tự, chiêu hồn, bái mệnh, lập đàn, làm chay cầu con cái. Tất cả mọi việc đều thuận lợi, hanh thông như mong muốn.'],
		6 => ['can' => 'Kỷ',
			'chi' => 'Tỵ',
			'ten' => 'Kỷ tỵ',
			'menh' => 'Mộc',
			'diengiai' => 'Đại Lâm Mộc (Gỗ rừng già)',
			'ynghia' => 'Ngày Đinh Mão, Mậu Thìn, Kỷ Tỵ: Bách thần ở dưới trần gian ba ngày này. Nên sẽ rất tốt nếu gia chủ làm lễ bái, thượng biểu (dâng sớ), tế tự, chiêu hồn, bái mệnh, lập đàn, làm chay cầu con cái. Tất cả mọi việc đều thuận lợi, hanh thông như mong muốn.'],
		7 => ['can' => 'Canh',
			'chi' => 'Ngọ',
			'ten' => 'Canh ngọ',
			'menh' => 'Thổ',
			'diengiai' => 'Lộ Bàng Thổ (Đất đường đi)',
			'ynghia' => ' Ngày Canh Ngọ, Tân Mùi: Chư thần trong khoảng thời gian 2 ngày này đều ở trên trời. Gia chủ không nên tế tự, lễ bài vì thần linh không thể chứng giám.'],
		8 => ['can' => 'Tân',
			'chi' => 'Mùi',
			'ten' => 'Tân Mùi',
			'menh' => 'Thổ',
			'diengiai' => 'Lộ Bàng Thổ (Đất đường đi)',
			'ynghia' => ' Ngày Canh Ngọ, Tân Mùi: Chư thần trong khoảng thời gian 2 ngày này đều ở trên trời. Gia chủ không nên tế tự, lễ bài vì thần linh không thể chứng giám.'],
		9 => ['can' => 'Nhâm',
			'chi' => 'Thân',
			'ten' => 'Nhâm thân',
			'menh' => 'Kim',
			'diengiai' => 'Kiếm Phong Kim (Vàng mũi kiếm)',
			'ynghia' => ' Ngày Nhâm Thân: Mọi thần linh lúc này đang ở trên trời đều xuống  địa phủ, vậy nên gia chủ có thể tế tự, cầu phúc, thượng biểu (dâng sớ), bái chương (dâng lên) lễ chay để cầu trai, xin gái, cầu may mắn đều sẽ thành hiện thực.'],
		10 => ['can' => 'Quý',
			'chi' => 'Dậu',
			'ten' => 'Quý Dậu',
			'menh' => 'Kim',
			'diengiai' => 'Kiếm Phong Kim (Vàng mũi kiếm)',
			'ynghia' => ' Ngày Quý Dậu: Gia chủ chỉ nên thực hiện thờ cúng, tế lễ Chấn Hà Bá, thủy quan thì sẽ mang lại may mắn, cát lành. Còn các lễ bái khác đều xấu, không mang lại hiệu quả như mong muốn.'],
		11 => ['can' => 'Giáp',
			'chi' => 'Tuất',
			'ten' => 'Giáp tuất',
			'menh' => 'Hỏa',
			'diengiai' => 'Sơn Đầu Hỏa (Lửa trên núi)',
			'ynghia' => 'Ngày Giáp Tuất, Ất Hợi: Các thần ở trên trời không ở nhân gian, địa phủ, vì vậy chỉ nên làm những lễ bái nhỏ như lễ cầu an. Thực hiện buổi lễ vào giờ Thìn là tốt nhất, còn lại các giờ khác đều xấu không nên thực hiện.'],
		12 => ['can' => 'Ất',
			'chi' => 'Hợi',
			'ten' => 'Ất hợi',
			'menh' => 'Hỏa',
			'diengiai' => 'Sơn Đầu Hỏa (Lửa trên núi)',
			'ynghia' => 'Ngày Giáp Tuất, Ất Hợi: Các thần ở trên trời không ở nhân gian, địa phủ, vì vậy chỉ nên làm những lễ bái nhỏ như lễ cầu an. Thực hiện buổi lễ vào giờ Thìn là tốt nhất, còn lại các giờ khác đều xấu không nên thực hiện.'],
		13 => ['can' => 'Bính',
			'chi' => 'Tí',
			'ten' => 'Bính Tí',
			'menh' => 'Thủy',
			'diengiai' => 'Giảm Hạ Thủy (Nước cuối khe)',
			'ynghia' => 'Ngày Bính Tý, Đinh Sửu, Mậu Dần: Ba ngày rất xấu không nên tế lễ vì chư Thần phá Thiên Tào vận của Ngọc Hoàng Tây - hà bái Liễu Thạch - Sao Trực ngạn cho nên gia chủ lễ bái cầu phúc vào các ngày này sẽ khiến rước tai họa vào người, hao tốn tiền bạc.'],
		14 => ['can' => 'Đinh', 'chi' => 'Sửu', 'ten' => 'Đinh Sửu', 'menh' => 'Thủy', 'diengiai' => 'Giảm Hạ Thủy (Nước cuối khe)',
			'ynghia' => 'Ngày Bính Tý, Đinh Sửu, Mậu Dần: Ba ngày rất xấu không nên tế lễ vì chư Thần phá Thiên Tào vận của Ngọc Hoàng Tây - hà bái Liễu Thạch - Sao Trực ngạn cho nên gia chủ lễ bái cầu phúc vào các ngày này sẽ khiến rước tai họa vào người, hao tốn tiền bạc.'],
		15 => ['can' => 'Mậu', 'chi' => 'Dần', 'ten' => 'Mậu Dần', 'menh' => 'Thổ', 'diengiai' => 'Thạch Đầu Thổ (Đất trên thành)',
			'ynghia' => 'Ngày Bính Tý, Đinh Sửu, Mậu Dần: Ba ngày rất xấu không nên tế lễ vì chư Thần phá Thiên Tào vận của Ngọc Hoàng Tây - hà bái Liễu Thạch - Sao Trực ngạn cho nên gia chủ lễ bái cầu phúc vào các ngày này sẽ khiến rước tai họa vào người, hao tốn tiền bạc.'],
		16 => ['can' => 'Kỷ', 'chi' => 'Mão', 'ten' => 'Kỷ Mão', 'menh' => 'Thổ', 'diengiai' => 'Thạch Đầu Thổ (Đất trên thành)',
			'ynghia' => 'Ngày Kỷ Mão, Canh Thìn: Các thần ngự tại địa phủ nên nếu gia chủ cầu phúc thì sẽ có lợi cho con cháu, nhận được vinh hoa phú quý. Vì ngày này là ngày sinh nhật của vị Tiên Thánh nên rất tốt.'],
		17 => ['can' => 'Canh', 'chi' => 'Thìn', 'ten' => 'Canh Thìn', 'menh' => 'Kim', 'diengiai' => 'Bạch Lạp Kim (Vàng chân đèn)',
			'ynghia' => 'Ngày Kỷ Mão, Canh Thìn: Các thần ngự tại địa phủ nên nếu gia chủ cầu phúc thì sẽ có lợi cho con cháu, nhận được vinh hoa phú quý. Vì ngày này là ngày sinh nhật của vị Tiên Thánh nên rất tốt.'],
		18 => ['can' => 'Tân', 'chi' => 'Tỵ', 'ten' => 'Tân Tỵ', 'menh' => 'Kim', 'diengiai' => 'Bạch Lạp Kim (Vàng chân đèn)',
			'ynghia' => 'Ngày Tân Tỵ: Các thần ở cửa nhà trời chuyển đất đá rất khổ cho nên gia chủ không nên lễ bái cầu phúc ngày này. Nếu làm lễ cúng có thể sẽ mang họa vào người như con cái ba đời nghèo khổ, điên loạn, kiện cáo, tai bay vạ gió. Nặng nhất có thể dẫn đến bệnh tật, tử vong.'],
		19 => ['can' => 'Nhâm', 'chi' => 'Ngọ', 'ten' => 'Nhâm Ngọ', 'menh' => 'Mộc', 'diengiai' => 'Dương Liễu Mộc (Gỗ cây dương)',
			'ynghia' => 'Ngày Nhâm Ngọ, Quý Mùi: Chư thần ở trên Thiên Đình nên nếu gia chủ làm lễ cầu phúc thì sẽ nhận được tài lộc trong ba năm đầu. Nhưng đến 3 năm tieps theo đó sẽ nhận lại những hung hại, tai họa có thể dẫn đến chết người.'],
		20 => ['can' => 'Quý', 'chi' => 'Mùi', 'ten' => 'Quý Mùi', 'menh' => 'Mộc', 'diengiai' => 'Dương Liễu Mộc (Gỗ cây dương)',
			'ynghia' => 'Ngày Nhâm Ngọ, Quý Mùi: Chư thần ở trên Thiên Đình nên nếu gia chủ làm lễ cầu phúc thì sẽ nhận được tài lộc trong ba năm đầu. Nhưng đến 3 năm tieps theo đó sẽ nhận lại những hung hại, tai họa có thể dẫn đến chết người.'],
		21 => ['can' => 'Giáp', 'chi' => 'Thân', 'ten' => 'Giáp Thân', 'menh' => 'Thủy', 'diengiai' => 'Tuyền Trung Thủy (Đại Khê Thủy (Nước trong suối))',
			'ynghia' => 'Ngày Giáp Thân, Ất Dậu: Trong hai ngày này gia chủ nếu làm lễ cúng bái sẽ rất tốt  vì các vị chư thần ở trên trời sẽ xuống địa phủ, trần gian.'],
		22 => ['can' => 'Ất', 'chi' => 'Dậu', 'ten' => 'Ất Dậu', 'menh' => 'Thủy', 'diengiai' => 'Tuyền Trung Thủy (Đại Khê Thủy (Nước trong suối))',
			'ynghia' => 'Ngày Giáp Thân, Ất Dậu: Trong hai ngày này gia chủ nếu làm lễ cúng bái sẽ rất tốt  vì các vị chư thần ở trên trời sẽ xuống địa phủ, trần gian.'],
		23 => ['can' => 'Bính', 'chi' => 'Tuất', 'ten' => 'Bính Tuất', 'menh' => 'Thổ', 'diengiai' => 'Ốc Thượng Thổ (Đất nóc nhà)',
			'ynghia' => 'Ngày Bính Tuất, Đinh Hợi: Các vị chư thần đang ở trên trời sẽ xuống nhân gian, địa phủ nếu gia chủ muốn cầu phúc, tế tự, hoàn nguyên, thượng biểu, chiêu tài sẽ nhận được công lao và ân đức rất nhiều.'
		],
		24 => ['can' => 'Đinh', 'chi' => 'Hợi', 'ten' => 'Đinh Hợi', 'menh' => 'Thổ', 'diengiai' => 'Ốc Thượng Thổ (Đất nóc nhà)',
			'ynghia' => 'Ngày Bính Tuất, Đinh Hợi: Các vị chư thần đang ở trên trời sẽ xuống nhân gian, địa phủ nếu gia chủ muốn cầu phúc, tế tự, hoàn nguyên, thượng biểu, chiêu tài sẽ nhận được công lao và ân đức rất nhiều.'
		],
		25 => ['can' => 'Mậu', 'chi' => 'Tí', 'ten' => 'Mậu Tí', 'menh' => 'Hỏa', 'diengiai' => 'Thích Lịch Hỏa (Lửa sấm sét)',
			'ynghia' => 'Ngày Mậu Tý, Kỷ Sửu: Chư thần sẽ ở lại nhân gian, địa phủ hai ngày này, vậy nên gia chủ cầu phúc, tế lễ cảm ơn trời đất thì sẽ rất tốt. Còn nếu ngày ấy làm chủ chớ, thề bồi thì sẽ không mang lại hiệu quả như mong muốn và mang đến nhiều bất lợi'
		],
		26 => ['can' => 'Kỷ', 'chi' => 'Sửu', 'ten' => 'Kỷ Sửu', 'menh' => 'Hỏa', 'diengiai' => 'Thích Lịch Hỏa (Lửa sấm sét)',
			'ynghia' => 'Ngày Mậu Tý, Kỷ Sửu: Chư thần sẽ ở lại nhân gian, địa phủ hai ngày này, vậy nên gia chủ cầu phúc, tế lễ cảm ơn trời đất thì sẽ rất tốt. Còn nếu ngày ấy làm chủ chớ, thề bồi thì sẽ không mang lại hiệu quả như mong muốn và mang đến nhiều bất lợi'
		],
		27 => ['can' => 'Canh', 'chi' => 'Dần', 'ten' => 'Canh Dần', 'menh' => 'Mộc', 'diengiai' => 'Tùng Bách Mộc (Gỗ tùng bách)',
			'ynghia' => 'Ngày Canh Dần: Chư thân lúc này đang ở trên Thiên Đình xem xét các tội lỗi của con người ở dưới nhân gian. Vì vậy nên nếu gia chủ làm lễ cầu phúc hay ước nguyện thì sẽ rất xấu, có thể làm hại đến bản thân.'
		],
		28 => ['can' => 'Tân', 'chi' => 'Mão', 'ten' => 'Tân Mão', 'menh' => 'Mộc', 'diengiai' => 'Tùng Bách Mộc (Gỗ tùng bách)',
			'ynghia' => 'Ngày Tân Mão: Chư thần ngày này đang ở địa phủ, nên nếu gia chủ làm lễ khẩn cầu, chiêu hồn, lập bàn thờ, bài vị gia tiên đều được. Đây là ngày không quá đẹp, cũng không quá xấu mọi việc đều sẽ bình an trôi qua.'
		],
		29 => ['can' => 'Nhâm', 'chi' => 'Thìn', 'ten' => 'Nhâm Thìn', 'menh' => 'Thủy', 'diengiai' => 'Trường Lưu Thủy (Nước chảy mạnh)',
			'ynghia' => 'Ngày Nhâm Thìn, Quý Tỵ: Chư thần ở trên trời xem lại sổ sách sinh tử dưới trần gian. Vậy nên nếu gia chủ làm lễ tế tự thì sẽ dễ gặp đau ốm, bệnh tật, có thể ảnh hưởng xấu đến bản thân và những người xung quanh.'
		],
		30 => ['can' => 'Quý', 'chi' => 'Tỵ', 'ten' => 'Quý Tỵ', 'menh' => 'Thủy', 'diengiai' => 'Trường Lưu Thủy (Nước chảy mạnh)',
			'ynghia' => 'Ngày Nhâm Thìn, Quý Tỵ: Chư thần ở trên trời xem lại sổ sách sinh tử dưới trần gian. Vậy nên nếu gia chủ làm lễ tế tự thì sẽ dễ gặp đau ốm, bệnh tật, có thể ảnh hưởng xấu đến bản thân và những người xung quanh.'
		],
		31 => ['can' => 'Giáp', 'chi' => 'Ngọ', 'ten' => 'Giáp Ngọ', 'menh' => 'Kim', 'diengiai' => 'Sa Trung Kim (Vàng trong cát)',
			'ynghia' => 'Ngày Giáp Ngọ: Chư thần xuống khắp cõi nhân gian, vậy nên gia chủ nếu làm lễ thượng chương, tiến biểu, lễ tạ thổ công, thổ địa… thì sẽ rất tốt, nhận được nhiều phúc lộc gấp 5, gấp 10 bình thường.'
		],
		32 => ['can' => 'Ất', 'chi' => 'Mùi', 'ten' => 'Ất Mùi', 'menh' => 'Kim', 'diengiai' => 'Sa Trung Kim (Vàng trong cát)',
			'ynghia' => 'Ngày Ất Mùi: Chư thần ở trên Thiên Đình nên nếu làm lễ tế sẽ nhận được phúc lộc nhưng không nhiều.'
		],
		33 => ['can' => 'Bính', 'chi' => 'Thân', 'ten' => 'Bính Thân', 'menh' => 'Hỏa', 'diengiai' => 'Sơn Hạ Hỏa (Lửa chân núi)',
			'ynghia' => 'Ngày Bính Thân, Đinh Dậu, Mậu Tuất: Chư thần tại Thiên Đình giúp Ngọc Hoàng thượng để làm sổ sách sinh tử, ghi thiện ác của nhân gian, địa phủ. Nên nếu gia chủ làm lễ cầu bình an, sống lâu trăm tuổi, lễ chiêu hồn sẽ rất tốt.'
		],
		34 => ['can' => 'Đinh', 'chi' => 'Dậu', 'ten' => 'Đinh Dậu', 'menh' => 'Hỏa', 'diengiai' => 'Sơn Hạ Hỏa (Lửa chân núi)',
			'ynghia' => 'Ngày Bính Thân, Đinh Dậu, Mậu Tuất: Chư thần tại Thiên Đình giúp Ngọc Hoàng thượng để làm sổ sách sinh tử, ghi thiện ác của nhân gian, địa phủ. Nên nếu gia chủ làm lễ cầu bình an, sống lâu trăm tuổi, lễ chiêu hồn sẽ rất tốt.'
		],
		35 => ['can' => 'Mậu', 'chi' => 'Tuất', 'ten' => 'Mậu Tuất', 'menh' => 'Mộc', 'diengiai' => 'Bình Địa Mộc (Gỗ đồng bằng)',
			'ynghia' => 'Ngày Bính Thân, Đinh Dậu, Mậu Tuất: Chư thần tại Thiên Đình giúp Ngọc Hoàng thượng để làm sổ sách sinh tử, ghi thiện ác của nhân gian, địa phủ. Nên nếu gia chủ làm lễ cầu bình an, sống lâu trăm tuổi, lễ chiêu hồn sẽ rất tốt.'
		],
		36 => ['can' => 'Kỷ', 'chi' => 'Hợi', 'ten' => 'Kỷ Hợi', 'menh' => 'Mộc', 'diengiai' => 'Bình Địa Mộc (Gỗ đồng bằng)',
			'ynghia' => ''
		],
		37 => ['can' => 'Canh', 'chi' => 'Tí', 'ten' => 'Canh Tí', 'menh' => 'Thổ', 'diengiai' => 'Bích thượng thổ (Đất trên vách)',
			'ynghia' => 'Ngày Canh Tý, Tân Sửu: Chư thần ở trên trời nên nếu gia chủ làm lễ tế tự, cầu phúc sẽ mang đến bệnh tật, tai vạ cho bản thân và những người thân trong gia đình.'
		],
		38 => ['can' => 'Tân', 'chi' => 'Sửu', 'ten' => 'Tân Sửu', 'menh' => 'Thổ', 'diengiai' => 'Bích thượng thổ (Đất trên vách)',
			'ynghia' => 'Ngày Canh Tý, Tân Sửu: Chư thần ở trên trời nên nếu gia chủ làm lễ tế tự, cầu phúc sẽ mang đến bệnh tật, tai vạ cho bản thân và những người thân trong gia đình.'
		],
		39 => ['can' => 'Nhâm', 'chi' => 'Dần', 'ten' => 'Nhâm Dần', 'menh' => 'Kim', 'diengiai' => 'Kim Bạch Kim (Vàng pha bạc)',
			'ynghia' => 'Ngày Nhâm Dần, Quý Mão: Chư thần hội họp để đưa ra các quyết định cho nhân gian, âm phủ nên gia chủ làm lễ cầu phúc ngày này sẽ rất tốt.'
		],
		40 => ['can' => 'Quý', 'chi' => 'Mão', 'ten' => 'Quý Mão', 'menh' => 'Kim', 'diengiai' => 'Kim Bạch Kim (Vàng pha bạc)',
			'ynghia' => 'Ngày Nhâm Dần, Quý Mão: Chư thần hội họp để đưa ra các quyết định cho nhân gian, âm phủ nên gia chủ làm lễ cầu phúc ngày này sẽ rất tốt.'
		],
		41 => ['can' => 'Giáp', 'chi' => 'Thìn', 'ten' => 'Giáp Thìn', 'menh' => 'Hỏa', 'diengiai' => 'Phú Đăng Hỏa (Lửa đèn to)',
			'ynghia' => 'Ngày Giáp Thìn: Chư thần đang ở trên trời nên gia chủ tiến hành lễ bái ngày này sẽ không tốt, có thể mang đến tai họa.'
		],
		42 => ['can' => 'Ất', 'chi' => 'Tỵ', 'ten' => 'Ất Tỵ', 'menh' => 'Hỏa', 'diengiai' => 'Phú Đăng Hỏa (Lửa đèn to)',
			'ynghia' => 'Ngày Ất Tỵ: Chư thần vào ngày này đang ở trần gian, địa phủ nên gia chủ cấu phúc, tế tự, lễ bái sẽ rất tốt, mang đến nhiều may mắn, cát lành cho bản thân và gia đình.'
		],
		43 => ['can' => 'Bính', 'chi' => 'Ngọ', 'ten' => 'Bính Ngọ', 'menh' => 'Thủy', 'diengiai' => 'Thiên Hà Thủy (Nước trên trời)',
			'ynghia' => 'Ngày Bính Ngọ: Chư thần ở trên trời không có ở nhân gian nên gia chủ làm lễ và cầu phúc sẽ không tốt, không mang đến hiệu quả như mong muốn.'
		],
		44 => ['can' => 'Đinh', 'chi' => 'Mùi', 'ten' => 'Đinh Mùi', 'menh' => 'Thủy', 'diengiai' => 'Thiên Hà Thủy (Nước trên trời)',
			'ynghia' => 'Ngày Đinh Mùi: Chư thần đang ở tại địa phủ nếu gia chủ cầu phúc, lễ bái, biểu chương, biểu nguyệt sẽ rất tốt.'
		],
		45 => ['can' => 'Mậu', 'chi' => 'Thân', 'ten' => 'Mậu Thân', 'menh' => 'Thổ', 'diengiai' => 'Đại Trạch Thổ (Đất nền nhà)',
			'ynghia' => 'Ngày Mậu Thân: Chư thần ở trên trời không ở nhân gian, địa phủ nếu gia chủ tế lễ sẽ dễ làm ảnh hưởng đến sức khỏe, tính mạng của người lớn trong gia đình, công việc.'
		],
		46 => ['can' => 'Kỷ', 'chi' => 'Dậu', 'ten' => 'Kỷ Dậu', 'menh' => 'Thổ', 'diengiai' => 'Đại Trạch Thổ (Đất nền nhà)',
			'ynghia' => 'Ngày Kỷ Dậu: Trên thượng giới có lệnh đại ân xá nếu gia chủ tế tự, tiến điền tâm rất tốt'
		],
		47 => ['can' => 'Canh', 'chi' => 'Tuất', 'ten' => 'Canh Tuất', 'menh' => 'Kim', 'diengiai' => 'Thoa Xuyến Kim (Vàng trang sức)',
			'ynghia' => 'Ngày Canh Tuất, Tân Hợi: Chư thần đang ở trên trời, nếu lúc này gia chủ lễ bái Hà Bá thì sẽ tạm ổn, còn tiến biểu chương (dâng sớ) thì lại bị họa rất xấu.'
		],
		48 => ['can' => 'Tân', 'chi' => 'Hợi', 'ten' => 'Tân Hợi', 'menh' => 'Kim', 'diengiai' => 'Thoa Xuyến Kim (Vàng trang sức)',
			'ynghia' => 'Ngày Canh Tuất, Tân Hợi: Chư thần đang ở trên trời, nếu lúc này gia chủ lễ bái Hà Bá thì sẽ tạm ổn, còn tiến biểu chương (dâng sớ) thì lại bị họa rất xấu.'
		],
		49 => ['can' => 'Nhâm', 'chi' => 'Tí', 'ten' => 'Nhâm Tí', 'menh' => 'Mộc', 'diengiai' => 'Tang Đồ Mộc (Gỗ cây dâu)',
			'ynghia' => 'Ngày Nhâm Tý, Quý Sửu: Trong ngày này nếu gia chủ lễ bái rất xấu vì các vị thần ở Thiên cung'
		],
		50 => ['can' => 'Quý', 'chi' => 'Sửu', 'ten' => 'Quý Sửu', 'menh' => 'Mộc', 'diengiai' => 'Tang Đồ Mộc (Gỗ cây dâu)',
			'ynghia' => 'Ngày Nhâm Tý, Quý Sửu: Trong ngày này nếu gia chủ lễ bái rất xấu vì các vị thần ở Thiên cung'
		],
		51 => ['can' => 'Giáp', 'chi' => 'Dần', 'ten' => 'Giáp Dần', 'menh' => 'Thủy', 'diengiai' => 'Đại Khê Thủy (Nước trong suối)',
			'ynghia' => 'Ngày Giáp Dần, Ất Mão: Chư thần lúc này đang ở nhân gian, địa phủ nếu gia chủ lễ bái, cầu phúc mọi sự đều tốt lành. ',
		],
		52 => ['can' => 'Ất', 'chi' => 'Mão', 'ten' => 'Ất Mão', 'menh' => 'Thủy', 'diengiai' => 'Đại Khê Thủy (Nước trong suối)',
			'ynghia' => 'Ngày Giáp Dần, Ất Mão: Chư thần lúc này đang ở nhân gian, địa phủ nếu gia chủ lễ bái, cầu phúc mọi sự đều tốt lành. ',
		],
		53 => ['can' => 'Bính', 'chi' => 'Thìn', 'ten' => 'Bính Thìn', 'menh' => 'Thổ', 'diengiai' => 'Sa Trung Thổ (Đất trong cát)',
			'ynghia' => 'Ngày Bính Thìn, Đinh Tỵ, Mậu Ngọ, Kỷ Mùi: Chư thần cai quản trên trời bốn ngày này, vì vậy nên gia chủ tiến hành tế tự sẽ rất xấu.'
		],
		54 => ['can' => 'Đinh', 'chi' => 'Tỵ', 'ten' => 'Đinh Tỵ', 'menh' => 'Thổ', 'diengiai' => 'Sa Trung Thổ (Đất trong cát)',
			'ynghia' => 'Ngày Bính Thìn, Đinh Tỵ, Mậu Ngọ, Kỷ Mùi: Chư thần cai quản trên trời bốn ngày này, vì vậy nên gia chủ tiến hành tế tự sẽ rất xấu.'
		],
		55 => ['can' => 'Mậu', 'chi' => 'Ngọ', 'ten' => 'Mậu Ngọ', 'menh' => 'Hỏa', 'diengiai' => 'Thiên Thượng Hỏa (Đất trong cát)',
			'ynghia' => 'Ngày Bính Thìn, Đinh Tỵ, Mậu Ngọ, Kỷ Mùi: Chư thần cai quản trên trời bốn ngày này, vì vậy nên gia chủ tiến hành tế tự sẽ rất xấu.'
		],
		56 => ['can' => 'Kỷ', 'chi' => 'Mùi', 'ten' => 'Kỷ Mùi', 'menh' => 'Hỏa', 'diengiai' => 'Thiên Thượng Hỏa (Đất trong cát)',
			'ynghia' => 'Ngày Bính Thìn, Đinh Tỵ, Mậu Ngọ, Kỷ Mùi: Chư thần cai quản trên trời bốn ngày này, vì vậy nên gia chủ tiến hành tế tự sẽ rất xấu.'
		],
		57 => ['can' => 'Canh', 'chi' => 'Thân', 'ten' => 'Canh Thân', 'menh' => 'Mộc', 'diengiai' => 'Thạch Lựu Mộc (Gỗ cây lựu đá)',
			'ynghia' => 'Ngày Canh Thân: Ngày cửa trời 5 đường phúc mở rộng, nếu gia chủ làm cỗ chay, tế lễ, dâng sớ sẽ rất tốt, có thể nhận được mọi điều mà mình cầu khấn.'
		],
		58 => ['can' => 'Tân', 'chi' => 'Dậu', 'ten' => 'Tân Dậu', 'menh' => 'Mộc', 'diengiai' => 'Thạch Lựu Mộc (Gỗ cây lựu đá)',
			'ynghia' => 'Ngày Tân Dậu: Ngọc Hoàng sai chư thần xuống nhân gian, địa phủ nên nếu gia chủ làm lễ bái, tế tự sẽ không tốt. Vì vậy nên tránh ngày này để khoogn gặp phải những hung hại đáng tiếc.'
		],
		59 => ['can' => 'Nhâm', 'chi' => 'Tuất', 'ten' => 'Nhâm Tuất', 'menh' => 'Thủy', 'diengiai' => 'Đại Hải Thủy (Nước biển lớn)',
			'ynghia' => 'Ngày Nhâm Tuất - Quý Hợi: Là ngày Lục thần cùng xuống nhân gian, nếu gia chủ cầu phúc, cầu an ngày này sẽ phạm phải cô quả, không tốt, làm việc gì cũng không thuận lợi.'
		],
		60 => ['can' => 'Quý', 'chi' => 'Hợi', 'ten' => 'Quý Hợi', 'menh' => 'Thủy', 'diengiai' => 'Đại Hải Thủy (Nước biển lớn)',
			'ynghia' => 'Ngày Nhâm Tuất - Quý Hợi: Là ngày Lục thần cùng xuống nhân gian, nếu gia chủ cầu phúc, cầu an ngày này sẽ phạm phải cô quả, không tốt, làm việc gì cũng không thuận lợi.'
		],
	];
    public static $thuAmLich = [0 => 2, 1 => 3, 2 => 4, 3 => 5, 4 => 6, 5 => 7, 6 => 'CN'];
    public static $matTroi = [
        1 => ['kinhdo' => 0, 'tiet' => 'Xuân Phân', 'ynghia' => 'Giữa xuân', 'ngayduonglich' => '21 tháng 3',
            'diengiai' => 'Chim Yên đến, sấm chính phát thành tiếng, bắt đầu có chớp và Sét.'
        ],
        2 => ['kinhdo' => 15, 'tiet' => 'Thanh minh', 'ynghia' => 'Trời trong sáng', 'ngayduonglich' => '5 tháng 4',
            'diengiai' => 'Ngô Đồng bắt đầu có hoa, chuột đồng hóa làm chim Ưng, Cầu Vồng bắt đầu thấy.'
        ],
        3 => ['kinhdo' => 30, 'tiet' => 'Cốc vũ', 'ynghia' => 'Mưa rào', 'ngayduonglich' => '20 tháng 4',
            'diengiai' => 'Bèo bắt đầu sinh, chim tu hú kêu, Lông phất nhẹ qua, chim đầu đàn đậu xuống cây Tang (cây dâu).'
        ],
        4 => ['kinhdo' => 45, 'tiet' => 'Lập hạ', 'ynghia' => 'Bắt đầu mùa hè', 'ngayduonglich' => '6 tháng 5',
            'diengiai' => 'Ếch, chão chuộc kêu, giun đất bò ra, móng chân móng tay vua mọc ra.'
        ],
        5 => ['kinhdo' => 60, 'tiet' => 'Tiểu mãn', 'ynghia' => 'Lũ nhỏ, duối vàng', 'ngayduonglich' => '21 tháng 5',
            'diengiai' => 'Rau đắng (Khổ thái) nở hoa đẹp. Cỏ mi vu chết, lúa mạch mùa thu đến.'
        ],
        6 => ['kinhdo' => 75, 'tiet' => 'Mang chủng', 'ynghia' => 'Chòm sao tua rua mọc', 'ngayduonglich' => '6 tháng 6',
            'diengiai' => 'Con bọ ngựa đẻ, chim bạch lao (loài chim kêu được trăm thứ tiếng) bắt đầu kêu, trái lại lưỡi không có tiếng kêu.'
        ],
        7 => ['kinhdo' => 90, 'tiet' => 'Hạ chí', 'ynghia' => 'Giữa hè', 'ngayduonglich' => '21 tháng 6',
            'diengiai' => 'Sừng Hươu Nai tách ra, ve bắt đầu kêu, cây bán hạ sinh.'
        ],
        8 => ['kinhdo' => 105, 'tiet' => 'Tiểu thử', 'ynghia' => 'Nóng nhẹ', 'ngayduonglich' => '7 tháng 7',
            'diengiai' => 'Gió ấm lên, con dế ở vách tường. Chim ưng bắt đầu mạnh dữ.'
        ],
        9 => ['kinhdo' => 120, 'tiet' => 'Đại thử', 'ynghia' => 'Nóng oi', 'ngayduonglich' => '23 tháng 7',
            'diengiai' => 'Cỏ mục rữa là đom đóm, đất nóng nhuần ẩm, trời bắt đầu có mưa lớn.'
        ],
        10 => ['kinhdo' => 135, 'tiet' => 'Lập thu', 'ynghia' => 'Bắt đầu mùa thu', 'ngayduonglich' => '7 tháng 8',
            'diengiai' => 'Gió mát đến, con cò trắng giáng xuống, ve sầu mùa hạ kêu.'
        ],
        11 => ['kinhdo' => 150, 'tiet' => 'Xử thử', 'ynghia' => 'Mưa ngâu', 'ngayduonglich' => '23 tháng 8',
            'diengiai' => 'Chim Ưng là chim sẻ, trời bắt đầu đẹp yên. Cây mạ đang lên.'
        ],
        12 => ['kinhdo' => 165, 'tiet' => 'Bạch lộ', 'ynghia' => 'Nắng nhạt', 'ngayduonglich' => '8 tháng 9',
            'diengiai' => 'Chim Hồng Nhạn đến, chim Yến trở về, bầy chim nuôi e thẹn lúng túng.'
        ],
        13 => ['kinhdo' => 180, 'tiet' => 'Thu phân', 'ynghia' => 'Giữa thu', 'ngayduonglich' => '23 tháng 9',
            'diengiai' => 'Sấm bắt đầu thu tiếng, triết trùng ở nhà gạch gỗ. Nước bắt đầu khô cạn.'
        ],
        14 => ['kinhdo' => 195, 'tiet' => 'Hàn lộ', 'ynghia' => 'Mát mẻ', 'ngayduonglich' => '8 tháng 10',
            'diengiai' => 'Chim Hồng Nhạn kêu khách đến, chim sẻ nhập vào nước lớn làm con hầu. Cúc có hoa vàng.'
        ],
        15 => ['kinhdo' => 210, 'tiet' => 'Sương giáng', 'ynghia' => 'Sương mù xuất hiện', 'ngayduonglich' => '23 tháng 10',
            'diengiai' => 'Chó sói là thú để tế, cây cỏ vàng rụng lá, Triết trùng đều cúi xuống.'
        ],
        16 => ['kinhdo' => 225, 'tiet' => 'Lập đông', 'ynghia' => 'Bắt đầu mùa đông', 'ngayduonglich' => '7 tháng 11',
            'diengiai' => 'Nước bắt đầu đóng băng, đất bắt đầu đông lại, chim trĩ nhậm nước lớn làm loài trai sò hến.'
        ],
        17 => ['kinhdo' => 240, 'tiet' => 'Tiểu tuyết', 'ynghia' => 'Tuyết xuất hiện', 'ngayduonglich' => '22 tháng 11',
            'diengiai' => 'Chim két ẩn mình không thấy, Thiên khí tăng lên, địa khí giáng xuống, bế tắc mà thành mùa Đông.'
        ],
        18 => ['kinhdo' => 255, 'tiet' => 'Đại tuyết', 'ynghia' => 'Tuyết dày', 'ngayduonglich' => '7 tháng 12',
            'diengiai' => 'Chim hát dán (giống như gà rừng hay con trĩ) không kêu. Hổ bắt đầu giao nhau, cỏ lệ vươn thẳng cao lên mà xuất ra.'
        ],
        19 => ['kinhdo' => 270, 'tiet' => 'Đông chí', 'ynghia' => 'Giữa đông', 'ngayduonglich' => '22 tháng 12',
            'diengiai' => 'Giun đất kết bện vào nhau. Sừng nai tách ra, nước suối động.'
        ],
        20 => ['kinhdo' => 285, 'tiet' => 'Tiểu hàn', 'ynghia' => 'Rét nhẹ', 'ngayduonglich' => '6 tháng 1',
            'diengiai' => 'Nhạn về quê hương ở phương Bắc, Chim bồ (chim khách) bắt đầu vào tổ. Tiếng chim trĩ kêu.'
        ],
        21 => ['kinhdo' => 300, 'tiet' => 'Đại hàn', 'ynghia' => 'Rét đậm', 'ngayduonglich' => '21 tháng 1',
            'diengiai' => 'Gà đẻ, chim đi xa dữ tợn, nước hồ ao đông cứng.'
        ],
        22 => ['kinhdo' => 315, 'tiet' => 'Lập xuân', 'ynghia' => 'Bắt đầu mùa xuân', 'ngayduonglich' => '4 tháng 2',
            'diengiai' => 'Đông phong giải nước đóng băng. Tiết trùng (Sâu ở trong đất) bắt đầu chấn động. Cá lên cao dựa vào băng.'
        ],
        23 => ['kinhdo' => 330, 'tiet' => 'Vũ thủy', 'ynghia' => 'Mưa ẩm', 'ngayduonglich' => '19 tháng 2',
            'diengiai' => 'Con rái cá tế cá, Nhạn Bắc di trú, cỏ cây bắt đầu phát động.'
        ],
        24 => ['kinhdo' => 345, 'tiet' => 'Kinh trập', 'ynghia' => 'Sâu nở', 'ngayduonglich' => '5 tháng 3',
            'diengiai' => 'Đào bắt đầu rực rỡ ra hoa, chim thương (hay chim hoàng li) hót. Chim Ưng (hay Ó) hóa là con chim gáy.'
        ],
    ];
// tinhs bang gio
    public static $gioDataChi = [
        1 => ['Tí', 'Thân', 'Dậu', 'Tuất', 'Hợi', 'Tí', 'Sửu', 'Dần', 'Mão', 'Thìn', 'Tỵ', 'Ngọ', 'Mùi'],
        2 => ['Sửu', 'Tuất', 'Hợi', 'Tí', 'Sửu', 'Dần', 'Mão', 'Thìn', 'Tỵ', 'Ngọ', 'Mùi', 'Thân', 'Dậu'],
        3 => ['Dần', 'Tí', 'Sửu', 'Dần', 'Mão', 'Thìn', 'Tỵ', 'Ngọ', 'Mùi', 'Thân', 'Dậu', 'Tuất', 'Hợi'],
        4 => ['Mão', 'Dần', 'Mão', 'Thìn', 'Tỵ', 'Ngọ', 'Mùi', 'Thân', 'Dậu', 'Tuất', 'Hợi', 'Tí', 'Sửu'],
        5 => ['Thìn', 'Thìn', 'Tỵ', 'Ngọ', 'Mùi', 'Thân', 'Dậu', 'Tuất', 'Hợi', 'Tí', 'Sửu', 'Dần', 'Mão'],
        6 => ['Tỵ', 'Ngọ', 'Mùi', 'Thân', 'Dậu', 'Tuất', 'Hợi', 'Tí', 'Sửu', 'Dần', 'Mão', 'Thìn', 'Tỵ'],
        7 => ['Ngọ', 'Thân', 'Dậu', 'Tuất', 'Hợi', 'Tí', 'Sửu', 'Dần', 'Mão', 'Thìn', 'Tỵ', 'Ngọ', 'Mùi'],
        8 => ['Mùi', 'Tuất', 'Hợi', 'Tí', 'Sửu', 'Dần', 'Mão', 'Thìn', 'Tỵ', 'Ngọ', 'Mùi', 'Thân', 'Dậu'],
        9 => ['Thân', 'Tí', 'Sửu', 'Dần', 'Mão', 'Thìn', 'Tỵ', 'Ngọ', 'Mùi', 'Thân', 'Dậu', 'Tuất', 'Hợi'],
        10 => ['Dậu', 'Dần', 'Mão', 'Thìn', 'Tỵ', 'Ngọ', 'Mùi', 'Thân', 'Dậu', 'Tuất', 'Hợi', 'Tí', 'Sửu'],
        11 => ['Tuất', 'Thìn', 'Tỵ', 'Ngọ', 'Mùi', 'Thân', 'Dậu', 'Tuất', 'Hợi', 'Tí', 'Sửu', 'Dần', 'Mão'],
        12 => ['Hợi', 'Ngọ', 'Mùi', 'Thân', 'Dậu', 'Tuất', 'Hợi', 'Tí', 'Sửu', 'Dần', 'Mão', 'Thìn', 'Tỵ'],
    ];
    public static $gioData = [
        1 => ['ten' => 'Thanh Long', 'gio' => 'Hoàng đạo', 'hd' => true],
        2 => ['ten' => 'Minh Đường', 'gio' => 'Hoàng đạo', 'hd' => true],
        3 => ['ten' => 'Thiên Hình', 'gio' => 'Hắc đạo', 'hd' => false],
        4 => ['ten' => 'Chu Tước', 'gio' => 'Hắc đạo', 'hd' => false],
        5 => ['ten' => 'Kim Quỹ', 'gio' => 'Hoàng đạo', 'hd' => true],
        6 => ['ten' => 'Bảo Quang', 'gio' => 'Hoàng đạo', 'hd' => true],
        7 => ['ten' => 'Bạch Hổ', 'gio' => 'Hắc đạo', 'hd' => false],
        8 => ['ten' => 'Ngọc Đường', 'gio' => 'Hoàng đạo', 'hd' => true],
        9 => ['ten' => 'Thiên Lao', 'gio' => 'Hắc đạo', 'hd' => false],
        10 => ['ten' => 'Nguyên Vũ', 'gio' => 'Hắc đạo', 'hd' => false],
        11 => ['ten' => 'Tư Mệnh', 'gio' => 'Hoàng đạo', 'hd' => true],
        12 => ['ten' => 'Câu Trận', 'gio' => 'Hắc đạo', 'hd' => false],
    ];
    public static $saoTot = [
        'thienduc' => ['ten' => 'Thiên đức',
            'tinhchat' => 'Là phúc đức của Trời, dùng trong mọi việc đều cực tốt. ',
            'thutu' => [
                1 => 'Đinh',
                2 => 'Thân',
                3 => 'Nhâm',
                4 => 'Tân',
                5 => 'Hợi',
                6 => 'Giáp',
                7 => 'Quý',
                8 => 'Dần',
                9 => 'Bính',
                10 => 'Ất',
                11 => 'Kỷ', 12 => 'Canh']],
        'thienduchop' => ['ten' => 'Thiên đức hợp',
            'tinhchat' => 'Là Thần Đức Hợp trong tháng, mọi việc đều tốt.',
            'thutu' => [1 => 'Nhâm', 2 => 'Tỵ', 3 => 'Đinh', 4 => 'Bính', 5 => 'Dần', 6 => 'Kỷ',
                7 => 'Mậu', 8 => 'Hợi', 9 => 'Canh', 10 => 'Tân', 11 => 'Thân', 12 => 'Ất']],
        'nguyetduchop' => ['ten' => 'Nguyệt Đức',
            'tinhchat' => 'Kiêng kỵ tố tụng còn lại tốt cho mọi việc',
            'thutu' => [1 => 'Tân', 2 => 'Kỷ', 3 => 'Đinh', 4 => 'Ất', 5 => 'Tân', 6 => 'Kỷ',
                7 => 'Đinh', 8 => 'Ất', 9 => 'Tân', 10 => 'Kỷ', 11 => 'Đinh', 12 => 'Ất']],
	    'nguyetduc' => ['ten' => 'Nguyệt Đức',
		    'tinhchat' => 'Là đức thần trong tháng, mọi việc đều tốt.',
		    'thutu' => [1 => 'Bính', 2 => 'Giáp', 3 => 'Nhâm', 4 => 'Canh', 5 => 'Bính', 6 => 'Giáp',
			    7 => 'Nhâm', 8 => 'Canh', 9 => 'Bính', 10 => 'Giáp', 11 => 'Nhâm', 12 => 'Canh']],
        'thienhytructhanh' => ['ten' => 'Thiên hỷ (Trực thành)',
            'tinhchat' => 'Nên cưới xin, xuất hành, nhận trầu cau ăn hỏi, mọi việc đều tốt',
            'thutu' => [1 => 'Tuất', 2 => 'Hợi', 3 => 'Tí', 4 => 'Sửu', 5 => 'Dần', 6 => 'Mão',
                7 => 'Thìn', 8 => 'Tỵ', 9 => 'Ngọ', 10 => 'Mùi', 11 => 'Thân', 12 => 'Dậu']],
        'thienphutrucman' => ['ten' => 'Thiên phú (Trực mãn)',
            'tinhchat' => 'Nên làm kho tàng để chứa đựng thóc lúa đồ dùng',
            'thutu' => [1 => 'Thìn', 2 => 'Tỵ', 3 => 'Ngọ', 4 => 'Mùi', 5 => 'Thân', 6 => 'Dậu',
                7 => 'Tuất', 8 => 'Hợi', 9 => 'Tí', 10 => 'Sửu', 11 => 'Dần', 12 => 'Mão']],
        'thienquy' => ['ten' => 'Thiên Quý',
            'tinhchat' => 'Mọi việc đều tốt',
            'thutu' => [1 => 'Giáp', 2 => 'Giáp', 3 => 'Giáp', 4 => 'Bính', 5 => 'Bính', 6 => 'Bính',
                7 => 'Canh', 8 => 'Canh', 9 => 'Canh', 10 => 'Nhâm', 11 => 'Nhâm', 12 => 'Nhâm']],
        'thienquy2' => ['ten' => 'Thiên Quý',
            'tinhchat' => 'Mọi việc đều tốt',
            'thutu' => [1 => 'Ất', 2 => 'Ất', 3 => 'Ất', 4 => 'Đinh', 5 => 'Đinh', 6 => 'Đinh',
                7 => 'Tân', 8 => 'Tân', 9 => 'Tân', 10 => 'Quý', 11 => 'Quý', 12 => 'Quý']],
        'thienxa' => ['ten' => 'Thiên Xá',
            'tinhchat' => 'Trời xá lỗi, khoan tội, tốt cho mọi việc.',
            'thutu' => [1 => 'Mậu Dần', 2 => 'Mậu Dần', 3 => 'Mậu Dần', 4 => 'Giáp Ngọ', 5 => 'Giáp Ngọ', 6 => 'Giáp Ngọ',
                7 => 'Mậu Thân', 8 => 'Mậu Thân', 9 => 'Mậu Thân', 10 => 'Giáp Tí', 11 => 'Giáp Tí', 12 => 'Giáp Tí']],
        'sinhkhitruckhai' => ['ten' => 'Sinh khí (Trực Khai)',
            'tinhchat' => 'Ngày này nên định hôn nhân, cải tạo, sửa sang lại nhà cửa, nuôi thêm động vật, trồng cây đều cát sự.',
            'thutu' => [1 => 'Tí', 2 => 'Sửu', 3 => 'Dần', 4 => 'Mão', 5 => 'Thìn', 6 => 'Tỵ',
                7 => 'Ngọ', 8 => 'Mùi', 9 => 'Thân', 10 => 'Dậu', 11 => 'Tuất', 12 => 'Hợi']],
        'thienphuc' => ['ten' => 'Thiên Phúc',
            'tinhchat' => 'Tốt mọi việc, nên nhận công tác (việc quan), chuyển đến nhà mới, thực hiện cúng bái.',
            'thutu' => [1 => 'Kỷ', 2 => 'Mậu', 3 => '', 4 => 'Tân', 5 => 'Tân', 6 => '',
                7 => 'Ất', 8 => 'Giáp', 9 => '', 10 => 'Đinh', 11 => 'Bính', 12 => '']],
        'thienphuc2' => ['ten' => 'Thiên phúc',
            'tinhchat' => 'Tốt mọi việc, nên nhận công tác (việc quan), chuyển đến nhà mới, thực hiện cúng bái.',
            'thutu' => [1 => '', 2 => '', 3 => '', 4 => 'Quý', 5 => 'Nhâm', 6 => '',
                7 => '', 8 => '', 9 => '', 10 => '', 11 => '', 12 => '']],
        'thienthanh' => ['ten' => 'Thiên thành',
            'tinhchat' => 'Mọi việc đều tốt',
            'thutu' => [1 => 'Mùi', 2 => 'Dậu', 3 => 'Hợi', 4 => 'Sửu', 5 => 'Mão', 6 => 'Tỵ',
                7 => 'Mùi', 8 => 'Dậu', 9 => 'Hợi', 10 => 'Sửu', 11 => 'Mão', 12 => 'Tỵ']],
        'thienquan' => ['ten' => 'Thiên Quan',
            'tinhchat' => 'Mọi việc đều tốt',
            'thutu' => [1 => 'Tuất', 2 => 'Tí', 3 => 'Dần', 4 => 'Thìn', 5 => 'Ngọ', 6 => 'Thân',
                7 => 'Tuất', 8 => 'Tí', 9 => 'Dần', 10 => 'Thìn', 11 => 'Ngọ', 12 => 'Thân']],
        'thienma' => ['ten' => 'Thiên mã',
            'tinhchat' => 'Tốt cho việc xuất hành, giao dịch, cầu tài lộc.',
            'thutu' => [1 => 'Ngọ', 2 => 'Thân', 3 => 'Tuất', 4 => 'Tí', 5 => 'Dần', 6 => 'Thìn',
                7 => 'Ngọ', 8 => 'Thân', 9 => 'Tuất', 10 => 'Tí', 11 => 'Dần', 12 => 'Thìn']],
        'thientai' => ['ten' => 'Thiên tài',
            'tinhchat' => 'Tốt cho việc cầu tài hoặc khai trương.',
            'thutu' => [1 => 'Thìn', 2 => 'Ngọ', 3 => 'Thân', 4 => 'Tuất', 5 => 'Tí', 6 => 'Dần',
                7 => 'Thìn', 8 => 'Ngọ', 9 => 'Thân', 10 => 'Tuất', 11 => 'Tí', 12 => 'Dần']],
        'diatai' => ['ten' => 'Địa tài',
            'tinhchat' => 'Tốt cho việc cầu tài hoặc khai trương.',
            'thutu' => [1 => 'Tỵ', 2 => 'Mùi', 3 => 'Dậu', 4 => 'Hợi', 5 => 'Sửu', 6 => 'Mão',
                7 => 'Tí', 8 => 'Mùi', 9 => 'Dậu', 10 => 'Hợi', 11 => 'Sửu', 12 => 'Mão']],
        'nguyettai' => ['ten' => 'Nguyệt tài',
            'tinhchat' => 'Tốt cho việc cầu tài lộc, khai trương, xuất hành, di chuyển, giao dịch.',
            'thutu' => [1 => 'Ngọ', 2 => 'Tỵ', 3 => 'Tỵ', 4 => 'Mùi', 5 => 'Dậu', 6 => 'Hợi',
                7 => 'Ngọ', 8 => 'Tỵ', 9 => 'Tỵ', 10 => 'Mùi', 11 => 'Dậu', 12 => 'Hợi']],
        'nguyetan' => ['ten' => 'Nguyệt Ân',
            'tinhchat' => 'Mọi việc đều tốt',
            'thutu' => [1 => 'Bính', 2 => 'Đinh', 3 => 'Canh', 4 => 'Kỷ', 5 => 'Mậu', 6 => 'Tân',
                7 => 'Nhâm', 8 => 'Quý', 9 => 'Canh', 10 => 'Ất', 11 => 'Giáp', 12 => 'Tân']],
        'thienkhong' => ['ten' => 'Nguyệt Không',
            'tinhchat' => 'Nên trù mưu kế, dâng biểu chương.',
            'thutu' => [1 => 'Nhâm', 2 => 'Canh', 3 => 'Bính', 4 => 'Giáp', 5 => 'Nhâm', 6 => 'Canh',
                7 => 'Bính', 8 => 'Giáp', 9 => 'Nhâm', 10 => 'Canh', 11 => 'Bính', 12 => 'Giáp']],
        'minhtinh' => ['ten' => 'Minh tinh (trùng với Thiên lao Hắc Đạo - xấu)',
            'tinhchat' => 'Mọi việc đều tốt',
            'thutu' => [1 => 'Thân', 2 => 'Tuất', 3 => 'Tí', 4 => 'Dần', 5 => 'Thìn', 6 => 'Ngọ',
                7 => 'Thân', 8 => 'Tuất', 9 => 'Tí', 10 => 'Dần', 11 => 'Thìn', 12 => 'Ngọ']],
        'thanhtam' => ['ten' => 'Thánh tâm',
            'tinhchat' => 'Tốt mọi việc, nhất là cầu phúc, tế tự.',
            'thutu' => [1 => 'Hợi', 2 => 'Tỵ', 3 => 'Tỵ', 4 => 'Ngọ', 5 => 'Sửu', 6 => 'Mùi',
                7 => 'Dần', 8 => 'Thân', 9 => 'Mão', 10 => 'Dậu', 11 => 'Thìn', 12 => 'Tuất']],
        'nguphu' => ['ten' => 'Ngũ phú',
            'tinhchat' => 'Là ngày Thần Phú thịnh, ngày này nên bắt đầu một công việc mới, một dự định mới, rất nên cải tạo, động thổ, kinh thương cầu tài.',
            'thutu' => [1 => 'Hợi', 2 => 'Dần', 3 => 'Tỵ', 4 => 'Thân', 5 => 'Hợi', 6 => 'Dần',
                7 => 'Tỵ', 8 => 'Thân', 9 => 'Hợi', 10 => 'Dần', 11 => 'Tỵ', 12 => 'Thân']],
        'lockho' => ['ten' => 'Lộc khố',
            'tinhchat' => 'Tốt cho việc cầu tài, khai trương, giao dịch.',
            'thutu' => [1 => 'Thìn', 2 => 'Tỵ', 3 => 'Ngọ', 4 => 'Mùi', 5 => 'Thân', 6 => 'Dậu',
                7 => 'Tuất', 8 => 'Hợi', 9 => 'Tí', 10 => 'Sửu', 11 => 'Dần', 12 => 'Mão']],
        'phucsinh' => ['ten' => 'Phúc Sinh',
            'tinhchat' => 'Cầu phúc, lấy vợ, giả chồng',
            'thutu' => [1 => 'Dậu', 2 => 'Mão', 3 => 'Tuất', 4 => 'Thìn', 5 => 'Hợi', 6 => 'Tỵ',
                7 => 'Tí', 8 => 'Ngọ', 9 => 'Sửu', 10 => 'Mùi', 11 => 'Dần', 12 => 'Thân']],
        'catkhanh' => ['ten' => 'Cát Khánh',
            'tinhchat' => 'Mọi việc đều tốt',
            'thutu' => [1 => 'Dậu', 2 => 'Dần', 3 => 'Hợi', 4 => 'Thìn', 5 => 'Sửu', 6 => 'Ngọ',
                7 => 'Mão', 8 => 'Thân', 9 => 'Tỵ', 10 => 'Tuất', 11 => 'Mùi', 12 => 'Tí']],
        'amduc' => ['ten' => 'Âm Đức',
            'tinhchat' => 'Làm việc tốt cho mọi người, nhân ái, giải oan, sắp xếp người chính trực.',
            'thutu' => [1 => 'Dậu', 2 => 'Mùi', 3 => 'Tỵ', 4 => 'Mão', 5 => 'Sửu', 6 => 'Hợi',
                7 => 'Dậu', 8 => 'Mùi', 9 => 'Tỵ', 10 => 'Mão', 11 => 'Sửu', 12 => 'Hợi']],
        'uvitinh' => ['ten' => 'U Vi tinh',
            'tinhchat' => 'Mọi việc đều tốt',
            'thutu' => [1 => 'Hợi', 2 => 'Thìn', 3 => 'Sửu', 4 => 'Ngọ', 5 => 'Mão', 6 => 'Thân',
                7 => 'Tỵ', 8 => 'Tuất', 9 => 'Mùi', 10 => 'Tí', 11 => 'Dậu', 12 => 'Dần']],
        'manductinh' => ['ten' => 'Mãn đức tinh',
            'tinhchat' => 'Mọi việc đều tốt',
            'thutu' => [1 => 'Dần', 2 => 'Mùi', 3 => 'Thìn', 4 => 'Dậu', 5 => 'Ngọ', 6 => 'Hợi',
                7 => 'Thân', 8 => 'Sửu', 9 => 'Tuất', 10 => 'Mão', 11 => 'Tỵ', 12 => 'Tỵ']],
        'kinhtam' => ['ten' => 'Kính Tâm',
            'tinhchat' => 'Tốt đối với tang lễ.',
            'thutu' => [1 => 'Mùi', 2 => 'Sửu', 3 => 'Thân', 4 => 'Dần', 5 => 'Dậu', 6 => 'Mão',
                7 => 'Tuất', 8 => 'Thìn', 9 => 'Hợi', 10 => 'Tỵ', 11 => 'Tỵ', 12 => 'Ngọ']],
        'tuehop' => ['ten' => 'Tuế hợp',
            'tinhchat' => 'Mọi việc đều tốt',
            'thutu' => [1 => 'Sửu', 2 => 'Tí', 3 => 'Hợi', 4 => 'Tuất', 5 => 'Dậu', 6 => 'Thân',
                7 => 'Mùi', 8 => 'Ngọ', 9 => 'Tỵ', 10 => 'Thìn', 11 => 'Mão', 12 => 'Dần']],
        'nguyetgiai' => ['ten' => 'Nguyệt giải',
            'tinhchat' => 'Mọi việc đều tốt',
            'thutu' => [1 => 'Thân', 2 => 'Thân', 3 => 'Dậu', 4 => 'Dậu', 5 => 'Tuất', 6 => 'Tuất',
                7 => 'Hợi', 8 => 'Hợi', 9 => 'Ngọ', 10 => 'Ngọ', 11 => 'Mùi', 12 => 'Mùi']],
        'quannhat' => ['ten' => 'Quan nhật',
            'tinhchat' => 'Nên làm các việc lớn như thăng quan, tiến chức, tặng thưởng.',
            'thutu' => [1 => 'Mão', 2 => 'Mão', 3 => 'Mão', 4 => 'Ngọ', 5 => 'Ngọ', 6 => 'Ngọ',
                7 => 'Dậu', 8 => 'Dậu', 9 => 'Dậu', 10 => 'Tí', 11 => 'Tí', 12 => 'Tí']],
        'hoatdieu' => ['ten' => 'Hoạt điệu',
            'tinhchat' => 'Nên làm các việc lớn như thăng quan, tiến chức, tặng thưởng.',
            'thutu' => [1 => 'Tỵ', 2 => 'Tuất', 3 => 'Mùi', 4 => 'Tí', 5 => 'Dậu', 6 => 'Dần',
                7 => 'Hợi', 8 => 'Thìn', 9 => 'Sửu', 10 => 'Ngọ', 11 => 'Mão', 12 => 'Thân']],
        'giaithan' => ['ten' => 'Giải thần',
            'tinhchat' => 'Tốt cho việc tế tự, tố tụng, giải oan (trừ được các sao xấu).',
            'thutu' => [1 => 'Thân', 2 => 'Thân', 3 => 'Tuất', 4 => 'Tuất', 5 => 'Tí', 6 => 'Tí',
                7 => 'Dần', 8 => 'Dần', 9 => 'Thìn', 10 => 'Thìn', 11 => 'Ngọ', 12 => 'Ngọ']],
        'phoho' => ['ten' => 'Phổ hộ (Hội hộ)',
            'tinhchat' => 'Là thần của thần che chở, nên cần cầu cúng, tìm thầy ngừa bệnh.',
            'thutu' => [1 => 'Thân', 2 => 'Dần', 3 => 'Dậu', 4 => 'Mão', 5 => 'Tuất', 6 => 'Thìn',
                7 => 'Hợi', 8 => 'Tỵ', 9 => 'Tí', 10 => 'Ngọ', 11 => 'Sửu', 12 => 'Mùi']],
        'ichhau' => ['ten' => 'Ích hậu',
            'tinhchat' => 'Là Phúc thần trong tháng, nên tu tạo nhà cửa, làm lễ cưới, an buồng sản phụ.',
            'thutu' => [1 => 'Tí', 2 => 'Ngọ', 3 => 'Sửu', 4 => 'Mùi', 5 => 'Dần', 6 => 'Thân',
                7 => 'Mão', 8 => 'Dậu', 9 => 'Thìn', 10 => 'Tuất', 11 => 'Tỵ', 12 => 'Hợi']],
        'tucthe' => ['ten' => 'Tục Thế',
            'tinhchat' => 'Là thiện thần trong tháng, nên định hôn nhân, hòa thuận với mọi người trong gia đình, dòng tộc, lễ tạ thần linh, cầu người nối dỗi.',
            'thutu' => [1 => 'Sửu', 2 => 'Mùi', 3 => 'Dần', 4 => 'Thân', 5 => 'Mão', 6 => 'Dậu',
                7 => 'Thìn', 8 => 'Tuất', 9 => 'Tỵ', 10 => 'Hợi', 11 => 'Ngọ', 12 => 'Tí']],
        'yeuyen' => ['ten' => 'Yếu Yên (Yến An)',
            'tinhchat' => 'Là Cát Thần trong tháng, nên vỗ về an ủi nhân viên dưới cấp, sửa sang lại nhà cửa, nơi làm việc.',
            'thutu' => [1 => 'Dần', 2 => 'Thân', 3 => 'Mão', 4 => 'Dậu', 5 => 'Thìn', 6 => 'Tuất',
                7 => 'Tỵ', 8 => 'Hợi', 9 => 'Ngọ', 10 => 'Tí', 11 => 'Mùi', 12 => 'Sửu']],
        'dichma' => ['ten' => 'Dịch mã',
            'tinhchat' => 'Phong tặng, ra mệnh lệnh, quyết định, phải đi xa, di chyển.',
            'thutu' => [1 => 'Thân', 2 => 'Tỵ', 3 => 'Dần', 4 => 'Hợi', 5 => 'Thân', 6 => 'Tỵ',
                7 => 'Dần', 8 => 'Hợi', 9 => 'Thân', 10 => 'Tỵ', 11 => 'Dần', 12 => 'Hợi']],
        'tamhop' => ['ten' => 'Tam Hợp',
            'tinhchat' => 'Mọi việc đều tốt',
            'thutu' => [1 => 'Ngọ', 2 => 'Mùi', 3 => 'Thân', 4 => 'Dậu', 5 => 'Tuất', 6 => 'Hợi',
                7 => 'Tí', 8 => 'Sửu', 9 => 'Dần', 10 => 'Mão', 11 => 'Thìn', 12 => 'Tỵ']],
        'tamhop2' => ['ten' => 'Tam hợp',
            'tinhchat' => 'Mọi việc đều tốt',
            'thutu' => [1 => 'Tuất', 2 => 'Hợi', 3 => 'Tí', 4 => 'Sửu', 5 => 'Dần', 6 => 'Mão',
                7 => 'Thìn', 8 => 'Tỵ', 9 => 'Ngọ', 10 => 'Mùi', 11 => 'Thân', 12 => 'Dậu']],
        'luchop' => ['ten' => 'Lục hợp',
            'tinhchat' => 'Mọi việc đều tốt',
            'thutu' => [1 => 'Hợi', 2 => 'Tuất', 3 => 'Dậu', 4 => 'Thân', 5 => 'Mùi', 6 => 'Ngọ',
                7 => 'Tỵ', 8 => 'Thìn', 9 => 'Mão', 10 => 'Dần', 11 => 'Sửu', 12 => 'Tí']],
        'mauthuong1' => ['ten' => 'Mẫu thương',
            'tinhchat' => 'Tốt về cầu tài, trồng trọt, chăn nuôi gia súc.',
            'thutu' => [1 => 'Hợi', 2 => 'Hợi', 3 => 'Hợi', 4 => 'Dần', 5 => 'Dần', 6 => 'Dần',
                7 => 'Thìn', 8 => 'Thìn', 9 => 'Thìn', 10 => 'Thân', 11 => 'Thân', 12 => 'Thân']],
        'mauthuong2' => ['ten' => 'Mẫu thương',
            'tinhchat' => 'Tốt về cầu tài, trồng trọt, chăn nuôi gia súc.',
            'thutu' => [1 => 'Tí', 2 => 'Tí', 3 => 'Tí', 4 => 'Mão', 5 => 'Mão', 6 => 'Mão',
                7 => 'Sửu', 8 => 'Sửu', 9 => 'Sửu', 10 => 'Dậu', 11 => 'Dậu', 12 => 'Dậu']],
        'mauthuong3' => ['ten' => 'Mẫu thương',
            'tinhchat' => 'Tốt về cầu tài, trồng trọt, chăn nuôi gia súc.',
            'thutu' => [1 => '', 2 => '', 3 => '', 4 => '', 5 => '', 6 => '',
                7 => 'Tuất', 8 => 'Tuất', 9 => 'Tuất', 10 => '', 11 => '', 12 => '']],
        'mauthuong4' => ['ten' => 'Mẫu thương',
            'tinhchat' => 'Tốt về cầu tài, trồng trọt, chăn nuôi gia súc.',
            'thutu' => [1 => '', 2 => '', 3 => '', 4 => '', 5 => '', 6 => '',
                7 => 'Mùi', 8 => 'Mùi', 9 => 'Mùi', 10 => '', 11 => '', 12 => '']],
        'phuchau' => ['ten' => 'Phúc hậu',
            'tinhchat' => 'Tốt về cầu tài, khai trương.',
            'thutu' => [1 => 'Dần', 2 => 'Dần', 3 => 'Dần', 4 => 'Tỵ', 5 => 'Tỵ', 6 => 'Tỵ',
                7 => 'Thân', 8 => 'Thân', 9 => 'Thân', 10 => 'Hợi', 11 => 'Hợi', 12 => 'Hợi']],
        'daihongsa' => ['ten' => 'Đại Hồng Sa',
            'tinhchat' => 'Mọi việc đều tốt',
            'thutu' => [1 => 'Tí', 2 => 'Tí', 3 => 'Tí', 4 => 'Thìn', 5 => 'Thìn', 6 => 'Thìn',
                7 => 'Ngọ', 8 => 'Ngọ', 9 => 'Ngọ', 10 => 'Thân', 11 => 'Thân', 12 => 'Thân']],
        'daihongsa2' => ['ten' => 'Đại Hồng Sa',
            'tinhchat' => 'Mọi việc đều tốt',
            'thutu' => [1 => 'Tuất', 2 => 'Tuất', 3 => 'Tuất', 4 => 'Tỵ', 5 => 'Tỵ', 6 => 'Tỵ',
                7 => 'Mùi', 8 => 'Mùi', 9 => 'Mùi', 10 => 'Tuất', 11 => 'Tuất', 12 => 'Tuất']],
        'dannhatthoiduc' => ['ten' => 'Dân nhật, thời đức',
            'tinhchat' => 'Nên động thổ xây dựng và chữa các việc vặt, đồ dùng hàng ngày.',
            'thutu' => [1 => 'Ngọ', 2 => 'Ngọ', 3 => 'Ngọ', 4 => 'Dậu', 5 => 'Dậu', 6 => 'Dậu',
                7 => 'Tí', 8 => 'Tí', 9 => 'Tí', 10 => 'Mão', 11 => 'Mão', 12 => 'Mão']],
        'hoangan' => ['ten' => 'Hoàng Ân',
            'tinhchat' => 'Mọi việc đều tốt',
            'thutu' => [1 => 'Tuất', 2 => 'Sửu', 3 => 'Dần', 4 => 'Tỵ', 5 => 'Dậu', 6 => 'Mão',
                7 => 'Tí', 8 => 'Ngọ', 9 => 'Hợi', 10 => 'Thìn', 11 => 'Thân', 12 => 'Mùi']],
        'thanhlong' => ['ten' => 'Thanh Long',
            'tinhchat' => 'Hoàng Đạo - Tốt cho mọi việc.',
            'thutu' => [1 => 'Tí', 2 => 'Dần', 3 => 'Thìn', 4 => 'Ngọ', 5 => 'Thân', 6 => 'Tuất',
                7 => 'Tí', 8 => 'Dần', 9 => 'Thìn', 10 => 'Ngọ', 11 => 'Thân', 12 => 'Tuất']],
        'minhduong' => ['ten' => 'Minh đường',
            'tinhchat' => 'Hoàng Đạo - Tốt cho mọi việc.',
            'thutu' => [1 => 'Sửu', 2 => 'Mão', 3 => 'Tỵ', 4 => 'Mùi', 5 => 'Dậu', 6 => 'Hợi',
                7 => 'Sửu', 8 => 'Mão', 9 => 'Tỵ', 10 => 'Mùi', 11 => 'Dậu', 12 => 'Hợi']],
        'kimduong' => ['ten' => 'Kim đường',
            'tinhchat' => 'Hoàng Đạo - Tốt cho mọi việc.',
            'thutu' => [1 => 'Tỵ', 2 => 'Mùi', 3 => 'Dậu', 4 => 'Hợi', 5 => 'Sửu', 6 => 'Mão',
                7 => 'Tỵ', 8 => 'Mùi', 9 => 'Dậu', 10 => 'Hợi', 11 => 'Sửu', 12 => 'Mão']],
        'ngocduong' => ['ten' => 'Ngọc đường',
            'tinhchat' => 'Hoàng Đạo - Tốt cho mọi việc.',
            'thutu' => [1 => 'Mùi', 2 => 'Dậu', 3 => 'Hợi', 4 => 'Sửu', 5 => 'Mão', 6 => 'Tỵ',
                7 => 'Mùi', 8 => 'Dậu', 9 => 'Hợi', 10 => 'Sửu', 11 => 'Mão', 12 => 'Tỵ']],
        'thieny' => ['ten' => 'Thiên Y',
            'tinhchat' => 'Thiên Y là thầy mo chữa bệnh của Trời, ngày này nên đi xin, mua thuốc, phòng ngừa bệnh tật, tìm thầy phụng tế.',
            'thutu' => [1 => 'Sửu', 2 => 'Dần', 3 => 'Mão', 4 => 'Thìn', 5 => 'Tỵ', 6 => 'Ngọ',
                7 => 'Mùi', 8 => 'Thân', 9 => 'Dậu', 10 => 'Tuất', 11 => 'Hợi', 12 => 'Ngọ']],
    ];
    public static $saoXau = [
        'thiencuong' => ['ten' => 'Thiên Cương (hay Diệt Môn)',
            'tinhchat' => 'Kiêng kỵ mọi việc không nên làm.',
            'thutu' => [
                1 => 'Tỵ',
                2 => 'Tí',
                3 => 'Mùi',
                4 => 'Dần',
                5 => 'Dậu',
                6 => 'Thìn',
                7 => 'Hợi',
                8 => 'Ngọ',
                9 => 'Sửu',
                10 => 'Thân',
                11 => 'Mão',
                12 => 'Tuất']],
        'thienlai' => ['ten' => 'Thiên Lại',
            'tinhchat' => 'Mọi việc đều xấu',
            'thutu' => [
                1 => 'Dậu',
                2 => 'Ngọ',
                3 => 'Mão',
                4 => 'Tí',
                5 => 'Dậu',
                6 => 'Ngọ',
                7 => 'Mão',
                8 => 'Tí',
                9 => 'Dậu',
                10 => 'Ngọ',
                11 => 'Mão',
                12 => 'Tí']],
        'thiennguc' => ['ten' => 'Thiên Ngục',
            'tinhchat' => 'Mọi việc đều xấu',
            'thutu' => [
                1 => 'Tí',
                2 => 'Mão',
                3 => 'Ngọ',
                4 => 'Dậu',
                5 => 'Tí',
                6 => 'Mão',
                7 => 'Ngọ',
                8 => 'Dậu',
                9 => 'Tí',
                10 => 'Mão',
                11 => 'Ngọ',
                12 => 'Dậu']],
        'thienhoa' => ['ten' => 'Thiên Hoả',
            'tinhchat' => 'Xấu về lợp nhà.',
            'thutu' => [
                1 => '',
                2 => '',
                3 => '',
                4 => '',
                5 => '',
                6 => '',
                7 => '',
                8 => '',
                9 => '',
                10 => '',
                11 => '',
                12 => '']],
        'tieuhongsa' => ['ten' => 'Tiểu Hồng Sa',
            'tinhchat' => 'Mọi việc đều xấu',
            'thutu' => [1 => 'Tí', 2 => 'Dậu', 3 => 'Sửu', 4 => 'Tỵ', 5 => 'Dậu', 6 => 'Sửu',
                7 => 'Tỵ', 8 => 'Dậu', 9 => 'Sửu', 10 => 'Tỵ', 11 => 'Dậu', 12 => 'Sửu']],
        'daihao' => ['ten' => 'Đại Hao (Tử khí, quan phú)',
            'tinhchat' => 'Mọi việc đều xấu',
            'thutu' => [1 => 'Ngọ', 2 => 'Mùi', 3 => 'Thân', 4 => 'Dậu', 5 => 'Tuất', 6 => 'Hợi',
                7 => 'Tí', 8 => 'Sửu', 9 => 'Dần', 10 => 'Mão', 11 => 'Thìn', 12 => 'Tỵ']],
        'tieuhao' => ['ten' => 'Tiểu Hao',
            'tinhchat' => 'Xấu về kinh doanh, cầu tài.',
            'thutu' => [1 => 'Tỵ', 2 => 'Ngọ', 3 => 'Mùi', 4 => 'Thân', 5 => 'Dậu', 6 => 'Tuất',
                7 => 'Hợi', 8 => 'Tí', 9 => 'Sửu', 10 => 'Dần', 11 => 'Mão', 12 => 'Thìn']],
        'nguyetpha' => ['ten' => 'Nguyệt phá',
            'tinhchat' => 'Xấu về xây dựng nhà cửa.',
            'thutu' => [1 => 'Thân', 2 => 'Dậu', 3 => 'Tuất', 4 => 'Hợi', 5 => 'Tí', 6 => 'Sửu',
                7 => 'Dần', 8 => 'Mão', 9 => 'Thìn', 10 => 'Tỵ', 11 => 'Ngọ', 12 => 'Mùi']],
        'kiepsat' => ['ten' => 'Kiếp sát',
            'tinhchat' => 'Kỵ xuất hành, kết hôn, an táng, xây dựng.',
            'thutu' => [1 => 'Hợi', 2 => 'Thân', 3 => 'Tỵ', 4 => 'Dần', 5 => 'Hợi', 6 => 'Thân',
                7 => 'Tỵ', 8 => 'Dần', 9 => 'Hợi', 10 => 'Thân', 11 => 'Tỵ', 12 => 'Dần']],
        'diapha' => ['ten' => 'Địa phá',
            'tinhchat' => 'Kỵ xây dựng.',
            'thutu' => [1 => 'Hợi', 2 => 'Tí', 3 => 'Sửu', 4 => 'Dần', 5 => 'Mão', 6 => 'Thìn',
                7 => 'Tỵ', 8 => 'Ngọ', 9 => 'Mùi', 10 => 'Thân', 11 => 'Dậu', 12 => 'Tuất']],
        'thophu' => ['ten' => 'Thổ phủ',
            'tinhchat' => 'Kỵ xây dựng, động thổ.',
            'thutu' => [1 => 'Dần', 2 => 'Mão', 3 => 'Thìn', 4 => 'Tỵ', 5 => 'Ngọ', 6 => 'Mùi',
                7 => 'Thân', 8 => 'Dậu', 9 => 'Tuất', 10 => 'Hợi', 11 => 'Tí', 12 => 'Sửu']],
        'thoon' => ['ten' => 'Thổ ôn (thiên cẩu)',
            'tinhchat' => 'Kỵ xây dựng, đào ao, đào giếng, xấu về tế tự.',
            'thutu' => [1 => 'Thìn', 2 => 'Tỵ', 3 => 'Ngọ', 4 => 'Mùi', 5 => 'Thân', 6 => 'Dậu',
                7 => 'Tuất', 8 => 'Hợi', 9 => 'Tí', 10 => 'Sửu', 11 => 'Dần', 12 => 'Mão']],
        'thienon' => ['ten' => 'Thiên ôn',
            'tinhchat' => 'Kỵ xây dựng.',
            'thutu' => [1 => 'Mùi', 2 => 'Tuất', 3 => 'Thìn', 4 => 'Dần', 5 => 'Ngọ', 6 => 'Tí',
                7 => 'Dậu', 8 => 'Thân', 9 => 'Tỵ', 10 => 'Hợi', 11 => 'Tí', 12 => 'Mão']],
        'thutu' => ['ten' => 'Thụ tử',
            'tinhchat' => 'Việc săn bắt tốt còn lại mọi việc đều xấu',
            'thutu' => [
                1 => 'Tuất',
                2 => 'Thìn',
                3 => 'Hợi',
                4 => 'Tỵ',
                5 => 'TÝ',
                6 => 'Ngọ',
                7 => 'Sửu',
                8 => 'Mùi',
                9 => 'Dần',
                10 => 'Thân',
                11 => 'Mão',
                12 => 'Dậu']],
        'hoangvu' => ['ten' => 'Hoang vu',
            'tinhchat' => 'Mọi việc đều xấu',
            'thutu' => [
                1 => 'Tỵ',
                2 => 'Tỵ',
                3 => 'Tỵ',
                4 => 'Thân',
                5 => 'Thân',
                6 => 'Thân',
                7 => 'Hợi',
                8 => 'Hợi',
                9 => 'Hợi',
                10 => 'Dần',
                11 => 'Dần',
                12 => 'Dần']],
        'hoangvu2' => ['ten' => 'Hoang vu',
            'tinhchat' => 'Mọi việc đều xấu',
            'thutu' => [
                1 => 'Dậu',
                2 => 'Dậu',
                3 => 'Dậu',
                4 => 'Tí',
                5 => 'Tí',
                6 => 'Tí',
                7 => 'Mão',
                8 => 'Mão',
                9 => 'Mão',
                10 => 'Ngọ',
                11 => 'Ngọ',
                12 => 'Ngọ']],
        'hoangvu3' => ['ten' => 'Hoang vu',
            'tinhchat' => 'Mọi việc đều xấu',
            'thutu' => [
                1 => 'Sửu',
                2 => 'Sửu',
                3 => 'Sửu',
                4 => 'Thìn',
                5 => 'Thìn',
                6 => 'Thìn',
                7 => 'Mùi',
                8 => 'Mùi',
                9 => 'Mùi',
                10 => 'Tuất',
                11 => 'Tuất',
                12 => 'Tuất']],
        'thientac' => ['ten' => 'Thiên tặc',
            'tinhchat' => 'Xấu đối với khởi tạo, động thổ, nhập trạch, khai trương.',
            'thutu' => [
                1 => 'Thìn',
                2 => 'Dậu',
                3 => 'Thân',
                4 => 'Mùi',
                5 => 'Tí',
                6 => 'Tỵ',
                7 => 'Tuất',
                8 => 'Mão',
                9 => 'Thân',
                10 => 'Sửu',
                11 => 'Ngọ',
                12 => 'Hợi']],
        'diatac' => ['ten' => 'Địa Tặc',
            'tinhchat' => 'Xấu đối với khởi tạo, an táng, động thổ, xuất hành.',
            'thutu' => [
                1 => 'Sửu',
                2 => 'Tí',
                3 => 'Hợi',
                4 => 'Tuất',
                5 => 'Dậu',
                6 => 'Thân',
                7 => 'Mùi',
                8 => 'Ngọ',
                9 => 'Tỵ',
                10 => 'Thìn',
                11 => 'Mão',
                12 => 'Dần']],
        'hoatai' => ['ten' => 'Hoả tai',
            'tinhchat' => 'Xấu đối với làm nhà, lợp nhà.',
            'thutu' => [
                1 => 'Sửu',
                2 => 'Mùi',
                3 => 'Dần',
                4 => 'Thân',
                5 => 'Mão',
                6 => 'Dậu',
                7 => 'Thìn',
                8 => 'Tuất',
                9 => 'Tỵ',
                10 => 'Hợi',
                11 => 'Ngọ',
                12 => 'Tí']],
        'nguyethoadochoa' => ['ten' => 'Nguyệt Hoả Độc Hoả',
            'tinhchat' => 'Xấu đối với lợp nhà, làm bếp.',
            'thutu' => [
                1 => 'Tỵ',
                2 => 'Thìn',
                3 => 'Mão',
                4 => 'Dần',
                5 => 'Sửu',
                6 => 'Tí',
                7 => 'Hợi',
                8 => 'Tuất',
                9 => 'Dậu',
                10 => 'Thân',
                11 => 'Mùi',
                12 => 'Ngọ']],
        'nguyetyemdaihoa' => ['ten' => 'Nguyệt Yếm đại hoạ',
            'tinhchat' => 'Xấu đối với xuất hành, kết hôn',
            'thutu' => [
                1 => 'Tuất',
                2 => 'Dậu',
                3 => 'Thân',
                4 => 'Mùi',
                5 => 'Ngọ',
                6 => 'Tỵ',
                7 => 'Thìn',
                8 => 'Mão',
                9 => 'Dần',
                10 => 'Sửu',
                11 => 'Tí',
                12 => 'Hợi']],
        'nguyethu' => ['ten' => 'Nguyệt Hư (Nguyệt Sát)',
            'tinhchat' => 'Xấu đối với việc kết hôn, mở cửa, mở hàng.',
            'thutu' => [
                1 => 'Sửu',
                2 => 'Tuất',
                3 => 'Mùi',
                4 => 'Thìn',
                5 => 'Sửu',
                6 => 'Tuất',
                7 => 'Mùi',
                8 => 'Thìn',
                9 => 'Sửu',
                10 => 'Tuất',
                11 => 'Mùi',
                12 => 'Thìn']],
        'hoangsa' => ['ten' => 'Hoàng Sa',
            'tinhchat' => 'Xấu đối với xuất hành.',
            'thutu' => [
                1 => 'Ngọ',
                2 => 'Dần',
                3 => 'Tí',
                4 => 'Ngọ',
                5 => 'Dần',
                6 => 'Tí',
                7 => 'Ngọ',
                8 => 'Dần',
                9 => 'Tí',
                10 => 'Ngọ',
                11 => 'Dần',
                12 => 'Tí']],
        'lucbatthanh' => ['ten' => 'Lục Bất thành',
            'tinhchat' => 'Xấu đối với xây dựng.',
            'thutu' => [
                1 => 'Dần',
                2 => 'Ngọ',
                3 => 'Tuất',
                4 => 'Tỵ',
                5 => 'Dậu',
                6 => 'Sửu',
                7 => 'Thân',
                8 => 'Tí',
                9 => 'Thìn',
                10 => 'Hợi',
                11 => 'Mão',
                12 => 'Mùi']],
        'nhancach' => ['ten' => 'Nhân Cách',
            'tinhchat' => 'Kiêng lấy vợ, lấy chồng, không nuôi thêm người giúp việc.',
            'thutu' => [
                1 => 'Dậu',
                2 => 'Mùi',
                3 => 'Tỵ',
                4 => 'Mão',
                5 => 'Sửu',
                6 => 'Hợi',
                7 => 'Dậu',
                8 => 'Mùi',
                9 => 'Tỵ',
                10 => 'Mão',
                11 => 'Sửu',
                12 => 'Hợi']],
        'thancach' => ['ten' => 'Thần cách',
            'tinhchat' => 'Kiêng lễ bái cầu thần linh.',
            'thutu' => [
                1 => 'Tỵ',
                2 => 'Mão',
                3 => 'Sửu',
                4 => 'Hợi',
                5 => 'Dậu',
                6 => 'Mùi',
                7 => 'Tỵ',
                8 => 'Mão',
                9 => 'Sửu',
                10 => 'Hợi',
                11 => 'Dậu',
                12 => 'Mùi']],
        'phimasat' => ['ten' => 'Phi Ma sát (Tai sát)',
            'tinhchat' => 'Kỵ lấy vợ, gả chồng, nhập trạch.',
            'thutu' => [
                1 => 'Tí',
                2 => 'Dậu',
                3 => 'Ngọ',
                4 => 'Mão',
                5 => 'Tí',
                6 => 'Dậu',
                7 => 'Ngọ',
                8 => 'Mão',
                9 => 'Tí',
                10 => 'Dậu',
                11 => 'Ngọ',
                12 => 'Mão']],
        'nguquy' => ['ten' => 'Ngũ Quỹ',
            'tinhchat' => 'Kỵ xuất hành.',
            'thutu' => [
                1 => 'Ngọ',
                2 => 'Dần',
                3 => 'Thìn',
                4 => 'Dậu',
                5 => 'Mão',
                6 => 'Thân',
                7 => 'Sửu',
                8 => 'Tỵ',
                9 => 'Tí',
                10 => 'Hợi',
                11 => 'Mùi',
                12 => 'Tuất']],
        'bangtieungoaham' => ['ten' => 'Băng tiêu ngoạ hãm',
            'tinhchat' => 'Mọi việc đều xấu',
            'thutu' => [
                1 => 'Tỵ',
                2 => 'Tí',
                3 => 'Sửu',
                4 => 'Dần',
                5 => 'Mão',
                6 => 'Tuất',
                7 => 'Hợi',
                8 => 'Ngọ',
                9 => 'Mùi',
                10 => 'Thân',
                11 => 'Dậu',
                12 => 'Thìn']],
        'hakhoicaugiao' => ['ten' => 'Hà khôi Cẩu Giảo',
            'tinhchat' => 'Kỵ khởi công xây nhà cửa, xấu mọi việc',
            'thutu' => [
                1 => 'Hợi',
                2 => 'Ngọ',
                3 => 'Sửu',
                4 => 'Thân',
                5 => 'Mão',
                6 => 'Tuất',
                7 => 'Tỵ',
                8 => 'Tí',
                9 => 'Mùi',
                10 => 'Dần',
                11 => 'Dậu',
                12 => 'Thìn']],
        'vangvong' => ['ten' => 'Vãng vong (Thổ kỵ)',
            'tinhchat' => 'Vãng là đi, vong là vô, kỵ việc phong quan tiến chức, đi xa quay về nhà, đi làm việc nơi xa để ký kết hợp đồng, mở rộng, tìm thầy thuốc.',
            'thutu' => [
                1 => 'Dần',
                2 => 'Tỵ',
                3 => 'Thân',
                4 => 'Hợi',
                5 => 'Mão',
                6 => 'Ngọ',
                7 => 'Dậu',
                8 => 'Tí',
                9 => 'Thìn',
                10 => 'Mùi',
                11 => 'Tuất',
                12 => 'Sửu']],
        'cuukhong' => ['ten' => 'Cửu không',
            'tinhchat' => 'Kỵ xuất hành, cầu tài, khai trương.',
            'thutu' => [
                1 => 'Thìn',
                2 => 'Sửu',
                3 => 'Tuất',
                4 => 'Mùi',
                5 => 'Mão',
                6 => 'Tí',
                7 => 'Dậu',
                8 => 'Ngọ',
                9 => 'Dần',
                10 => 'Hợi',
                11 => 'Thân',
                12 => 'Tỵ']],
        'trungtang' => ['ten' => 'Trùng Tang',
            'tinhchat' => 'Kiêng kết hôn, xuất hành, xây nhà, mồ mả.',
            'thutu' => [
                1 => 'Giáp',
                2 => 'Ất',
                3 => 'Kỷ',
                4 => 'Bính',
                5 => 'Đinh',
                6 => 'Kỷ',
                7 => 'Canh',
                8 => 'Tân',
                9 => 'Kỷ',
                10 => 'Nhâm',
                11 => 'Quý',
                12 => 'Kỷ']],
        'trungphuc' => ['ten' => 'Trùng phục',
            'tinhchat' => 'Kiêng kết hôn, xuất hành, xây nhà, mồ mả.',
            'thutu' => [
                1 => 'Canh',
                2 => 'Tân',
                3 => 'Kỷ',
                4 => 'Nhâm',
                5 => 'Quý',
                6 => 'Dậu',
                7 => 'Giáp',
                8 => 'Ất',
                9 => 'Mậu',
                10 => 'Bính',
                11 => 'Đinh',
                12 => 'Mậu']],
        'chutuochacdao' => ['ten' => 'Chu tước hắc đạo',
            'tinhchat' => 'Kỵ nhập trạch, khai trương.',
            'thutu' => [
                1 => 'Mão',
                2 => 'Tỵ',
                3 => 'Mùi',
                4 => 'Dậu',
                5 => 'Hợi',
                6 => 'Sửu',
                7 => 'Mão',
                8 => 'Tỵ',
                9 => 'Mùi',
                10 => 'Dậu',
                11 => 'Hợi',
                12 => 'Sửu']],
        'bachho' => ['ten' => 'Bạch hổ (trùng ngày với Thiên giải -> sao tốt)',
            'tinhchat' => 'Kỵ mai táng.',
            'thutu' => [
                1 => 'Ngọ',
                2 => 'Thân',
                3 => 'Tuất',
                4 => 'Tí',
                5 => 'Dần',
                6 => 'Thìn',
                7 => 'Ngọ',
                8 => 'Thân',
                9 => 'Tuất',
                10 => 'Tí',
                11 => 'Dần',
                12 => 'Thìn']],
        'huyenvu' => ['ten' => 'Huyền Vũ',
            'tinhchat' => 'Kỵ mai táng.',
            'thutu' => [
                1 => 'Dậu',
                2 => 'Hợi',
                3 => 'Tí',
                4 => 'Mão',
                5 => 'Sửu',
                6 => 'Mùi',
                7 => 'Dậu',
                8 => 'Hợi',
                9 => 'Tí',
                10 => 'Mão',
                11 => 'Sửu',
                12 => 'Mùi']],
        'cautran' => ['ten' => 'Câu Trận',
            'tinhchat' => 'Kỵ mai táng.',
            'thutu' => [
                1 => 'Hợi',
                2 => 'Tỵ',
                3 => 'Mão',
                4 => 'Sửu',
                5 => 'Mùi',
                6 => 'Dậu',
                7 => 'Hợi',
                8 => 'Tỵ',
                9 => 'Mão',
                10 => 'Sửu',
                11 => 'Mùi',
                12 => 'Dậu']],
        'loicong' => ['ten' => 'Lôi công',
            'tinhchat' => 'Xấu với xây dựng nhà cửa.',
            'thutu' => [
                1 => 'Dần',
                2 => 'Hợi',
                3 => 'Tỵ',
                4 => 'Thân',
                5 => 'Dần',
                6 => 'Hợi',
                7 => 'Tỵ',
                8 => 'Thân',
                9 => 'Dần',
                10 => 'Hợi',
                11 => 'Tỵ',
                12 => 'Thân']],
        'cothan' => ['ten' => 'Cô thần',
            'tinhchat' => 'Xấu với kết hôn',
            'thutu' => [
                1 => 'Tuất',
                2 => 'Hợi',
                3 => 'Tí',
                4 => 'Sửu',
                5 => 'Dần',
                6 => 'Mão',
                7 => 'Thìn',
                8 => 'Tỵ',
                9 => 'Ngọ',
                10 => 'Mùi',
                11 => 'Thân',
                12 => 'Dậu']],
        'quatu' => ['ten' => 'Quả tú',
            'tinhchat' => 'Xấu với kết hôn',
            'thutu' => [
                1 => 'Thìn',
                2 => 'Tỵ',
                3 => 'Ngọ',
                4 => 'Mùi',
                5 => 'Thân',
                6 => 'Dậu',
                7 => 'Tuất',
                8 => 'Hợi',
                9 => 'Tí',
                10 => 'Sửu',
                11 => 'Dần',
                12 => 'Mão']],
        'satchu' => ['ten' => 'Sát chủ',
            'tinhchat' => 'Mọi việc đều xấu',
            'thutu' => [
                1 => 'Tỵ',
                2 => 'Tí',
                3 => 'Mùi',
                4 => 'Mão',
                5 => 'Thân',
                6 => 'Tuất',
                7 => 'Sửu',
                8 => 'Hợi',
                9 => 'Ngọ',
                10 => 'Dậu',
                11 => 'Dần',
                12 => 'Thìn']],
        'nguyethinh' => ['ten' => 'Nguyệt Hình',
            'tinhchat' => 'Mọi việc đều xấu',
            'thutu' => [
                1 => 'Tỵ',
                2 => 'Tí',
                3 => 'Thìn',
                4 => 'Thân',
                5 => 'Ngọ',
                6 => 'Sửu',
                7 => 'Dần',
                8 => 'Dậu',
                9 => 'Mùi',
                10 => 'Hợi',
                11 => 'Mão',
                12 => 'Tuất']],
        'toichi' => ['ten' => 'Tội chỉ',
            'tinhchat' => 'Xấu với thờ cúng, kiện cáo.',
            'thutu' => [
                1 => 'Ngọ',
                2 => 'Tí',
                3 => 'Mùi',
                4 => 'Sửu',
                5 => 'Thân',
                6 => 'Dần',
                7 => 'Dậu',
                8 => 'Mão',
                9 => 'Tuất',
                10 => 'Thìn',
                11 => 'Hợi',
                12 => 'Tỵ']],
        'nguyetkienchuyensat' => ['ten' => 'Nguyệt Kiến chuyển sát',
            'tinhchat' => 'Kỵ động thổ.',
            'thutu' => [
                1 => 'Mão',
                2 => '',
                3 => '',
                4 => 'Ngọ',
                5 => '',
                6 => '',
                7 => 'Dậu',
                8 => '',
                9 => '',
                10 => 'Tí',
                11 => '',
                12 => '']],
        'thiendiachinhquyen' => ['ten' => 'Thiên địa  chính chuyển',
            'tinhchat' => 'Kỵ động thổ.',
            'thutu' => [
                1 => 'Quý Mão',
                2 => '',
                3 => '',
                4 => 'Bính Ngọ',
                5 => '',
                6 => '',
                7 => 'Đinh Dậu',
                8 => '',
                9 => '',
                10 => 'Canh Tí',
                11 => '',
                12 => '']],
        'thiendiachuyensat' => ['ten' => 'Thiên địa chuyển sát',
            'tinhchat' => 'Mọi việc đều xấu',
            'thutu' => [
                1 => 'Ất Mão',
                2 => '',
                3 => '',
                4 => 'Bính Ngọ',
                5 => '',
                6 => '',
                7 => 'Tân Dậu',
                8 => '',
                9 => '',
                10 => 'Nhâm Tí',
                11 => '',
                12 => '']],
        'lobansat' => ['ten' => 'Lỗ ban sát',
            'tinhchat' => 'Kỵ bắt đầu một công việc, công trình mới',
            'thutu' => [
                1 => 'Tí',
                2 => '',
                3 => '',
                4 => 'Mão',
                5 => '',
                6 => '',
                7 => 'Ngọ',
                8 => '',
                9 => '',
                10 => 'Dậu',
                11 => '',
                12 => '']],
        'phudaudat' => ['ten' => 'Phủ đầu dát',
            'tinhchat' => 'Kỵ bắt đầu một công việc, công trình mới',
            'thutu' => [
                1 => 'Thìn',
                2 => '',
                3 => '',
                4 => 'Mùi',
                5 => '',
                6 => '',
                7 => 'Dậu',
                8 => '',
                9 => '',
                10 => 'Tí',
                11 => '',
                12 => '']],
        'tamlang' => ['ten' => 'Tam tang',
            'tinhchat' => 'Kỵ bắt đầu công việc mới, kết hôn, an táng.',
            'thutu' => [
                1 => 'Thìn',
                2 => '',
                3 => '',
                4 => 'Mùi',
                5 => '',
                6 => '',
                7 => 'Tuất',
                8 => '',
                9 => '',
                10 => 'Sửu',
                11 => '',
                12 => '']],
        'nguhu' => ['ten' => 'Ngũ hư',
            'tinhchat' => 'Kỵ bắt đầu công việc mới, kết hôn, an táng.',
            'thutu' => [
                1 => 'Tí',
                2 => 'Dậu',
                3 => 'Sửu',
                4 => 'Thân',
                5 => 'Tí',
                6 => 'Thìn',
                7 => 'Hợi',
                8 => 'Mão',
                9 => 'Mùi',
                10 => 'Dần',
                11 => 'Ngọ',
                12 => 'Tuất']],
        'tuthoidaimo' => ['ten' => 'Tứ thời đại mộ',
            'tinhchat' => 'Kỵ an táng.',
            'thutu' => [
                1 => 'Ất Mùi',
                2 => '',
                3 => '',
                4 => 'Bính Tuất',
                5 => '',
                6 => '',
                7 => 'Tân Sửu',
                8 => '',
                9 => '',
                10 => 'Nhâm Thìn',
                11 => '',
                12 => '']],
        'thocam' => ['ten' => 'Thổ cẩm',
            'tinhchat' => 'Kỵ xây dựng, an táng.',
            'thutu' => [
                1 => 'Hợi',
                2 => '',
                3 => '',
                4 => 'Dần',
                5 => '',
                6 => '',
                7 => 'Tỵ',
                8 => '',
                9 => '',
                10 => 'Thân',
                11 => '',
                12 => '']],
        'lysang' => ['ten' => 'Ly sàng',
            'tinhchat' => 'Kỵ lấy vợ gả chồng',
            'thutu' => [
                1 => 'Dậu',
                2 => '',
                3 => '',
                4 => 'Dần,Ngọ',
                5 => '',
                6 => '',
                7 => 'Tuất',
                8 => '',
                9 => '',
                10 => 'Tỵ',
                11 => '',
                12 => '']],
        'tuthoicoqua' => ['ten' => 'Tứ thời cô quả',
            'tinhchat' => 'Kỵ lấy vợ gả chồng',
            'thutu' => [
                1 => 'Sửu',
                2 => '',
                3 => '',
                4 => 'Thìn',
                5 => '',
                6 => '',
                7 => 'Mùi',
                8 => '',
                9 => '',
                10 => 'Tuất',
                11 => '',
                12 => '']],
        'khongphong' => ['ten' => 'Không phòng',
            'tinhchat' => 'Kỵ lấy vợ gả chồng',
            'thutu' => [
                1 => 'Thìn',
                2 => 'Tỵ',
                3 => 'Tí',
                4 => 'Tuất',
                5 => 'Hợi',
                6 => 'Mùi',
                7 => 'Dần',
                8 => 'Mão',
                9 => 'Ngọ',
                10 => 'Thân',
                11 => 'Dậu',
                12 => 'Sửu']],
        'amthac' => ['ten' => 'Âm thác',
            'tinhchat' => 'Kiêng xuất hành, nhận công tác.',
            'thutu' => [
                1 => 'Canh Tuất',
                2 => 'Tân Dậu',
                3 => 'Canh Thân',
                4 => 'Đinh Mùi',
                5 => 'Bính Ngọ',
                6 => 'Đinh Tỵ',
                7 => 'Giáp Thìn',
                8 => 'Ất Mão',
                9 => 'Giáp Dần',
                10 => 'Quý Sửu',
                11 => 'Nhâm Tí',
                12 => 'Quý Hợi']],
        'duongthac' => ['ten' => 'Dương thác',
            'tinhchat' => 'Kiêng đi xa, hôn nhân, không di chuyển chỗ ở.',
            'thutu' => [
                1 => 'Giáp Dần',
                2 => 'Ất Mão',
                3 => 'Giáp Thìn',
                4 => 'Đinh Tỵ',
                5 => 'BÍnh Ngọ',
                6 => 'Đinh Mùi',
                7 => 'Canh Thân',
                8 => 'Tân Dậu',
                9 => 'Canh Tuất',
                10 => 'Quý Hợi',
                11 => 'Nhâm Tí',
                12 => 'Quý Sửu']],
        'quykhoc' => ['ten' => 'Quỷ khốc',
            'tinhchat' => 'Xấu với thờ cúng, mai táng.',
            'thutu' => [
                1 => 'Tuất',
                2 => 'Tuất',
                3 => 'Tuất',
                4 => 'Tuất',
                5 => 'Tuất',
                6 => 'Tuất',
                7 => 'Tuất',
                8 => 'Tuất',
                9 => 'Tuất',
                10 => 'Tuất',
                11 => 'Tuất',
                12 => 'Tuất']],
    ];
    // Thong thu 2, nhat trach, thap bat nhi tu.
    public static $saoTBNT = [
        1 => [
            'thu' => 5,
            'sao' => 'GIÁC MỘC GIAO',
            'tuongcon' => 'Thuồng Luồng',
            'hungkiet' => 'Kiết',
            'thonhattrach' => '<div>Giác tinh khởi tạo đặng bền lâu</div>
<div>Học hành đỗ đạc đến công hầu</div>
<div>Cưới hỏi hôn nhân sinh Quý tử</div>
<div>Mộ phần cất sửa chết trùng đôi</div>',
            'nenlam' => 'Tạo tác mọi việc đều đặng vinh xương, tấn lợi. Hôn nhân cưới gã sanh con quý. Công danh khoa cử cao thăng, đỗ đạt.',
            'kylam' => 'Chôn cất hoạn nạn 3 năm. Sửa chữa hay xây đắp mộ phần ắt có người chết. Sanh con nhằm ngày có Sao Giác khó nuôi, nên lấy tên Sao mà đặt tên cho nó mới an toàn. Dùng tên sao của năm hay của tháng cũng được.',
            'ngoaitru' => '"Sao Giác trúng ngày Dần là Đăng Viên được ngôi cao cả, mọi sự tốt đẹp.
Sao Giác trúng ngày Ngọ là Phục Đoạn Sát: rất Kỵ chôn cất, xuất hành, thừa kế, chia lãnh gia tài, khởi công lò nhuộm lò gốm. NHƯNG Nên dứt vú trẻ em, xây tường, lấp hang lỗ, làm cầu tiêu, kết dứt điều hung hại.
Sao Giác trúng ngày Sóc là Diệt Một Nhật: Đại Kỵ đi thuyền, và cũng chẳng nên làm rượu, lập lò gốm lò nhuộm, vào làm hành chánh, thừa kế."'
        ],
        2 => [
            'thu' => 6,
            'sao' => 'CANG KIM LONG',
            'tuongcon' => 'Rồng',
            'hungkiet' => 'Hung',
            'thonhattrach' => '<div>Cang tinh tạo tác khổ khôn lường</div>
<div>Chẳng đến mười ngày có họa ương</div>
<div>Chôn cất, hôn nhân gặp sao ấy</div>
<div>Con dâu hiu quạnh lắm sầu thương.</div>',
            'nenlam' => 'Cắt may áo màn (sẽ có lộc ăn).',
            'kylam' => 'Chôn cất bị Trùng tang. Cưới gã e phòng không giá lạnh. Tranh đấu kiện tụng lâm bại. Khởi dựng nhà cửa chết con đầu. 10 hoặc 100 ngày sau thì gặp họa, rồi lần lần tiêu hết ruộng đất, nếu làm quan bị cách chức. Sao Cang thuộc Thất Sát Tinh, sanh con nhằm ngày này ắt khó nuôi, nên lấy tên của Sao mà đặt cho nó thì yên lành',
            'ngoaitru' => '"Sao Cang ở nhằm ngày Rằm là Diệt Một Nhật: Cử làm rượu, lập lò gốm lò nhuộm, vào làm hành chánh, thừa kế sự nghiệp, thứ nhất đi thuyền chẳng khỏi nguy hại ( vì Diệt Một có nghĩa là chìm mất ).
Sao Cang tại Hợi, Mẹo, Mùi trăm việc đều tốt. Thứ nhất tại Mùi
"'
        ],
        3 => [
            'thu' => 7,
            'sao' => 'ĐÊ THỔ LẠC',
            'tuongcon' => 'Cầy',
            'hungkiet' => 'Hung',
            'thonhattrach' => '<div>Đê tinh khởi tạo gặp tai hung</div>
<div>Cưới gả hôn nhân họa chẳng cùng</div>
<div>Tách bến ra khơi thuyền hay đắm</div>
<div>Cất chôn con cháu chịu bần cùng.</div>',
            'nenlam' => 'Sao Đê Đại Hung , không cò việc chi hạp với nó',
            'kylam' => 'Khởi công xây dựng, chôn cất, cưới gã, xuất hành kỵ nhất là đường thủy, sanh con chẳng phải điềm lành nên làm Âm Đức cho nó. Đó chỉ là các việc Đại Kỵ, các việc khác vẫn kiêng cử.',
            'ngoaitru' => 'Tại Thân, Tí, Thìn trăm việc đều tốt, nhưng Thìn là tốt hơn hết vì Sao Đê Đăng Viên tại Thìn.'
        ],
        4 => [
            'thu' => 'CN',
            'sao' => 'PHÒNG NHẬT THỐ',
            'tuongcon' => 'Thỏ',
            'hungkiet' => 'Kiết',
            'thonhattrach' => '<div>Sao Phòng tạo tác vượng Đinh Tài</div>
<div>Phú Quý vinh hoa phúc lộc lai</div>
<div>An táng nếu được nhằm ngày ấy</div>
<div>Thăng quan tiến chức đến tam thai.</div>',
            'nenlam' => 'Khởi công tạo tác mọi việc đều tốt , thứ nhất là xây dựng nhà , chôn cất , cưới gã , xuất hành , đi thuyền , mưu sự , chặt cỏ phá đất , cắt áo.',
            'kylam' => 'Sao Phòng là Đại Kiết Tinh, không kỵ việc chi cả.',
            'ngoaitru' => '"Tại Đinh Sửu và Tân Sửu đều tốt, tại Dậu càng tốt hơn, vì Sao Phòng Đăng Viên tại Dậu.
Trong 6 ngày Kỷ Tị, Đinh Tị, Kỷ Dậu, Quý Dậu, Đinh Sửu, Tân Sửu thì Sao Phòng vẫn tốt với các việc khác, ngoại trừ chôn cất là rất kỵ. Sao Phòng nhằm ngày Tị là Phục Đoạn Sát: chẳng nên chôn cất, xuất hành, các vụ thừa kế, chia lãnh gia tài, khởi công làm lò nhuộm lò gốm. NHƯNG Nên dứt vú trẻ em, xây tường, lấp hang lỗ, làm cầu tiêu, kết dứt điều hung hại.
"'
        ],
        5 => [
            'thu' => 2,
            'sao' => 'TÂM NGUYỆT HỒ',
            'tuongcon' => 'Chồn',
            'hungkiet' => 'Hung',
            'thonhattrach' => '<div>Sao Tâm tạo tác việc đại hung</div>
<div>Muôn việc chẳng tròn chử thủy chung</div>
<div>Chôn cất hôn nhân đềo chẳng lợi</div>
<div>Trong ba năm ấy họa trùng trùng trùng.</div>',
            'nenlam' => 'Tạo tác việc chi cũng không hạp với Hung tú này.',
            'kylam' => 'Khởi công tạo tác việc chi cũng không khỏi hại, thứ nhất là xây cất, cưới gã, chôn cất, đóng giường, lót giường, tranh tụng.',
            'ngoaitru' => 'Ngày Dần Sao Tâm Đăng Viên, có thể dùng các việc nhỏ.'
        ],
        6 => [
            'thu' => 3,
            'sao' => 'VĨ HỎA HỔ',
            'tuongcon' => 'Cọp',
            'hungkiet' => 'Kiết',
            'thonhattrach' => '<div>Vĩ tinh tạo dựng lắm vui mừng</div>
<div>Mở cửa khai ngòi con cháu hưng</div>
<div>Chôn cất hôn nhân nhằm ngày ấy</div>
<div>Đời đời nối giữ bậc công hầu.</div>',
            'nenlam' => 'Mọi việc đều tốt , tốt nhất là các vụ khởi tạo , chôn cất , cưới gã , xây cất , trổ cửa , đào ao giếng , khai mương rạch , các vụ thủy lợi , khai trương , chặt cỏ phá đất.',
            'kylam' => 'Đóng giường , lót giường, đi thuyền.',
            'ngoaitru' => 'Tại Hợi, Mẹo, Mùi Kỵ chôn cất. Tại Mùi là vị trí Hãm Địa của Sao Vỹ. Tại Kỷ Mẹo rất Hung, còn các ngày Mẹo khác có thể tạm dùng được.'
        ],
        7 => [
            'thu' => 4,
            'sao' => 'CƠ THỦY BÁO',
            'tuongcon' => 'Beo',
            'hungkiet' => 'Kiết',
            'thonhattrach' => '<div>Cơ tinh tạo tác thật hùng cường</div>
<div>Mở cửa ra vào đại khiết xương</div>
<div>Cưới gả cất chôn, đều khiết lợi</div>
<div>Kho tàng đầy lúa, bạc đầy nương.</div>',
            'nenlam' => 'Khởi tạo trăm việc đều tốt, tốt nhất là chôn cất, tu bổ mồ mã, trổ cửa, khai trương, xuất hành, các vụ thủy lợi ( như tháo nước, đào kinh, khai thông mương rảnh...).',
            'kylam' => 'Đóng giường, lót giường, đi thuyền.',
            'ngoaitru' => 'Tại Thân, Tí, Thìn trăm việc kỵ, duy tại Tí có thể tạm dùng. Ngày Thìn Sao Cơ Đăng Viên lẽ ra rất tốt nhưng lại phạm Phục Đoạn. Phạm Phục Đoạn thì kỵ chôn cất, xuất hành, các vụ thừa kế, chia lãnh gia tài, khởi công làm lò nhuộm lò gốm ; NHƯNG nên dứt vú trẻ em, xây tường, lấp hang lỗ, làm cầu tiêu, kết dứt điều hung hại.'
        ],
        8 => [
            'thu' => 5,
            'sao' => 'ĐẨU MỘC GIẢI',
            'tuongcon' => 'Cua',
            'hungkiet' => 'Kiết',
            'thonhattrach' => '<div>Đẩu tinh tạo dựng lợi muôn phần</div>
<div>Sửa mả an táng con cháu hưng</div>
<div>Mở cửa khơi ngòi trâu ngựa phát</div>
<div>Đính hôn cưới giả lắm vui mưng.</div>',
            'nenlam' => 'Khởi tạo trăm việc đều tốt, tốt nhất là xây đắp hay sửa chữa phần mộ, trổ cửa, tháo nước, các vụ thủy lợi, chặt cỏ phá đất, may cắt áo mão, kinh doanh, giao dịch, mưu cầu công danh.',
            'kylam' => 'Rất kỵ đi thuyền. Con mới sanh đặt tên nó là Đẩu, Giải, Trại hoặc lấy tên Sao của năm hay tháng hiện tại mà đặt tên cho nó dễ nuôi.',
            'ngoaitru' => 'Tại Tị mất sức. Tại Dậu tốt. Ngày Sửu Đăng Viên rất tốt nhưng lại phạm Phục Đoạn. Phạm Phục Đoạn thì kỵ chôn cất, xuất hành, thừa kế, chia lãnh gia tài, khởi công làm lò nhuộm lò gốm ; NHƯNG nên dứt vú trẻ em, xây tường, lấp hang lỗ, làm cầu tiêu, kết dứt điều hung hại.'
        ],
        9 => [
            'thu' => 6,
            'sao' => 'NGƯU KIM NGƯU',
            'tuongcon' => 'Trâu',
            'hungkiet' => 'Hung',
            'thonhattrach' => '<div>Ngưu tinh tạo dựng thật tai nguy</div>
<div>Ruộng, tằm chẳng lợi chủ nhân suy</div>
<div>Giá thú khai môn đều họa đến</div>
<div>Heo dê trâu ngựa ít dần đi.</div>',
            'nenlam' => 'Đi thuyền, cắt may áo mão.',
            'kylam' => 'Khởi công tạo tác việc chi cũng hung hại. Nhất là xây cất nhà, dựng trại, cưới gã, trổ cửa, làm thủy lợi, nuôi tằm, gieo cấy, khai khẩn, khai trương, xuất hành đường bộ.',
            'ngoaitru' => '"Ngày Ngọ Đăng Viên rất tốt. Ngày Tuất yên lành. Ngày Dần là Tuyệt Nhật, chớ động tác việc chi, riêng ngày Nhâm Dần dùng được. Trúng ngày 14 ÂL là Diệt Một Sát, cử: làm rượu, lập lò nhuộm lò gốm, vào làm hành chánh, thừa kế sự nghiệp, kỵ nhất là đi thuyền chẳng khỏi rủi ro.
Sao Ngưu là 1 trong Thất sát Tinh, sanh con khó nuôi, nên lấy tên Sao của năm, tháng hay ngày mà đặt tên cho trẻ và làm việc Âm Đức ngay trong tháng sanh nó mới mong nuôi khôn lớn được."'
        ],
        10 => [
            'thu' => 7,
            'sao' => 'NỮ THỔ BỨC',
            'tuongcon' => 'Dơi',
            'hungkiet' => 'Hung',
            'thonhattrach' => '<div>Nữ tinh tạo tác gái lâm nạn</div>
<div>Cốt nhục thâm thù giống hổ lang</div>
<div>Chôn cất hôn nhân gặp sao ấy</div>
<div>Gia tài lụn bại bỏ xóm làng.</div>',
            'nenlam' => 'Kết màn, may áo.',
            'kylam' => 'Khởi công tạo tác trăm việc đều có hại, hung hại nhất là trổ cửa, khơi đường tháo nước, chôn cất, đầu đơn kiện cáo.',
            'ngoaitru' => 'Tại Hợi Mẹo Mùi đều gọi là đường cùng. Ngày Quý Hợi cùng cực đúng mức vì là ngày chót của 60 Hoa giáp. Ngày Hợi tuy Sao Nữ Đăng Viên song cũng chẳng nên dùng. Ngày Mẹo là Phục Đoạn Sát, rất kỵ chôn cất, xuất hành, thừa kế sự nghiệp, chia lãnh gia tài, khởi công làm lò nhuộm lò gốm ; NHƯNG nên dứt vú trẻ em, xây tường, lấp hang lỗ, làm cầu tiêu, kết dứt điều hung hại.'
        ],
        11 => [
            'thu' => 'CN',
            'sao' => 'HƯ NHẬT THỬ',
            'tuongcon' => 'Chuột',
            'hungkiet' => 'Hung',
            'thonhattrach' => '<div>Hư tinh tạo tác chịu tai ương</div>
<div>Nam nữ phòng không kẻ một phương</div>
<div>Nội loạn, dâm loàn, không tiết hạnh</div>
<div>Cha con dâu rể trái luôn thương.</div>',
            'nenlam' => 'Hư có nghĩa là hư hoại, không có việc chi hợp với Sao Hư.',
            'kylam' => 'Khởi công tạo tác trăm việc đều không may, thứ nhất là xây cất nhà cửa, cưới gã, khai trương, trổ cửa, tháo nước, đào kinh rạch.',
            'ngoaitru' => '"Gặp Thân, Tí, Thìn đều tốt, tại Thìn Đắc Địa tốt hơn hết. Hạp với 6 ngày Giáp Tí, Canh Tí, Mậu Thân, Canh Thân, Bính Thìn, Mậu Thìn có thể động sự. Trừ ngày Mậu Thìn ra, còn 5 ngày kia kỵ chôn cất.
Gặp ngày Tí thì Sao Hư Đăng Viên rất tốt, nhưng lại phạm Phục Đoạn Sát: Kỵ chôn cất, xuất hành, thừa kế, chia lãnh gia tài sự nghiệp, khởi công làm lò nhuộm lò gốm, NHƯNg nên dứt vú trẻ em, xây tường, lấp hang lỗ, làm cầu tiêu, kết dứt điều hung hại.
Gặp Huyền Nhật là những ngày 7, 8 , 22, 23 ÂL thì Sao Hư phạm Diệt Một: Cử làm rượu, lập lò gốm lò nhuộm, vào làm hành chánh, thừa kế, thứ nhất là đi thuyền ắt chẳng khỏi rủi ro."'
        ],
        12 => [
            'thu' => 2,
            'sao' => 'NGUY NGUYỆT YẾN',
            'tuongcon' => 'Én',
            'hungkiet' => 'Hung',
            'thonhattrach' => '<div>Nguy tinh chẳng khá tạo cao đường</div>
<div>Chôn cất sửa mồ thấy thê lương</div>
<div>Trổ cửa khai mươn bị phạt trượng</div>
<div>Ba năm gánh chịu những tai ương.</div>',
            'nenlam' => 'Chôn cất rất tốt, lót giường bình yên.',
            'kylam' => 'Dựng nhà, trổ cửa, gác đòn đông, tháo nước, đào mương rạch, đi thuyền.',
            'ngoaitru' => 'Tại Tị, Dậu, Sửu trăm việc đều tốt, tại Dậu tốt nhất. Ngày Sửu Sao Nguy Đăng Viên: tạo tác sự việc được quý hiển.'
        ],
        13 => [
            'thu' => 3,
            'sao' => 'THẤT HỎA TRƯ',
            'tuongcon' => 'Heo',
            'hungkiet' => 'Kiết',
            'thonhattrach' => '<div>Thất tinh tu tạo ruộng trâu tăng</div>
<div>Con cháu nối đời lộc vị tăng</div>
<div>Lập nghiệp, của tiền gia trạch vượng</div>
<div>Hôn nhân chôn cất vững ai bằng.</div>',
            'nenlam' => 'Khởi công trăm việc đều tốt. Tốt nhất là xây cất nhà cửa, cưới gã, chôn cất, trổ cửa, tháo nước, các việc thủy lợi, đi thuyền, chặt cỏ phá đất.',
            'kylam' => 'Sao thất Đại Kiết không có việc chi phải cử.',
            'ngoaitru' => '"Tại Dần, Ngọ, Tuất nói chung đều tốt, ngày Ngọ Đăng viên rất hiển đạt.
Ba ngày Bính Dần, Nhâm Dần, Giáp Ngọ rất nên xây dựng và chôn cất, song những ngày Dần khác không tốt. Vì sao Thất gặp ngày Dần là phạm Phục Đoạn Sát ( kiêng cữ như trên ).
"'
        ],
        14 => [
            'thu' => 4,
            'sao' => 'BÍCH THỦY DU',
            'tuongcon' => 'Nhím',
            'hungkiet' => 'Kiết',
            'thonhattrach' => '<div>Bích tinh tạo dựng đặng hưng đầy</div>
<div>Giá thú hôn nhân hỷ khí vây</div>
<div>Mai táng thêm tài, nhân đinh vượng</div>
<div>Mở ngỏ khai ngòi con cháu đầy.</div>',
            'nenlam' => 'Khởi công tạo tác việc chi cũng tốt. Tốt nhất là xây cất nhà, cưới gã, chôn cất, trổ cửa, dựng cửa, tháo nước, các vụ thuỷ lợi, chặt cỏ phá đất, cắt áo thêu áo, khai trương, xuất hành, làm việc thiện ắt Thiện quả tới mau hơn.',
            'kylam' => 'Sao Bích toàn kiết, không có việc chi phải kiêng cử.',
            'ngoaitru' => 'Tại Hợi Mẹo Mùi trăm việc kỵ , thứ nhất trong Mùa Đông. Riêng ngày Hợi Sao Bích Đăng Viên nhưng phạm Phục Đọan Sát ( Kiêng cữ như trên ).'
        ],
        15 => [
            'thu' => 5,
            'sao' => 'KHUÊ MỘC LANG',
            'tuongcon' => 'Sói',
            'hungkiet' => 'Hung',
            'thonhattrach' => '<div>Khuê tinh tạo tác đắc trinh tường</div>
<div>Gia đạo thuận hòa đặng khiết xương</div>
<div>Nếu nhà mai táng thêm lo ngại</div>
<div>Cùng với khai môn họa chẳng lường.</div>',
            'nenlam' => 'Tạo dựng nhà phòng , nhập học , ra đi cầu công danh , cắt áo.',
            'kylam' => 'Chôn cất , khai trương , trổ cửa dựng cửa , khai thông đường nước , đào ao móc giếng , thưa kiện , đóng giường lót giường.',
            'ngoaitru' => '"Sao Khuê là 1 trong Thất Sát Tinh, nếu đẻ con nhằm ngày này thì nên lấy tên Sao Khuê hay lấy tên Sao của năm tháng mà đặt cho trẻ dễ nuôi.
Sao Khuê Hãm Địa tại Thân: Văn Khoa thất bại.
Tại Ngọ là chỗ Tuyệt gặp Sanh, mưu sự đắc lợi, thứ nhất gặp Canh Ngọ.
Tại Thìn tốt vừa vừa.
Ngày Thân Sao Khuê Đăng Viên: Tiến thân danh.
"'
        ],
        16 => [
            'thu' => 6,
            'sao' => 'LÂU KIM CẨU',
            'tuongcon' => 'Chó',
            'hungkiet' => 'Kiết',
            'thonhattrach' => '<div>Lâu tinh rạng rỡ chốn môn đình</div>
<div>Gia đạo phát tài ít kẻ đương</div>
<div>Hôn nhân ngày ấy sinh hiền tử</div>
<div>Nối đời lộc vị rạng tông đường.</div>',
            'nenlam' => 'Khởi công mọi việc đều tốt . Tốt nhất là dựng cột, cất lầu, làm dàn gác, cưới gã, trổ cửa dựng cửa, tháo nước hay các vụ thủy lợi, cắt áo.',
            'kylam' => 'Đóng giường , lót giường, đi đường thủy.',
            'ngoaitru' => '"Tại Ngày Dậu Đăng Viên : Tạo tác đại lợi.
Tại Tị gọi là Nhập Trù rất tốt.
Tại Sửu tốt vừa vừa.
Gặp ngày cuối tháng thì Sao Lâu phạm Diệt Một: rất kỵ đi thuyền, cữ làm rượu, lập lò gốm lò nhuộm, vào làm hành chánh, thừa kế sự nghiệp.
"'
        ],
        17 => [
            'thu' => 7,
            'sao' => 'VỊ THỔ TRĨ',
            'tuongcon' => 'Chim Trĩ',
            'hungkiet' => 'Kiết',
            'thonhattrach' => '<div>Vị tinh tạo tác ra sao?</div>
<div>Giàu sang vui sướng lộc hằng hà</div>
<div>Chôn cất sau này tăng chức vị</div>
<div>Hôn nhân ngày ấy được an hòa.</div>',
            'nenlam' => 'Khởi công tạo tác việc chi cũng lợi. Tốt nhất là xây cất, cưới gã, chôn cất, chặt cỏ phá đất, gieo trồng, lấy giống.',
            'kylam' => ' Đi thuyền.',
            'ngoaitru' => '"Sao Vị mất chí khí tại Dần, thứ nhất tại Mậu Dần, rất là Hung, chẳng nên cưới gã, xây cất nhà cửa.
Tại Tuất Sao Vị Đăng Viên nên mưu cầu công danh, nhưng cũng phạm Phục Đoạn ( kiêng cữ như các mục trên ).
"'
        ],
        18 => [
            'thu' => 'CN',
            'sao' => 'MÃO NHẬT KÊ',
            'tuongcon' => 'Gà',
            'hungkiet' => 'Hung',
            'thonhattrach' => '<div>Mão tinh xây dựng phát ruộng trâu</div>
<div>Chôn cất quan phi mãi chẳng đâu</div>
<div>Khai môn chắc hẳn vời họa đến</div>
<div>Cưới hỏi hôn nhân phải chịu sầu.</div>',
            'nenlam' => 'Xây dựng , tạo tác.',
            'kylam' => 'Chôn Cất ( ĐẠI KỴ ), cưới gã, trổ cửa dựng cửa, khai ngòi phóng thủy, khai trương, xuất hành, đóng giường lót giường. Các việc khác cũng không hay.',
            'ngoaitru' => '"Tại Mùi mất chí khí.
Tại Ất Mẹo và Đinh Mẹo tốt, Ngày Mẹo Đăng Viên cưới gã tốt, nhưng ngày Quý Mẹo tạo tác mất tiền của.
Hạp với 8 ngày: Ất Mẹo, Đinh Mẹo, Tân Mẹo, Ất Mùi, Đinh Mùi, Tân Mùi, Ất Hợi, Tân Hợi.
"'
        ],
        19 => [
            'thu' => 2,
            'sao' => 'TẤN NGUYỆT Ô',
            'tuongcon' => 'Quạ',
            'hungkiet' => 'Kiết',
            'thonhattrach' => '<div>Tấn tinh tạo tác lợi vô biên</div>
<div>Tằm tiện được mù, lợi của tiền</div>
<div>Trổ cửa ngày này nhiều may mắn</div>
<div>Hôn nhân an táng phúc lưu truyền.</div>',
            'nenlam' => 'Khởi công tạo tác việc chi cũng tốt. Tốt nhất là chôn cất, cưới gã, trổ cửa dựng cửa, đào kinh, tháo nước, khai mương, móc giếng, chặt cỏ phá đất. Những việc khác cũng tốt như làm ruộng, nuôi tằm, khai trương, xuất hành, nhập học',
            'kylam' => 'Đi thuyền.',
            'ngoaitru' => '"Tại Thân, Tí, Thìn đều tốt.
Tại Thân hiệu là Nguyệt Quải Khôn Sơn, trăng treo đầu núi Tây Nam, rất là tốt. Lại thên Sao tất Đăng Viên ở ngày Thân, cưới gã và chôn cất là 2 điều ĐẠI KIẾT.
"'
        ],
        20 => [
            'thu' => 3,
            'sao' => 'CHỦY HỎA HẦU',
            'tuongcon' => 'Khỉ',
            'hungkiet' => 'Hung',
            'thonhattrach' => '<div>Chủy tinh tạo tác chịu hao hình</div>
<div>Mai táng không yên, gia đạo khuynh</div>
<div>Tam tang điềm giữ đều do đó</div>
<div>Kho đụng lương tiền khó giữ dìn.</div>',
            'nenlam' => 'Không có sự việc chi hợp với Sao Chủy.',
            'kylam' => 'Khởi công tạo tác việc chi cũng không tốt. KỴ NHẤT là chôn cất và các vụ thuộc về chết chôn như sửa đắp mồ mả, làm sanh phần (làm mồ mã để sẵn), đóng thọ đường (đóng hòm để sẵn).',
            'ngoaitru' => 'Tại tị bị đoạt khí, Hung càng thêm hung. Tại dậu rất tốt, vì Sao Chủy Đăng Viên ở Dậu, khởi động thăng tiến. Nhưng cũng phạm Phục Đoạn Sát. Tại Sửu là Đắc Địa, ắt nên. Rất hợp với ngày Đinh sửu và Tân Sửu, tạo tác Đại Lợi, chôn cất Phú Quý song toàn.'
        ],
        21 => [
            'thu' => 4,
            'sao' => 'SÂM THỦY VIÊN',
            'tuongcon' => 'Vượn',
            'hungkiet' => 'Kiết',
            'thonhattrach' => '<div>Sâm tinh tạo dựng được an hòa</div>
<div>Văn trường rực rỡ lắm vinh hoa</div>
<div>Khai mương mở ngõ đều điềm tốt</div>
<div>Chôn cất hôn nhân bị phá gia.</div>',
            'nenlam' => 'Khởi công tạo tác nhiều việc tốt như : xây cất nhà, dựng cửa trổ cửa, nhập học, đi thuyền, làm thủy lợi, tháo nước đào mương.',
            'kylam' => 'Cưới gả, chôn cất, đóng giường lót giường, kết bạn.',
            'ngoaitru' => 'Ngày Tuất Sao sâm Đăng Viên, nên phó nhậm, cầu công danh hiển hách.'
        ],
        22 => [
            'thu' => 5,
            'sao' => 'TỈNH MỘC LẠI',
            'tuongcon' => 'Rái',
            'hungkiet' => 'Kiết',
            'thonhattrach' => '<div>Tỉnh tinh tạo tác ruộng, tằm sinh</div>
<div>Bảng hổ tên đề, đệ nhất danh</div>
<div>Mai táng lo phòng thêm tang chế</div>
<div>Khai môn gặp được của sinh con.</div>',
            'nenlam' => 'Tạo tác nhiều việc tốt như xây cất, trổ cửa dựng cửa, mở thông đường nước, đào mương móc giếng, nhậm chức, nhập học, đi thuyền.',
            'kylam' => 'Chôn cất, tu bổ phần mộ, làm sanh phần, đóng thọ đường.',
            'ngoaitru' => 'Tại Hợi, Mẹo, Mùi trăm việc tốt. Tại Mùi là Nhập Miếu, khởi động vinh quang.'
        ],
        23 => [
            'thu' => 6,
            'sao' => 'QUỶ KIM DƯƠNG',
            'tuongcon' => 'Dê',
            'hungkiet' => 'Hung',
            'thonhattrach' => '<div>Quỷ tinh tạo dựng ắt suy vong</div>
<div>Của nhà vắng bóng chủ nhân ông</div>
<div>Chôn cất ngày này thêm quan lộc</div>
<div>Cưới gả loan phòng chắc trống không.</div>',
            'nenlam' => 'Chôn cất, chặt cỏ phá đất, cắt áo.',
            'kylam' => 'Khởi tạo việc chi cũng hại. Hại nhất là xây cất nhà, cưới gã, trổ cửa dựng cửa, tháo nước, đào ao giếng, động đất, xây tường, dựng cột.',
            'ngoaitru' => '"Ngày Tí Đăng Viên thừa kế tước phong tốt, phó nhiệm may mắn. Ngày Thân là Phục Đoạn Sát kỵ chôn cất, xuất hành, thừa kế, chia lãnh gia tài, khởi công lập lò gốm lò nhuộm; NHƯNG nên dứt vú trẻ em, xây tường, lấp hang lỗ, làm cầu tiêu, kết dứt điều hung hại.
Nhằm ngày 16 ÂL là ngày Diệt Một kỵ làm rượu, lập lò gốm lò nhuộm, vào làm hành chánh, kỵ nhất đi thuyền.
"'
        ],
        24 => [
            'thu' => 7,
            'sao' => 'LIỂU THỔ CHƯỚNG',
            'tuongcon' => 'Cheo',
            'hungkiet' => 'Hung',
            'thonhattrach' => '<div>Liễu tinh tạo dựng lắm tội oan</div>
<div>Tai ương trộm cướp phải cơ hàn</div>
<div>Chôn cất hôn nhân nhằm sao ấy</div>
<div>Ba năm đôi lược chịu sầu than.</div>',
            'nenlam' => 'Không có việc chi hạp với Sao Liễu.',
            'kylam' => 'Khởi công tạo tác việc chi cũng hung hại. Hung hại nhất là chôn cất, xây đắp, trổ cửa dựng cửa, tháo nước, đào ao lũy, làm thủy lợi.',
            'ngoaitru' => 'Tại Ngọ trăm việc tốt. Tại Tị Đăng Viên: thừa kế và lên quan lãnh chức là 2 điều tốt nhất. Tại Dần, Tuất rất kỵ xây cất và chôn cất : Rất suy vi.'
        ],
        25 => [
            'thu' => 'CN',
            'sao' => 'TINH NHẬT MẠ',
            'tuongcon' => 'Ngự',
            'hungkiet' => 'Hung',
            'thonhattrach' => '<div>Sao tinh chỉ tốt việc xây phòng</div>
<div>Gia quan, tấn lộc gần quân vương</div>
<div>Chẳng khá khai mương cùng chôn cất</div>
<div>Vợ chông li tán chớ xem thường.</div>',
            'nenlam' => 'Xây dựng phòng mới.',
            'kylam' => 'Chôn cất, cưới gã, mở thông đường nước.',
            'ngoaitru' => '"Sao Tinh là 1 trong Thất Sát Tinh, nếu sanh con nhằm ngày này nên lấy tên Sao đặt tên cho trẻ để dễ nuôi, có thể lấy tên sao của năm, hay sao của tháng cũng được. Tại Dần Ngọ Tuất đều tốt, tại Ngọ là Nhập Miếu, tạo tác được tôn trọng. Tại Thân là Đăng Giá ( lên xe ): xây cất tốt mà chôn cất nguy.
Hạp với 7 ngày: Giáp Dần, Nhâm Dần, Giáp Ngọ, Bính Ngọ, Mậu Ngọ, Bính Tuất, Canh Tuất.
"'
        ],
        26 => [
            'thu' => 2,
            'sao' => 'TRƯƠNG NGUYỆT LỘC',
            'tuongcon' => 'Nai',
            'hungkiet' => 'Kiết',
            'thonhattrach' => '<div>Trương tinh ngày ấy tạo thêm nhà</div>
<div>Nối nghiệp công hầu gần quân vương</div>
<div>Mai táng khai mương tiền của đến</div>
<div>Hôn nhân hòa hợp phúc minh trường.</div>',
            'nenlam' => 'Khởi công tạo tác trăm việc tốt, tốt nhất là xây cất nhà, che mái dựng hiên, trổ cửa dựng cửa, cưới gã, chôn cất, làm ruộng, nuôi tằm, đặt táng kê gác, chặt cỏ phá đất, cắt áo, làm thuỷ lợi.',
            'kylam' => 'Sửa hoặc làm thuyền chèo, đẩy thuyền mới xuống nước.',
            'ngoaitru' => 'Tại Hợi, Mẹo, Mùi đều tốt. Tại Mùi Đăng viên rất tốt nhưng phạm Phục Đoạn.'
        ],
        27 => [
            'thu' => 3,
            'sao' => 'DỰC HỎA XÀ',
            'tuongcon' => 'Rắn',
            'hungkiet' => 'Hung',
            'thonhattrach' => '<div>Dực tinh tối kị dựng xây nhà</div>
<div>Ba năm hai lượt chủ tiêu vong</div>
<div>Chôn cất hôn nhân đều chẳng lợi</div>
<div>Thiếu nữ lăng loàn, mất gia phong.</div>',
            'nenlam' => 'Cắt áo sẽ đước tiền tài.',
            'kylam' => 'Chôn cất, cưới gã, xây cất nhà, đặt táng kê gác, gác đòn dông, trổ cửa gắn cửa, các vụ thủy lợi.',
            'ngoaitru' => 'Tại Thân, Tí, Thìn mọi việc tốt. Tại Thìn Vượng Địa tốt hơn hết. Tại Tí Đăng Viên nên thừa kế sự nghiệp, lên quan lãnh chức.'
        ],
        0 => [
            'thu' => 4,
            'sao' => 'CHẤN THỦY DẪN',
            'tuongcon' => 'Trùn',
            'hungkiet' => 'Kiết',
            'thonhattrach' => '<div>Chuẩn tinh tạo tác được càng hay</div>
<div>Hôn nhân lại được lắm duyên may</div>
<div>An táng văn tinh từng chiết thấu</div>
<div>Ngọc kho vàng đống phúc sâu dày.</div>',
            'nenlam' => 'Khởi công tạo tác mọi việc tốt lành, tốt nhất là xây cất lầu gác, chôn cất, cưới gã. Các việc khác cũng tốt như dựng phòng, cất trại, xuất hành, chặt cỏ phá đất.',
            'kylam' => 'Đi thuyền.',
            'ngoaitru' => 'Tại Tị Dậu Sửu đều tốt. Tại Sửu Vượng Địa, tạo tác thịnh vượng. Tại Tị Đăng Viên là ngôi tôn đại, mưu động ắt thành danh.'
        ],
    ];

    public static $thangAmTruc = [
    	1 => ['dan','mao','thin','ty','ngo','mui','than','dau','tuat','hoi','ti','suu'],
    	2 => ['mao','thin','ty','ngo','mui','than','dau','tuat','hoi','ti','suu','dan'],
    	3 => ['thin','ty','ngo','mui','than','dau','tuat','hoi','ti','suu','dan','mao'],
    	4 => ['ty','ngo','mui','than','dau','tuat','hoi','ti','suu','dan','mao','thin'],
    	5 => ['ngo','mui','than','dau','tuat','hoi','ti','suu','dan','mao','thin','ty'],
	    6 => ['mui','than','dau','tuat','hoi','ti','suu','dan','mao','thin','ty','ngo'],
	    7 => ['than','dau','tuat','hoi','ti','suu','dan','mao','thin','ty','ngo','mui'],
	    8 => ['dau','tuat','hoi','ti','suu','dan','mao','thin','ty','ngo','mui','than'],
	    9 => ['tuat','hoi','ti','suu','dan','mao','thin','ty','ngo','mui','than','dau'],
	    10 => ['hoi','ti','suu','dan','mao','thin','ty','ngo','mui','than','dau','tuat'],
	    11 => ['ti','suu','dan','mao','thin','ty','ngo','mui','than','dau','tuat','hoi'],
	    12 => ['suu','dan','mao','thin','ty','ngo','mui','than','dau','tuat','hoi','ti'],
    ];

    public static $trucArr = [
        [
            'name' => 'Kiến',
            'nen_lam' => 'Ngày trực Kiến vô cùng cát lợi cho các việc như khai trương, nhậm chức, cưới hỏi, trồng cây, đền ơn đáp nghĩa',
            'kieng' => 'Xấu cho các việc động thổ, chôn cất, đào giếng, lợp nhà.',
        ],
        [
            'name' => 'Trừ',
            'nen_lam' => 'Ngày có trực Trừ nên tiến hành các công việc như: Động thổ, sửa chữa xây dựng, dâng lễ, chữa bệnh, dâng sao giải hạn, tỉa chân nhang, thay bát hương…',
            'kieng' => 'Không nên làm các việc như chi xuất tiền lớn, ký hợp đồng, khai trương, cưới hỏi, thụ thai',
        ],
        [
            'name' => 'Mãn',
            'nen_lam' => 'Ngày có trực Mãn nên: Xuất hành, buôn bán, đặt nóc, đổ trần, nhận người làm, nhận học viên, xây dựng chuồng trại, cúng lễ, xuất hành, sửa kho',
            'kieng' => 'Xấu cho việc chôn cất, dâng lễ cầu an, kiện tụng, hay nhậm chức',
        ],
        [
            'name' => 'Bình',
            'nen_lam' => 'Ngày có trực Bình mọi việc đều tốt, Tốt nhất cho các việc di dời bếp, cất nóc, đổ trần, giao thương, mua bán.',
            'kieng' => '',
        ],
        [
            'name' => 'Định',
            'nen_lam' => 'Ngày có trực Định mọi việc đều tốt, tốt nhất cho buôn bán, giao thương, làm chuồng gia súc',
            'kieng' => 'Cần tránh các việc như thưa kiện, xuất hành đi xa.',
        ],
        [
            'name' => 'Chấp',
            'nen_lam' => 'Ngày có trực Chấp tốt cho các việc tu sửa, ký hợp đồng, tuyển dụng, thuê người làm, giao dịch, động thổ, làm nền, cầu thầy chữa bệnh',
            'kieng' => 'Chú ý không nên xuất nhập kho, truy xuất tiền nong, khởi công đắp, làm, bồi nền, xây tường',
        ],
        [
            'name' => 'Phá',
            'nen_lam' => 'Việc tốt nên làm trong ngày có trực Phá là đi xa, phá bỏ công trình, nhà ở cũ kỹ',
            'kieng' => 'Cần lưu ý thêm rất xấu cho những việc mở hàng, cưới hỏi, hội họp, đóng giường, cho vay, động thổ, ban nền đắp nền, lên quan đến nhận chức, thừa kế công việc hay sự nghiệp, nhập học, học nghề, vào làm cơ quan nhà nước, nạp đơn dâng sớ.',
        ],
        [
            'name' => 'Nguy',
            'nen_lam' => 'Ngày có trực Nguy cực xấu nên làm lễ bái, cầu tự, tụng kinh.',
            'kieng' => 'Tránh công việc làm ăn kinh doanh buôn bán, động thổ, khai trương hay cưới xin, thăm hỏi.',
        ],
        [
            'name' => 'Thành',
            'nen_lam' => 'Ngày có trực Thành rất tốt, nên làm các việc như nhập học, kết hôn, dọn về nhà mới.',
            'kieng' => 'Tránh các việc kiện tụng, cãi vã, tranh chấp.',
        ],
        [
            'name' => 'Thu',
            'nen_lam' => 'Ngày có trực Thâu nên làm các việc mở cửa hàng, cửa tiệm, lập kho, buôn bán.',
            'kieng' => 'Không nên làm các việc như ma chay, an táng, tảo mộ.',
        ],
        [
            'name' => 'Khai',
            'nen_lam' => 'Ngày có trực Khai thường được nhiều người sử dụng để làm các việc lớn như động thổ làm nhà, kết hôn vì đây là ngày có nhiều cát lành, may mắn',
            'kieng' => 'Cần lưu ý kiêng các việc như an táng, động thổ vì người ta quan niệm nó không được sạch sẽ.',
        ],
        [
            'name' => 'Bế',
            'nen_lam' => 'Ngày có trực Bế chỉ nên làm các việc như sửa chữa, làm nội thất, xây vá tường vách đã lở.',
            'kieng' => 'Không nên nhận chức, dự án, nhận thừa kế, nhập học trong ngày trực Bế',
        ],
    ];

    // Trừ
    public static $truArr = [
        'tuat' => [
            'tru' => 'Kiến',
            'nen_lam' => 'Nên làm: Xuất hành đạt được nhiều thuận lợi, sanh con rất tốt',
            'kieng' => 'Động thổ xây nhà, đắp nền, lót giường, vẽ họa chụp ảnh, lễ nhận chức, lễ ăn hỏi cưới xin, vào làm hành chính, dâng nhận đơn sớ, mở kho, đóng thọ dưỡng sanh'
        ],
        
        'hoi' => ['tru' => 'Trừ', 'nen_lam' => 'Động thổ, ban nền đắp nền, thờ cúng Táo Thần, cầu thầy chữa bệnh bằng cách mổ xẻ hay châm cứu, bốc thuốc, xả tang, khởi công làm lò nhuộm, lò gốm. Nữ giới nên khởi đầu uống thuốc chữa bệnh.', 'kieng' => 'Đẻ con nhằm Trực Trừ khó nuôi, nên làm Âm Đức cho nó. Nam giới sẽ gặp nhiều bất lợi về sức khỏe nếu khởi đầu uống thuốc'],

        'ti' => ['tru' => 'Mãn', 'nen_lam' => 'Xuất hành, đi thuyền, cho vay, thu nợ, mua hàng, bán hàng, đem ngũ cốc hoa màu cất vào kho, cải táng, kê gác, đặt nóc mái nhà, sửa chữa kho, đặt yên chỗ máy dệt, nhận người làm, vào học nghề, làm chuồng gà ngỗng vịt.', 'kieng' => 'Lên quan đến nhận chức, uống thuốc, vào làm hành chính, dâng nhận đơn sớ'],

        'suu' => ['tru' => 'Bình',
            'nen_lam' => 'Xuất hành, đi thuyền, động thổ, ban nền đắp nền, xây dựng khô chứa đồ, làm hay sửa phòng bếp, thờ cúng Táo Thần, đóng giường lót giường, may áo, đặt yên chỗ máy dệt hay các loại máy, cấy lúa, gặt lúa, đào ao xây giếng, tháo nước, các việc trong nuôi tằm, khơi thông cống rãnh, ao ngòi, sông hồ, cầu thầy chữa bệnh, mua bốc thuốc, uống thuốc, mua trâu, làm rượu, nhập học, học nghề, vẽ tranh, khởi công làm lò nhuộm lò gốm, làm chuồng gà ngỗng vịt, bó cây để chiết nhánh.',
            'kieng' => 'Chôn cất'
        ],

        'dan' => ['tru' => 'Định',
            'nen_lam' => 'Xây đắp tường, cải táng, lắp cửa, kê gác, đặt mái nhà, làm cầu tiêu, khởi công lò nhuộm lò gốm, uống thuốc, trị bệnh (nhưng không trị bệnh về mắt), bó cây để chiết nhánh.',
            'kieng' => 'Lên quan nhận chức, nhận lại công việc, dự án, thừa kế sự nghiệp, nhập học, chữa bệnh về mắt, các việc trong nuôi tằm'],

        'mao' => ['tru' => 'Chấp',
            'nen_lam' => 'Nên làm: Xuất hành đạt được nhiều thuận lợi, sanh con rất tốt',
            'kieng' => 'Kiêng cữ: Động thổ xây nhà, đắp nền, lót giường, vẽ họa chụp ảnh, lễ nhận chức, lễ ăn hỏi cưới xin, vào làm hành chính, dâng nhận đơn sớ, mở kho, đóng thọ dưỡng sanh'],
        'thin' => ['tru' => 'Phá',
            'nen_lam' => 'Nên làm:  Động thổ, ban nền đắp nền, thờ cúng Táo Thần, cầu thầy chữa bệnh bằng cách mổ xẻ hay châm cứu, bốc thuốc, xả tang, khởi công làm lò nhuộm, lò gốm. Nữ giới nên khởi đầu uống thuốc chữa bệnh.',
            'kieng' => 'Kiêng cữ: Đẻ con nhằm Trực Trừ khó nuôi, nên làm Âm Đức cho nó. Nam giới sẽ gặp nhiều bất lợi về sức khỏe nếu khởi đầu uống thuốc'],

        'ty' => ['tru' => 'Nguy',
            'nen_lam' => 'Nên làm: Xuất hành, đi thuyền, cho vay, thu nợ, mua hàng, bán hàng, đem ngũ cốc hoa màu cất vào kho, cải táng, kê gác, đặt nóc mái nhà, sửa chữa kho, đặt yên chỗ máy dệt, nhận người làm, vào học nghề, làm chuồng gà ngỗng vịt.',
            'kieng' => 'Kiêng cữ: lên quan đến nhận chức, uống thuốc, vào làm hành chính, dâng nhận đơn sớ'],
        'ngo' => ['tru' => 'Thành',
            'nen_lam' => 'Nên làm: Đem ngũ cốc vào kho, cải táng, lắp cửa, kê gác, cất nóc nhà, đặt yên chỗ máy dệt, sửa hay làm thuyền chèo, đẩy thuyền mới xuống nước, các việc bồi đắp thêm (như bồi bùn, đắp đất, lót đá, xây bờ kè…)',
            'kieng' => 'Kiêng cữ: Lót giường đóng giường, thừa kế công việc, sự nghiệp, các công việc liên quan đến đào bới (như đào mương, móc giếng, xả nước…)'],
        'mui' => ['tru' => 'Thu',
            'nen_lam' => 'Nên làm: lập hợp đồng, giao dịch, động thổ ban nền, cầu thầy chữa bệnh, ra khơi bắt cá, tìm bắt trộm cướp',
            'kieng' => 'Kiêng cữ: Mua nuôi thêm súc vật'],
        'than' => ['tru' => 'Khai',
            'nen_lam' => 'Nên làm: lập hợp đồng, giao dịch, động thổ ban nền, cầu thầy chữa bệnh, ra khơi bắt cá, tìm bắt trộm cướp',
            'kieng' => 'Kiêng cữ: đắp nền, xây tường'],
        'dau' => ['tru' => 'Bế', 'nen_lam' => 'Nên làm: Bốc mua thuốc, uống thuốc', 'kieng' => 'Kiêng cữ: Lót giường đóng giường, cho vay, động thổ, ban nền đắp nền, vẽ họa chụp ảnh, lên quan đến nhận chức, thừ kế công việc hay sự nghiệp, nhập học, học nghề, ăn hỏi cưới xin, vào làm cơ quan nhà nước, nạp đơn dâng sớ, đóng thọ dưỡng sanh.'],
    ];
    // key la thang
    public static $dongCong = [
        1 => [
            'dan' => ['chi' => 'Dần', 'truc' => 'NGÀY TRỰC KIẾN', 'ynghia' => 'Ngày Vãng vong, không lợi cho việc khởi tạo, kết hôn nhân, lạp thái (ăn hỏi), chủ về gia 
trưởng bị bệnh, bị gọi vì việc quan, trong vòng 60 ngày và 120 ngày tổn tiểu khẩu, trong vòng 
một năm thấy trùng tang, trăm việc không nên dùng.'],
            'mao' => ['chi' => 'Mão', 'truc' => 'NGÀY TRỰC TRỪ', 'ynghia' => 'Không nên khởi tạo, hôn nhân, phạm vào cái đó thì trong vòng 60 ngày tổn gia trưởng, bị 
gọi vì việc quan, trong vòng 3-6 năm thấy xấu, lãnh thoái, chủ về huynh đệ bất nghĩa, mọi 
nghiệp chia tan, gặp phải người ác, sinh ly tử biệt.'],
            'thin' => ['chi' => 'Thìn', 'truc' => 'NGÀY TRỰC MÃN', 'ynghia' => 'Là Thiên phú, Thiên tặc, là Thiên la, lại nói: 
  Giáp Thìn tuy có khí khích giống với Mậu Thìn, cung mà sát tập trung, trăm việc đều 
kị, phạm phải cái đó thì chủ về việc khởi đầu giết người, của bị giảm (thoái), rất hung. 
 Trừ mà ở ngày Thìn cũng không tốt.'],
            'ty' => ['chi' => 'Tỵ', 'truc' => 'NGÀY TRỰC BÌNH', 'ynghia' => 'Là Tiểu hồng sa, có Chu tước, Câu giảo đáo châu tinh, phạm vào cái đó chủ về bị gọi vì 
việc quan, tổn gia trưởng trạch, đàn bà, con gái trong vòng 3-5 năm lớp lớp bất lợi, phá của, 
rất hung, ruộng tằm không thu được sản vật, chết vì tự thắt cổ, bị người ác cướp bóc.'],
            'ngo' => ['chi' => 'Ngọ', 'truc' => 'NGÀY TRỰC ĐỊNH', 'ynghia' => 'Là Hoàng sa, có Hoàng la, Tử đàn, Thiên hoàng, Địa hoàng, Kim ngân, Khố lâu, Điền 
đường, nguyệt tài khố trữ tinh che, chiếu, nên khởi tạo, an táng, dời chỗ ở, khai trương, xuất 
hành, trong vòng 60 ngày, 120 ngày, tiến hoành tài, hoặc nhân phụ ký thành gia (nhờ vả mà 
thành nghiệp), làm lớn thì phát lớn, làm nhỏ thì phát nhỏ, chủ về ruộng, tằm thu lớn, vàng bạc 
đầy kho.'],
            'mui' => ['chi' => 'Mùi', 'truc' => 'NGÀY TRỰC CHẤP', 'ynghia' => 'Là Thiên tặc, có Chu tước, Câu giảo, trong vòng 60 ngày, 100 ngày lục súc hại, lừa ngựa 
thành ác tật. 
  Ất Mùi sát tập trung cung càng kị khởi tạo, nhập trạch (về nhận nhà mới), hôn nhân, khai 
trương, tu chỉnh.'],
            'than' => ['chi' => 'Thân', 'truc' => 'NGÀY TRỰC PHÁ', 'ynghia' => 'Có Chu tước, Câu giảo, bị gọi vì việc quan, khẩu thiệt, giảm gia súc và của, trong vòng 
3-5 năm thấy mộ đàn bà, việc xấu. 
Ngày Canh Thân là chính tứ phế, càng xấu.'],
            'dau' => ['chi' => 'Dậu', 'truc' => 'NGÀY TRỰC NGUY', 'ynghia' => 'Tân Dậu ở tháng giêng, tư, bỏ, không nên dùng vào việc. 
  Duy có ngày Đinh Dậu có Thiên  đức, Phúc tinh che, chiếu, nên an táng, hoàn phúc 
nguyện, xuất hành, khai trương, vào việc quan gặp quý, tốt, chỉ không nên các việc khởi tạo, 
hôn nhân, giá thú, vẫn cái đó vào ngày đó. 
Ngoài ra, các ngày Dậu khác không nên dùng.'],
            'tuat' => ['chi' => 'Tuất', 'truc' => 'NGÀY TRỰC THÀNH', 'ynghia' => 'Có Thiên hỉ, nhưng lại là ngày Địa võng, mọi việc không nên phạm ngày đó, chủ về gia 
trưởng bệnh, nhân khẩu không có nghĩa, lạnh lùng mà lui (lãnh thoái). 
 Lại nói Bính Tuất, Mậu Tuất, Canh Tuất, Nhâm Tuất là sát tập trung cung, phạm vào 
cái đó chủ về khởi đầu giết người, anh em bất nghĩa, tử biệt sinh ly, kị trước nhất là khởi tạo, 
hôn giá, nhập trạch, tu tác.'],
            'hoi' => ['chi' => 'Hợi', 'truc' => 'NGÀY TRỰC THÂU', 'ynghia' => 'Có Câu giảo, không nên dùng vào việc, phạm cái đó tổn gia trưởng, hại con cháu, trong 
vòng 60 ngày, 120 ngày, chủ phương Nam Bạch y hình hại, nam nữ nhiều tai vạ, rất xấu. 
  Duy có ngày bình địa chi với nguyệt kiến âm dương hợp đức, là tốt vừa phải (thứ cát).'],
            'ti' => ['chi' => 'Tí', 'truc' => 'NGÀY TRỰC KHAI', 'ynghia' => 'Ngày Giáp Tí là kim tự chết, ngày ngũ hành âm kị. 
Nhâm Tí là mộc đả bảo bình chung (gỗ đánh vào bình quí cuối cùng), là phương Bắc, 
nơi tắm gội (mộc dục), không nên khởi tạo, hôn nhân, nhập trạch, khai trương. 
 Chỉ có riêng ba ngày Mậu Tí, Bính Tí, Canh Tí duy thủy thổ sinh người, dùng cái đó 
rất tốt, trong có Hoàng la, Tử đàn, Thiên hoàng, Địa hoàng, Kim ngân, tàng tài trữ, liên châu, 
chúng tinh che, chiếu. Trong vòng 60 ngày, 120 ngày được rất nhiều của, quý nhân tiếp dẫn, 
giữ chức lộc, mưu việc thì nhiều may mắn, vượng lục súc, thêm tài sản, cũng nên an táng.'],
            'suu' => ['chi' => 'Sửu', 'truc' => 'NGÀY TRỰC BẾ', 'ynghia' => 'Không lợi cho hôn nhân, khởi tạo, phòng hổ và rắn làm hại, lừa ngựa đá phải thành ác 
tật, bần, bệnh, rất xấu.'],
        ],
        2 => [
            'mao' => ['chi' => 'Mão', 'truc' => 'NGÀY TRỰC KIẾN', 'ynghia' => 'Không nên dùng việc, phạm cái đó tổn gia trưởng, và con trai út (thiếu phòng), con cháu 
gặp ôn dịch, nghèo khổ, khóc lóc, lớp, lớp chồng chất, trong vòng 3-5 năm, xa hơn thì 9 năm, 
bị kiện ngang trái, bại vong. 
  Tháng hai vào ngày Mão đều là ngày trời đất chuyển sát.'],
            'thin' => ['chi' => 'Thìn', 'truc' => 'NGÀY TRỰC TRỪ', 'ynghia' => 'Không lợi cho dời chỗ ở, về nhà mới, hôn nhân, khai trương các loại, mưu trù làm việc, 
phạm cái đó trong vòng 60 ngày, 120 ngày, chủ bị gọi vì việc quan, tốn của, bại ruộng vườn, 
tằm, mất sản nghiệp. 
 Ngày Giáp  Thìn, Mậu  Thìn, sát tập trung cung càng xấu, trong ba năm mất người 
trưởng trạch, cái vật làm quái hỏa, trộm vào lừa.'],
            'ty' => ['chi' => 'Tỵ', 'truc' => 'NGÀY TRỰC MÃN', 'ynghia' => 'Vãng vong, Thiên không, không nên động thổ, nếu tu tạo trăm việc đều tốt. 
 Nếu như ở hai cung Càn, Tốn khởi tạo đều tốt, xuất hành, khai trương, hôn nhân, nhập 
trạch, trong có Hoàng la, Tử đàn, Điền đường, Khố trữ tinh, che, chiếu, trong năm đó nhà sinh 
quý tử, ruộng, tằm hưng vượng, suốt đời tốt lành.'],
            'ngo' => ['chi' => 'Ngọ', 'truc' => 'NGÀY TRỰC BÌNH', 'ynghia' => 'Chỉ nên làm sinh cơ, như các việc hôn nhân, tu tạo, dùng cái đó trong 60 ngày, 120 ngày 
bị gọi vì việc quan, tổn nhân khẩu, 3-6-9 năm lạnh lùng mà lui. (Sinh cơ là thọ mộc (?) và 
sinh cơ - tức quan tài và gò mả làm trước, khi chủ còn sống).'],
            'mui' => ['chi' => 'Mùi', 'truc' => 'NGÀY TRỰC ĐỊNH', 'ynghia' => 'Không lợi việc hôn nhân, khởi tạo, hệ âm cung, chủ việc không nên hướng vào trong 
nhà, động làm nên nhất thiết sửa sang phía ngoài nhà thì sẽ không hại. 
  Ất Mùi là Bạch hổ nhập trung cung, càng xấu, phạm cái đó tổn nhân khẩu. 
 Là một tháng duy chỉ có một ngày Quý Mùi là thủy nhập Thái châu, do quý thủy gặp 
trường sinh tướng vượng việc đi (thương ?), trong đó có Hoàng la, Tử đàn, Thiên hoàng, Địa 
hoàng tinh, che, chiếu, lợi người sống lâu, thêm con cháu, tiến ruộng đất, rất tốt. 
  Ngoài ra, mọi ngày Mùi đều bất lợi.'],
            'than' => ['chi' => 'Thân', 'truc' => 'NGÀY TRỰC CHẤP', 'ynghia' => 'Có Thiên nguyệt nhị đức, nên tu tạo, động thổ, mai táng, hôn nhân, khai trương, nhập 
trạch, xuất hành, và có Hoàng la, Tử đàn, Kim ngân khố lâu, Bảo tàng tinh, che, chiếu, trong 
vòng 3-6-9 năm rất vượng, thêm nhân khẩu, sinh quý tử, tăng điền sản, rất tốt. 
 Duy ngày Canh Thân là Xuân chính tứ phế, trăm việc phải tránh, kiêng.'],
            'dau' => ['chi' => 'Dậu', 'truc' => 'NGÀY TRỰC PHÁ', 'ynghia' => 'Tiểu hồng sa, Thiên tặc, không lợi cho việc hôn nhân, tu tạo, phạm cái đó, trong vòng 60 
ngày, 120 ngày bị gọi vì việc quan, khẩu thiệt, người âm trở lại, hao miệng nhỏ, tật bệnh. 
  Tân Dậu chính tứ phế càng xấu, ngày đó là ngày Nguyệt phá, rất xấu.'],
            'tuat' => ['chi' => 'Tuất', 'truc' => 'NGÀY TRỰC NGUY', 'ynghia' => 'Nên hợp phản (Ghép ván gỗ thành quan tài), làm sinh cơ. 
 Nếu tu tạo, đi gặp cha mẹ, hôn nhân thì không lợi con trai trưởng, trước là thoái điền địa, 
lửa, trộm vào lừa. 
 Lại nói Bính Tuất, Nhâm Tuất là Sát nhập trung cung, càng xấu.'],
            'hoi' => ['chi' => 'Hợi', 'truc' => 'NGÀY TRỰC THÀNH', 'ynghia' => 'Thiên hỉ, có Thiên hoàng, Địa hoàng, Hoàng la, Tử đàn, Ngọc đường,Tụ bảo tinh, che, 
chiếu, nên hôn nhân, khai trương, nhập trạch, xuất hành, khởi tạo, an táng,  định tảng (đặt 
móng), buộc giàn, trong vòng 60 ngày, 120 ngày tiến hoành tài, quý nhân tiếp dẫn, mưu việc 
rất tốt. 
 Là Tân Hợi, Quý Hợi trong tháng đó tốt trên hết.'],
            'ti' => ['chi' => 'Tí', 'truc' => 'NGÀY TRỰC THÂU', 'ynghia' => 'Kị hôn nhân, khởi tạo, nhập trạch, khai trương, phạm cái đó trong vòng ba năm tất thoái 
của, không tiến thêm, chủ về không kiện cáo thì sản nghiệp cũng hư hao.'],
            'suu' => ['chi' => 'Sửu', 'truc' => 'NGÀY TRỰC KHAI', 'ynghia' => 'Không lợi về tạo tác, sửa sang, hôn nhân, gặp cha mẹ, phạm cái  đó chủ về  điền, tằm 
không có thu hoạch, trong nhà có người đẻ bị nguy, bị tai nạn về nước sôi và bỏng lửa. 
  Đinh Sửu, Quý Sửu là sát nhập trung cung càng xấu, chủ về quan không, tổn nhân khẩu, 
tiểu nhân vào làm hại.'],
            'dan' => ['chi' => 'Dần', 'truc' => 'NGÀY TRỰC BẾ', 'ynghia' => 'Hoàng sa, có Hoạt dược tinh nên ghép ván làm sinh cơ, nhưng bất lợi về tu tạo, động thổ, 
hôn nhân, nhập trạch, khai trương. 
  Là ngày mà ngũ hành vô khí, bình thường mà dùng thì có thể, tuy không có hại lớn, 
không dùng là hay nhất.'],
        ],
        3 => [
            'thin' => ['chi' => 'Thìn', 'truc' => 'NGÀY TRỰC KIẾN', 'ynghia' => 'Có Địa võng, Câu giảo, không lợi về tu tạo, an táng, hôn nhân, khai trương, phạm cái đó 
chủ bị bỏng nước sôi, bỏng lửa, chim ác (chim thiu) làm hại, tự do sinh nam, sinh nữ nhưng 
đều rất xấu xí, có ác tật, vô ích. 
 Ngày Giáp Thìn, Mậu Thìn, là Sát nhập trung cung, càng xấu, chủ về trong ba năm nhà 
bị phá, người mất.'],
            'ty' => ['chi' => 'Tỵ', 'truc' => 'NGÀY TRỰC TRỪ', 'ynghia' => 'Đinh Tị nên tu tạo, nhập trạch, di cư, động thổ, làm đồ dùng, hôn nhân, thì rất tốt. 
  Kỷ Tị tạo tác, nhập trạch, cũng tốt. Nếu mai táng thì phạm trùng tang bất lợi dụng. 
  Ất Tị có 10 thứ ác xấu. 
  Tân Tị tuy có hỏa tinh, ngược lại có Xương quỷ (quỷ cuồng vọng), bại vong, lại là ngày 
thập ác phạt, không nên dùng. 
  Quý Tị, Thiên thượng Không vong, lại phạm thổ quỷ cũng không nên dùng. 
  Đây đều là tất ứng mọi việc.'],
            'ngo' => ['chi' => 'Ngọ', 'truc' => 'NGÀY TRỰC MÃN', 'ynghia' => 'Thiên phú. 
  Giáp Ngọ có thổ quỷ. 
  Bính Ngọ bình thường, không thể thấy tốt. 
  Mậu Ngọ có Xương quỷ, bại vong, và phạm trùng tang, tức là an táng cũng thuộc không 
nên. 
  Canh Ngọ là ngày thập ác, không thể dùng. 
  Nhâm Ngọ là Thiên đức, Nguyệt đức, dùng là tốt vừa (thứ cát).'],
            'mui' => ['chi' => 'Mùi', 'truc' => 'NGÀY TRỰC BÌNH', 'ynghia' => 'Cũng giống như tháng giêng, tháng năm, không nên dùng, tức là mưu trù nho nhỏ (tiểu 
tiểu doanh) là cũng không lợi. 
 Nếu như Ất Mùi càng thêm xấu, hiểm. Cái số trực Thiên cang, lại phạm Câu giảo, Chu 
tước.'],
            'than' => ['chi' => 'Thân', 'truc' => 'NGÀY TRỰC ĐỊNH', 'ynghia' => 'Giáp Thân, Bính Thân nên phát chặt cây cỏ, phá đất, định tảng, buộc giàn, an táng rất 
tốt, trong 2-3 năm thêm con, cháu, tiến tài lộc. 
  Nhâm Thân có Thiên đức, Nguyệt  đức, Hoàng la, Tử  đàn, Thiên tinh, Địa tinh, Kim 
ngân khố lâu tinh, che, chiếu, là ngày thập toàn rất tốt, rất lợi. 
  Mậu Thân, Thiên cang, Không vong, Xương quỷ, bại vong, xấu. 
  Canh Thân tháng giêng, tháng tư, bỏ, cũng xấu. 
 Ngày Thân lại thuộc Vãng vong, xuất hành, xuất quân, phó nhậm (nhận việc đi trước) 
không lấy ngày này.'],
            'dau' => ['chi' => 'Dậu', 'truc' => 'NGÀY TRỰC CHẤP', 'ynghia' => 'Ất Dậu nên tu tạo, nhập trạch, hôn nhân, khai trương, xuất hành. 
Quý Dậu an táng thì rất tốt. 
Đinh Dậu an táng thì tốt vừa. 
Ất Dậu (Kỷ Dậu?) có cửu thổ quỷ. 
Tân Dậu ở Chính tứ phế, không nên dùng.'],
            'tuat' => ['chi' => 'Tuất', 'truc' => 'NGÀY TRỰC PHÁ', 'ynghia' => 'Trực với Nguyệt kiến xung phá mọi việc, không nên dùng. 
Bính Tuất, Nhâm Tuất là Sát nhập trung cung, càng xấu.'],
            'hoi' => ['chi' => 'Hợi', 'truc' => 'NGÀY TRỰC NGUY', 'ynghia' => 'Thiên thành, có hung bạo. 
  Kỷ Hợi có Hỏa tinh, có Văn Xương tinh, che, chiếu, học nên rất tốt, các việc còn lại tốt 
vừa. 
  Ất Hợi dùng cũng tốt vừa. 
  Tân Hợi đàn bà đó kim, ""âm phủ đã đến kỳ quyết điều khiển"", âm khí toàn thịnh, không 
có chỗ hợp ở dương gian. 
  Đinh Hợi lại trực Hắc sát. 
  Quý Hợi là ngày cuối cùng của lục giáp, ngũ hành không có khí, chủ về tuyệt nhân, lại là 
Thụ tử, việc không thể dùng.'],
            'ti' => ['chi' => 'Tí', 'truc' => 'NGÀY TRỰC THÀNH', 'ynghia' => 'Hoàng sa, Thiên hỉ. 
  Nhâm Tí tuy có Thiên đức, Nguyệt đức, là nhất bạch, chủ việc Mộc đả bảo bình chung 
(gỗ đánh vào bình quí cuối cùng), là nơi tắm gội ở phương Bắc, ngũ hành không có khí, phú 
lực nông, nhưng mưu trù nho nhỏ, làm thì có thể. Nếu như khai trương, xuất hành, nhập trạch, 
sửa sang, và hôn nhân, hạng (?), dùng ngày đó sẽ thấy xấu, bại, họa hại, tai thương. Ngày đó 
gọi là bình vỡ băng tiêu (phạn giải băng tiêu).'],
            'suu' => ['chi' => 'Sửu', 'truc' => 'NGÀY TRỰC THÂU', 'ynghia' => 'Tiểu hồng sa, Thiên tặc. 
  Đinh Sửu, Quý Sửu là sát nhập trung cung, không lợi cho tu tạo, hôn nhân, nhập trạch, 
phạm cái đó chủ thoái tài, tật bệnh, tranh tụng phải trái, xấu. 
 Còn lại Sửu là cũng không tốt, phòng tiểu nhân hình hại.'],
            'dan' => ['chi' => 'Dần', 'truc' => 'NGÀY TRỰC KHAI', 'ynghia' => 'Thiên tặc. 
  Mậu Dần là Thiên xá, dùng ngày đó lại tốt. 
  Nhâm Dần có Thiên đức, Nguyệt đức, chỉ nên mai táng và ghép ván làm sinh cơ, dùng 
cái đó thêm con cháu, tiến điền địa, thăng quan chức, tốt trên hết. 
 Ngoài đó ra, Dần là tốt vừa, nhưng có lục bất thành, lục bất hợp ở đó, ngưng dùng cái đó, 
cuối cùng là bất lợi, nên cẩn thận cái đó.'],
            'mao' => ['chi' => 'Mão', 'truc' => 'NGÀY TRỰC BẾ', 'ynghia' => 'Không nên tạo tác, hôn nhân, mai táng, nhập trạch, phạm cái đó tổn thương, tật đau, lãnh 
thoái, xấu cho trăm việc, không nên dùng.'],
        ],
        4 => [
            'ty' => ['chi' => 'Tỵ', 'truc' => 'NGÀY TRỰC KIẾN', 'ynghia' => 'Tiểu hồng sa, không lợi cho xuất hành, giá thú, an táng, tạo tác, nhập trạch, khai trương, 
phạm cái đó chủ lãnh thoái, tật bệnh, ruộng, tằm không có thu hoạch, chết ở nơi xa không về, 
tài sản phá tán, ngày đó là ngày thụ tử.'],
            'ngo' => ['chi' => 'Ngọ', 'truc' => 'NGÀY TRỰC TRỪ', 'ynghia' => 'Hoàng sa. 
  Canh Ngọ là Nguyệt đức. 
 Duy Giáp Ngọ, Nhâm Ngọ có Hoàng la, Tử đàn, Thiên hoàng, Địa hoàng, các tinh che, 
chiếu, nên tu tạo, hôn nhân, khai trương, xuất hành, nhập trạch, trong vòng 60 ngày, 120 
ngày, tăng điền địa, tiến nhân khẩu, sinh quý tử, rất vượng. 
 Ngày Bính Ngọ, Mậu Ngọ là thiên địa chuyển sát, dùng cái đó xấu.'],
            'mui' => ['chi' => 'Mùi', 'truc' => 'NGÀY TRỰC MÃN', 'ynghia' => 'Thiên phú, Thiên tặc. 
 Ngày Tân Mùi có Thiên đức, Nguyệt đức. 
  Kỷ Mùi có Hỏa tinh, đều là tốt vừa, nên định tảng, tạo giàn, mai táng, nhưng hai việc 
hôn nhân, khởi tạo là không chịu được. 
 Lại theo tu tạo lịch nói là ngày Bạch hổ nhập trung cung, dùng cái đó không thể là lợi, 
cần tra lại năm, tháng, ngày, nếu như có cát tinh, và mệnh cung cùng hợp phương thì được, 
nếu có dính với Nguyệt yếm, Thiên tặc, phạm những cái đó chủ về xấu, lãnh thoái.'],
            'than' => ['chi' => 'Thân', 'truc' => 'NGÀY TRỰC BÌNH', 'ynghia' => 'Chu tước, Câu giảo, không lợi cho xuất hành, an táng, hôn nhân, nhập trạch, chủ về bị 
gọi vì việc quan, khẩu thiệt, âm nhân, trẻ em sinh tai ách. 
 Ngày Giáp Thân, Canh Thân là Sát nhập trung cung, càng xấu, tất chủ về tiểu nhân lôi 
kéo vào việc vạ, phá của, sinh con xấu như con quái, có tai nguy về thủy, hỏa.'],
            'dau' => ['chi' => 'Dậu', 'truc' => 'NGÀY TRỰC ĐỊNH', 'ynghia' => 'Tuy có Cửu thổ quỷ, không nên động thổ, mai táng, nếu mưu trù nho nhỏ là ở vào tháng 
tư. 
 Ngày Dậu là ngày tốt vừa, như hôn nhân, nhập trạch, nên cấm không dùng, chủ về xấu.'],
            'tuat' => ['chi' => 'Tuất', 'truc' => 'NGÀY TRỰC CHẤP', 'ynghia' => 'Có Câu giảo. 
 Ngày Bính Tuất, Nhâm Tuất là Sát nhập trung cung, trăm việc đều rất xấu. 
  Duy có ngày Giáp Tuất mưu trù nho nhỏ là tốt vừa, hai mơi bốn hướng mọi thứ Sát trầu 
trời đã có sửa sang, thì có thể hôn nhân, an táng, nhập trạch, khai trương, không có chỗ nào 
nên dùng, chủ về tổn trạch trưởng (người lớn nhất trong hộ), hại tay chân, hao tiền tài, rất xấu.'],
            'hoi' => ['chi' => 'Hợi', 'truc' => 'NGÀY TRỰC PHÁ', 'ynghia' => 'Vãng vong, Chu tước, Câu giảo, hại về bị gọi vì việc quan, tiểu nhân mùa thu thì tại đó 
chủ về tổn tiền tài, bị tạp bệnh. 
  Quý Hợi ở tháng giêng, tư, bỏ, càng xấu. 
 Là ngày Hợi trong tháng thì mọi việc đều kị.'],
            'ti' => ['chi' => 'Tí', 'truc' => 'NGÀY TRỰC NGUY', 'ynghia' => 'Canh Tí là Nguyệt đức. 
  Bính Tí, Mậu Tí, khởi tạo, hôn nhân, hưng công, động thổ, xuất hành, khai trương, di 
đồ thì sẽ tiến nhân khẩu, thêm con cháu, vượng điền, tàm (tằm), tăng tài sản, làm lớn thì phát 
lớn, làm nhỏ thì phát nhỏ. 
  Giáp Tí là kim tự tử, ngũ hành vô khí. 
  Nhâm Tí là mộc đả bảo bình, nơi mà phương Bắc tắm gội, phúc lực mỏng, lại là Sát tứ 
phế, dùng cái đó tổn nhân khẩu, chủ lãnh thoái, rất xấu. 
 Hai ngày Giáp Tí, Nhâm Tí là thấy ngay tiêu sách (xơ xác cô đơn), tổn phá.'],
            'suu' => ['chi' => 'Sửu', 'truc' => 'NGÀY TRỰC THÀNH', 'ynghia' => 'Được Thiên hỉ, Thiên thành, nhưng phạm Chu tước, Câu giảo, nếu dùng cái đó sẽ bị quan tư, 
khẩu thiệt, tiểu nhân vu vạ bừa bãi, mất hỏng. 
  Đinh Sửu, Quý Sửu là Sát nhập trung cung, càng xấu, số ngày đó phạm không vong, 
phá tài, tiểu nhân hãm hại.'],
            'dan' => ['chi' => 'Dần', 'truc' => 'NGÀY TRỰC THÂU', 'ynghia' => 'Được Thiên hỉ, Thiên thành, nhưng phạm Chu tước, Câu giảo, nếu dùng cái đó sẽ bị quan tư, 
khẩu thiệt, tiểu nhân vu vạ bừa bãi, mất hỏng.'],
            'mao' => ['chi' => 'Mão', 'truc' => 'NGÀY TRỰC KHAI', 'ynghia' => 'Tân Mão là Thiên đức. 
  Quý Mão, Ất Mão có Hoàng la, Tử đàn, Thiên hoàng, Địa hoàng tinh che, chiếu, xuất 
hành, hôn giá, tạo tác, khai trương, nhập trạch, mọi việc đều rất tốt, chủ về mưu việc được 
hanh thông, có quý nhân tiếp dẫn, tiến tài lộc. 
 Ngoài đó ra các ngày Mão còn lại là tốt vừa.'],
            'thin' => ['chi' => 'Thìn', 'truc' => 'NGÀY TRỰC BẾ', 'ynghia' => 'Mậu Thìn, Giáp Thìn là Sát nhập trung cung, không lợi cho tu tạo, khai trương, nhập 
trạch, an táng, phạm cái đó tổn nhân khẩu, lục súc không vượng, tài sản có bị mất. 
 Ngày Canh Thìn tuy có trực Nguyệt đức, nhưng lại là Thiên địa chuyển sát chi ngưng. 
  Bính Thìn, Nhâm Thìn, hỏa tinh, mưu trù nho nhỏ làm thì được, không nên khởi tạo, 
hôn nhân, dời đồ, khai trương, rất xấu.'],
        ],
        5 => [
            'ngo' => ['chi' => 'ngọ', 'truc' => 'NGÀY TRỰC KIẾN', 'ynghia' => 'Giáp Ngọ là Thiên xá, tuy hệ chuyển sát, nhưng dùng cái đó tốt vừa. 
 Những ngày Ngọ còn lại mai táng cũng không lợi, nếu dùng chủ về bị gọi vì việc quan, 
khẩu thiệt, cô quả, cùng khổ, bệnh tật. 
  Cái tháng năm gặp Ngọ đều hệ Thiên địa chuyển sát.'],
            'mui' => ['chi' => 'Mùi', 'truc' => 'NGÀY TRỰC TRỪ', 'ynghia' => 'Duy Ất Mùi là một ngày rất bất lợi, nếu lấy vợ, khai trương, nhập trạch, tu tạo, chủ về 
thoái nhân khẩu, sinh bệnh tật, tổn của. 
 Ngoài ngày đó ra, những ngày Mùi còn lại, nếu làm việc nhỏ thì có thể dùng nhưng tốt 
vừa.'],
            'than' => ['chi' => 'Thân', 'truc' => 'NGÀY TRỰC MÃN', 'ynghia' => 'Thiên phú, Thiên hỉ. 
  Giáp Thân, Bính Thân, Mậu Thân, nên an táng, khởi tạo, hôn nhân, nhập trạch, khai 
trương xuất hành, thì tốt vừa, không nên động thổ. 
  Canh Thân chỉ nên an táng, không nên tu tạo, nhập trạch, là ngày tây trầm, ngũ hành 
không có khí, không thể dùng, tuy là ngày táng, nhưng nguyệt lệnh không lợi.'],
            'dau' => ['chi' => 'Dậu', 'truc' => 'NGÀY TRỰC BÌNH', 'ynghia' => 'Tiểu hồng sa, có Chu tước, Câu giảo, Đáo châu tinh, bị gọi vì việc quan, tổn trưởng, sơ, 
nhà xuống cảnh lênh đênh (linh đình), trăm việc không nên phạm cái đó, rất xấu.'],
            'tuat' => ['chi' => 'Tuất', 'truc' => 'NGÀY TRỰC ĐỊNH', 'ynghia' => 'Giáp Tuất, Canh Tuất, Mậu Tuất, có Hoàng la, Tử đàn, Thiên hoàng, Địa hoàng, Kim 
ngân bảo tàng, Điền bồi tầng, Châu tụ thâm, Giá mã quy, Thánh du thuận, các tinh che, chiếu, 
rất tốt. Nếu khởi tạo, hưng công, động thổ, nhập trạch, khai trương, hôn nhân, mai táng, mọi 
việc thì được gia quan, tiến tài, sinh quý tử, thêm hoành tài. 
 Duy Bính Tuất, Nhâm Tuất là hai ngày Sát nhập trung cung, tuy có cát tinh chiếu giải, 
nhưng cuối cùng thì khó được ích.'],
            'hoi' => ['chi' => 'Hợi', 'truc' => 'NGÀY TRỰC CHẤP', 'ynghia' => 'Ngày Ất Hợi, nhỏ thì có thể tu sửa vì là tốt vừa. 
  Đinh Hợi, Kỷ Hợi, cũng là tốt vừa. 
  Tân Hợi là ngày âm phủ hỏa thoái. 
  Quý Hợi là ngày cuối cùng của lục giáp, lại chính tứ phế, rất xấu.'],
            'ti' => ['chi' => 'Tí', 'truc' => 'NGÀY TRỰC PHÁ', 'ynghia' => 'Thiên tặc, không nên cưới, đi gặp cha mẹ, tạo tác, an táng, nhập trạch, mọi việc phạm cái 
đó bị gọi về việc quan, tổn lục súc, điền sản không thu, rất xấu. 
  Nhâm Tí là chính tứ phế, càng xấu, ngày đó trăm việc không lợi, phạm vào thụ tử.'],
            'suu' => ['chi' => 'Sửu', 'truc' => 'NGÀY TRỰC NGUY', 'ynghia' => 'Đinh Sửu, Quý Sửu không nên giá thú, đi gặp cha mẹ, tạo tác, an táng, nhập trạch, phạm 
cái đó thì điền sản không thu, tài vật thất thoát, hổ cắn, rắn hại, nhiều sự xấu. 
 Những ngày Sửu còn lại cũng không tốt, tổn lục súc, bị gọi vì việc quan, trăm việc không 
lợi.'],
            'dan' => ['chi' => 'Dần', 'truc' => 'NGÀY TRỰC THÀNH', 'ynghia' => 'Hoàng sa, thiên hỉ. 
  Bính Dần là Thiên đức, Nguyệt đức. 
  Canh Dần, Mậu Dần, Giáp Dần có Hoàng la, Tử đàn, Thiên hoàng, Địa hoàng, Kim 
ngân khố lâu, Ngọc đường bảo tàng, là những cát tinh cùng chiếu, hưng công, động thổ, định 
tảng, buộc giàn, nhập trạch, khai trương, trong vòng 60 ngày, 120 ngày sẽ thêm của, tăng, nhà 
cửa từ đó giầu thịnh, đường đời thấy an khang, rất tốt. 
 Cũng là Nhâm Dần của tháng tuy có sao tốt chiếu ở trong giữa, chỉ có Sát tinh tương 
khắc mà thành tốt vừa.'],
            'mao' => ['chi' => 'Mão', 'truc' => 'NGÀY TRỰC THÂU', 'ynghia' => 'Vãng vong, có Chu tước, Câu giảo, tiểu nhân hình hại, vạ nạn triền miên, bị gọi vì việc 
quan, khẩu thiệt, tổn lục súc, trăm việc không nên, rất xấu.'],
            'thin' => ['chi' => 'Thìn', 'truc' => 'NGÀY TRỰC KHAI', 'ynghia' => 'Thiên thành. 
  Bính Thìn có Nguyệt đức. 
  Canh Thìn, Nhâm Thìn, có Hoàng la, Tử đàn, là những sao tốt che, chiếu, dùng ngày đó 
thì điền sản và lục súc hưng vượng, sinh quý tử, trăm việc rất tốt. 
 Duy Mậu Thìn, Giáp Thìn là Sát tập trung cung, rất xấu.'],
            'ty' => ['chi' => 'Tỵ', 'truc' => 'NGÀY TRỰC BẾ', 'ynghia' => 'Ất Tị, Tân Tị có Hoàng la, Tử  đàn, che, chiếu, hưng công, tạo tác,  động thổ, tu tạo 
đường trì, thương khố (làm hoặc sửa đường, ao, kho chứa), chuồng trại trâu, dê, hôn nhân, 
khai trương, xuất hành, nhiều ích lợi, nhà cửa, con cháu Xương (vượng) thịnh, điền sản bội 
thu, nhân khẩu an khang, rất tốt. 
 Các ngày Tị còn lại không tốt.'],
        ],
        6 => [
            'mui' => ['chi' => 'Mùi', 'truc' => 'NGÀY TRỰC KIẾN', 'ynghia' => 'Ất Mùi là Sát nhập trung cung, không lợi cho những việc tu tạo, hôn nhân, nhập trạch, 
khai trương, lên quan, phạm cái đó không tốt, nhiễm ôn dịch, tổn nhân khẩu, mất của cải, rất 
xấu.'],
            'than' => ['chi' => 'Thân', 'truc' => 'NGÀY TRỰC TRỪ', 'ynghia' => 'Giáp Thân có Thiên đức, Nguyệt đức, Hoàng la, Tử đàn tinh che, chiếu, lợi cho việc 
dựng cột, khởi tạo, an táng, động thổ, khai sơn, phạt cỏ, xuất hành, khai trương, trăm việc đều 
tốt. 
Các ngày Thân còn lại cũng rất tốt. 
Duy có Bính Thân là một ngày ngũ hành không có khí, không thể dùng. 
Ngày Canh Thân dùng phải thận trọng.'],
            'dau' => ['chi' => 'Dậu', 'truc' => 'NGÀY TRỰC MÃN', 'ynghia' => 'Thiên hỉ, Thiên phú. 
  Ất Dậu, Tân Dậu, phạt mộc, buộc giàn, đặt móng (định tảng), khởi tạo là tốt vừa. 
 Ngày Kỷ Dậu là cửu thổ quỷ. 
  Quý Dậu là ngày tiểu táng, lại phạm Hắc sát sở thuộc, cẩn thận có thể hung với việc cấp 
dùng. 
 Ngày Đinh Dậu gặp ngày Mãn cũng bất lợi, đó là ngày hại, sợ rằng trong tốt có xấu, cuối 
cùng là không đẹp, dùng thì nên cẩn thận.'],
            'tuat' => ['chi' => 'Tuất', 'truc' => 'NGÀY TRỰC BÌNH', 'ynghia' => 'Có Chu tước, Câu giảo, lại phạm Đáo châu tinh, không lợi cho nhập trạch, hôn nhân, 
phạm vào cái đó chủ về bị gọi vì việc quan, không xấu nhiều. 
 Duy ngày Giáp Tuất là một ngày Huyền nữ trộm sửa, tám hướng đều trắng, ngày đó ở 
24 hướng chư thần chầu trời, có khí, có thể dùng.'],
            'hoi' => ['chi' => 'Hợi', 'truc' => 'NGÀY TRỰC ĐỊNH', 'ynghia' => 'Kỷ Hợi là Hỏa tinh. 
  Đinh Hợi có Hoàng la, Tử đàn, Thiên hoàng, Địa hoàng, các tinh che, chiếu. 
  Ất Hợi có Văn Xương trực nhật, nên xuất hành, nhập trạch, hôn nhân, nhập học, tu tạo, 
động thổ, tham quan (đi gặp quan), thấy quý, chiêu tài lộc (thu hút được tài lộc), sinh quý tử 
làm việc lớn thì phát lớn, làm việc nhỏ thì phát nhỏ. Lại nói Văn Xương Ất Hợi tại Ngọ, Văn 
Xương là Thái dương ở cung Ngọ, là ngôi của Thái dương, cho nên Có Văn Xương tinh trực 
nhật là đã rất tốt. 
  Tân Hợi là phụ nhân chi kim, âm khí của kim thịnh. 
  Quý Hợi là ngày cuối cùng của lục giáp, ngày ấy ngũ hành không có khí, hai ngày đó 
không nên dùng.'],
            'ti' => ['chi' => 'Tí', 'truc' => 'NGÀY TRỰC CHẤP', 'ynghia' => 'Hoàng sa. 
  Bính Tí, Canh Tí lợi cho khởi tạo, hưng công, động thổ, làm kho chứa, nhập trạch, di 
đồ, khai trương, xuất hành. 
  Mậu Tí là tốt vừa. 
  Giáp Tí tuy là đầu của lục giáp, ở tháng giêng, tháng sáu, trực Thiên đức, Nguyệt đức 
nên không thể dùng Sát tự tử chi kim, ngũ hành không có khí, người bình thường không thể 
gặp được (bất năng dương), đó là Hắc sát ở phương Bắc, tướng quân chi khí. 
  Nhâm Tí là mộc đả bảo bình, Bắc phương mộc dục chi địa, lại là chính tứ phế, càng kị 
dùng.'],
            'suu' => ['chi' => 'Sửu', 'truc' => 'NGÀY TRỰC PHÁ', 'ynghia' => 'Tiểu hồng sa, ngày đó không có cát tinh (sao tốt), không thể mưu trù làm, là vạn bất đắc, 
khi đã cần chọn cẩn thận làm những việc nho nhỏ cấp dùng, nếu như khởi tạo, khai trương, 
xuất hành, hôn nhân, chủ về tổn lục súc, bị gọi vì việc quan. 
  Đinh Sửu, Quý Sửu là Sát nhập trung cung, phạm cái đó sát nhân, xấu không thể nói.'],
            'dan' => ['chi' => 'Dần', 'truc' => 'NGÀY TRỰC NGUY', 'ynghia' => 'Mùa hạ là quỷ thần không vong. 
  Giáp Dần Thiên đức, Nguyệt đức, Hoàng la, Tử đàn, Kim ngân khố lâu, Lộc bảo lâu, ích 
đế ngự tinh, cùng chiếu, nhưng không lợi cho đi xa, định, tạo, nhập trạch, hôn nhân. Nếu khai sơn, mai táng, mưu trù trăm việc, trong vòng 60 ngày, 120 ngày sinh quý tử, gia nghiệp hưng vượng, có quý nhân tiếp dẫn, tiến sản nghiệp, rất tốt. 
 Các ngày Dần còn lại tốt vừa.'],
            'mao' => ['chi' => 'Mão', 'truc' => 'NGÀY TRỰC THÀNH', 'ynghia' => 'Thiên hỉ. 
  Ất Mão, Tân Mão có Hoàng la, Tử đàn, Loan dữ (xe kiệu) bảo cái, Lộc âm, mã vãng, và 
Quỳnh ngọc Kim bảo, Thiên đế tụ bảo, mọi thứ sao tốt chiếu lâm, lợi cho nhập trạch, khai 
trương, xuất hành, hôn nhân, chủ về thêm con cháu, vượng điền sản, tiến hoành tài, tăng cư ốc 
(nhà ở), sinh quý tử, rất tốt. 
 Các ngày Mão còn lại tốt vừa.'],
            'thin' => ['chi' => 'Thìn', 'truc' => 'NGÀY TRỰC THÂU', 'ynghia' => 'Giáp Thìn có Thiên đức, với Bính Thìn và Nhâm Thìn là ba ngày tốt vừa, lợi thâu mới 
sửa sang, chủ về thêm điền sản, vượng lục súc, cũng nên an táng, mưu trù. 
 Là Canh Thìn làm Đằng sà (rắn biết bay), Chu tước. 
  Không nên dùng Mậu Thìn vì cũng không tốt.'],
            'ty' => ['chi' => 'Tỵ', 'truc' => 'NGÀY TRỰC KHAI', 'ynghia' => 'Thiên thành, Thiên tặc, Phúc sinh. 
 Chỉ nên Ất Tị, Quý Tị thì hưng công, động thổ, nhập trạch, khai trương, là tốt vừa. 
 Các ngày Tị còn lại bất lợi, phạm Nguyệt yếm, xấu'],
            'ngo' => ['chi' => 'Ngọ', 'truc' => 'NGÀY TRỰC BẾ', 'ynghia' => 'Vãng vong. 
  Giáp Ngọ là Thiên xá, không hệ chuyển sát, lại trực Nguyệt đức, sát, cũng chỉ có thể 
dùng việc nhỏ, bởi vì có Thụ tử, khí đó không chọn vẹn. 
  Bính Ngọ là táng nhật, nếu mưu trù nho nhỏ thì cũng là tốt vừa. 
  Nhâm Ngọ, Canh Ngọ táng nhỏ là tốt vừa, các việc còn lại khác thì không nên. 
  Mậu Ngọ là trùng tang, không thể dùng.'],
        ],
        7 => [
            'than' => ['chi' => 'Thân', 'truc' => 'NGÀY TRỰC KIẾN', 'ynghia' => 'Mậu Thân là Thiên xá (?). 
  Giáp Thân, Nhâm Thân là ngày tỷ hòa, chỉ nên mai táng. Nhưng nguyệt kiến trên xấu, 
không thể dùng. 
  Canh Thân là Sát nhập trung cung. 
  Bính Thân là ngũ hành không có khí, càng xấu.'],
            'dau' => ['chi' => 'Dậu', 'truc' => 'NGÀY TRỰC TRỪ', 'ynghia' => 'Vãng vong. 
  Ất Dậu không có sao xấu, khai sơn, phạt cỏ, an táng, hưng công, định tảng, buộc giàn, 
sửa mới, tạo tác, xuất hành, khai trương, nhập trạch, di cư là tốt vừa. 
  Kỷ Dậu là Cửu thổ quỷ. 
  Đinh Dậu xấu bại. 
  Quý Dậu là Phục kiếm chi kim, Bắc phương Hắc sát tướng quân chi khí, tổn thương, 
xấu, ác. 
  Tân Dậu là Thiên địa chuyển sát chính tứ phế, xấu.'],
            'tuat' => ['chi' => 'Tuất', 'truc' => 'NGÀY TRỰC MÃN', 'ynghia' => 'Thiên phú, Thiên tặc. 
  Bính Tuất, Nhâm Tuất là Chu tước, Câu giảo, Bạch hổ nhập trung cung, dùng ngày đó 
chủ về bị gọi vì việc quan, là không nhà cửa, suy bại, tổn nhân khẩu, tật bệnh triền miên, một 
lần dậy là một lần ngã, không rời giường chiếu, rất xấu, kị cái đó.'],
            'hoi' => ['chi' => 'Hợi', 'truc' => 'NGÀY TRỰC BÌNH', 'ynghia' => 'Đằng sà triền miên, tổn nhân khẩu, gặp việc quan, khẩu thiệt, vạ ngang, xấu.'],
            'ti' => ['chi' => 'Tí', 'truc' => 'NGÀY TRỰC ĐỊNH', 'ynghia' => 'Bính Tí là lúc nước sạch sẽ, lại gặp vượng địa, trực Hoàng la, Tử đàn tinh, che, chiếu, 
nên tu tạo, an táng, gặp gỡ người thân, khai trương, xuất hành, nhập trạch, hưng công, động 
thổ, rất tốt.'],
            'suu' => ['chi' => 'Sửu', 'truc' => 'NGÀY TRỰC CHẤP', 'ynghia' => 'Có Chu tước, Câu giảo, Đằng xà, Bạch hổ, chi sát, không nên dùng vào việc, phạm cái đó 
chủ thoái tài, hại nhân khẩu. 
  Đinh Sửu, Quý Sửu là Sát nhập trung cung, đều không thể dùng, là ngày thụ mệnh.'],
            'dan' => ['chi' => 'Dần', 'truc' => 'NGÀY TRỰC PHÁ', 'ynghia' => 'Giáp Dần là Chính tứ phế. 
  Canh Dần, Mậu Dần, Bính Dần đều không tốt, mọi việc không nên, chủ có việc lên 
quan, thoái tài (giảm của), nhân khẩu thì nheo mắt nói nhỏ. 
  Duy có 1 ngày Nhâm Dần có Nguyệt đức, chỉ lợi cho an táng.'],
            'mao' => ['chi' => 'Mão', 'truc' => 'NGÀY TRỰC NGUY', 'ynghia' => 'Ất Mão là chính tứ phế, xấu. 
  Quý Mão, Đinh Mão, có Thiên đức, Hoàng la, Tử đàn, Kim ngân khố lâu, Ngọc đường 
tụ báu tinh, che, chiếu, nên khởi tạo, hôn nhân, giá thú, hưng công, động thổ, đặt móng, buộc 
giàn, khai trương, xuất hành, nhập trạch, thượng quan, làm kho chứa, chuồng trại trâu dê, chủ 
về gia nghiệp xương thịnh, nhân khẩu hưng vượng, sinh quý tử, tiến hoành tài, giàu sang lúa 
gạo. 
 Các ngày Mão còn lại (Kỷ Mão, Tân Mão) là tốt vừa.'],
            'thin' => ['chi' => 'Thìn', 'truc' => 'NGÀY TRỰC THÀNH', 'ynghia' => 'Thiên hỷ. 
  Nhâm Thìn là Nguyệt đức, Canh Thìn, Bính Thìn là ba ngày táng, tốt vừa, không nên 
dùng vào việc lớn. 
  Mậu Thìn, Giáp Thìn là Bạch hổ nhập trung cung, phạm cái đó trong 3-6-9 năm sách 
(?)gặp xấu.'],
            'ty' => ['chi' => 'Tỵ', 'truc' => 'NGÀY TRỰC THÂU', 'ynghia' => 'Tiểu hồng sa, có Chu tước, Câu giảo, Đằng xà, mọi việc bất lợi, phạm cái đó bị gọi vì 
việc quan, nhân khẩu rất xấu.'],
            'ngo' => ['chi' => 'Ngọ', 'truc' => 'NGÀY TRỰC KHAI', 'ynghia' => 'Hoàng sa. 
  Nhâm Ngọ, Nguyệt đức, Bính Ngọ, Mậu Ngọ, là ba ngày lợi về gặp cha mẹ (thân), giá 
thú tu tạo, mai táng, khai trương, xuất hành, nhập trạch, động thổ, mọi việc đó trong vòng 60 
ngày - 120 ngày tài tụ tập phúc dẫn về, quý nhân tiếp dẫn, điền sản hưng vượng, người thân 
thuộc (quyến nhân) an khang. 
 Các ngày Ngọ còn lại (Giáp Ngọ) là tốt vừa. 
 Riêng Canh Ngọ rất xấu.'],
            'mui' => ['chi' => 'Mùi', 'truc' => 'NGÀY TRỰC BẾ', 'ynghia' => 'Thiên thành, Thiên tặc. 
  Quý Mùi là Hỏa tinh, Thiên đức. 
  Kỷ Mùi là Hỏa tinh, nên tu tạo nhập trạch, đặt móng, buộc giàn, xuất hành, khai trương, 
là tốt vừa. 
  Tân Mùi, Đinh Mùi dùng vào việc nhỏ, cũng tốt vừa. 
 Riêng Ất Mùi là Sát nhập trung cung, nếu như ở trong sân đóng đinh, gõ vật, ồn, ào, gọi 
to, kêu gào,v.v.., làm kinh động, Thần sát trừng phạt gia trưởng, tổn thương đầu, mặt, tay, 
chân, rất xấu, chủ về huyết quang (bị về chảy máu), tai nạn về nước sôi, lửa bỏng, không đến 
việc vạ, tiểu nhân chiếm hại, kiện cáo, cãi vã, liên miên. 
  Phàm là Sát nhập trung cung, ngày đó đều nên phòng cái đó, chọn mà tránh.'],
        ],
        8 => [
            'dau' => ['chi' => 'Dậu', 'truc' => 'NGÀY TRỰC KIẾN', 'ynghia' => 'Tiểu hồng sa, Thiên thành, nhưng khi ngũ hành tự bại, trăm việc đều xấu, thêm phạm 
Thiên địa chuyển sát càng xấu, gặp việc quan, nguy khi đẻ, người con gái đẹp bị tai nạn về 
nước, con cháu bỏ trốn tan tác, bại gia không dứt.'],
            'tuat' => ['chi' => 'Tuất', 'truc' => 'NGÀY TRỰC TRỪ', 'ynghia' => 'Ngày Canh Tuất là Thiên đức, Nguyệt đức. 
  Mậu Tuất, Giáp Tuất nên hưng công, động thổ, nhập trạch, khai trương, hôn nhân, mọi 
việc dùng ngày đó là tốt vừa. 
  Bính Tuất, Nhâm Tuất là Sát nhập trung cung, mọi việc không nên phạm, chủ về mất 
của, lãnh thoái, rất xấu.'],
            'hoi' => ['chi' => 'Hợi', 'truc' => 'NGÀY TRỰC MÃN', 'ynghia' => 'Thiên phú. 
  Ất Hợi là Văn Xương quý hiển tinh. 
  Đinh Hợi, Kỷ Hợi có Hoàng la, Tử đàn, Thiên hoàng, Địa hoàng, Hoa thái, Thao trì, Lộc 
mã, là những tinh che, chiếu, lợi cho khởi tạo, hưng công, động thổ, buộc giàn, nhập trạch, 
hôn nhân, giá thú, khai trương, xuất hành, doanh (mưu trù), là mọi việc làm lớn thì phát lớn, 
làm nhỏ thì phát nhỏ, trong vòng 60 ngày, 120 ngày, chậm là đủ vòng năm lại thấy tài thành, 
nhà sinh con quý, vượng điền sản và lục súc. 
  Tân Hợi là ngày âm phủ ương khiển (phóng thích hết), không phải là chỗ cho dương 
gian dùng. 
  Quý Hợi là ngày tận cùng của lục giáp, ngũ hành không có khí, không thể dùng.'],
            'ti' => ['chi' => 'Tí', 'truc' => 'NGÀY TRỰC BÌNH', 'ynghia' => 'Vãng vong, Chu tước, Câu giảo, bị gọi vì việc quan, tổn trạch trưởng (chủ trang trại). 
  Bính Tí là khi nước trong sạch (khiết tinh). 
  Canh Tí là hỏa tinh dựa vào Thiên đức, Nguyệt đức, và Mậu Tí nữa là ba ngày lợi cho 
khởi tạo, giá thú, nhập trạch, xuất hành, động thổ, dùng ngày đó rất tốt. 
  Giáp Tí cũng có Hỏa tinh, nhưng là Bắc phương Hắc sát chi khí. 
  Nhâm Tí là lúc thảo mộc điêu linh (tàn hại), ngũ hành không có khí, không thể dùng.'],
            'suu' => ['chi' => 'Sửu', 'truc' => 'NGÀY TRỰC ĐỊNH', 'ynghia' => 'Tân Sửu, Quý Sửu, Ất Sửu, Đinh Sửu là tốt vừa. 
 Duy có Kỷ Sửu bất lợi cho mọi việc, không nên phạm cái đó, chủ về tật bệnh, sinh tai 
(vạ) xấu. 
* * * * * 
 Tra ngày Định là Sửu ở Đổng công trong nguyên bản, có chép: 
  - Tân Sửu, Quý Sửu, là ngày dùng việc thì tốt vừa. 
  - Ất Sửu, Đinh Sửu cũng tốt vừa. 
    - Duy có Kỷ Sửu là bất lợi. 
    - Các nhà thố pháp (người làm việc chôn quan tài) nói Đinh Sửu, Quý Sửu phạm
   Chu tước, Câu giảo, lại có Bạch hổ, Sát nhập trung cung, những cái đó xấu. 
  - Mà Tân Sửu thẳng mùa Thu là ngũ mộ, can chi không có khí, trăm việc kị dùng. 
* * * * * 
 Tựa như khó nói cái đó là tốt, tuy có cẩn thận bàn về đầu mối mới nói là Đinh Sửu, Kỷ 
Sửu nên làm việc hôn nhân, giá thú. 
 Nhưng 4 ngày Sửu là Đinh, Kỷ, Tân, Quý của tháng đó, đều có hung Sát, huống hồ Kỷ 
Sửu càng có thập ác chi hung (xấu vì có mười thứ ác), Xương quỷ (quỷ cuồng vọng), bại 
vong, đã nghiệm, dùng làm sao được, nếu như những ngày đó nói chung đã không dùng mới 
là ẩn cái mừng (một cách) cao minh, thế là vì sao? 
 Duy có Ất Sửu tiếp đối các sách đều nói là tốt trên hết, hoặc có thể dùng?'],
            'dan' => ['chi' => 'Dần', 'truc' => 'NGÀY TRỰC CHẤP', 'ynghia' => 'Hoàng sa. 
  Canh Dần là Thiên  đức, Nguyệt  đức, có Hoàng la, Tử  đàn, Thiên hoàng, Địa hoàng, 
Kim ngân bảo tàng, Điền đường khố, Châu tụ, Lộc đới mã loan, và Cung Diệu chúng cát tinh 
chiếu lâm, nên khởi tạo, hôn nhân, động thổ, di cư, khai trương, xuất hành, vượng điền sản, 
tiến hoành tài, tăng lục súc, thêm nhân khẩu, và con cháu cải đổi nhà, sân, gia đạo hưng thịnh. 
 Các ngày Dần còn lại cũng tốt vừa, có thể dùng. 
 Riêng Giáp Dần là chính tứ phế, xấu.'],
            'mao' => ['chi' => 'Mão', 'truc' => 'NGÀY TRỰC PHÁ', 'ynghia' => 'Thiên tặc. 
  Quý Mão, Ất Mão, dùng vào việc thì tốt vừa. 
 Các ngày Mão còn lại bất lợi, có Chu tước, Câu giảo, bị gọi vì việc quan, khẩu thiệt, 
kiêm phạm Nguyệt yếm là xấu. 
  Ất Mão là chính tứ phế, cũng xấu.'],
            'thin' => ['chi' => 'Thìn', 'truc' => 'NGÀY TRỰC NGUY', 'ynghia' => 'Nhâm Thìn là lúc nước trong sạch. 
  Bính Thìn nên phá đất, hưng công, khai trương, xuất hành, nhập trạch, hôn nhân, trăm 
việc thuận lợi, rất tốt. 
  Mậu Thìn thảo mộc điêu linh. 
  Canh Thìn là thiên địa cùng phế, không tốt. 
  Giáp Thìn là Sát nhập trung cung, rất xấu.'],
            'ty' => ['chi' => 'Tỵ', 'truc' => 'NGÀY TRỰC THÀNH', 'ynghia' => 'Thiên hỉ. 
  Ất Tị, Kỷ Tị, có Tử đàn, Đới lộc, Dịch mã, tập tụ ở Khúc đường, mọi sao che, chiếu, nên 
hôn nhân, nhập trạch, hưng công,  động thổ, khai trương, xuất hành, khởi tạo kho chứa, 
chuồng dê ngựa, đều rất tốt, trăm việc thuận lợi. 
 Các ngày Tị còn lại là tốt vừa.'],
            'ngo' => ['chi' => 'Ngọ', 'truc' => 'NGÀY TRỰC THÂU', 'ynghia' => 'Phúc tinh, có thể yên tĩnh. Kiến, Phá lại xung. 
  Nhâm Ngọ là Hỏa tinh, dùng vào việc là tốt vừa. 
 Duy Mậu Ngọ có Hỏa tinh, bất lợi. 
  Canh Ngọ cũng bất lợi. 
  Bính Ngọ động thổ, an táng, các loại mưu trù cũng là tốt vừa, phạm cái đó tổn con cháu, 
bị gọi vì việc quan, lãnh thoái, xấu.'],
            'mui' => ['chi' => 'Mùi', 'truc' => 'NGÀY TRỰC KHAI', 'ynghia' => 'Đinh Mùi, Kỷ Mùi, Tân Mùi, Quý Mùi đều hệ tốt vừa, ngày đó chỉ nên phạt cỏ, mở núi 
(khai sơn), nhổ cây, an táng. 
 Duy Ất Mùi trăm sự không lợi, xấu, phạm thì suy, bại, tử, tuyệt.'],
            'than' => ['chi' => 'Thân', 'truc' => 'NGÀY TRỰC BẾ', 'ynghia' => 'Mậu Thân là Thiên xá. 
  Canh Thân, Bính Thân là Thiên đức, Nguyệt đức, nên xuất hành, sửa mới, động thổ, 
hưng công, đặt móng, buộc giàn, hôn nhân, nhập trạch, an táng, khai trương, làm kho chứa, 
chuồng trâu, dê, lợn, lợi con cháu, vượng điền sản, tiến hoành tài, nhà cửa phát đạt, tốt nhất 
(thượng cát). 
  Giáp Thân, Nhâm Thân là tốt vừa.'],
        ],
        9 => [
            'tuat' => ['chi' => 'Tuất', 'truc' => 'NGÀY TRỰC KIẾN', 'ynghia' => 'Bính Tuất là Thiên đức, Nguyệt đức, rất tốt. 
 Các ngày Tuất còn lại bất lợi, nếu như dùng cái đó thì tổn của, bần cùng, rất xấu.'],
            'hoi' => ['chi' => 'Hợi', 'truc' => 'NGÀY TRỰC TRỪ', 'ynghia' => 'Thiên thành. 
  Ất Hợi, Đinh Hợi, nên khởi tạo, khai trương, giá thú, nhập trạch, xuất hành, động thổ, 
mọi việc rất tốt, con cháu hưng vượng, giàu sang mãi mãi. 
  Quý Hợi là ngày cuối cùng của lục giáp, không thể dùng. 
  Tân Hợi thuần là khí âm, không có chỗ dùng ở dương gian. 
  Kỷ Hợi là Hỏa tinh, chỉ có khởi tạo, hôn thú là tốt.'],
            'ti' => ['chi' => 'Tí', 'truc' => 'NGÀY TRỰC MÃN', 'ynghia' => 'Hoàng sa, Thiên phú. 
  Bính Tí là lúc nước trong sạch, kiêm có Thiên  đức, Nguyệt  đức, Hoàng la, Tử  đàn, 
Thiên hoàng, Địa hoàng, Tầng tiêu Liên châu (chuỗi nhọc trên tầng không), Lộc mã, là mọi 
sao tốt che, chiếu, nên hôn nhân, giá thú, khai trương, xuất hành, nhập trạch, hưng công, động 
thổ, đặt móng, buộc giàn, an táng, thêm nhà cửa, lợi con cháu, vượng điền sản, tiến lục súc, 
tăng hoành tài, trong vòng 60 ngày, 120 ngày sẽ thấy nghiệm. 
  Nhâm Tí là Mộc đả bảo bình, thảo mộc (cây cỏ) điêu linh, rất xấu. 
 Các ngày Tí còn lại không nên dùng việc. 
  Giáp Tí có Hoàng la, Tử đàn là sao che, chiếu, có thể dùng.'],
            'suu' => ['chi' => 'Sửu', 'truc' => 'NGÀY TRỰC BÌNH', 'ynghia' => 'Tiểu hồng sa, có Phúc tinh, bị Nguyệt kiến xung, phá, Chu tước, Câu giảo, bị gọi vì việc 
quan, kết chiếm mọi việc không lợi, nếu mưu trù nhỏ là trong đó có phúc sinh, cũng phải cẩn 
thận, có thể mượn dùng tạm, nhưng cuối cùng là không có lợi ích, dùng việc lớn vào cái đó thì 
thấy ngay là xấu. 
  Đinh Sửu, Quý Sửu là sát nhập trung cung, càng xấu.'],
            'dan' => ['chi' => 'Dần', 'truc' => 'NGÀY TRỰC ĐỊNH', 'ynghia' => 'Bính Dần là Thiên đức, Nguyệt đức. 
  Canh Dần, Mậu Dần có Hoàng la, Tử đàn, Thiên hoàng, Địa hoàng, mọi sao tốt che, 
chiếu, nên khởi tạo, giá thú, xuất hành, nhập trạch, khai trương, nhất thiết mọi việc, chủ về 
tiến của, sinh quý tử, hưng gia đạo, vượng lục súc, rất tốt. 
  Nhâm Dần phạm Nguyệt yếm, Thụ tử, không giải. 
 Nhưng Bính Dần, Mậu Dần, Canh Dần, tuy 3 ngày đó phạm Nguyệt yếm nhưng trong 
đó có mọi sao tốt che, chiếu, cho nên rất tốt. 
 Duy có Giáp Dần là chính tứ phế, xấu.'],
            'mao' => ['chi' => 'Mão', 'truc' => 'NGÀY TRỰC CHẤP', 'ynghia' => 'Tân Mão, Kỷ Mão có Hoàng la, Tử  đàn, Thiên hoàng, Địa hoàng, mọi sao tốt che, 
chiếu, nên giá thú, khai trương, xuất hành, nhập trạch, động thổ, sửa mới, khởi tạo, kho chứa, 
chủ về tiến của cải, tăng nhân khẩu, hưng gia đạo, vượng lục súc, rất tốt. 
 Các ngày Mão còn lại là tốt vừa. 
 Duy Ất Mão là chính tứ phế, xấu.'],
            'thin' => ['chi' => 'Thìn', 'truc' => 'NGÀY TRỰC PHÁ', 'ynghia' => 'Vãng vong, Thiên đức, Nguyệt đức, tu tạo thì tốt ít, kị giá thú, khai trương, nhập trạch, đi 
ở (đồ cư), chủ về tổn lục súc, hao của, tụ tập khẩu thiệt. 
 Những ngày Thìn còn lại càng không tốt. 
  Mậu Thìn, Giáp Thìn là Sát nhập trung cung, rất xấu.'],
            'ty' => ['chi' => 'Tỵ', 'truc' => 'NGÀY TRỰC NGUY', 'ynghia' => 'Ất Tị nên phạt cỏ, an táng, hưng công, tạo tác, hôn thú, khai trương, nạp thái (nộp lễ vật 
xin cưới), di cư, xuất hành, nhập trạch, chủ về thêm con cháu, gia đạo hưng thịnh, phát tài, rất 
tốt. 
 Những ngày Tị còn lại là tốt vừa, chỉ nên làm việc nhỏ thì có thể dùng, không lợi cho 
hôn nhân, chuyển chỗ ở, khai trương, xuất hành, phạm cái đó xấu, bại.'],
            'ngo' => ['chi' => 'Ngọ', 'truc' => 'NGÀY TRỰC THÀNH', 'ynghia' => 'Thiên hỷ. 
  Bính Ngọ là Thiên đức, Nguyệt đức, có Hoàng la, Tử đàn, Thiên hoàng, Địa hoàng, Kim 
ngân khố lâu là các sao che, chiếu, nên khởi tạo, giá thú, nhập trạch, xuất hành, thương mại, 
khai trương,  động thổ, an táng, tốt cả, nhất thiết phát tài, giàu sang, thêm  đinh (đàn ông), 
người hầu (nô tỳ) tự đến, mưu vọng thì thắng, luôn luôn. 
 Các ngày Ngọ còn lại là tốt vừa, đều có thể dùng.'],
            'mui' => ['chi' => 'Mùi', 'truc' => 'NGÀY TRỰC THÂU', 'ynghia' => 'Ất Mùi là ngày mộ. 
  Tân Mùi, Quý Mùi là đặt móng, buộc giàn, là tốt vừa, nhưng không lợi cho khởi tạo, 
hôn nhân, xuất hành, nhập trạch, an táng, khai trương, thương khố (kho chứa), tổn, gặp ôn 
dịch. 
  Ất Mùi là Chu tước, Câu giảo, Bạch hổ nhập trung cung. 
  Đinh Mùi cũng xấu.'],
            'than' => ['chi' => 'Thân', 'truc' => 'NGÀY TRỰC KHAI', 'ynghia' => 'Thiên tặc. 
  Mậu Thân là Thiên xá. 
  Giáp Thân là khi nước trong sạch, có Hoàng la, Tử đàn, Tụ lộc đới mã, là những sao 
che, chiếu, nên an táng, làm sinh cơ. 
 Nhưng ngày Tây trầm ngũ hành không có khí, huống hồ là đúng đêm mùa thu, khí hậu 
đó không nên khởi tạo, hôn nhân, nhập trạch, khai trương. 
  Duy an táng thì rất tốt, thêm con cháu, nhà cửa phát đạt. 
 Các ngày Thân còn lại là tốt vừa. 
  Canh Thân là Bạch hổ nhập trung cung, phạm cái đó, sát nhân, càng xấu.'],
            'dau' => ['chi' => 'Dậu', 'truc' => 'NGÀY TRỰC BẾ', 'ynghia' => 'Lúc đó là giao giới hai mùa thu và đông, đều là Sát thương. 
  Kỷ Dậu là Cửu thổ quỷ. 
  Ất Dậu là ngày an táng. 
 Các ngày Dậu còn lại cũng nên dùng vào việc nhỏ, nhưng ngũ hành không có khí, tên là 
bạo tán sát trùng, ngày đó không nên khởi tạo, hôn nhân, nhập trạch, khai trương, dùng thì 
lãnh thoái, xấu.'],
        ],
        10 => [
            'hoi' => ['chi' => 'Hợi', 'truc' => 'NGÀY TRỰC KIẾN', 'ynghia' => 'Không lợi cho khởi tạo, khai trương, hôn thú, nhập trạch, xuất hành, an táng, dùng cái đó 
bị gọi vì việc quan, tổn gia trưởng. 
 Như Ất Hợi, Kỷ Hợi cũng chỉ nên làm nhỏ, mưu trù là có lộc. 
  Tháng 10 ngày Kiến Hợi là không lợi.'],
            'ti' => ['chi' => 'Tí', 'truc' => 'NGÀY TRỰC TRỪ', 'ynghia' => 'Tuy là ngũ hành vượng tướng, nhưng giao giới giữa hai mùa thu và đông, thoạt đầu có 
chuyển sát là xấu. Ngạn ngữ nói rằng ""Chuyển Sát nhi thương vị khả khinh dụng"", nghĩa là 
Chuyển Sát mà hại chưa thể coi nhẹ mà dùng. 
  Giáp Tí là Thiên xá, không phải là Chuyển Sát, dùng cái đó không hại.'],
            'suu' => ['chi' => 'Sửu', 'truc' => 'NGÀY TRỰC MÃN', 'ynghia' => 'Thiên phú, Thiên thành, Thiên tặc. 
  Đinh Sửu, Quý Sửu là Sát nhập trung cung, không lợi cho khởi tạo, giá thú, cổ nhạc 
(trống khua nhạc cử) ồn ào, và cả tới việc các cách đóng đinh vào cửa (đinh môn các cách), 
làm kinh động thần Sát, tổn nhân đinh, hại lục súc. 
 Những ngày Sửu còn lại cũng không nên dùng, chỉ có thể thanh hồn, nhập mộ. 
  Phàm kim nhập cung Sửu là ngũ hành không có khí và phạm Nguyệt sát, Thiên tặc, xấu.'],
            'dan' => ['chi' => 'Dần', 'truc' => 'NGÀY TRỰC BÌNH', 'ynghia' => 'Thiên phú, Thiên thành, có Đáo châu tinh, việc đến phủ quan mà sau đó tán. 
 Duy có Giáp Dần là tốt trên hết. 
  Nhâm Dần, Canh Dần là tốt vừa, sửa nho nhỏ thì có thể, làm lớn thì không nên. 
 Những ngày Dần còn lại xấu.'],
            'mao' => ['chi' => 'Mão', 'truc' => 'NGÀY TRỰC ĐỊNH', 'ynghia' => 'Ất Mão là Thiên đức. 
  Tân Mão, Kỷ Mão nên  động thổ, hưng công,  định tảng (đặt móng),  đặt nóc (thượng 
lương), giá thú, nhập trạch, xuất hành, khai trương, dùng các ngày đó tốt, có cát diệu chiếu 
lâm. 
 Những ngày Mão còn lại là xấu.'],
            'thin' => ['chi' => 'Thìn', 'truc' => 'NGÀY TRỰC CHẤP', 'ynghia' => 'Giáp Thìn là Thiên đức, Nguyệt đức, chỉ có thể sửa trộm, nếu khởi tạo, hưng công, giá 
thú, nhập trạch thì không lợi. 
 Duy Bính Thìn có thể mở núi, phạt cỏ, an táng là tốt vừa. 
  Mậu Thìn là Sát nhập trung cung, rất xấu.'],
            'ty' => ['chi' => 'Tỵ', 'truc' => 'NGÀY TRỰC PHÁ', 'ynghia' => 'Tiểu hồng sa, lại phạm Chu tước, Câu giảo, mọi việc không nên. 
 Duy Ất Tị có Thiên đức, mưu trù việc nho nhỏ thì có thể dùng, là tốt vừa. 
  Đinh Tị là chính tứ phế, phạm cái đó thì lôi đình tan bại, việc ngang trái, mất của.'],
            'ngo' => ['chi' => 'Ngọ', 'truc' => 'NGÀY TRỰC NGUY', 'ynghia' => 'Hoàng sa. 
  Giáp Ngọ là Nguyệt đức, có Hoàng la, Tử đàn, Kim ngân khố lâu, mọi sao tốt che, chiếu, 
giá thú, khai trương, khởi tạo, động thổ, xuất hành, nhập trạch, an táng, rất tốt. 
 Những ngày Ngọ còn lại là tốt vừa. 
  Bính Ngọ là chính tứ phế, xấu.'],
            'mui' => ['chi' => 'Mùi', 'truc' => 'NGÀY TRỰC THÀNH', 'ynghia' => 'Là tam hợp tích của nguyệt kiến. 
  Ất Mùi là Sát nhập trung cung, kị xuất hành, an táng, giá thú, nhập trạch, khai trương, tu 
tạo. 
 Duy Quý Mùi, hỏa tinh, Thủy nhập Tần châu, là quý nhân tinh, trực với Hoàng la, Tử 
đàn, Kim ngân Liên châu tinh, che, chiếu, nên khởi tạo, giá thú, nạp thái (nạp lễ vật khi xin 
cưới), vấn danh (lễ ăn hỏi), xuất hành, gặp quý nhân, gia trạch an ninh mãi mãi, chủ về cả 
năm, 100 ngày được quý nhân tiếp dẫn, tiến điền sản, sinh quý tử, phát phúc, tốt trên hết. 
 Các ngày Mùi còn lại tốt vừa.'],
            'than' => ['chi' => 'Thân', 'truc' => 'NGÀY TRỰC THÂU', 'ynghia' => 'Ngược lại phạm Đáo châu tinh (?), dùng cái đó bị gọi vì việc quan, tổn nhân khẩu. 
 Duy Giáp Thân là khi nước trong sạch, thủy thổ trường sinh cư Thân (?), lợi cho an 
táng, hôn thú, xuất hành, nhập trạch, động thổ, khai trương, khởi tạo, mưu trù việc làm, chủ về 
trong vòng một năm, 100 ngày, quý nhân tự đến dẫn dậy, mọi việc toại ý. 
  Canh Thân là Thụ tử, không có khí, lại là Sát nhập trung cung, phạm cái đó chủ sát nhân 
rất xấu.'],
            'dau' => ['chi' => 'Dậu', 'truc' => 'NGÀY TRỰC KHAI', 'ynghia' => 'Ất Dậu là Thiên đức, là ngày táng, nên giá thú, gặp cha mẹ, nhập trạch, khởi tạo, khai
trương, dùng các ngày đó là tốt nhất, chủ về tăng điền trạch, thụ chức, lộc, sáng cửa nhà (rạng
rỡ), nô tỳ, nghĩa bộc tự đến xin làm công, mọi việc thuận toại ý. 
  Kỷ Dậu là cửu thổ quỷ, an táng thì được, không nên dùng vào việc lớn. 
 Các ngày Dậu còn lại là tốt vừa.'],
            'tuat' => ['chi' => 'Tuất', 'truc' => 'NGÀY TRỰC BẾ', 'ynghia' => 'Hỏa tinh. 
  Giáp Tuất là Nguyệt đức, nên giá thú, khai trương, xuất hành, nhập trạch. Nhưng không 
lợi cho động thổ, khởi tạo, mai táng, di cư. 
  Bính Tuất, Mậu Tuất, trăm việc đều xấu, bại.'],
        ],
        11 => [
            'ti' => ['chi' => 'Tí', 'truc' => 'NGÀY TRỰC KIẾN', 'ynghia' => 'Hỏa tinh. 
  Giáp Tí là Thiên xá, là ngày tiến thần ích, bị Nguyệt Kiến xung phá, dùng cái đó chủ 
việc quan, phá bại, thỉnh Thiên xá không hợp với ngày đó. 
  Bính Tí tuy trực lúc thủy vượng, Tiến thần làm địa chuyển, cũng cùng với Nguyệt Kiến 
tương xung, lúc đó thủy đoạn (nước hết), sức suối chảy cũng rất giảm, cuối cùng trong tốt có 
dấu hiệu xấu, chủ về Trước là có ích, sau là hại, nước hết bình vỡ.'],
            'suu' => ['chi' => 'Sửu', 'truc' => 'NGÀY TRỰC TRỪ', 'ynghia' => 'Thiên ôn. 
  Ất Sửu là quê hương kim mộ, nên tụ họp với cha mẹ, khởi tạo, xuất hành, khai trương, 
động thổ, phạt mộc, khai sơn, có cát tinh che, chiếu, chủ quý nhân tiếp dẫn, mưu vọng toại ý. 
 Những ngày Sửu còn lại là tốt vừa.'],
            'dan' => ['chi' => 'Dần', 'truc' => 'NGÀY TRỰC MÃN', 'ynghia' => 'Hoàng sa, Thiên phú, là thổ ôn, nhưng không nên động thổ. Vì có phúc tinh và Hoàng la, 
Tử đàn, Thiên hoàng, Địa hoàng, là các sao che, chiếu, nên hôn nhân, nhập trạch, khởi tạo, an 
táng, xuất hành, khai trương, trăm sự thuận toại ý. 
  Nhâm Dần, Mậu Dần tốt trên hết. 
  Bính Dần, Canh Dần tốt vừa. 
  Giáp Dần là tốt vừa.'],
            'mao' => ['chi' => 'Mão', 'truc' => 'NGÀY TRỰC BÌNH', 'ynghia' => 'Thiên tặc. 
  Tân Mão, Hỏa tinh, lại phạm Chu tước, Câu giảo, dùng cái đó bị gọi vì việc quan, tổn tài 
vật, khởi việc tranh nhà cửa, thương tình nghĩa, lắm ác tật, xấu. 
 Duy có một ngày Ất Mão là tốt vừa. 
 Những ngày Mão còn lại chủ Phụ tử, huynh đệ bất nghĩa, tranh nhà cửa, tự thắt cổ, người 
ác cướp hại, phá tán, rất xấu.'],
            'thin' => ['chi' => 'Thìn', 'truc' => 'NGÀY TRỰC ĐỊNH', 'ynghia' => 'Tuy nói tốt, lại có Thiên la, Địa võng, là hung họa, quý nhân không gặp, mưu trù việc 
làm không lợi, Sát nhập trung cung, phạm cái đó sát nhân, xấu. 
 Duy chỉ có Nhâm Thìn tuy phạm Quan phù, nhưng trong có Thiên đức, Hoàng la, Tử 
đàn, Thiên hoàng, Địa hoàng, là những sao che, chiếu, chỉ nên an táng, an môn (đặt cửa), giá 
thú, nhập trạch, những việc còn lại là ngày dùng thận trọng, nhưng vẫn là ngày Tử khí, phạm 
Quan phù, Kiếp sát, không phải cung Quan phù cùng đến phương đó, cho nên không lợi.'],
            'ty' => ['chi' => 'Tỵ', 'truc' => 'NGÀY TRỰC CHẤP', 'ynghia' => 'Ất Tị, Quý Tị, Kỷ Tị, có Hoàng la, Tử đàn, Thiên hoàng, Địa hoàng là những sao che, 
chiếu, nên an táng, đặt cửa, hưng công, động thổ, giá thú, nhập trạch, xuất hành, khai trương, 
mưu trù làm mọi việc dùng ngày đó thêm nhân khẩu, vượng gia đạo, sinh quý tử, tăng điền 
địa, rất tốt. 
Tân Tị là tốt vừa. 
Đinh Tị là chính tứ phế, xấu.'],
            'ngo' => ['chi' => 'Ngọ', 'truc' => 'NGÀY TRỰC PHÁ', 'ynghia' => 'Thiên tặc. 
  Nhâm Ngọ là Hỏa tinh, cạnh Nguyệt đức, cẩn thận, có thể nho nhỏ mà gấp thì dùng. 
 Các ngày Ngọ còn lại thì dẫn đến ôn dịch, hại lục súc, và là ngày Nguyệt Kiến xung phá, 
xấu. 
  Bính Ngọ là chính tứ phế, xấu.'],
            'mui' => ['chi' => 'Mùi', 'truc' => 'NGÀY TRỰC NGUY', 'ynghia' => 'Đinh Mùi là khi nước đại hải trong sạch, dùng cái đó trăm việc tốt hết. 
  Kỷ Mùi mai táng là tốt vừa. 
 Những ngày Mùi còn lại cũng tốt. 
 Hai ngày đó (?) dùng việc chủ về tiến nhân khẩu, tăng điền sản, được tài ngang (hoành 
tài). 
  Tân Mùi, Quý Mùi mọi việc bất lợi. 
  Ất Mùi là Sát nhập trung cung, càng xấu.'],
            'than' => ['chi' => 'Thân', 'truc' => 'NGÀY TRỰC THÀNH', 'ynghia' => 'Thiên hỷ. 
  Nhâm Thân là Thiên đức, Nguyệt đức. 
  Giáp Thân, Mậu Thân là lúc ngũ hành không có khí, trực Hoàng la, Tử đàn, Kim ngân 
Bảo tàng khố lâu, là mọi sao tốt che, chiếu, nhất thiết làm là trăm phúc cùng đến (biền trăm), 
mọi việc thuận theo, sinh quý tử, vượng tài lộc. 
 Ngày Canh Thân chỉ nên an táng và tu tạo nho nhỏ phía ngoài nhà chính thì có thể được, 
nếu như khởi tạo công lớn và hôn nhân, nhập trạch, khai trương thì thấy ngay vạ hung (xấu), 
chủ tổn gia trưởng, hại đàn bà và trẻ con, vì cái đó là ngũ hành không có khí, Sát thần tụ vào 
trung cung, Thiện nhân không thể giáng phúc. 
* * * * * 
 Ta từ khi còn ít tuổi được cái đó, khi ở giang hồ không thiết, đến lúc trung tuổi và về già 
thấy có người chọn dùng ngày đó, sức làm trở ngại người đó không nghe(?), liền thấy ngay tai 
vạ. Qua đó có thể biết sách chọn ngày đó thực là có kinh nghiệm, không thể xem nhẹ. 
* * * * * 
 Ngày Bính Thân dùng việc thì sợ phạm quỷ khốc, hiệu như thần, càng nên cẩn thận cái 
đó.'],
            'dau' => ['chi' => 'Dậu', 'truc' => 'NGÀY TRỰC THÂU', 'ynghia' => 'Tiểu hồng sa, có Đáo châu tinh, việc đến quan mà sau đó tán, chỉ nên mai táng là tốt vừa, 
kị khởi tạo, khai trương, xuất hành, nhập trạch, giá thú, những việc trên phạm vào cung đó 
không lãnh thoái cũng tổn thương tài vật, xấu. 
 Các ngày Dậu còn lại(?) cũng bất lợi.'],
            'tuat' => ['chi' => 'Tuất', 'truc' => 'NGÀY TRỰC KHAI', 'ynghia' => 'Vãng vong, tiểu táng cũng phải chuẩn bị đầy đủ và có vì cấp thì dùng ngày đó cũng chỉ 
tốt vừa. 
 Như Bính Tuất, Nhâm Tuất là Sát nhập trung cung, mọi việc kị dùng. 
  Giáp Tuất tám phương  đều trắng, 24 hướng mọi thần trầu trời Nguyên nữ, trộm sửa 
ngày đó có thể dùng.'],
            'hoi' => ['chi' => 'Hợi', 'truc' => 'NGÀY TRỰC BẾ', 'ynghia' => 'Ất Hợi, Kỷ Hợi là những sao Văn Xương, Quý hiển, Hoàng la, Tử đàn, Thiên hoàng, 
Địa hoàng, Bài châu (thẻ bằng ngọc), Thiên đăng, Tụ lộc Đới mã, Kim ngân khố lâu, Bảo 
tàng là những sao tốt che, chiếu, nên khởi tạo, mưu trù là trăm việc đều tốt, tám phương, 24 
hướng đều lợi dụng cái đó, gia đạo phong dinh (nhiều thừa), sinh quý tử, tiến tài lộc, vượng 
lục súc. 
  Đinh Hợi là ngày tốt vừa. 
  Quý Hợi là ngày cuối cùng của lục giáp. 
  Tân Hợi là ngày phụ nhân chi kim (vợ của kim), âm phủ quyết quán chi kỳ (kỳ ở âm phủ 
quyết trốn tránh). 
 Một năm có bốn mùa, duy chỉ tháng hai là có ngày Tân Hợi tốt. 
 Các ngày Hợi còn lại đều không thể dùng.'],
        ],
        12 => [
            'suu' => ['chi' => 'Sửu', 'truc' => 'NGÀY TRỰC KIẾN', 'ynghia' => 'Vãng vong, Hồng sa. 
  Ất Sửu, Kỷ Sửu, nên khai sơn, phạt cỏ, hưng công, động thổ, giá thú, khai trương, xuất 
hành, nhập trạch, là ngày tốt vừa. 
  Đinh Sửu là Sát nhập trung cung, không nên khua nhạc, trống, làm ồn ào, hôn nhân, mọi 
việc đó hại gia trưởng, trạch mẫu. 
  Quý Sửu tuy vượng nhưng lục sát nhập trung cung, tổn thương nhân khẩu, xấu.'],
            'dan' => ['chi' => 'Dần', 'truc' => 'NGÀY TRỰC TRỪ', 'ynghia' => 'Canh Dần là Hỏa tinh, Thiên đức, Nguyệt đức. 
  Giáp Dần, Bính Dần, Nhâm Dần, đều có Hỏa tinh, và Hoàng la, Tử đàn, Thiên hoàng, 
Địa hoàng, Bảo liễu (xe ngọc quý), Khố châu phúc lộc, Văn Xương, Lộc mã quan ích là 
những sao tốt chiếu lâm, nên khởi tạo, hôn nhân, an táng, nhập trạch, khai trương, xuất hành, 
trăm việc thuận lợi, dùng ngày đó gia môn phát đạt, động thổ thấy tiến tài sản, tên là ""Đăng hổ 
bảng"". 
  Mậu Dần cũng có Hỏa tinh nhưng là tốt vừa, ngày đó có thể dùng. 
* * * * * 
  Theo ""Thích kỷ biện phương"", Dần ở tháng chạp là thiên tặc, là ngày Dần trong tháng có 
Hỏa tinh thì không ghi, đó là hai thuyết nên tồn lưu để tham khảo.'],
            'mao' => ['chi' => 'Mão', 'truc' => 'NGÀY TRỰC MÃN', 'ynghia' => 'Thiên phú, Thổ ôn, không nên động thổ, Thiên ôn một năm. 
 Nếu dùng ngày Mão vào việc cưới, gặp cha mẹ, ăn hỏi, cũng tốt nhỏ nhưng có lục bất 
thành, lục bất hợp, cái đó ngừng. 
 Duy có Tân Mão, tạo tác, hưng công, nhưng là tốt vừa.'],
            'thin' => ['chi' => 'Thìn', 'truc' => 'NGÀY TRỰC BÌNH', 'ynghia' => 'Có Đáo châu tinh, việc đến quan mà sau đó tán. 
 Duy có Nhâm Thìn nên mai táng, cưới vợ, gặp cha mẹ, hưng công, động thổ, xuất hành, 
nhập trạch là tốt vừa. 
  Canh Thìn là Thiên đức, Nguyệt đức, nên làm nhỏ cũng tốt vừa. 
  Mậu Thìn thảo mộc điêu linh, lúc đó ngũ hành không có khí, và là thoái tinh, lại kiêm 
Sát nhập trung cung, mọi việc bất lợi, xấu.'],
            'ti' => ['chi' => 'Tỵ', 'truc' => 'NGÀY TRỰC ĐỊNH', 'ynghia' => 'Thiên thành. 
 Một thuyết nói là Quan phù tinh phi, nhưng nói là ngày Tử khí, nếu phương tu tạo trực 
với Phi cung Châu bách, Quan phù, thấy ngay, nếu như phương đó hợp với cát thần tụ tập sẽ 
cầu cái đó xấu dùng cũng được. 
  Quý Tị tuy trực kim thủy trong sạch lúc đó. Hoặc có thể khai sơn, phạt cỏ, nhưng ngày 
đó tốt vừa, nếu cưới vợ chồng hoặc khai trương, xuất hành, nhập trạch, đặt móng, buộc giàn, 
lại là thiên thượng đại không vong nạp âm Tị, tuyệt không nên dùng. 
  Đinh Tị là Chính tứ phế, xấu, một năm bốn mùa (quý), dùng ngày Tị chủ khẩu thiệt, tuy 
có Hỷ thần hoá giải cũng thuộc khó thoát. 
 Như tốt thì vượng, xấu thì suy, tất cần xét rõ mệnh tuổi và sơn hướng không phạm xung 
khắc thì mới có thể dùng.'],
            'ngo' => ['chi' => 'Ngọ', 'truc' => 'NGÀY TRỰC CHẤP', 'ynghia' => 'Canh Ngọ là Thiên đức, Nguyệt đức, như Canh Ngọ làm Canh sơn Giáp hướng có thể 
thâu vào nạp âm, huống hồ ngày đó có dùng giờ Canh Thìn, giờ đó gặp tam hợp chiếu Thân, 
Canh diện Canh lộc, cư Thân, Thìn mã trực Nhâm Thân đó sinh thành lộc mã nhật, sẽ là 
mã gặp lộc tinh, Thánh nhân nam diện tinh, có Hoàng la, Tử đàn, Thiên hoàng, Địa hoàng, 
Kim ngân bảo lâu, là những sao tốt che, chiếu, chủ về thêm con cháu, vượng gia môn, tiến 
điền sản, đạt lộc vị. 
  Nhâm Ngọ cũng tốt. 
 Các ngày Ngọ còn lại là tốt vừa. 
 Bính Ngọ là chính tứ phế, xấu.'],
            'mui' => ['chi' => 'Mùi', 'truc' => 'NGÀY TRỰC PHÁ', 'ynghia' => 'Đinh Mùi là ""Thủy cư cự mẫn"" (trong nước có con cá bể to tên là mẫn). 
  Quý Mùi là ""Thủy nhập Tần châu nội"", ""Văn Xương quý hiển tinh"",  động thổ, hưng 
công, xuất hành, nhập trạch, cưới vợ, khai trương, trăm việc rất tốt. 
  Kỷ Mùi, Tân Mùi là Sát nhập trung cung, xấu. 
  Ất Mùi cũng không lợi.'],
            'than' => ['chi' => 'Thân', 'truc' => 'NGÀY TRỰC NGUY', 'ynghia' => 'Canh Thân là Thiên đức, Nguyệt đức, nên sửa chôn (?), an táng, mưu trù làm việc nho 
nhỏ là thứ cát (tốt vừa), nếu nhà to, có hàng nghìn, hàng trăm thợ trở lên, thì những việc khởi 
tạo, khai trương, nhập trạch, hôn nhân, lại không nên, vì là ngày Sát nhập trung cung, không 
lợi cho người gia trưởng. 
  Mùa xuân tuy có Thiên  đức, Nguyệt  đức cũng không có tác dụng gì, tổn thương tay, 
chân, người thợ phá mất, tổn hoại khí huyết, làm lớn thì nhanh thấy, làm nhỏ thì ứng chậm. 
 Nếu làm chuồng trâu, dê, lợn, thì trong 60 ngày, 120 ngày sẽ thấy hổ lang làm bị thương, 
lại sinh ôn dịch thời khí. 
Giáp Thân, khởi tạo, an táng tốt. 
Bính Thân, Nhâm Thân, chỉ nên mai táng.'],
            'dau' => ['chi' => 'Dậu', 'truc' => 'NGÀY TRỰC THÀNH', 'ynghia' => 'Thiên hỉ. 
  Ất Dậu, Quý Dậu là khi kim vượng. 
  Ất Dậu là lúc nước trong sạch, có Hoàng la, Tử đàn, Kim ngân khố lâu, Tụ lộc đới mã, là 
những tinh che, chiếu, lợi cho việc cưới vợ, khởi tạo, khai trương, nhập trạch, an táng, là ngày 
tốt chọn vẹn, chủ về con cháu hưng vượng, trăm việc vừa lòng (xứng tâm). 
  Đinh Dậu cũng thuộc kim vượng, chỉ có mai táng là tốt nhất, những việc còn lại là tốt 
vừa. 
  Tân Dậu là Kim loan (nhạc ngựa bằng vàng), tốt vừa.'],
            'tuat' => ['chi' => 'Tuất', 'truc' => 'NGÀY TRỰC THÂU', 'ynghia' => 'Có Đáo châu tinh, việc đến công đường mà sau đó tán. 
  Canh Tuất có Thiên đức, Nguyệt đức, tám vị Kim tinh, có ""Nam tử chi hoan"" (cái hang 
của con trai), trước hết bị khẩu thiệt mà sau đó thì rất tốt. 
  Giáp Tuất tám phương đều trắng, ở 24 hướng mọi thần đều chầu trời Nguyên nữ, ngày 
đó trộm sửa có thể dùng. 
  Bính Tuất, Nhâm Tuất là Sát nhập trung cung, trăm việc đều kị. 
 Ngày Mậu Tuất cũng không thể dùng.'],
            'hoi' => ['chi' => 'Hợi', 'truc' => 'NGÀY TRỰC KHAI', 'ynghia' => 'Thiên tặc, Nguyệt yếm. 
  Ất Hợi có Văn Xương tinh. 
  Kỷ Hợi có Hỏa tinh, có Văn Xương hiển quý tinh, nên đặt móng, buộc giàn, hôn nhân, 
khai trương, nhập trạch, xuất hành, trù mưu làm mọi việc, đều tốt trọn vẹn. Nên dùng giờ 
Mậu Thìn. 
  Là ngày tuy phạm Thiên tặc nhưng lại có Thiên cẩu huyên, cho nên không hại vì thế là 
tốt trên hết. Nếu như gặp ngày này người sống rất hoại cái mệnh (?). 
  Đinh Hợi cũng nên dùng việc. 
 Ngày Tân Hợi âm khí rất bạo, không phải là chỗ dùng của dương gian. 
  Quý Hợi là ngày cùng của lục giáp, không thể dùng. 
 Mà Kỷ Hợi vì có Hỏa tinh nên mọi việc có thể dùng, không thể không thuận mà xứng 
lòng, như ý.'],
            'ty' => ['chi' => 'Tí', 'truc' => 'NGÀY TRỰC BẾ', 'ynghia' => 'Hoàng sa. 
  Canh Tí tuy có Thiên đức, Nguyệt đức nhưng lại là lúc Thiên Địa chuyển Sát. 
  Nhâm Tí, Bính Tí là Thiên địa chuyển trục, không nên hưng công, động thổ, phạm cái 
đó rất xấu. 
  Giáp Tí là Thiên xá, là Tiến thần. 
 Và Mậu Tí nên việc nhỏ thì có thể sửa là tốt, nếu dùng việc lớn thì xấu,vạ triền miên, 
chẳng lành, không biết Đại mã nạp âm, hung sát và Bắc phương tạo độc chi thần (thần làm cờ 
lớn ở phương Bắc), thuần âm hắc sát chi khí Dư tào túc lệnh (chủ quản đông người nghiêm 
chỉnh lệnh), không phải là rất quý, không cảm thấy đáng dùng, phải cẩn thận.'],
        ],
    ];
    public static $thienCan = [
        [
            "id" => 0,
            "chuCaiDau" => '',
            "tenCan" => '',
            "nguHanh" => '',
            "nguHanhID" => '',
            "vitriDiaBan" => '',
            'amDuong' => ''
        ], [
            "id" => 1,
            "chuCaiDau" => "G",
            "tenCan" => "Giáp",
            "nguHanh" => "M",
            "nguHanhID" => 2,
            "vitriDiaBan" => 3,
            'amDuong' => 1
        ], [
            "id" => 2,
            "chuCaiDau" => "A",
            "tenCan" => "Ất",
            "nguHanh" => "M",
            "nguHanhID" => 2,
            "vitriDiaBan" => 4,
            'amDuong' => -1
        ], [
            "id" => 3,
            "chuCaiDau" => "B",
            "tenCan" => "Bính",
            "nguHanh" => "H",
            "nguHanhID" => 4,
            "vitriDiaBan" => 6,
            'amDuong' => 1
        ],
        [
            "id" => 4,
            "chuCaiDau" => "D",
            "tenCan" => "Đinh",
            "nguHanh" => "H",
            "nguHanhID" => 4,
            "vitriDiaBan" => 7,
            'amDuong' => -1
        ],
        [
            "id" => 5,
            "chuCaiDau" => "M",
            "tenCan" => "Mậu",
            "nguHanh" => "O",
            "nguHanhID" => 5,
            "vitriDiaBan" => 6,
            'amDuong' => 1
        ],
        [
            "id" => 6,
            "chuCaiDau" => "K",
            "tenCan" => "Kỷ",
            "nguHanh" => "O",
            "nguHanhID" => 5,
            "vitriDiaBan" => 7,
            'amDuong' => -1
        ],
        [
            "id" => 7,
            "chuCaiDau" => "C",
            "tenCan" => "Canh",
            "nguHanh" => "K",
            "nguHanhID" => 1,
            "vitriDiaBan" => 9,
            'amDuong' => 1
        ],
        [
            "id" => 8,
            "chuCaiDau" => "T",
            "tenCan" => "Tân",
            "nguHanh" => "K",
            "nguHanhID" => 1,
            "vitriDiaBan" => 10,
            'amDuong' => -1
        ],
        [
            "id" => 9,
            "chuCaiDau" => "N",
            "tenCan" => "Nhâm",
            "nguHanh" => "T",
            "nguHanhID" => 3,
            "vitriDiaBan" => 12,
            'amDuong' => 1
        ],
        [
            "id" => 10,
            "chuCaiDau" => "Q",
            "tenCan" => "Quý",
            "nguHanh" => "T",
            "nguHanhID" => 3,
            "vitriDiaBan" => 1,
            'amDuong' => -1
        ]
    ];
    public static $diaChi = [
        [
            "id" => 0,
            "tenChi" => "Hem có",
            "tenHanh" => "=>D",
            "amDuong" => 0
        ],
        [
            "id" => 1,
            "tenChi" => "Tí",
            "tenHanh" => "T",
            "menhChu" => "Tham lang",
            "thanChu" => "Linh tinh",
            "amDuong" => 1
        ],
        [
            "id" => 2,
            "tenChi" => "Sửu",
            "tenHanh" => "O",
            "menhChu" => "Cự môn",
            "thanChu" => "Thiên tướng",
            "amDuong" => -1
        ],
        [
            "id" => 3,
            "tenChi" => "Dần",
            "tenHanh" => "M",
            "menhChu" => "Lộc tồn",
            "thanChu" => "Thiên lương",
            "amDuong" => 1
        ],
        [
            "id" => 4,
            "tenChi" => "Mão",
            "tenHanh" => "M",
            "menhChu" => "Văn khúc",
            "thanChu" => "Thiên đồng",
            "amDuong" => -1
        ],
        [
            "id" => 5,
            "tenChi" => "Thìn",
            "tenHanh" => "O",
            "menhChu" => "Liêm trinh",
            "thanChu" => "Văn xương",
            "amDuong" => 1
        ],
        [
            "id" => 6,
            "tenChi" => "Tỵ",
            "tenHanh" => "H",
            "menhChu" => "Vũ khúc",
            "thanChu" => "Thiên cơ",
            "amDuong" => -1
        ],
        [
            "id" => 7,
            "tenChi" => "Ngọ",
            "tenHanh" => "H",
            "menhChu" => "Phá quân",
            "thanChu" => "Hỏa tinh",
            "amDuong" => 1
        ],
        [
            "id" => 8,
            "tenChi" => "Mùi",
            "tenHanh" => "O",
            "menhChu" => "Vũ khúc",
            "thanChu" => "Thiên tướng",
            "amDuong" => -1
        ],
        [
            "id" => 9,
            "tenChi" => "Thân",
            "tenHanh" => "K",
            "menhChu" => "Liêm trinh",
            "thanChu" => "Thiên lương",
            "amDuong" => 1
        ],
        [
            "id" => 10,
            "tenChi" => "Dậu",
            "tenHanh" => "K",
            "menhChu" => "Văn khúc",
            "thanChu" => "Thiên đồng",
            "amDuong" => -1
        ],
        [
            "id" => 11,
            "tenChi" => "Tuất",
            "tenHanh" => "O",
            "menhChu" => "Lộc tồn",
            "thanChu" => "Văn xương",
            "amDuong" => 1
        ],
        [
            "id" => 12,
            "tenChi" => "Hợi",
            "tenHanh" => "T",
            "menhChu" => "Cự môn",
            "thanChu" => "Thiên cơ",
            "amDuong" => -1
        ]
    ];
}
