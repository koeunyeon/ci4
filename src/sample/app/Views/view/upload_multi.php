<form method="POST" enctype="multipart/form-data">
    <p>
        멀티 파일 업로드
        <input type="file" name="files[]" multiple="multiple" />
    </p>
    <input type="submit" value="입력" />
    <hr />
    <?php foreach ($file_info_array as $fileInfo) : ?> 
        <hr />
        <?php foreach ($fileInfo as $key => $val) : ?>
            <p><?= $key ?> : <?= $val ?></p>
        <?php endforeach; ?>
    <?php endforeach ?>
</form>