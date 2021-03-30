<!doctype html>
<html>
<head>
    <title>레이아웃 확인</title>
</head>
<body>
<h1>여기는 레이아웃 영역입니다.</h1>
<p style="font-style: italic">컨트롤러에서 보낸 데이터 : <?= $hello ?></p>
<hr />
<?= $this->renderSection('content') ?>
</body>
</html>