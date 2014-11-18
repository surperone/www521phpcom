<?php
   $file = @$_GET['file'];
   if(!is_file($file))
   header("HTTP/1.0 404 Not Found");
   header("Content-type: text/html; charset=utf-8");
   $filename = strrchr($file,'/');
   $filename = ltrim($filename,'/');
   $dir = rtrim($file,$filename);
?>
<head>
<title>
<?php echo $filename;?>
</title>
<link href="https://assets-cdn.github.com/assets/github-59da74dcbe2f1d555e306461652274f8741238a64e7b1fe8cc5a286232044835.css" media="all" rel="stylesheet" type="text/css">
<link href="https://assets-cdn.github.com/assets/github2-22a0054564248c6dd87336e91bca068b1ab49e28ee1062519b3a0722d29da804.css" media="all" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
	<div id="js-repo-pjax-container" class="repository-content context-loader-container" data-pjax-container="">
	<div class="file-wrap">
	  <table class="files" data-pjax="">
		<tbody>
		<?php
			$dir = opendir($dir);
			while (($f = readdir($dir)) !== false){
				if('.' !=$f && '..' != $f){
				$href = $f;
				if(is_dir($dir.$f))
				$href = $f.'/index.md';
		?>
			<tr>
			  <td class="icon">
				<span class="octicon octicon-file-directory"></span>
			  </td>
			  <td class="content">
				<span class="css-truncate css-truncate-target"><a href="<?php echo $href;?>" class="js-directory-link" title=""><?php echo $file;?></a></span>
			  </td>
			  <td class="message">
				<span class="css-truncate css-truncate-target">
				</span>
			  </td>
			  <td class="age">
				<span class="css-truncate css-truncate-target"><time datetime="2014-11-17T17:00:09Z" is="time-ago" title="2014年11月18日 GMT+8上午1:00">9 hours ago</time></span>
			  </td>
			</tr>
			<?php
				}
			}
		    ?>
		</tbody>
	  </table>
	</div>
		<div class="file-box">
           <div class="file">
			<div class="meta clearfix">
			  <div class="info file-name">
				  <span><?php echo $filename;?></span>
			  </div>
			</div>
			<div id="readme" class="blob instapaper_body">
				<article class="markdown-body entry-content" itemprop="mainContentOfPage">
				<?php
				   echo system('/usr/bin/kramdown  '.$file);
				?>
				</article>
			</div>
		   </div>
		</div>
	</div>
</div>
</body>
