<?php foreach ($data as $row) : ?>
    <div>        
        <img src="<?= $row['src'] ?>" alt="<?= $row['alt'] ?>" width="<?= $row['width'] ?>"  height="<?= $row['height'] ?>" />
    </div>
<?php endforeach; ?>