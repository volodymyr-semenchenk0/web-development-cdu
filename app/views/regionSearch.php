<?php
$title = "Select Region";
require_once 'components/head.php';
?>
<body>
    <?php require_once 'components/header.php'; ?>
    <div id="root">
        <h1>Інформація про Регіон</h1>
        <div class="content-wrapper">
            <form class="content-wrapper__form" id="directions-form" method="POST" action="/region/info">
                <label for="regions">Оберіть Регіон</label>
                <select name="selectedRegionId" id="regions">
                    <?php foreach ($this->getRegions() as $key => $region): ?>
                    <option value="<?= $key ?>">
                        <?= $region->getName() ?>
                     </option>
                    <?php endforeach; ?>
                </select>
                <button class="button button__primary" id="submit-button" type="submit" >Знайти Інформацію</button>
            </form>
        </div>
    </div>
    <?php require_once 'components/footer.php'; ?>
</body>