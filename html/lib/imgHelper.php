<?php
/**
 * ͼƬ��������
 */
class imgHelper
{
    public $srcFiles;     //Դ�ļ�   array
    public $srcDirs;      //ԴĿ¼
    public $exportDir;    //���Ŀ¼
    public $exportFiles;  //����ļ�  array
    private  $_option = array("maxWidth"=>"1024" , "maxHeight"=>"768");

    function __construct($dir = '' , $option = array() )
    {
        if (!$dir) return;
        $this->srcDirs = $dir;
        $this->srcFiles = $this->traversal($dir);
        $this->setOptions( $option );
    }

    /**
     * �������Ŀ¼
     * @param $dir
     */
    public function setOutputDir( $dir )
    {
        if( !is_dir( $dir )) { mkdir($dir , 0777 , 1);}
            $this->exportDir = $dir;
    }

    public function execution()
    {
       foreach( $this->srcFiles as $key =>$val ):
           $srcImg = $val;
           $toFile = str_replace( $this->srcDirs , $this->exportDir , $srcImg); //todo ��㴦��.
           $maxWidth = $this->_option["maxWidth"];
           $maxHeight = $this->_option["maxHeight"];
           $this->resize($srcImg , $toFile , $maxWidth , $maxHeight );
       endforeach;
    }

    //����ͼƬ��
    private  function resize($srcImage,$toFile,$maxWidth = 100,$maxHeight = 100,$imgQuality=100)
    {
            //����Ŀ¼Ŀ¼!
            $pInfo = pathinfo( $toFile );
            $dir = $pInfo["dirname"];  if(!is_dir( $dir) ){ mkdir($dir , 0777 , 1);}

            list($width, $height, $type, $attr) = getimagesize($srcImage);

            if($width < $maxWidth  || $height < $maxHeight) return ;
            switch ($type) {
                case 1: $img = imagecreatefromgif($srcImage); break;
                case 2: $img = imagecreatefromjpeg($srcImage); break;
                case 3: $img = imagecreatefrompng($srcImage); break;
            }
            $scale = min($maxWidth/$width, $maxHeight/$height); //������ű���

            if($scale < 1) {
                $newWidth = floor($scale*$width);
                $newHeight = floor($scale*$height);
                $newImg = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($newImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                $newName = "";
                $toFile = preg_replace("/(.gif|.jpg|.jpeg|.png)/i","",$toFile);
                switch($type) {
                    case 1: if(imagegif($newImg, "$toFile$newName.gif", $imgQuality))
                        return "$newName.gif"; break;
                    case 2: if(imagejpeg($newImg, "$toFile$newName.jpg", $imgQuality))
                        return "$newName.jpg"; break;
                    case 3: if(imagepng($newImg, "$toFile$newName.png", $imgQuality))
                        return "$newName.png"; break;
                    default: if(imagejpeg($newImg, "$toFile$newName.jpg", $imgQuality))
                        return "$newName.jpg"; break;
                }
                imagedestroy($newImg);
            }
            imagedestroy($img);
            return false;
    }

    /**
     * ��������Ĵ�С
     * @param string $width
     * @param string $height
     */
    public function setOutputSize( $width = "1024" , $height = "768"){
        $_option = array("maxWidth"=>"$width" , "maxHeight"=>"$height");
        $this->setOptions( $_option );
    }

    /**
     * ���ÿ�ѡ����
     * @param $option
     */
    private  function setOptions( $option)
    {
        foreach( $option as $key =>$val):
            if( isset( $option[$key]) && $option[$key] ){
                $this->_option[$key] = $val;
            }
        endforeach;
    }

    /**
     * ��õ��ļ����µ������ļ�
     */
    private function traversal($path)
    {
        if (!$path) return array();
        $files = array();
        if (!is_dir($path)) return;
        foreach (scandir($path) as $file)
        {
            if ($file != '.' && $file != '..') {
                $path2 = $path . '/' . $file;
                if (is_dir($path2)) {
                    $temp = $this->traversal($path2);
                    $files = array_merge($files, $temp);
                } else {
                    if ($this->isIMg($file)) {
                        $files[] = $path . "/" . $file;
                    }
                }
            }
        }
        return $files;
    }

    /**
     * �ж��Ƿ���ͼƬ
     * @param $file
     * @return bool
     */
    private function isIMg($file)   {
        $pInfo  = pathinfo( $file);
         $extention =  $pInfo["extension"];
        return  preg_match("/(jpg)|(png)|gif/i" , $extention);
    }
    /** * �������� */
    public  function debug() {$this->pr($this->srcFiles, "������ͼƬ����.");
          $this->pr( $this->srcDirs , "ԴĿ¼");
          $this->pr( $this->exportDir , "Ŀ��Ŀ¼");
    }

    private function  pr($array, $title = 'DEBUG', $type = 'array', $width = '')  {      /*** @��ʽ����� */
        $title .= date("Y-m-d H:i:s");
        $widthStr = "";
        if ($width) $widthStr = "width:$width" . "px";
        echo "<fieldset style=\"-moz-border-radius:5px 5px 5px 5px; -moz-box-shadow:0px 0px 10px rgba(00,00,00,0.45); border: 3px solid  transparent; padding:3px; margin-top:20px; \"><legend style=\"color: #069; margin:3px; $widthStr \">$title</legend>";
        echo "<div style = '-moz-border-radius:10px 10px 10px 10px;font-size:14px; color:#069; border:1px solid #F0FAF9;  font-size:9pt; background:#F0FAF9; padding:5px;'>";
        print("<pre>");
        if ($type == 'json') {  $array = json_decode($array);    }
        print_r($array);
        print("</pre>");
        echo "<div>";
        echo  "</fieldset>";
    }
}
?>