<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container header-container">
        <a class="navbar-brand" href="{{ url('/home') }}">
            {{ config('app.name') }}
        </a>
        
        <x-nav />

    </div>
</nav>