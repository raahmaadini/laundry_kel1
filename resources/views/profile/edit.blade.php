@extends('layouts.app', ['title' => 'Profil Saya'])

@section('content')

<h1 class="text-2xl font-bold mb-6">👤 Profil Saya</h1>

<div class="max-w-3xl space-y-6">

    <!-- Update Profile Information -->
    <div class="bg-white p-6 shadow rounded-lg">
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <!-- Update Password -->
    <div class="bg-white p-6 shadow rounded-lg">
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <!-- Delete Account -->
    <div class="bg-white p-6 shadow rounded-lg">
        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

</div>

@endsection
