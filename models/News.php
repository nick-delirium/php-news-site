<?php

class News
{
    public static function getNewsById($id)
    {
        $id=intval($id);
        
        if ($id) {
            
            $db = Db::dbConnect(); 
            
            $result = $db->query('SELECT * from news WHERE id='.$id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
                
            $newsItem = $result->fetch();
//            print_r($newsItem);
            return $newsItem;
        }
    }
    
    public static function getNewsList()
    {
    
       $db = Db::dbConnect();
        
        $newsList = [];
        $result = $db->query('SELECT id, title, date, short_content, author_name '
                            . 'FROM news '
                            . 'ORDER BY date DESC '
                            . 'LIMIT 10');
        $i=0;
        while ($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['short_content'] = $row['short_content'];
            $newsList[$i]['author_name'] = $row['author_name'];
            $i++;
        }
       
        return $newsList;

        
    }
    
}