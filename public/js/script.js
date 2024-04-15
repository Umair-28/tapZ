
const slides = document.querySelectorAll('.slide');
const indicatorsContainer = document.querySelector('.slider-indicators');
let currentSlideIndex = 0;

// Create indicators
slides.forEach((_, index) => {
    const indicator = document.createElement('button');
    indicator.classList.add('indicator');
    indicator.addEventListener('click', () => {
        goToSlide(index);
    });
    indicatorsContainer.appendChild(indicator);
});

// Add active class to the first indicator
indicatorsContainer.children[currentSlideIndex].classList.add('active');

// Add event listeners to arrow buttons
document.querySelector('.prev-slide').addEventListener('click', () => {
    goToSlide(currentSlideIndex - 1);
});

document.querySelector('.next-slide').addEventListener('click', () => {
    goToSlide(currentSlideIndex + 1);
});

// Function to go to a specific slide
function goToSlide(index) {
    slides[currentSlideIndex].classList.remove('active');
    indicatorsContainer.children[currentSlideIndex].classList.remove('active');

    // Wrap around if index is out of bounds
    currentSlideIndex = (index + slides.length) % slides.length;

    slides[currentSlideIndex].classList.add('active');
    indicatorsContainer.children[currentSlideIndex].classList.add('active');
}
