<?php
require 'vendor/autoload.php';
use QL\QueryList;

//�ɼ�ĳҳ�����е�ͼƬ
$data = QueryList::get('http://cms.querylist.cc/bizhi/453.html')->find('img')->attrs('src');
//��ӡ���
print_r($data->all());

//�ɼ�ĳҳ�����еĳ����Ӻͳ������ı�����
//�������ֶ���ȡҪ�ɼ���ҳ��Դ��
$html = file_get_contents('http://cms.querylist.cc/google/list_1.html');
//Ȼ����԰�ҳ��Դ�����HTMLƬ�δ���QueryList
$data = QueryList::html($html)->rules([  //���òɼ�����
    // �ɼ�����a��ǩ��href����
    'link' => ['a','href'],
    // �ɼ�����a��ǩ���ı�����
    'text' => ['a','text']
])->query()->getData();
//��ӡ���
print_r($data->all());

/**
 * ���߲��Բɼ����鿴�ɼ����:http://querylist.cc/querylist-test
 */
?>
