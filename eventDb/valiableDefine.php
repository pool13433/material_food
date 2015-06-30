<?php

define('APPLICATION_NAME', 'ระบบจัดการร้านอาหาร');
define('EMPLOYEE', 1);
define('ONWER', 2);

define('BACKEND_HOME', 'dashboard');


// ################### upload config #############
define('PATH_UPLOAD', '/images/uploads/');
define('PATH_UNZIP', '/images/unzip/');
define('EX_FILEZIP_NAME', '99999-20141231-01.zip');
define('EX_FILEZIP_LENGTH', 21);
define('ACCEPTED_FILES', 'application/zip');
define('MAX_FILE_SIZE', 20);
define('MUTI_UPLOAD', 1);  // 1 = Signgle, > 1 = Muti
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
