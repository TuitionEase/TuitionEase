document.addEventListener("DOMContentLoaded", function() {
    // Get the current page URL
    var currentPage = window.location.pathname;

    // Get all navigation links
    var navLinks = document.querySelectorAll(".navbar-nav .nav-link");

    // Loop through each navigation link
    navLinks.forEach(function(link) {
        // Get the link's href attribute
        var linkHref = link.getAttribute("href");

        // Check if the link's href matches the current page URL
        if (currentPage.includes(linkHref)) {
            // Add the active class to the link
            link.classList.add("active");
            // Add border bottom to the active link
            link.style.borderBottom = "2px solid #007bff";
        }
    });
});





