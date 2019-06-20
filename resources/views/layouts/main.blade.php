<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
    <body>
        <div class="container-fluid">
            @include('layouts.header')
            @yield('content')
            @include('layouts.footer')
        </div>
        @yield('script')
    </body>
</html>
