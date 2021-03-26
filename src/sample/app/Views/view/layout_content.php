<?= $this->extend('/view/layout') ?>
<?= $this->section('content') ?>
    <h2>여기는 레이아웃 본문입니다.</h2>
    <p style="font-weight: bold;">컨트롤러에서 보낸 데이터 : <?= $hello ?></p>
<?= $this->endSection() ?>