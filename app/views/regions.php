<?php
    $title = "Regions";
    require_once 'components/head.php';
?>
<body>
    <?php require_once 'components/header.php'; ?>
    <div id="root">
        <h1>Regions List</h1>
        <table class="regions-table">
                <tr>
                    <th>#</th>
                    <th>Область</th>
                    <th>Населення, тис</th>
                    <th>Кільк. навчальних закладів</th>
                    <th>Кільк. навчальних закладів на 100тис. насалення</th>
                </tr>
                <?php if (!empty($regions)) : ?>
                    <?php foreach ($regions as $regionData) : ?>
                        <tr>
                            <td><?= $regionData->id ?></td>
                            <td><?= $regionData->name ?></td>
                            <td><?= $regionData->population ?></td>
                            <td><?= $regionData->higherEducationInstitutions ?></td>
                            <td><?= $regionData->institutionsBy100000Population ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3">No regions found.</td>
                    </tr>
                <?php endif; ?>
        </table>
    </div>
    <?php require_once 'components/footer.php'; ?>
</body>