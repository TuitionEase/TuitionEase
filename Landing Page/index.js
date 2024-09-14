let slides = document.querySelectorAll(".slide-container");
let index = 0;

function next(){
    slides[index].classList.remove("active");
    index = (index+1)%slides.length;
    slides[index].classList.add("active")
}

function prev(){
    slides[index].classList.remove("active");
    index = (index-1+slides.length)%slides.length;
    slides[index].classList.add("active")
}

setInterval(next, 3000);

function loadEvents() {
    const events = JSON.parse(localStorage.getItem('events')) || [];
    const contentsDiv = document.getElementById('edu-contents');
    events.forEach(event => {
        const newBox = createBox(event.time, event.name, event.address);
        contentsDiv.appendChild(newBox);
    });
}

///active

document.addEventListener("DOMContentLoaded", function() {
    // Get the current page URL
    var currentPage = window.location.href;

    // Check if the current page URL matches the href attribute of any nav link
    var navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    navLinks.forEach(function(link) {
        if (link.href === currentPage) {
            link.classList.add('active'); // Add the 'active' class to the current link
            link.style.borderBottom = "2px solid #007bff"; // Add border bottom to the active link
        }
    });
});



////SWIPER
document.addEventListener('DOMContentLoaded', function() {
    var mySwiper = new Swiper('.mySwiper', {
        // Optional parameters
        loop: true,
        slidesPerView: 1,
        spaceBetween: 30,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const profilePictureInput = document.getElementById('profile-picture');
    const fileNameDisplay = document.getElementById('upload-label');

    profilePictureInput.addEventListener('change', function () {
        if (profilePictureInput.files.length > 0) {
            fileNameDisplay.textContent = profilePictureInput.files[0].name;
        } else {
            fileNameDisplay.textContent = '';
        }
    });
});