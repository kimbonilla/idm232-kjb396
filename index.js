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

// css fixes
const searchH3 = document.querySelector('.search-results h3');
searchH3.forEach(h3 => {
    h3.style.textAlign = 'center';
});