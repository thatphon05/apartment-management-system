<?php

use Carbon\Carbon;


if (!function_exists('convertDateToAD')) {
    /**
     * Convert B.E. to A.D.
     * @param $date
     */
    function convertDateToAD($date): Carbon
    {
        $parse = Carbon::parse($date);

        if ($parse->year > 2400) {
            return $parse->subYears(543);
        }

        return $parse;
    }
}

if (!function_exists('convertDateToBE')) {
    /**
     * Convert to B.E.
     * @param $date
     */
    function convertDateToBE($date): Carbon
    {
        return Carbon::parse($date)->addYears(543);
    }
}

if (!function_exists('getAllMonth')) {
    /**
     * get all month available
     * @return array
     */
    function getAllMonth(): array
    {
        return [
            'มกราคม',
            'กุมภาพันธ์',
            'มีนาคม',
            'เมษายน',
            'พฤษภาคม',
            'มิถุนายน',
            'กรกฎาคม',
            'สิงหาคม',
            'กันยายน',
            'ตุลาคม',
            'พฤศจิกายน',
            'ธันวาคม',
        ];
    }
}

if (!function_exists('getAllProvinces')) {
    /**
     * get all province in thailand available
     * @return array
     */
    function getAllProvince(): array
    {
        return [
            'กระบี่', 'กรุงเทพมหานคร', 'กาญจนบุรี', 'กาฬสินธุ์', 'กำแพงเพชร',
            'ขอนแก่น',
            'จันทบุรี',
            'ฉะเชิงเทรา',
            'ชลบุรี', 'ชัยนาท', 'ชัยภูมิ', 'ชุมพร', 'เชียงราย', 'เชียงใหม่',
            'ตรัง', 'ตราด', 'ตาก',
            'นครนายก', 'นครปฐม', 'นครพนม', 'นครราชสีมา', 'นครศรีธรรมราช', 'นครสวรรค์', 'นนทบุรี', 'นราธิวาส', 'น่าน',
            'บึงกาฬ', 'บุรีรัมย์',
            'ปทุมธานี', 'ประจวบคีรีขันธ์', 'ปราจีนบุรี', 'ปัตตานี',
            'พระนครศรีอยุธยา', 'พะเยา', 'พังงา', 'พัทลุง', 'พิจิตร', 'พิษณุโลก', 'เพชรบุรี', 'เพชรบูรณ์', 'แพร่',
            'ภูเก็ต',
            'มหาสารคาม', 'มุกดาหาร', 'แม่ฮ่องสอน',
            'ยโสธร', 'ยะลา',
            'ร้อยเอ็ด', 'ระนอง', 'ระยอง', 'ราชบุรี',
            'ลพบุรี', 'ลำปาง', 'ลำพูน', 'เลย',
            'ศรีสะเกษ',
            'สกลนคร', 'สงขลา', 'สตูล', 'สมุทรปราการ', 'สมุทรสงคราม', 'สมุทรสาคร', 'สระแก้ว', 'สระบุรี', 'สิงห์บุรี', 'สุโขทัย', 'สุพรรณบุรี', 'สุราษฎร์ธานี', 'สุรินทร์',
            'หนองคาย', 'หนองบัวลำภู',
            'อ่างทอง', 'อำนาจเจริญ', 'อุดรธานี', 'อุตรดิตถ์', 'อุทัยธานี', 'อุบลราชธานี',
        ];
    }
}
