<?php

/*

!   link for ONE article hsould be above so if you will type incorrect 
    path(http://site.com/news/wr0ng i.e) you will see list of ALL news

!   a-z and 0-9 regular expression returns path with better style, for
    example you can go http://site.com/news/category/id instead of 
    http://site.com/news/?id=id&category=category  getting with $_GET['id'] and $_GET['category']

*/

return array(
//    'news/([a-z]+)/([0-9]+)' => 'news/view/$1/$2',// news/category/id
    'news/id=([0-9]+)' => 'news/view/$1',   // news/id
    'news' => 'news/index', // actionIndex in NewsController
    'products' => 'product/list', // actionList in ProductController
    'news/archive' => 'news/archive',
);
