/**
 * Menu samping (drawer) yang dipakai semua halaman.
 * Butuh elemen: #menuToggle (tombol hamburger), #drawerOverlay, #drawerBackdrop, #drawerCloseBtn.
 * Menyediakan openDrawer() dan closeDrawer() secara global.
 */
(function () {
    const toggle = document.getElementById('menuToggle');
    const overlay = document.getElementById('drawerOverlay');
    if (!overlay) return;

    function setOpen(open) {
        overlay.classList.toggle('is-open', open);
        overlay.setAttribute('aria-hidden', String(!open));
        toggle?.setAttribute('aria-expanded', String(open));
        document.body.style.overflow = open ? 'hidden' : '';
    }

    window.openDrawer = () => setOpen(true);
    window.closeDrawer = () => setOpen(false);

    toggle?.addEventListener('click', window.openDrawer);
    document.getElementById('drawerCloseBtn')?.addEventListener('click', window.closeDrawer);
    document.getElementById('drawerBackdrop')?.addEventListener('click', window.closeDrawer);
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && overlay.classList.contains('is-open')) window.closeDrawer();
    });
})();
