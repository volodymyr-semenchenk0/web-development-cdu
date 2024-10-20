<?php
    $title = "Regions List";
    require_once 'components/head.php';
?>
<body>
    <?php require_once 'components/header.php'; ?>
    <div id="root">
        <h1>Regions Info</h1>
        <div class="table-wrapper">
            <table class="regions-table">
                    <tr>
                        <th>#</th>
                        <th>Область</th>
                        <th>Населення, тис</th>
                        <th>Кільк. навчальних закладів</th>
                        <th>Кільк. навчальних закладів на 100тис. насалення</th>
                    </tr>
                    <?php foreach ($this->getRegions() as $key => $region) : ?>
                        <tr>
                            <td><?= $key ?></td>
                            <td><?= $region->getName() ?></td>
                            <td><?= $region->getPopulation() ?></td>
                            <td><?= $region->getHigherEducationInstitutions() ?></td>
                            <td><?= $region->getInstitutionsBy100000Population() ?></td>
                        </tr>
                    <?php endforeach; ?>
            </table>
        </div>
    </div>
    <?php require_once 'components/footer.php'; ?>
</body>