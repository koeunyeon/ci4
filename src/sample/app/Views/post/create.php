<?= $this->extend('/post/layout') ?>
<?= $this->section('content') ?>


<h2 class="title mb-2">글쓰기</h2>
<form method="POST">
    <div class="form-group"> <!-- (1) -->
        <label for="title">제목을 알려주세요</label>  <!-- (2) -->
        <input type="text" class="form-control" id="title" name="title" value="<?= $post_data['title'] ?? "" ?>" placeholder="제목" required />  <!-- (3) -->
        <small id="titlehelp" class="form-text text-muted">제목은 4-100글자 사이입니다.</small>  <!-- (4) -->
    </div>
    <div class="form-group">
        <label for="content">내용을 입력하세요</label>
        <textarea name="content" class="form-control" id="content" rows="10" required><?= $post_data['content'] ?? "" ?></textarea>  <!-- (5) -->
    </div>
    <p style="text-align: right;">  <!-- (6) -->
        <input type="submit" class="btn btn-primary" value="저장">  <!-- (7) -->
        <a href="/post/" class="btn btn-info">취소</a>
    </p>
    <?php
    if (isset($errors)) {
        echo "<ul>";
        foreach ($errors as $val) {
            echo "<li>$val</li>";
        }
        echo "</ul>";
    }
    ?>
</form>

<?= $this->endSection() ?>