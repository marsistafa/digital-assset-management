<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .dropdown-menu {
            display: flex;
            flex-direction: row;
            list-style: none;
            padding: 0;
        }

        .dropdown-menu .dropdown-link {
            margin-right: 15px; /* Adjust the spacing between menu items as needed */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark dark-bg-secondary">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <x-application-logo class="d-inline-block align-top" />
        </a>
        
        <!-- Hamburger Menu Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" >
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div  id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Image Recognition') }}
            </x-nav-link>
        </li>
        <li class="nav-item">
            <x-nav-link :href="route('files.index')" :active="request()->routeIs('files.index')">
                {{ __('My Files') }}
            </x-nav-link>
        </li>
        <li class="nav-item">
            <x-nav-link :href="route('files.create')" :active="request()->routeIs('files.create')">
                {{ __('Upload Files') }}
            </x-nav-link>
        </li>
    </ul>
</div>

        <!-- User dropdown (right-aligned) -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbardropdown">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- Add Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
