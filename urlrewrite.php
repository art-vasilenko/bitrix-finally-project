<?php
$arUrlRewrite=array (
  1 => 
  array (
    'CONDITION' => '#^/news/topics/(\\d+)/#',
    'RULE' => 'theme=$1',
    'ID' => '',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^/news/(\\d+)/#',
    'RULE' => 'id=$1',
    'ID' => '',
    'PATH' => '/news/detail.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/books/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/books/index.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/books/filter/(.+?)/apply/#',
    'RULE' => 'SMART_FILTER_PATH=$1',
    'ID' => 'bitrix:catalog.smart.filter',
    'PATH' => '/books/index.php',
    'SORT' => 50,
  ),
);
