$(function() {

    // Accordéon
    var profileSection = $(".profil-section");
    var sectionHeaders = $(".section-header");
    var sectionContent = $(".section-content");

    sectionHeaders.on('click', showSectionContent);

    function showSectionContent() {
        var section = $(this).parent();
        var sectionName = section.attr('data-ps-parent');
        section.toggleClass("ps-open ps-closed");
        $("#sc-"+sectionName).slideToggle("slide");
    }
});