<?php
$title = "Weather";
require_once 'components/head.php';
?>
<body>
<?php require_once 'components/header.php'; ?>
<div id="root">
    <h1><?= $this->weatherList[0]->getCityName() ?></h1>
    <h1>Схід - <?= $this->weatherList[0]->getLightDay()->getSunriseTime()->format('H:i') ?></h1>
    <h1>Захід - <?= $this->weatherList[0]->getLightDay()->getSunsetTime()->format('H:i') ?></h1>
    <h1>Тривалість дня: <?= $this->weatherList[0]->getLightDay()->getDayLightDuration() ?></h1>
    <h1>Тривалість дня: <?= $this->weatherList[0]->getLightDay()->getDayLightDuration() ?></h1>

</div>
<?php require_once 'components/footer.php'; ?>
</body>