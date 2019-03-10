<?php
require 'vendor/autoload.php';
use QL\QueryList;

//采集某页面所有的图片
$data = QueryList::get('http://cms.querylist.cc/bizhi/453.html')->find('img')->attrs('src');
//打印结果
print_r($data->all());

//采集某页面所有的超链接和超链接文本内容
//可以先手动获取要采集的页面源码
$html = file_get_contents('http://cms.querylist.cc/google/list_1.html');
//然后可以把页面源码或者HTML片段传给QueryList
$data = QueryList::html($html)->rules([  //设置采集规则
    // 采集所有a标签的href属性
    'link' => ['a','href'],
    // 采集所有a标签的文本内容
    'text' => ['a','text']
])->query()->getData();
//打印结果
print_r($data->all());

/**
 * 在线测试采集并查看采集结果:http://querylist.cc/querylist-test
 */
?>
