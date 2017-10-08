<?php
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL^E_NOTICE);
header("text/html,charset='utf-8'");
for($p=0;$p<=10;$p++){
    $query="生活";
    $page_num=20;
    $region="保山";
    $url="http://api.map.baidu.com/place/v2/search?query=".$query."&page_size=".$page_num."&page_num=".$p."&scope=1&region=".$region."&output=json&ak=f3jVlLprbprp0KkMYGXvKEUAbjAs6K7s";
    $data=getAction($url);
    $result=json_decode($data,true);
    $re=$result['results'];
    for($i=0; $i <=count($re)-1 ; $i++) { 
        if($re[$i]['telephone']){
            $str1="<tr>";
               $r[$i]['name']='<td>'.$re[$i]['name'].'</td>';
               $r[$i]['address']='<td>'.$re[$i]['address'].'</td>';
               $r[$i]['telephone']='<td>'.$re[$i]['telephone'].'</td>';
            $str2="</tr>";
            $string=$string.$str1.$r[$i]['name'].$r[$i]['address']. $r[$i]['telephone'].$str2;
            }
    }
    if(!empty($string)){
        if($p==10){
    file_put_contents("./data/".$query.".html", "<table><tr style='background-color:green;color;white'><td>公司名称</td><td>地址</td><td>电话</td></tr>".$string."</table>",FILE_APPEND);
    	echo "写入成功第".$p."页";
    }
        }else{
            echo "第".$p."页没有数据了";
        }
	}
	
function getAction($url='')
{
     $curl = curl_init();
     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
     curl_setopt($curl, CURLOPT_URL, $url); 
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
     $data = curl_exec($curl);
     curl_close($curl);
     return $data; 
 }
 function postAction($url='', $data=array())
{
     $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
     curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
     curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
     curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
     $result = curl_exec($curl);
		curl_close($curl);
     return $result;
	 }
?>