//Counter about us
$(document).ready(function() {
    // Ensure the counter elements have the correct data-to attribute
    $('.counter').each(function () {
        var target = $(this).attr('data-to');  // Get the value from the data-to attribute
        $(this).prop('Counter', 0).animate({
            Counter: target
        }, {
            duration: 4000,  // Duration of the animation
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now)); // Update the counter text as it animates
            }
        });
    });
});