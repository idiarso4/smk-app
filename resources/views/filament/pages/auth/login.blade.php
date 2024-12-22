<x-filament-panels::page.simple>
    <div class="min-h-screen relative overflow-hidden">
        <!-- Animated Background -->
        <div class="animated-background"></div>
        
        <!-- Floating Particles -->
        <div class="particles">
            @for ($i = 0; $i < 50; $i++)
                <div class="particle"
                    style="
                        left: {{ rand(0, 100) }}%;
                        top: {{ rand(0, 100) }}%;
                        width: {{ rand(2, 6) }}px;
                        height: {{ rand(2, 6) }}px;
                        animation-delay: -{{ rand(0, 20) }}s;
                        animation-duration: {{ rand(10, 30) }}s;
                    "
                ></div>
            @endfor
        </div>
        
        <!-- Login Form -->
        <div class="relative z-10 p-6">
            <div class="login-card">
                <div class="text-center mb-8">
                    <x-filament-panels::logo class="mx-auto h-16" />
                    <h2 class="mt-6 text-2xl font-bold tracking-tight text-white">
                        {{ $this->getHeading() }}
                    </h2>
                    <p class="mt-2 text-sm text-gray-300">
                        {{ $this->getSubheading() }}
                    </p>
                </div>

                <x-filament-panels::form wire:submit="authenticate">
                    {{ $this->form }}

                    <x-filament::button type="submit" class="login-button">
                        {{ __('filament-panels::pages/auth/login.form.actions.authenticate.label') }}
                    </x-filament::button>
                </x-filament-panels::form>
            </div>
        </div>
    </div>
</x-filament-panels::page.simple> 