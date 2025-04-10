<nav class="navbar">
    <div class="nav-container">
        <a href="#home" class="logo">
            <span class="logo-text">Gallery Bejo</span>
        </a>

        <div class="nav-links">
            <a href="#home" class="nav-link">
                <i class='bx bx-home-alt'></i>
                <span>Beranda</span>
            </a>
            <a href="#promosi-unggulan" class="nav-link">
                <i class='bx bx-store-alt'></i>
                <span>Produk</span>
            </a>
            <a href="#contact" class="nav-link">
                <i class='bx bx-envelope'></i>
                <span>Kontak</span>
            </a>
        </div>

        <div class="auth-buttons">
            <a href="{{ route('login') }}" class="auth-link login">
                <i class='bx bx-log-in'></i>
                <span>Login</span>
            </a>
            <a href="{{ route('register') }}" class="auth-link register">
                <i class='bx bx-user-plus'></i>
                <span>Register</span>
            </a>
        </div>

        <button class="mobile-menu-btn">
            <i class='bx bx-menu'></i>
        </button>
    </div>
</nav>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');
    const navLinksItems = document.querySelectorAll('.nav-link');
    const navbar = document.querySelector('.navbar');

    // Toggle mobile menu
    mobileMenuBtn.addEventListener('click', function() {
        navLinks.classList.toggle('show');
        this.classList.toggle('active');
    });

    // Smooth scroll with minimal offset
    navLinksItems.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);

            if (targetSection) {
                // Remove active class from all links
                navLinksItems.forEach(item => item.classList.remove('active'));
                // Add active class to clicked link
                this.classList.add('active');

                // Get the target section's position
                const targetPosition = targetSection.offsetTop;

                // Smooth scroll to target with minimal offset
                window.scrollTo({
                    top: targetPosition + 50, // Changed to positive offset to scroll lower
                    behavior: 'smooth'
                });

                // Close mobile menu if open
                navLinks.classList.remove('show');
                mobileMenuBtn.classList.remove('active');
            }
        });
    });

    // Update active state on scroll with tighter detection
    function updateActiveLink() {
        const sections = document.querySelectorAll('#home, #promosi-unggulan, #contact');
        const scrollPosition = window.scrollY + 120; // Adjusted for lower detection

        sections.forEach(section => {
            const sectionTop = section.offsetTop - 20; // Adjusted for lower detection
            const sectionBottom = sectionTop + section.offsetHeight;

            if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                const targetId = '#' + section.id;
                navLinksItems.forEach(link => {
                    if (link.getAttribute('href') === targetId) {
                        link.classList.add('active');
                    } else {
                        link.classList.remove('active');
                    }
                });
            }
        });
    }

    // Throttled scroll event listener
    let isScrolling = false;
    window.addEventListener('scroll', function() {
        if (!isScrolling) {
            window.requestAnimationFrame(function() {
                updateActiveLink();
                isScrolling = false;
            });
            isScrolling = true;
        }
    });

    // Initial check for active section
    updateActiveLink();
});
</script>
@endpush
