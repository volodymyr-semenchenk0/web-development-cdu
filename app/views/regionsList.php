<?php
    $title = "Regions List";
    require_once 'components/head.php';
?>
<body>
    <?php require_once 'components/header.php'; ?>
    <div id="root">
        <script>
            if (window.location.pathname === '/region/info') {
                document.write(`
                    <a href="/region" class="link link_nav">
                        <span class="link__icon">
                            <svg class="icon" id="ic_left-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                                <path d="M20 11H7.83L13.42 5.41L12 4L4 12L12 20L13.41 18.59L7.83 13H20V11Z" fill="currentColor"/>
                            </svg>
                        </span>
                        Choose Another Type
                    </a>
                `);
            }
        </script>
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