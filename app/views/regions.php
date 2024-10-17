<?php
    $title = "Regions";
    require_once 'components/head.php';
?>
<body>
    <?php require_once 'components/header.php'; ?>
    <div id="root">
        <h1>Regions List</h1>
        <div class="table-wrapper">
            <table class="regions-table">
                    <tr>
                        <th>#</th>
                        <th>Область</th>
                        <th>Населення, тис</th>
                        <th>Кільк. навчальних закладів</th>
                        <th>Кільк. навчальних закладів на 100тис. насалення</th>
                    </tr>
                    <?php if (!empty($regions)) : ?>
                        <?php foreach ($regions as $key => $region) : ?>
                            <tr>
                                <td><?= $key ?></td>
                                <td><?= $region->getName() ?></td>
                                <td><?= $region->getPopulation() ?></td>
                                <td><?= $region->getHigherEducationInstitutions() ?></td>
                                <td><?= $region->getInstitutionsBy100000Population() ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="3">No regions found.</td>
                        </tr>
                    <?php endif; ?>
            </table>
        </div>
    </div>
    <?php require_once 'components/footer.php'; ?>
</body>