jQuery(document).ready(function($) {

    $( "#travel-tab" ).tabs();

    var sliders = document.querySelectorAll('.travel-tab__slider-tns'); // Select all sliders with the class 'my-slider'

    sliders.forEach(function(slider) {
        tns({
            container: slider,   // The class or ID of the slider container
            items: 1,                  // Show one item at a time
            slideBy: 'page',           // Slide by page
            autoplay: true,            // Enable autoplay
            autoplayTimeout: 5000,     // Set autoplay interval (5 seconds)
            controls: false,            // Enable previous/next buttons
            nav: true,                 // Enable navigation dots
            loop: true,
            mouseDrag: true,
            autoplayButton: false,
            responsive: {
                0: {
                    items: 1          // Show 1 item on all screen sizes
                }
            }
        });
    });
    $(".next-tab").click(function(e) {
        e.preventDefault();
        // Get the next tab index
        var nextTabIndex = $(this).data("next");
        console.log(nextTabIndex);
        var totalTabs = $("#travel-tab .travel-tab__nav ul li").length;

        // Check if there is a next tab, otherwise loop back to the first tab
        if (nextTabIndex < totalTabs) {
            $("#travel-tab").tabs("option", "active", nextTabIndex);
        } else {
            $("#travel-tab").tabs("option", "active", 0); // Loop back to the first tab
        }

        // Update the next tab button data attribute for the next tab
        $(this).data("next", nextTabIndex + 1);
    });
});