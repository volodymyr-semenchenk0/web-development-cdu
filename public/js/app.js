
document.querySelectorAll('.link__header').forEach(link => {
    const linkUrl = new URL(link.href);
    const currentUrl = new URL(window.location.href);

    if (linkUrl.pathname === currentUrl.pathname) {
        link.classList.add('link__header--active');
    }
});


document.addEventListener('DOMContentLoaded', () => {
    const submitButton = document.getElementById('submit-button');
    const radioButtons = document.querySelectorAll('input[name="studyDirectionId"]');

    function checkRadioButtonSelection() {
        let isChecked = false;
        for (const radioButton of radioButtons) {
            const card = radioButton.closest('.directions-container__radio-card');

            if (radioButton.checked) {
                isChecked = true;
                card.classList.add('directions-container__radio-card--checked');
            } else {
                card.classList.remove('directions-container__radio-card--checked');
            }
        }

        if (isChecked) {
            submitButton.disabled = false;
            submitButton.classList.remove('button__primary--disabled');
        }
    }

    for (const radioButton of radioButtons) {
        radioButton.addEventListener('change', checkRadioButtonSelection);
    }

    checkRadioButtonSelection();
});

// document.addEventListener('DOMContentLoaded', () => {
//     const tabs = document.querySelectorAll('.tab');
//     const params = new URLSearchParams(window.location.search);
//     const activeLocation = params.get('location');
//
//     tabs.forEach(tab => {
//         const requestValue = tab.getAttribute('data-request');
//         if (requestValue === activeLocation) {
//             tab.classList.add('tab--active');
//         } else {
//             tab.classList.remove('tab--active');
//         }
//     });
// });