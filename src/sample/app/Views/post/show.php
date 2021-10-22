<?= $this->extend('/post/layout') ?>
<?= $this->section('content') ?>

<header class="blog-post-header">
    <h2 class="title mb-2"><?= esc($post['title']) ?></h2>
    <div class="meta mb-3">
        <span class="date"><?= esc($post['created_at']) ?></span>
    </div>
</header>

<div class="blog-post-body">
    <?= $post['html_content'] ?>
</div><!--//blog-comments-section-->
<?= $this->endSection() ?>