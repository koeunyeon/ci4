<p>순서 없는 목록</p>
<ul> <!-- (1) -->
    <?php foreach ($alphabet as $char) : ?> <!-- (2) -->
        <li><?= $char ?></li> <!-- (3) (4) -->
    <?php endforeach ?> <!-- (5) -->
</ul>
<hr /> <!-- (6) -->
<p>순서 있는 목록</p>
<ol> <!-- (7) -->
    <?php foreach ($alphabet as $char) : ?>
        <li><?= $char  ?></li>
    <?php endforeach ?> 
</ol>