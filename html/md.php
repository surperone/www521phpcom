<?php
   header("Content-type: text/html; charset=utf-8");
?>
<link href="https://assets-cdn.github.com/assets/github-59da74dcbe2f1d555e306461652274f8741238a64e7b1fe8cc5a286232044835.css" media="all" rel="stylesheet" type="text/css">
<div class="container">
<div id="js-repo-pjax-container" class="repository-content context-loader-container" data-pjax-container="">
<div class="file-box">
<br />
<article class="markdown-body entry-content" itemprop="mainContentOfPage">
<?php
   $file = @$_GET['file'];
   echo system('/usr/bin/kramdown  '.$file);
?>
</article>
</div>
</div>
</div>
