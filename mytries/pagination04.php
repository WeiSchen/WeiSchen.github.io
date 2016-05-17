<?php 
//备注：假使下面函数都已经已经初始化$memcached了 
class Article 
{ 
    private $article_version = 'article_version'; 
     
    public function getArticle($type='new',$page='1',$limit=0){      
        //设置memcached的key，在key的末端加上版本号 
        $cache_id = 'art_type'.$type.'_page'.$page.'_limit'.$limit.'v_'.$this->_getArticleVersion();         
        //得到分页数据 
        $artdata = $memcached->get($cache_id); 
        if( FALSE === $artdata) { 
            //重新从数据库得到数据并设置新的memcached缓存     
        } 
        return $artdata; 
    } 
     
    public function updateArticle($conditions,$data){ 
        //更新数据库数据操作 
         
        //更新Article的版本，这样所有Article表相关的缓存就都失效了，下次调用getArticle函数的时候将生成新的缓存数据 
        $this->_setArticleVersion(); 
    } 
     
    private function _getArticleVersion(){ 
        $article_version_num = $memcached->get($this->article_version); 
        if( FALSE === $article_version_num){ 
            $article_version_num = 1; 
            $memcached->set($this->article_version, $article_version_num, 86400); 
        } 
        return $article_version_num; 
    } 
     
    private function _setArticleVersion(){ 
        $article_version_num = $memcached->get($this->article_version); 
        $article_version_num++; 
        $memcached->set($this->article_version, $article_version_num, 86400); 
    } 
 
} 
?> 