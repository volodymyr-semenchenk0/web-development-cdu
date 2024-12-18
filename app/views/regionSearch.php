<?php
$title = "Select Region";
require_once 'components/head.php';
?>
<body>
<?php require_once 'components/header.php'; ?>
<div id="root">
    <h1>Region</h1>
    <div class="directions-container">
        <form class="directions-container__form" id="directions-form" method="POST" action="/region/info">
            <label for="regions">Choose Region</label>
            <select name="selectedRegionId" id="regions">
                <?php foreach ($this->getRegions() as $key => $region): ?>
                <option value="<?= $key ?>">
                    <?= $region->getName() ?>
                 </option>
                <?php endforeach; ?>
            </select>
            <button class="button button__primary" id="submit-button" type="submit" >Search Information</button>
        </form>
    </div>
</div>
<?php require_once 'components/footer.php'; ?>
</body>