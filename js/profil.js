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

    // Description
    var showMore = $(".show-more");

    showMore.on('click', toggleDescription)

    function toggleDescription() {
        var id = $(this).attr('data-description-id');
        var strStart = $("[data-description-start='"+id+"']");
        var strEnd = $("[data-description-end='"+id+"']");
        strStart.removeClass("description-hidden");
        strStart.append(strEnd.text());
        $(this).toggle();
    }
});