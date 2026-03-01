<x-filament-panels::page>
    <div class="flex flex-col items-center justify-center min-h-screen">
        <div class="w-full max-w-md">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-center mb-6">{{ $this->getHeading() }}</h2>

                <form wire:submit="register">
                    {{ $this->form }}

                    <div class="mt-6 space-y-4">
                        <x-filament::button type="submit" class="w-full">
                            إنشاء حساب
                        </x-filament::button>

                        <div class="text-center">
                            <a href="{{ \Filament\Facades\Filament::getPanel('office')->getLoginUrl() }}" class="text-sm text-primary-600 hover:text-primary-700">
                                لديك حساب بالفعل؟ تسجيل الدخول
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-filament-panels::page>
