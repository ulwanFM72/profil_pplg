<div
    id="login-modal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-ink/80 p-4"
    role="dialog"
    aria-modal="true"
    aria-labelledby="login-modal-title"
    data-auto-open="{{ $errors->has('username') ? '1' : '0' }}"
>
    <div class="nb-card w-full max-w-sm bg-white p-6">
        <div class="mb-4 flex items-center justify-between">
            <h2 id="login-modal-title" class="text-xl font-extrabold">Login Admin</h2>
            <button type="button" id="login-modal-close" class="nb-btn nb-btn-light px-3 py-1" aria-label="Tutup modal login">✕</button>
        </div>.

        @if ($errors->has('username'))
            <div class="mb-4 border-[3px] border-ink bg-brand p-3 text-sm font-bold text-white" role="alert">
                {{ $errors->first('username') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.store') }}" novalidate>
            @csrf
            <div class="mb-3">
                <label for="modal-username" class="mb-1 block text-sm font-bold">Username</label>
                <input type="text" id="modal-username" name="username" value="{{ old('username') }}" required autocomplete="username" class="nb-input w-full">
            </div>
            <div class="mb-4">
                <label for="modal-password" class="mb-1 block text-sm font-bold">Password</label>
                <div class="relative">
                    <input type="password" id="modal-password" name="password" required autocomplete="current-password" class="nb-input w-full pr-12">
                    <button type="button" data-toggle-password="modal-password" aria-label="Tampilkan password" aria-pressed="false"
                            class="absolute inset-y-0 right-0 flex w-11 items-center justify-center text-lg">👁</button>
                </div>
            </div>
            <label class="mb-4 flex items-center gap-2 text-sm font-bold">
                <input type="checkbox" name="remember" class="size-4">
                Ingat saya
            </label>
            <button class="nb-btn w-full">Masuk</button>
        </form>
    </div>
</div>
