<!--СПИСОК ПЕРЕМЕННЫХ В ШАБЛОНЕ
    $articles
    isAuth
-->

    <span class="h4"><b>Список статей:</b></span>
    <table>
<?php
        foreach($articles as $article):
            if ($isAuth): ?>
                <tr>
                <td><!--div class="articles_item"-->
                    <a href="post/one/<?php echo $article['id_article']?>" class="articles_link">
                        "<?php echo $article['title']?>" </a></td><td> от <?php echo $article['dt']?>
                    &nbsp;&nbsp;</td>
                <td><a href="post/edit/<?php echo $article['id_article']?>">
                        <img src="/assets/img/icons/logo_edit.png" alt="Редактировать статью" width="16" height="16" border="0"></a></td><td><?php if($article['dt_ed'] !== null) { ?>&nbsp; ред. от&nbsp; <?php echo $article['dt_ed'];}?></td>
                <!--/div-->
<?php
            else :?>
                <tr>
                    <div class="articles_item">
                        <a href="post/one/<?php echo $article['id_article']?>" class="articles_link">
                            "<?php echo $article['title']?>" </a> от <?php echo $article['dt']?> &nbsp;&nbsp;
                    </div>
                </tr>
<?php
            endif;
        endforeach;
        ?>
    </table>
    <div class="clear">&nbsp;</div>
<?php
    if ($isAuth):?>
        <div class="nav">
            <div class="nav_link">
                <a href="post/add">
                    Добавить</a>
            </div>
        </div>
<?php
    endif; ?>