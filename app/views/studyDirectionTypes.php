<?php
    $title = "Study Directions";
    require_once 'components/head.php';
?>
<body>
    <?php require_once 'components/header.php'; ?>
    <div id="root">
        <h1>Study Directions</h1>
        <div class="directions-container">
            <form class="directions-container__form" id="directions-form" method="GET" action="/study-directions/institution">
                <p class="directions-container__description">Please select study direction type:</p>
                <div class="directions-container__radio-group">
                    <?php foreach ($this->studyDirectionTypes as $key => $directionType) : ?>
                        <label class="directions-container__radio-card" for="<?=$key?>">
                            <input type="radio"
                                   id="<?=$key?>"
                                   name="studyDirectionId"
                                   value="<?=$key?>"
                            />
                            <span class="directions-container__radio-label">
                                <?=$directionType->getDirectionTypeName()?>
                            </span>
                        </label>
                    <?php endforeach; ?>
                </div>
                <button class="button button__primary button__primary--disabled" id="submit-button"  type="submit" disabled>Search Information</button>
            </form>
        </div>
    </div>
    <?php require_once 'components/footer.php'; ?>
</body>