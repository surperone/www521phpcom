<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK" />
<title>�Ұ���php-�ٶȡ��ȸ衢�ѹ������ѡ�bing���Ż����е���֩������ͳ��</title>
<meta name="keywords" content="֩�����У���ϸ��¼��php���˲���">
<meta name="description" content="֩�����У���ϸ��¼��php���˲���">
<style type="text/css">
a{
    color:#00572C;
    font-size:15px;
    text-decoration:none;
}
a:hover{color: #8000FF; }
.td1{ width:100px; }
.td2{ width:610px;height:15px;}
.div1{text-align:left;width:600px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;word-break:keep-all; }
</style>
<?php
error_reporting(0);
include 'config.php';
@$zz=$_GET['zz'];
if($zz=="baidu")
{
    $where="where robotsname='baidu'";
}
elseif($zz=="google")
{
    $where="where robotsname='google'";
}
elseif($zz=="soso")
{
    $where="where robotsname='soso'";
}
elseif($zz=="sogou")
{
    $where="where robotsname='sogou'";
}
elseif($zz=="bing")
{
    $where="where robotsname='bing'";
}
elseif($zz=="yahoo")
{
    $where="where robotsname='yahoo'";
}
elseif($zz=="youdao")
{
    $where="where robotsname='youdao'";
}
elseif($zz=="Alexa")
{
    $where="where robotsname='Alexa'";
}
elseif($zz=="so")
{
    $where="where robotsname='so'";
}
else
{
    $where=null;
}

$sql="select count(*) from robots $where";
$resultc=mysql_query($sql) or die(mysql_error());
$rsc=mysql_fetch_array($resultc);
$num=$rsc[0];//ȡ�����ݱ���ܼ�¼��
$pagesize=20;//��ҳ��С
if($_GET[page]<>""){
$page=$_GET[page]-1;
if($page<0)$page=0;
if($page>(intval($num/$pagesize)))$page=intval($num/$pagesize);}
$sql="select * from robots $where order by id DESC limit ".$pagesize*$page.",".$pagesize;
$ok=mysql_query($sql,$conn);
?>
</head>
<body>
<table align=center width=960 cellpadding=3 cellspacing=1  bgcolor=#009900 >
<tr align=center style=#008822  bgcolor=#0077aa height=100>
  <td colspan=4 style=font-size:28px;font-weight:bold;>�Ұ���php--��������֩�����м��ϵͳ&nbsp;��<a style=font-size:24px;text-decoration:none;color:#770000; href=?delete>�������</a>��</td> 
</tr>
<tr bgcolor=#E8F3FF align=left style=color:blue; height=50><td colspan=4 >�鿴������֩��ץȡ�б�: <a href='index.php'>�鿴ȫ��</a> | <a href='?zz=baidu'>�ٶ�</a> | <a href='?zz=google'>�ȸ�</a> | <a href='?zz=sogou'>�ѹ�</a> | <a href='?zz=soso'>SOSO</a> | <a href='?zz=yahoo'>�Ż�</a> | <a href='?zz=bing'>Bing</a> | <a href='?zz=youdao'>�е�</a> | <a href='?zz=Alexa'>Alexa</a> | <a href='?zz=so'>360</a></td></tr>
<tr  height=20px bgcolor=#E8F3FF style=color:blue;>
<td colspan=4 >
��<?php echo ceil($num/$pagesize);?>ҳ
<a href="?zz=<?php echo $zz;?>&page=1">��ҳ</a>
<?php if($page>0) echo " <a href='?zz=".$zz."&page=".$page."'>��һҳ</a> ";
for($i=($page>4?($page-3):1);$i<=(ceil($num/$pagesize)<9?ceil($num/$pagesize):(ceil($num/$pagesize)>($page+5)?($page+($page>5?5:(9-$page))):ceil($num/$pagesize)));$i++)
{
if(($page+1)==($i))
echo "&nbsp;".$i."&nbsp;";
else
echo "<a href='?zz=".$zz."&page=".$i."'>[".($i)."]</a>";
}
?><?php if($page<ceil($num/$pagesize)-1) echo " <a href='?zz=".$zz."&page=".($page+2)."'>��һҳ</a> ";?><a href="?zz=<?php echo $zz;?>&page=<?php echo round(ceil($num/$pagesize));?>">ĩҳ</a>
</td></tr>
<?php
echo "<tr align=center style=color:#FFFFFF;><td class=td1>֩������</td><td width=150>֩��IP</td><td class=td1>ץȡʱ��</td><td width=610>��¼ҳ��</td></tr>";
while($i=mysql_fetch_array($ok))
{  
    echo "<tr align=center bgcolor=#E8F3FF>";
    echo "<td >";
    echo $i['1'];
    echo "</td>";
    echo "<td >";
    echo $i['2'];
    echo "</td>";
    echo "<td >";
    echo $i['3'];
    echo "<br />";
    echo $i['4'];
    echo "</td>";
    echo "<td  class=td2>";
	echo "<div class=div1>";
	echo "��<a target='_blank'  href='".$i['6']." '>";
	echo iconv('utf-8', 'GBK',URLDecode($i['6']));
	echo "</a>&nbsp;";
   	echo "<a target='_blank'  href='".$i['5']." '>";
	echo "��ҳ��>";
	echo iconv('utf-8', 'GBK',URLDecode($i['5']));
	echo "</a>";
	echo "</div>";
	echo "</td>";
    echo "</tr>";
}
$delsj=$_SERVER['QUERY_STRING'];
if($delsj=="delete")
{
$delsql="TRUNCATE `robots`";
$okdel=mysql_query($delsql,$conn);
if($okdel)
{
    echo "<script>alert('���������');location.href='index.php';</script>";
}
} 
?>
<tr height=30px bgcolor=#E8F3FF style=color:blue;>
<td colspan=4 >
��<?php echo ceil($num/$pagesize);?>ҳ
<a href="?zz=<?php echo $zz;?>&page=1">��ҳ</a>
<?php if($page>0) echo " <a href='?zz=".$zz."&page=".$page."'>��һҳ</a> ";
for($i=($page>4?($page-3):1);$i<=(ceil($num/$pagesize)<9?ceil($num/$pagesize):(ceil($num/$pagesize)>($page+5)?($page+($page>5?5:(9-$page))):ceil($num/$pagesize)));$i++)
{
if(($page+1)==($i))
echo "&nbsp;".$i."&nbsp;";
else
echo "<a href='?zz=".$zz."&page=".$i."'>[".($i)."]</a>";
}
?><?php if($page<ceil($num/$pagesize)-1) echo " <a href='?zz=".$zz."&page=".($page+2)."'>��һҳ</a> ";?><a href="?zz=<?php echo $zz;?>&page=<?php echo round(ceil($num/$pagesize));?>">ĩҳ</a>
</td></tr>
</table>
<table align=center width=960 cellpadding=0 cellspacing=0  bgcolor=#009900 >
<tr bgcolor=#0077aa>
  <td height="25" align="center" colspan=4 style=font-size:15px; >
    <a  href="http://www.521php.com">php��������</a></td>
</tr>
</table>
</body>
</html>