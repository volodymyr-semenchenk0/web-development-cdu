<?php
$title = "Study Directions";
require_once 'components/head.php';
?>
<body>
<?php require_once 'components/header.php'; ?>
<div id="root">
    <a href="/study-directions">Choose Another Type</a>
    <h1><?= isset($institutionDirectionType) ? $institutionDirectionType->getDirectionTypeName() : 'Unknown Study Direction' ?></h1>
    <table class="institution-table">
        <tr>
            <th>#</th>
            <th>Середній бал вступивших на бюджет</th>
            <th>Число поступивших на бюджет</th>
            <th>Недобір</th>
            <th>Кількість контрактників</th>
            <th>Назва ВУЗа</th>
        </tr>
        <?php if (!empty($institutionsList)) : ?>
            <?php foreach ($institutionsList as $key => $institution) : ?>
                <tr>
                    <td><?= $key?></td>
                    <td><?= $institution->getBudgetStateAverageMark() ?></td>
                    <td><?= $institution->getBudgetStudentsCount() ?></td>
                    <td><?= $institution->getShortage() ?></td>
                    <td><?= $institution->getContractStudentsCount() ?></td>
                    <td><?= $institution->getName() ?></td>
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