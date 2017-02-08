<?php

include_once ROOT.'/models/News.php';

class NewsController{
    
    public function actionIndex()
    {
        $newsList = [];
        $newsList = News::getNewsList();
        // echo '<pre>'; print_r($newsList); echo '</pre>';
        require_once(ROOT.'/views/news/index.php');
        return true;
    }
    
    public function actionView($id)
    {
       if ($id) {
           $newsItem = News::GetNewsById($id);
           // echo '<pre>';print_r($newsItem);echo '</pre>';
            require_once(ROOT.'/views/news/article.php');
       } 
        return true;
    }
}

