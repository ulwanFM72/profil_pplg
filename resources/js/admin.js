import * as bootstrap from 'bootstrap';

document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach((el) => new bootstrap.Tooltip(el));

// Konfirmasi hapus generik: tombol dengan data-confirm-delete memicu modal lalu submit form terkait.
document.querySelectorAll('[data-confirm-delete]').forEach((btn) => {
    btn.addEventListener('click', () => {
        document.getElementById(btn.dataset.confirmDelete)?.querySelector('form')?.addEventListener('submit', () => {}, { once: true });
    });
});

// Toggle tampil/sembunyikan password (dipakai di halaman /admin/login).
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

// Auto-tutup alert sukses setelah beberapa detik.
document.querySelectorAll('.alert-auto-dismiss').forEach((el) => {
    setTimeout(() => bootstrap.Alert.getOrCreateInstance(el)?.close(), 4000);
});
