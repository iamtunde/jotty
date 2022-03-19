<!DOCTYPE html>
<html lang="en">
    @include('template.head')
    <body>
        @include('template.header')
        @include('template.messages')
        @yield('content')
        @include('template.foot')
    </body>
</html>