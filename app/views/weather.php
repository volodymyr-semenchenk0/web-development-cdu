<?php
$title = "Weather";
require_once 'components/head.php';
?>
<body>
<?php require_once 'components/header.php'; ?>
<div id="root">
    <h1><?= $this->getWeatherData()->getLocationName() ?></h1>
    <div class="tabs-group">
        <form id="weather-form" method="GET" action="/weather">
            <?php foreach ($this->getLocations() as $city) : ?>
                <button type="submit"
                        name="location"
                        value="<?= $city['request'] ?>"
                        class="tab
                        <?= $city['request'] === ($_GET['location'] ??
                            $this->getLocations()[0]['request']) ?
                            'tab--active' : ''
                        ?>"
                >
                    <?= $city['name'] ?>
                </button>
            <?php endforeach; ?>
        </form>
    </div>
    <div class="container">
        <div class="weather-cards-wrapper">
            <div class="weather-card weather-card--default">
                <?php
                    $date = $this->getWeatherData()->getCurrentDate();
                    $formatter = new IntlDateFormatter(
                        'uk_UA',
                        IntlDateFormatter::MEDIUM,
                        IntlDateFormatter::NONE,
                    );
                    $formatter->setPattern('EEEE');
                    $dayOfWeek = mb_convert_case($formatter->format($date), MB_CASE_TITLE, "UTF-8");

                    $formatter->setPattern('d MMM y');
                    $datePart = $formatter->format($date);
                ?>
                <span class="weather-card__value weather-card__value--opacity">
                    <?= $dayOfWeek ?>
                </span>
                <span class="weather-card__description weather-card__description--opacity">
                    <?= $datePart ?>
                </span>
            </div>
            <div class="weather-card weather-card--minimum">
                <span class="weather-card__value weather-card__value--opacity">
                  <?= $this->getWeatherData()->getMinTemperaturePerDay() . '°'?>
                </span>
                <span class="weather-card__description weather-card__description--opacity">
                   Мін
                </span>
            </div>
            <div class="weather-card weather-card--maximum">
                <span class="weather-card__value weather-card__value--opacity">
                  <?= $this->getWeatherData()->getMaxTemperaturePerDay() . '°'?>
                </span>
                <span class="weather-card__description weather-card__description--opacity">
                   Макс
                </span>
            </div>
        </div>
        <div class="weather-cards-wrapper">
            <div class="weather-card weather-card--default">
                <span class="weather-card__value weather-card__value--opacity">
                   <?= $this->getWeatherData()->getLightDay()->getDayLightDuration() ?>
                </span>
                <span class="weather-card__description weather-card__description--opacity">
                   Тривалість дня
                </span>
            </div>
            <div class="weather-card weather-card--default">
                <div class="weather-card__image-wrapper">
                    <img class="weather-card__image" src=" /images/sunrise.png" alt="Sunrise">
                </div>
                <span class="weather-card__value weather-card__value--opacity">
                   <?= $this->getWeatherData()->getLightDay()->getSunriseTime()->format('H:i') ?>
                </span>
                <span class="weather-card__description weather-card__description--opacity">
                   Cхід
                </span>
            </div>
            <div class="weather-card weather-card--default">
                <div class="weather-card__image-wrapper">
                    <img class="weather-card__image" src="/images/sunset.png" alt="Sunset">
                </div>
                <span class="weather-card__value weather-card__value--opacity">
                   <?= $this->getWeatherData()->getLightDay()->getSunsetTime()->format('H:i') ?>
                </span>
                <span class="weather-card__description weather-card__description--opacity">
                   Захід
                </span>
            </div>
        </div>
        <div class="forecast-temperature-list-wrapper">
            <?php foreach ($this->getWeatherData()->getTemperatureForecast() as $city) : ?>
                <div class="forecast-temperature-card">
                    <span class="weather-card__description weather-card__description--neutral">
                        <?= $city['date']->setTimezone(new DateTimeZone('Europe/Kyiv'))->format('H:i') ?>
                    </span>
                    <span class="weather-card__value weather-card__value--neutral">
                        <?= ($city['temperature'] > 0 ? '+' : '') . $city['temperature'] . '°' ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php require_once 'components/footer.php'; ?>
</body>