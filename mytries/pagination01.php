<?php

/**
 * 长文章分段
 * @param string $article 文章内容
 * @param number $word_number 文章字节限制
 * @return array
 */

function article_addpage($article,$word_number=1000){
	// $con = explode("_ueditor_page_break_tag_",$article);
	// if(count($con)>1){
		// return $article; //如果包含了表格就跳过，不进行分页处理
	// }
	// else{
		$word_all="";
		$word_num=0;
		$n="";
		$weor_cha=($word_number/10);//(上下浮动每页字数的10%)
		$article=preg_replace("/<div(.*?)>/m", "<br>",  $article);
		$article= str_replace("</div>","",  $article);
		$article=preg_replace("/<span(.*?)>/m", "<br>",  $article);
		$article= str_replace("</span>","",  $article);
		$article=preg_replace("/<p(.*?)>/m", "<br>",  $article);
		$article= str_replace("</p>","",  $article);
		$article= str_replace(chr(10),"<br>",  $article);
		$article=preg_replace("/<(.*?)<br>(.*?)>/m", "<\\1 \\2>",  $article);
		$artinfo=split("<br>",$article);//根据字符串确定段落
		$art_num=count($artinfo);//确定段落数
		$page_num_word=array();
		for($i=0;$i<=$art_num-1;$i++){
			$page_num_word[$i]=strlen($artinfo[$i]);
			$word_num=$word_num+$page_num_word[$i];//得到字数
			if ($word_num-$weor_cha<=$word_number or $i==0){
				$word_all.=$artinfo[$i]."<br>";
			}
			else{
				$word_all.="[nextpage]<br>".$artinfo[$i];
				$word_num=0;
			}
		}
		return $word_all; 
	// }
}
 

 
/**
 * 文章分页
 * @param string $article 文章内容
 * @param number $id 默认第一页
 * @param string $page 当前第几页
 * @return string
 */
function article_turnPage($article,$id,$page){
 
    $artinfo=explode("[nextpage]",$article);//根据字符串确定段落
    $pages=count($artinfo);//确定段落数
    $tempurla="";
    $fenyedh="";
    // echo $pages;
    //=======================================分页导航
    //显示总页数
    if ($pages>1){
 
    //$fenyedh= $fenyedh."共有".$pages."页 ";
    $substart=$page-10;
    $sybend=$page+10;
    if ($substart<=1 ){
        $substart=1;
    }
    if ($sybend>=$pages ){
        $sybend=$pages;
    }
    //显示分页数
    $first=1;
    $prev=$page-1;
    $next=$page+1;
    $last=$pages;
 
    // $fenyedh = "<div class='pages c_txt'>";
    // $fenyedh= $fenyedh."<a href='?id=".$id."'>第一页</a> ";
    $fenyedh= $fenyedh."<a href='?page=".$id."' class='inline_b up_page'>上一页</a> ";
    for ($i=$substart;$i<$page;$i++){
    $fenyedh= $fenyedh."<a href='?page=".$i."' class='inline_b'>".$i."</a> ";
    }
    $fenyedh= $fenyedh.'<a href="javascript:void(0);" title="1" class="inline_b current_pages">'.$page.'</a> '; //当前页
    for ($i=$page+1;$i<=$sybend;$i++){
            $fenyedh= $fenyedh."<a href='?page=".$i."'  class='inline_b' title=".$i.">".$i."</a> ";}
    }
    if($next > $pages){
        $href = 'javascript:void(0);';
    }else{
        $href = '?page='.$next;
    }
    $fenyedh= $fenyedh."<a href='".$href."' class='inline_b down_page'>下一页</a> ";
    $fenyedh .='<a href="'.Yii::app()->request->hostInfo.'/'.Yii::app()->request->pathInfo.'?view=all" title="全文浏览" class="inline_b">全文浏览</a>';
    // $fenyedh= $fenyedh."<a href='?page=".$last."'>最后一页</a>";
    // $fenyedh= $fenyedh."</div>";
 
    //=======================================分页导航end
    return $fenyedh;
	// return $artinfo[$page-1]."<br>".$fenyedh; 
}

 // 从数据库导入文章
$conn = mysql_connect('localhost','root','') or trigger_error("SQL", E_USER_ERROR);
$db = mysql_select_db('test',$conn) or trigger_error("SQL", E_USER_ERROR);
mysql_query('set names utf8');
$sql = "SELECT article FROM my_article WHERE id=1";
$result = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
$article = mysql_fetch_row($result);

$a = article_addpage($article);


?>