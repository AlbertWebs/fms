<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-3xl font-bold text-white">Profile Settings</h1>
            <p class="mt-1 text-sm text-gray-300">Manage your account settings and preferences</p>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6">
        <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl border-2 border-indigo-200/60 shadow-xl backdrop-blur-sm overflow-hidden">
            <div class="p-8">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl border-2 border-indigo-200/60 shadow-xl backdrop-blur-sm overflow-hidden">
            <div class="p-8">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="bg-gradient-to-br from-white via-red-50/20 to-pink-50/20 rounded-2xl border-2 border-red-200/60 shadow-xl backdrop-blur-sm overflow-hidden">
            <div class="p-8">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
