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

// PWA Install Prompt
let deferredPrompt;
window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;
    showPwaInstallPopup();
});

function showPwaInstallPopup() {
    if (document.getElementById('pwa-install-popup')) return;
    const popup = document.createElement('div');
    popup.id = 'pwa-install-popup';
    popup.innerHTML = `
        <div style="position:fixed;bottom:30px;right:30px;z-index:9999;background:#fff;border-radius:1rem;box-shadow:0 4px 24px rgba(13,110,253,0.13);padding:1.5rem 2rem;display:flex;align-items:center;gap:1.2rem;max-width:350px;">
            <div style="font-size:2rem;color:#0d6efd;"><i class='fas fa-download'></i></div>
            <div style="flex:1;">
                <div style="font-weight:600;font-size:1.1rem;">Install Aplikasi Alumni?</div>
                <div style="font-size:0.95rem;color:#555;">Dapatkan pengalaman terbaik dengan menginstall aplikasi ini di perangkat Anda.</div>
            </div>
            <button id="pwa-install-btn" style="background:#0d6efd;color:#fff;border:none;border-radius:0.7rem;padding:0.5rem 1.2rem;font-weight:600;">Pasang</button>
            <button id="pwa-close-btn" style="background:none;border:none;color:#888;font-size:1.3rem;margin-left:0.5rem;">&times;</button>
        </div>
    `;
    document.body.appendChild(popup);
    document.getElementById('pwa-install-btn').onclick = async () => {
        if (deferredPrompt) {
            deferredPrompt.prompt();
            const { outcome } = await deferredPrompt.userChoice;
            if (outcome === 'accepted') {
                document.getElementById('pwa-install-popup').remove();
            }
            deferredPrompt = null;
        }
    };
    document.getElementById('pwa-close-btn').onclick = () => {
        document.getElementById('pwa-install-popup').remove();
    };
}
