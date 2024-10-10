<?php
    $title = "Study Directions";
    require_once 'components/head.php';
?>
<body>
    <?php require_once 'components/header.php'; ?>
    <div id="root">
        <h1>Study Directions</h1>
        <div class="directions-container">
            <form class="directions-container__form">
                <p class="form__description">Please select study directions:</p>
                <?php if (!empty($studyDirections)) : ?>
                    <?php foreach ($studyDirections as $direction) : ?>
                    <div>
                        <input class="form__radio-button"
                               type="radio"
                               id="<?=$direction->getId()?>"
                               name="studyDirection"
                               value="<?=$direction->getId()?>"
                        />
                        <label for="<?=$direction->getId()?>">
                            <?=$direction->getDirectionName()?>
                        </label>
                    </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No regions found.</p>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <?php require_once 'components/footer.php'; ?>
</body>