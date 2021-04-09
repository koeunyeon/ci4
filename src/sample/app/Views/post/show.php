<h3><?= esc($post['title']) ?></h3> <!-- (1) -->
<article>  <!-- (2) -->
    <?= nl2br(esc($post['content'])) ?>  <!-- (3) -->
</article>