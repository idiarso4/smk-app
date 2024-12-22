<x-filament-panels::layout.base :livewire="$livewire">
    <div class="min-h-screen flex items-center bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
        <div class="spider-web"></div>
        
        <div class="w-full max-w-md mx-auto p-6 space-y-8 relative z-10">
            <div class="bg-white/10 backdrop-blur-xl p-8 rounded-xl shadow-2xl border border-white/20">
                <div class="text-center space-y-2">
                    <h2 class="text-2xl font-bold text-white">
                        {{ $heading }}
                    </h2>
                    
                    @if (filled($subheading))
                        <p class="text-gray-400">
                            {{ $subheading }}
                        </p>
                    @endif
                </div>

                <div class="space-y-8 mt-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    @livewire('notifications')

    <script>
        // Spider web animation script
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.spider-web');
            // ... rest of your spider web animation code
        });
    </script>
</x-filament-panels::layout.base> 