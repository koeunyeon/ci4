<p>순서 없는 목록</p>
<ul>
    <?php foreach ($alphabet as $char) : ?>
        <li><?= $char ?></li>
    <?php endforeach ?>
</ul>
<hr />
<p>순서 있는 목록</p>
<ol>
    <?php foreach ($alphabet as $char) : ?>
        <li><?= $char  ?></li>
    <?php endforeach ?> 
</ol>