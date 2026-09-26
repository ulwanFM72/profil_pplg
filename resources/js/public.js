import { createApp } from 'vue';
import Lightbox from './components/Lightbox.vue';

// --- Menu mobile ---
const btn = document.getElementById('menu-toggle');
const menu = document.getElementById('mobile-menu');
btn?.addEventListener('click', () => {
    const open = menu.classList.toggle('hidden') === false;
    btn.setAttribute('aria-expanded', String(open));
});

// --- Modal login admin ---
const loginModal = document.getElementById('login-modal');
if (loginModal) {
    const openModal = () => {
        loginModal.classList.remove('hidden');
        loginModal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        loginModal.querySelector('input')?.focus();
    };
    const closeModal = () => {
        loginModal.classList.add('hidden');
        loginModal.classList.remove('flex');
        document.body.style.overflow = '';
    };

    document.querySelectorAll('[data-open-login]').forEach((el) => el.addEventListener('click', openModal));
    document.getElementById('login-modal-close')?.addEventListener('click', closeModal);
    loginModal.addEventListener('click', (e) => { if (e.target === loginModal) closeModal(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && !loginModal.classList.contains('hidden')) closeModal(); });

    if (loginModal.dataset.autoOpen === '1') openModal();
}

// --- Toggle tampil/sembunyikan password ---
// Dipakai di elemen mana pun dengan atribut data-toggle-password="<id-input>".
document.querySelectorAll('[data-toggle-password]').forEach((toggleBtn) => {
    const input = document.getElementById(toggleBtn.dataset.togglePassword);
    if (!input) return;

    toggleBtn.addEventListener('click', () => {
        const willShow = input.type === 'password';
        input.type = willShow ? 'text' : 'password';
        toggleBtn.textContent = willShow ? '🙈' : '👁';
        toggleBtn.setAttribute('aria-label', willShow ? 'Sembunyikan password' : 'Tampilkan password');
        toggleBtn.setAttribute('aria-pressed', String(willShow));
    });
});

// --- Lightbox galeri (Vue island) ---
const lightboxRoot = document.getElementById('lightbox-root');
if (lightboxRoot) {
    createApp(Lightbox).mount(lightboxRoot);
}
document.addEventListener('click', (e) => {
    const trigger = e.target.closest('[data-lightbox-index]');
    if (!trigger) return;
    const group = trigger.closest('[data-lightbox-group]');
    if (!group) return;
    e.preventDefault();
    const items = JSON.parse(group.dataset.lightboxGroup);
    window.dispatchEvent(new CustomEvent('lightbox:open', {
        detail: { items, index: Number(trigger.dataset.lightboxIndex) },
    }));
});

// --- Scroll reveal ---
function initReveal(root = document) {
    const targets = root.querySelectorAll('.nb-card:not(.reveal), .stat-card:not(.reveal), section h2:not(.reveal)');
    if (!('IntersectionObserver' in window) || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        targets.forEach((el) => el.classList.add('reveal', 'reveal-visible'));
        return;
    }
    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('reveal-visible');
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    targets.forEach((el) => { el.classList.add('reveal'); io.observe(el); });
}
initReveal();
document.addEventListener('livewire:navigated', () => initReveal());
window.addEventListener('livewire:init', () => {
    window.Livewire.hook('morph.updated', ({ el }) => initReveal(el.closest('body') ?? document));
});
