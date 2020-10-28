<?php
/**
 * @author: justwkj
 * @date: 2020/7/22 13:17
 * @update_date: 2020/10/28 11:16
 * @email: justwkj@gmail.com
 * @desc: 格式化复制的数据
 */


function outputJson($data) {
    $itemArr = [];
    foreach ($data as $datum) {
        $tmp = [
            'title' => $datum['title'],
            'arg'   => isset($datum['arg']) ? $datum['arg'] : '',
        ];
        if (isset($datum['quicklookurl'])) {
            $tmp['quicklookurl'] = $datum['quicklookurl'];
        }
        $itemArr[] = $tmp;
    }
    $data = ['items' => $itemArr];
    echo json_encode($data);
    die;
}

$query = empty($argv[1]) ? '' : $argv[1];
$input = shell_exec('pbpaste');


$array = array_filter(preg_split('/\s+/', $input));

if ($query==='"' || $query ==="'") {
    $joinSeparated = $query == '"' ? '"' : "'";
} else {
    $joinSeparated = $query;
}


$str = '';
if($query==='"' || $query ==="'"){
    $tmp = [];
    foreach ($array as $item) {
        $format = '%s%s%s';
        $tmp[] = sprintf($format, $joinSeparated, $item, $joinSeparated);
    }
    $str = implode(','.PHP_EOL, $tmp);
} else {
    $str = implode($joinSeparated, $array);
}
outputJson([[
    "title" => '格式化完毕:' . $str,
    "arg"   => $str,
]]);
