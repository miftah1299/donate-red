//

// Show the section with the given id and hide all other sections
function showSection(sectionId) {
    var sections = document.querySelectorAll(".section");
    sections.forEach(function (section) {
        section.classList.add("hidden");
    });
    var sectionToShow = document.getElementById(sectionId);
    sectionToShow.classList.remove("hidden");
}
