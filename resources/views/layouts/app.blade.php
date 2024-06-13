<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <title>@yield("title")</title>

        @yield("additional-head-props")
        @show

        @vite("resources/css/app.css")
        @include("layouts.meta")
        @include("layouts.links")
        @include("layouts.scripts-defer")
    </head>
    <body class="h-[100vh]">
        @yield("content")
        @show

        @include("layouts.scripts")
    </body>
</html>
