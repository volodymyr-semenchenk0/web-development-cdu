<?php
    $title = "Study Directions";
    require_once 'components/head.php';
?>
<body>
    <?php require_once 'components/header.php'; ?>
    <div id="root">
        <h1>Study Directions</h1>
        <div class="content-wrapper">
            <form class="content-wrapper__form" id="directions-form" method="GET" action="/study-directions/institution">
                <p class="content-wrapper__description">Please select study direction type:</p>
                <div class="study-direction__radio-group">
                    <?php foreach ($this->studyDirectionTypes as $key => $directionType) : ?>
                        <label class="study-direction__radio-card" for="<?=$key?>">
                            <input type="radio"
                                   id="<?=$key?>"
                                   name="studyDirectionId"
                                   value="<?=$key?>"
                            />
                            <span class="study-direction__radio-label">
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