<?php
$title = "Weather";
require_once 'components/head.php';
?>
<body>
<?php require_once 'components/header.php'; ?>
<div id="root">
    <h1><?= $this->weatherList[0]->getCityName() ?></h1>

</div>
<?php require_once 'components/footer.php'; ?>
</body>