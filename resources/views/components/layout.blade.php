<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gépjármű kártörténet</title>
    @vite('resources/css/app.css')
</head>

<body>
    <nav>
        <div class="flex justify-between bg-red-500">
            <div class="flex">
                <form method="GET" action="{{ route('/') }}" class="hover:bg-white">
                    @csrf
                    <button type="submit" class="p-4 text-white hover:text-red-500">Főoldal</button>
                </form>
                @if (!Auth::guest() && Auth::user()->is_admin)
                    <form method="GET" action="{{ route('vehicles.index') }}" class="hover:bg-white">
                        @csrf
                        <button type="submit" class="p-4 text-white hover:text-red-500">Összes jármű</button>
                    </form>
                    <form method="GET" action="{{ route('damage-events.index') }}" class="hover:bg-white">
                        @csrf
                        <button type="submit" class="p-4 text-white hover:text-red-500">Összes kártörténet</button>
                    </form>
                    <form method="GET" action="{{ route('users.index') }}" class="hover:bg-white">
                        @csrf
                        <button type="submit" class="p-4 text-white hover:text-red-500">Felhasználók</button>
                    </form>
                    <form method="GET" action="{{ route('vehicles.create') }}" class="hover:bg-white">
                        @csrf
                        <button type="submit" class="p-4 text-white hover:text-red-500">Új jármű</button>
                    </form>
                    <form method="GET" action="{{ route('damage-events.create') }}" class="hover:bg-white">
                        @csrf
                        <button type="submit" class="p-4 text-white hover:text-red-500">Új kártörténet</button>
                    </form>
                @endif
            </div>
            <div class="flex">
                @guest
                    <p class="p-4 text-white">
                        Szia, Vendég!
                    </p>
                    <form method="GET" action="{{ route('login') }}" class="hover:bg-white">
                        @csrf
                        <button type="submit" class="p-4 text-white hover:text-red-500">Bejelentkezés</button>
                    </form>
                @endguest

                @auth
                    <p class="p-4 text-white">
                        Szia, {{ Auth::user()->name }}!
                    </p>
                    <form method="POST" action="{{ route('logout') }}" class="hover:bg-white">
                        @csrf
                        <button type="submit" class="p-4 text-white hover:text-red-500">Kijelentkezés</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>
    <main>
        {{ $slot }}
    </main>
    <footer>

    </footer>
</body>

</html>
