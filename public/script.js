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

// disable date past
document.addEventListener("DOMContentLoaded", function () {
    let today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
    let dateInput = document.getElementById("date"); // Get the input element

    if (dateInput) { // Ensure element exists
        dateInput.setAttribute("min", today);
    }
});


// filter.js
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filterForm');
    const filterRadios = document.querySelectorAll('input[name="bus_type"]');
    const applyFilterBtn = document.querySelector('#filterForm button[type="submit"]');
    const clearFiltersBtn = document.getElementById('clearFilters');

    // Auto-submit when a radio button is selected
    filterRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (applyFilterBtn) {
                applyFilterBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Applying...';
                applyFilterBtn.disabled = true;
            }

            // Update URL without refreshing (optional)
            const url = new URL(window.location.href);
            url.searchParams.set('bus_type', this.value);
            window.history.pushState({}, '', url);

            // Submit the form programmatically
            filterForm.submit();
        });
    });

    // Handle manual submission with the button
    if (filterForm) {
        filterForm.addEventListener('submit', function(event) {
            if (applyFilterBtn) {
                applyFilterBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Applying...';
                applyFilterBtn.disabled = true;
            }
        });
    }

    // Clear filters functionality
    if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener('click', function() {
            const url = new URL(window.location.href);
            url.searchParams.delete('bus_type'); // Remove bus_type filter
            window.location.href = url.toString();
        });
    }

    // Highlight active filters
    const highlightActiveFilters = () => {
        const urlParams = new URLSearchParams(window.location.search);
        const busType = urlParams.get('bus_type');

        document.querySelectorAll('.form-check').forEach(el => el.classList.remove('active-filter'));

        if (busType) {
            const activeRadio = document.querySelector(`input[name="bus_type"][value="${busType}"]`);
            if (activeRadio) {
                activeRadio.closest('.form-check').classList.add('active-filter');
            }
        } else {
            const allTypesRadio = document.querySelector('input[name="bus_type"][value=""]');
            if (allTypesRadio) {
                allTypesRadio.closest('.form-check').classList.add('active-filter');
            }
        }
    };

    highlightActiveFilters();

    // Price range filter functionality
    const priceRange = document.getElementById('priceRange');
    const priceValue = document.getElementById('priceValue');

    if (priceRange && priceValue) {
        priceRange.addEventListener('input', function() {
            priceValue.textContent = this.value;
        });
    }
});
