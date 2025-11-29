<x-filament-panels::page.simple>
    @push('styles')
    <style>
        body,
        html {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .fi-body,
        .fi-layout,
        [x-data] {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }

        .fi-simple-page {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }

        .fi-simple-main {
            width: 100%;
            max-width: 450px;
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        }

        .login-header-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2rem;
        }

        .login-logo {
            width: 100px;
            height: 100px;
            margin-bottom: 1rem;
        }

        .login-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
        }

        .login-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            text-align: center;
            margin: 0;
        }
    </style>
    @endpush

    <div class="login-header-container">
        <div class="login-logo">
            <img src="{{ asset('images/Logo.jpg') }}" alt="DISTRINORT Logo">
        </div>
        <h1 class="login-title">DISTRINORT</h1>
    </div>

    <x-filament-panels::form wire:submit="authenticate">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>
</x-filament-panels::page.simple>
