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
                        content.style.display = 'none';
                        window.location = link.href;
                    }, 350); // waktu fade-out dipercepat
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
        <div style="position:fixed;top:24px;right:24px;z-index:9999;background:#fff;border-radius:0.9rem;box-shadow:0 2px 16px rgba(13,110,253,0.13);padding:0.9rem 1.2rem;display:flex;align-items:center;gap:0.8rem;max-width:260px;min-width:200px;">
            <div style="font-size:1.4rem;color:#0d6efd;flex-shrink:0;"><i class='fas fa-download'></i></div>
            <div style="flex:1;min-width:0;">
                <div style="font-weight:600;font-size:1rem;line-height:1.2;">Install Alumni?</div>
                
            </div>
            <button id="pwa-install-btn" style="background:#0d6efd;color:#fff;border:none;border-radius:0.6rem;padding:0.35rem 0.9rem;font-weight:600;font-size:0.95rem;line-height:1;">Pasang</button>
            <button id="pwa-close-btn" style="background:none;border:none;color:#888;font-size:1.1rem;margin-left:0.3rem;">&times;</button>
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
