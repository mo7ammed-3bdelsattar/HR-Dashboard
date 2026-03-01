<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('assets') }}/vendor/libs/jquery/jquery.js"></script>
<script src="{{ asset('assets') }}/vendor/libs/popper/popper.js"></script>
<script src="{{ asset('assets') }}/vendor/js/bootstrap.js"></script>
<script src="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="{{ asset('assets') }}/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('assets') }}/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="{{ asset('assets') }}/js/main.js"></script>

<!-- Page JS -->
<script src="{{ asset('assets') }}/js/dashboards-analytics.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    function updateDateTime() {
        const now = new Date();
        const locale = "{{ app()->getLocale() }}";
        const date = now.toLocaleDateString(locale === 'ar' ? 'ar-EG' : 'en-GB');
        const time = now.toLocaleTimeString(locale === 'ar' ? 'ar-EG' : 'en-US', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: true
        });

        const datetimeElement = document.getElementById('current-datetime');
        if (datetimeElement) {
            datetimeElement.textContent = `${date} | ${time}`;
        }
    }

    setInterval(updateDateTime, 1000);
    updateDateTime();

    // Theme Toggle Logic
    const themeToggle = document.querySelector('.style-switcher-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const htmlTag = document.documentElement;

    function updateThemeUI(theme) {
        if (theme === 'dark') {
            htmlTag.classList.add('dark-style');
            htmlTag.classList.remove('light-style');
            themeIcon.classList.replace('bx-sun', 'bx-moon');
        } else {
            htmlTag.classList.add('light-style');
            htmlTag.classList.remove('dark-style');
            themeIcon.classList.replace('bx-moon', 'bx-sun');
        }
    }

    // Initialize UI based on saved theme
    const savedTheme = localStorage.getItem('theme') || 'light';
    updateThemeUI(savedTheme);

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const currentTheme = htmlTag.classList.contains('dark-style') ? 'dark' : 'light';
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            localStorage.setItem('theme', newTheme);
            updateThemeUI(newTheme);
        });
    }
</script>
<script>
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif
    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>
@stack('scripts')
