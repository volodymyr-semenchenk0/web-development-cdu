
// change state of nav__link to active
document.querySelectorAll('.nav__link').forEach(link => {
    if (link.href === window.location.href) {
        link.classList.add('nav__link--active');
    }
});


// enable submit-button
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('directions-form');
    const submitButton = document.getElementById('submit-button');
    const radioButtons = document.querySelectorAll('input[name="studyDirection"]');

    function checkRadioButtonSelection() {
        let isChecked = false;
        for (const radioButton of radioButtons) {
            if (radioButton.checked) {
                isChecked = true;
                break;
            }
        }

        if(isChecked) {
            submitButton.disabled = false;
            submitButton.classList.remove('button__primary--disabled');
        }
    }

    for (const radioButton of radioButtons) {
        radioButton.addEventListener('change', checkRadioButtonSelection);
    }

    checkRadioButtonSelection();
});