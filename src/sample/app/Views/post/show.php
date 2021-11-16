<?= $this->extend('/post/layout') ?>
<?= $this->section('content') ?>

<header class="blog-post-header">
    <h2 class="title mb-2"><?= esc($post->title) ?></h2>
    <div class="meta mb-3">
        <span class="date"><?= esc($post->created_at) ?></span>
    </div>
</header>

<div class="blog-post-body">
    <?= $post->html_content ?>
</div><!--//blog-comments-section-->
<?php if ($isAuthor) : ?>
<div style="text-align: right;">
    <form method="POST" action="/post/delete">
        <a href="/post/edit/<?= $post->post_id ?>" class="btn btn-info">수정</a>
        <input type="hidden" name="post_id" value="<?= $post->post_id?>" />
        <input type="submit" class="btn btn-danger" value="삭제">
    </form>
</div>
<?php endif ?>
<?= $this->endSection() ?>
