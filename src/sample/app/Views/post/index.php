<?= $this->extend('/post/layout') ?>
<?= $this->section('content') ?>
<?php
foreach($post_list as $post){
    ?>
    <div class="item mb-5">
        <div class="media">
            <!-- <img class="mr-3 img-fluid post-thumb d-none d-md-flex" src="/assets/images/blog/blog-post-thumb-7.jpg" alt="image"> -->
            <div class="media-body">
                <h3 class="title mb-1">
                    <a href="<?= site_url("/post/show/{$post['post_id']}") ?>"><?= $post['title'] ?></a>
                </h3>
                <div class="meta mb-1">
                    <span class="date"><?= $post['created_at'] ?></span>
                    <!-- <span class="comment"><a href="<?= site_url("/post/show/{$post['post_id']}#comment") ?>">4 comments</a></span></div> -->
                <div class="intro"><?= $post['content'] ?></div>
                <a class="more-link" href="<?= site_url("/post/show/{$post['post_id']}/#content") ?>">Read more &rarr;</a>
            </div><!--//media-body-->
        </div><!--//media-->
    </div><!--//item-->
    <?php
}
?>
<?php $pager->setPath("/post"); ?>
<?= $pager->links() ?>
<?= $this->endSection() ?>