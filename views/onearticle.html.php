<!--СПИСОК ПЕРЕМЕННЫХ В ШАБЛОНЕ
    $title
    $id_article
    $dt
    $content
-->
<div class="nav">
    <div class="nav_link">
        <br><a href="/">На главную</a>
    </div>
</div>
<div class="article_title">
    <b><?php echo nl2br("\"" . $title . "\"(" . $id_article . ") от " . $dt); ?></b>
</div>
<div class="article_content">
		<?php echo nl2br($content); ?>
</div>
<div class="nav">
    <div class="nav_link">
        <br><a href="/">На главную</a>
	</div>
</div>