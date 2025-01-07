jQuery(document).ready(function($) {

    $( "#travel-tab" ).tabs();

    // var sliders = document.querySelectorAll('.travel-tab__slider-tns'); // Select all sliders with the class 'my-slider'
    //
    // sliders.forEach(function(slider) {
    //     tns({
    //         container: slider,   // The class or ID of the slider container
    //         items: 1,                  // Show one item at a time
    //         slideBy: 'page',           // Slide by page
    //         autoplay: true,            // Enable autoplay
    //         autoplayTimeout: 5000,     // Set autoplay interval (5 seconds)
    //         controls: false,            // Enable previous/next buttons
    //         nav: true,                 // Enable navigation dots
    //         loop: true,
    //         mouseDrag: true,
    //         autoplayButton: false,
    //         responsive: {
    //             0: {
    //                 items: 1          // Show 1 item on all screen sizes
    //             }
    //         }
    //     });
    // });

    // Select all sliders with the class 'travel-tab__slider-tns'
    const sliders = document.querySelectorAll('.travel-tab__slider-tns');
    const sliderInstances = [];

    sliders.forEach((slider, index) => {
        // Initialize Tiny Slider for each slider
        const sliderInstance = tns({
            container: slider,
            items: 1,
            slideBy: "page",
            autoplay: true,
            autoplayTimeout: 5000,
            mouseDrag: true,
            arrowKeys: true,
            swipeAngle: false,
            preventScrollOnTouch: "auto",
            controls: false, // Disable default controls
            nav: true, // Enable navigation dots
            loop: true
        });

        sliderInstances[index] = sliderInstance;

        // Function to handle progress bar animation
        const updateProgressBars = () => {
            const navItems = Array.from(sliderInstance.getInfo().navItems); // Convert to an array
            const activeIndex = sliderInstance.getInfo().navCurrentIndex;

            navItems.forEach((navItem, idx) => {
                const progressBar = navItem.querySelector('.progress-bar');
                if (idx === activeIndex) {
                    progressBar.classList.remove('progress-bar-hide');
                    progressBar.classList.add('progress-bar-animation');
                } else {
                    progressBar.classList.remove('progress-bar-animation');
                    progressBar.classList.add('progress-bar-hide');
                }
            });
        };

        // Reset progress bar on navigation click
        const resetProgressOnNavClick = () => {
            sliderInstance.play();
            updateProgressBars();
        };

        // Initialize navigation items with progress bars
        const navItems = Array.from(sliderInstance.getInfo().navItems); // Convert to an array
        navItems.forEach((navItem) => {
            navItem.innerHTML = '<span class="progress-bar progress-bar-hide"></span>';
            navItem.addEventListener("click", resetProgressOnNavClick);
        });

        // Update progress bars on slider transition
        sliderInstance.events.on("transitionStart", updateProgressBars);

        // Initial progress bar setup
        updateProgressBars();
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