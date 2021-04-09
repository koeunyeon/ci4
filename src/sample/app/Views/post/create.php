<h1>글쓰기</h1>
<form method="POST">
    <p>
    <h3>제목</h3>
    <input type="text" name="title" value="<?= $post_data['title'] ?? "" ?>" />
    </p>
    <p>
    <h3>내용</h3>
    <textarea name="content"><?= $post_data['content'] ?? "" ?></textarea>
    </p>
    <p><input type="submit" value="저장"></p>
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