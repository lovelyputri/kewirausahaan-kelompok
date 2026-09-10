@extends('layout')

@section('title', 'Dashboard')

@section('content')

    <div class="bg-white rounded-lg shadow p-8 text-center">

        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            Selamat Datang! 🎉
        </h1>

        <p class="text-gray-600 mb-6">
            Halo, <strong>{{ Auth::user()->name }}</strong>
        </p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white text-sm px-6 py-2 rounded-lg">
                Logout
            </button>
        </form>

    </div>

@endsection
