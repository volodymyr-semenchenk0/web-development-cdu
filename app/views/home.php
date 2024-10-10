<?php
$title = "Home";
require_once 'components/head.php';
?>
<body>
<?php require_once 'components/header.php'; ?>

<div id="root">
    <div class="home-container">
        <div class="home-container__label">
            <svg class="label__ic-globe" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                <path d="M4.1 9H20.9M4.1 15H20.9M12 3C10.3153 5.69961 9.4222 8.81787 9.4222 12C9.4222 15.1821 10.3153 18.3004 12 21M13 3C14.6847 5.69961 15.5778 8.81787 15.5778 12C15.5778 15.1821 14.6847 18.3004 13 21M3.5 12C3.5 13.1819 3.73279 14.3522 4.18508 15.4442C4.63738 16.5361 5.30031 17.5282 6.13604 18.364C6.97177 19.1997 7.96392 19.8626 9.05585 20.3149C10.1478 20.7672 11.3181 21 12.5 21C13.6819 21 14.8522 20.7672 15.9442 20.3149C17.0361 19.8626 18.0282 19.1997 18.864 18.364C19.6997 17.5282 20.3626 16.5361 20.8149 15.4442C21.2672 14.3522 21.5 13.1819 21.5 12C21.5 9.61305 20.5518 7.32387 18.864 5.63604C17.1761 3.94821 14.8869 3 12.5 3C10.1131 3 7.82387 3.94821 6.13604 5.63604C4.44821 7.32387 3.5 9.61305 3.5 12Z" stroke="none" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" id="GlobeIcon"/>
            </svg>
            <p class="label__text">php study project</p>
        </div>
        <p class="home-container__title"><?php echo $message ?? 'String is empty'; ?></p>
    </div>
</div>

<?php require_once 'components/footer.php'; ?>
</body>