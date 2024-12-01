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


// Show the section with the given id and hide all other sections
$(".nav_collapse").click(function () {
    console.log($(this).attr("href"));
    $($(this).attr("href")).collapse();
});
var page = "<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>";
$(".nav-" + page).addClass("active");
