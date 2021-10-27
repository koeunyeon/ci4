<?= $this->extend('/post/layout') ?>
<?= $this->section('content') ?>
<?php
function show_content($content)
{
    $content = strip_tags($content); // (1)
    if (mb_strlen($content) > 100) { // (2)
        $content = mb_substr($content, 0, 100); // (3)
    }
    return $content;
}

foreach ($post_list as $post) {
    ?>
    <div class="item mb-5">
    <div class="media">
        <div class="media-body">
            <h3 class="title mb-1">
                <a href="<?= site_url("/post/show/{$post->post_id}") ?>"><?= $post->title ?></a>
            </h3>
            <div class="meta mb-1">
                <span class="date"><?= $post->created_at ?></span>
                <div class="intro"><?= show_content($post->html_content) ?></div>
                <a class="more-link" href="<?= site_url("/post/show/{$post->post_id}/#content") ?>">Read more &rarr;</a>
            </div>
        </div>
    </div>
    <?php
}
?>
<?php $pager->setPath("/post"); ?>
<?= $pager->links() ?>
<?php if ($isLogin) : ?>
    <p style="text-align: right;">
        <a href="/post/create" class="btn btn-primary">글쓰기</a>
    </p>
<?php endif ?>
<?= $this->endSection() ?>