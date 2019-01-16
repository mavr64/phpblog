<!--СПИСОК ПЕРЕМЕННЫХ В ШАБЛОНЕ
    $login
    $password
    $msg
-->
<form class="form" method="post">
    <span class="h3">Логин: </span>
    <div class="form_item">
        <input type="text" name="login" value="<?php echo $title; ?>" placeholder="Введите логин">
    </div>
    <span class="h3">Пароль: </span>
    <div class="form_item">
		<input type="text" name="password" value="<?php echo $content; ?>" placeholder="Введите пароль">
    </div>
    <span class="h3"> </span>
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