<?php
    $title = "Study Directions";
    require_once 'components/head.php';
?>
<body>
    <?php require_once 'components/header.php'; ?>
    <div id="root">
        <h1>Study Directions</h1>
        <div class="directions-container">
            <form class="directions-container__form" id="directions-form" method="post">
                <p class="form__description">Please select study directions:</p>
                <?php if (!empty($studyDirectionTypes)) : ?>
                    <?php foreach ($studyDirectionTypes as $directionType) : ?>
                    <div>
                        <input type="radio"
                               id="<?=$directionType->getId()?>"
                               name="studyDirection"
                               value="<?=$directionType->getId()?>"
                        />
                        <label for="<?=$directionType->getId()?>">
                            <?=$directionType->getDirectionTypeName()?>
                        </label>
                    </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No regions found.</p>
                <?php endif; ?>
                <button class="button button__primary button__primary--disabled" id="submit-button"  type="submit" disabled>Search Information</button>
            </form>
        </div>
    </div>
    <?php require_once 'components/footer.php'; ?>
</body>