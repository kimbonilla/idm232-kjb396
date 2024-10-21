// help modal
const helpBtn = document.querySelector('.help-button');
const helpModal = document.querySelector('.help-modal');
const closeBtn = document.querySelector('.close-button');

helpBtn.addEventListener('click', () => {
    helpModal.style.display = 'block';
});

closeBtn.addEventListener('click', () => {
    helpModal.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target == helpModal) {
    helpModal.style.display = 'none';
    }
});