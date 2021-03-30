<ul>
    <?php foreach ($link_data as $row) : ?>
        <li>            
            <a href="<?= $row['url'] ?>" <?= $row['is_new_tab'] ? "target='_blank'" : "target='_self'" ?> ><?= $row['message'] ?></a>
        </li>
    <?php endforeach; ?>
</ul>