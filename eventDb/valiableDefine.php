<?php

define('APPLICATION_NAME', 'ระบบจัดการร้านอาหาร');
define('EMPLOYEE', 1);
define('ONWER', 2);

define('BACKEND_HOME', 'dashboard');


// ################### upload config #############
define('PATH_UPLOAD', '../uploads/picture_user/');
define('MAX_PICTURE_SIZE', 400);

// ################### upload config #############

function returnJson($status, $title, $message, $url) {
    return json_encode(array(
        'status' => $status,
        'title' => $title,
        'message' => $message,
        'url' => $url
    ));
}

function format_date($format, $date) {
    if ($date == null) {
        //return date('d/m/Y');
        return '-';
    } else if ($date == '0000-00-00') {
        return date('d-m-Y');
    } else {
        $date_format = new DateTime($date);
        $new_date = $date_format->format($format);
        return $new_date;
    }
}

function listUserPrefixStatus() {
    return array(
        1 => 'EMP',
        2 => 'OWN',
        3 => '',
    );
}

function listUserStatus() {
    return array(
        1 => 'EMPLOYEE',
        2 => 'OWNER',
        3 => '',
    );
}

function listUserSex() {
    return array(
        'M' => 'ชาย',
        'F' => 'หญิง'
    );
}

function listMaterialStatus() {
    return array(
        '0' => 'ปกติ',
        '1' => 'หมด',
        '2' => 'หมดอายุ'
    );
}

function listUserAge($minAge = 10, $maxAge = 100) {
    $ages = array();
    for ($i = $minAge; $i < $maxAge; $i++) {
        $ages[$i] = $i;
    }
    return $ages;
}

function getDataList($params, $list) {
    $array = $list;
    if (isset($params)):
        $result = "";
        foreach ($array as $key => $value):
            if ($key == strval($params)):
                $result = $value;
            endif;
        endforeach;
        return $result;
    endif;
}
