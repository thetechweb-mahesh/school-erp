@extends('layouts.admin')

@section('title', 'Profile')

@section('header', 'Profile Settings')

@section('content')

<div class="space-y-6">

    <!-- Top Banner -->
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
        <h2 class="text-2xl font-bold">My Profile 👤</h2>
        <p class="mt-2 text-sm text-indigo-100">
            Manage your account information, password and security settings.
        </p>
    </div>

    <!-- Profile Info -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            Update Profile Information
        </h3>

        <div class="max-w-2xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <!-- Password -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            Change Password
        </h3>

        <div class="max-w-2xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <!-- Delete Account -->
    <div class="bg-white rounded-2xl shadow border border-red-100 p-6">
        <h3 class="text-lg font-semibold text-red-600 mb-4">
            Danger Zone
        </h3>

        <p class="text-sm text-gray-500 mb-4">
            Once your account is deleted, all of its resources and data will be permanently removed.
        </p>

        <div class="max-w-2xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

</div>

@endsection