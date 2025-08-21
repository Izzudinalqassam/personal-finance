<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: '/admin', navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Masuk ke Akun Anda')" :description="__('Masukkan email dan password untuk melanjutkan')" />

    <!-- Session Status -->
    <x-auth-session-status class="auth-success" :status="session('status')" />

    <form method="POST" wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <div>
            <label class="auth-label" for="email">{{ __('Alamat Email') }}</label>
            <input
                wire:model="email"
                id="email"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="email@example.com"
                class="auth-input w-full"
            />
            @error('email')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-2">
                <label class="auth-label" for="password">{{ __('Password') }}</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="auth-link text-sm" wire:navigate>
                        {{ __('Lupa password?') }}
                    </a>
                @endif
            </div>
            <input
                wire:model="password"
                id="password"
                type="password"
                required
                autocomplete="current-password"
                placeholder="Masukkan password Anda"
                class="auth-input w-full"
            />
            @error('password')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center gap-3">
            <input
                wire:model="remember"
                id="remember"
                type="checkbox"
                class="auth-checkbox w-4 h-4"
            />
            <label for="remember" class="auth-label text-sm mb-0">{{ __('Ingat saya') }}</label>
        </div>

        <div class="flex items-center justify-end">
            <button type="submit" class="auth-button">
                <i class="fas fa-sign-in-alt mr-2"></i>
                {{ __('Masuk') }}
            </button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="text-center text-sm">
            <span class="text-white/80">{{ __('Belum punya akun?') }}</span>
            <a href="{{ route('register') }}" class="auth-link ml-1" wire:navigate>{{ __('Daftar sekarang') }}</a>
        </div>
    @endif
</div>
