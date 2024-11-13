<?php
$title = "Weather";
require_once 'components/head.php';
?>
<body>
<?php require_once 'components/header.php'; ?>
<div id="root">

    <div class="city-switcher">
        <form method="GET" action="/weather">
            <?php foreach ($this->getLocations() as $city) : ?>
                <label>
                    <input type="radio"
                           name="weatherCity"
                           value="<?= $city['request'] ?>"
                           onChange="this.form.submit()">
                    <span class="directions-container__radio-label">
                        <?= $city['name'] ?>
                    </span>
                </label>

            <?php endforeach; ?>
        </form>
    </div>
    <h1><?= $this->getWeatherData()->getLocationName() ?></h1>
    <h1>Схід - <?= $this->getWeatherData()->getLightDay()->getSunriseTime()->format('H:i') ?></h1>
    <h1>Захід - <?= $this->getWeatherData()->getLightDay()->getSunsetTime()->format('H:i') ?></h1>
    <h1>Тривалість дня: <?= $this->getWeatherData()->getLightDay()->getDayLightDuration() ?></h1>
    <h1>
        <?php
            $date = $this->getWeatherData()->getCurrentDate();
            $formatter = new IntlDateFormatter(
                'uk_UA',
                IntlDateFormatter::MEDIUM,
                IntlDateFormatter::NONE,
            );
        ?>
        Сьогодні: <?= $formatter->format($date); ?>

    </h1>
    <h1>Мінімальна температура: <?= $this->getWeatherData()->getMinTemperaturePerDay() ?></h1>
    <h1>Максимальна температура: <?= $this->getWeatherData()->getMaxTemperaturePerDay() ?></h1>

    <?php
    $timezone = new DateTimeZone('Europe/Kyiv');
    foreach ($this->getWeatherData()->getTemperatureForecast() as $city) :
        ?>
        <h1>
            <?=
                $city['date']
                    ->setTimezone(new DateTimeZone('Europe/Kyiv'))
                    ->format('H:i')
            ?>
        </h1>
        <span class="temperature">
            <?=
                ($city['temperature'] > 0 ? '+' : '') . $city['temperature'] . '°C'
            ?>
        </span>
    <?php endforeach; ?>


</div>
<?php require_once 'components/footer.php'; ?>
</body>