<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>{{ config('app.code') }} {{ config('app.version') }} @yield('title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('layouts.styles')
    </head>
    <body>
        <div id="app" class="container">
            <header id="page-header">
                <h1 id="site-name" class="float-left">{{ __('messages.general.cdvo') }}</h1>
                <div id="logo" class="float-right">
                    <img src="{{ asset('img/logo.png') }}" alt="{{ __('messages.general.cdvo') }}">
                </div>
            </header>

            <div id="content" class="leftBorder @yield('contentClass')">
                @yield('body')

                <div class="footer mt-5">{{ config('app.code') }} - {{ __('messages.general.cdvo') }} - Tous droits réservés - Version {{ config('app.version') }}</div>
            </div>
        </div>
        @include('layouts.scripts')
        @stack('scripts')
    </body>
</html>
