<?php
function show_content($content)
{
    $content = strip_tags($content);
    if (mb_strlen($content) > 100) {
        $content = mb_substr($content, 0, 100);
    }
    return $content;
}
?>
<ul>
<?php foreach ($post_list as $post) : ?>
    <a href="<?= site_url("/post/show/{$post["post_id"]}") ?>"><?= $post["title"] ?></a>
    <div><?= show_content($post["content"]) ?></div>
    <a href="<?= site_url("/post/show/{$post["post_id"]}/#content") ?>">Read more</a>
<?php endforeach ?>
</ul>
<?= $pager->links() ?>