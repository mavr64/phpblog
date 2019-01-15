<!--СПИСОК ПЕРЕМЕННЫХ В ШАБЛОНЕ
    $title
    $content
-->
<form method="post">
    <span class="h3">Название</span>
    <div class="form_item">
        <input type="text" name="title" value="<?php echo $title; ?>">
    </div>
    <span class="h3">Содержание</span>
    <div class="form_item">
		<textarea name="content" cols='32' rows='15'>
			<?php echo $content; ?>
		</textarea>
    </div>
    <div class="form_submit">
        <input type="submit" value="Добавить">
    </div>
</form>
<?php if (!$msg==''):?>
    <div class="error_text">
		<?php echo $msg; ?>
	</div>
<?php endif; ?>
<div class="nav">
    <div class="nav_link">
        <br><a href="/">На главную</a>
    </div>
</div>