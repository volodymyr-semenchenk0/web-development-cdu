<?php
$title = "Higher Education Institution";
require_once 'components/head.php';
?>
<body>
<?php require_once 'components/header.php'; ?>
<div id="root">
    <a href="/study-directions" class="link link_nav">
            <span class="link__icon">
                <svg class="icon" id="ic_left-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                <path d="M20 11H7.83L13.42 5.41L12 4L4 12L12 20L13.41 18.59L7.83 13H20V11Z" fill="currentColor"/>
                </svg>
            </span>
        Choose Another Type
    </a>
    <h1><?= $this->selectedInstitution->getStudyDirectionType()->getDirectionTypeName() ?></h1>
    <div class="table-wrapper">
        <table class="institution-table">
            <tr>
                <th>#</th>
                <th>Середній бал вступивших на бюджет</th>
                <th>Число поступивших на бюджет</th>
                <th>Недобір</th>
                <th>Кількість контрактників</th>
                <th>Назва ВУЗа</th>
            </tr>
            <?php foreach ($this->selectedInstitution->getHigherStudyInstitutions() as $key => $institution) : ?>
                <tr>
                    <td><?= $key?></td>
                    <td><?= $institution->getBudgetStateAverageMark() ?></td>
                    <td><?= $institution->getBudgetStudentsCount() ?></td>
                    <td><?= $institution->getShortage() ?></td>
                    <td><?= $institution->getContractStudentsCount() ?></td>
                    <td><?= $institution->getName() ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php require_once 'components/footer.php'; ?>
</body>