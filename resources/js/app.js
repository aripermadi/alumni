import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const content = document.querySelector('.content-wrapper');
    if(content) {
        content.classList.remove('fade-in');
        // Trigger reflow agar animasi bisa diulang
        void content.offsetWidth;
        content.classList.add('fade-in');
    }

    // Intercept klik menu utama
    const navLinks = document.querySelectorAll('.navbar-nav a.nav-link, .bottom-nav a.nav-item');
    navLinks.forEach(link => {
        // Hanya intercept link internal (bukan target _blank, bukan logout, bukan #)
        if (link.target === '' && link.href && !link.href.endsWith('#') && !link.closest('form')) {
            link.addEventListener('click', function(e) {
                // Cek jika link menuju halaman yang sama, abaikan
                if (window.location.pathname === link.pathname) return;
                e.preventDefault();
                if(content) {
                    content.classList.remove('fade-in');
                    content.classList.add('fade-out');
                    setTimeout(() => {
                        window.location = link.href;
                    }, 750); // waktu fade-out
                } else {
                    window.location = link.href;
                }
            });
        }
    });
});
