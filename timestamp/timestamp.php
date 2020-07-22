<?php
/**
 * @author: justwkj
 * @date: 2020/7/22 13:13
 * @email: justwkj@gmail.com
 * @desc:
 */

date_default_timezone_set("PRC");
$query = empty($argv[1]) ? '' : $argv[1];

if (empty($query)) {
    $param = time();
    $output = '当前时间戳为：' . $param;
    $param2 = date('Y-m-d H:i:s');
    $output2 = '当前日期为：' . $param2;
} else if (is_numeric($query)) {
    $param = date('Y-m-d H:i:s', $query);
    $output = $param;

    $output2 = $param2 = $query;
} else {
    $param = strtotime($query);
    $output = $param;

    $output2 = $param2 = $query;
}

echo '<?xml version="1.0" encoding="utf-8"?>
<items>
    <item valid="yes" arg="' . $param . '">
        <title>' . $output . '</title>
        <subtitle></subtitle>
        <icon></icon>
    </item>
 <item valid="yes" arg="' . $param2 . '">
        <title>' . $output2 . '</title>
        <subtitle></subtitle>
        <icon></icon>
    </item>
</items>';