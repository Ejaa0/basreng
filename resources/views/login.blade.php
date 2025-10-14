<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen">

    <div class="bg-gray-800 text-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Login Admin</h1>

        @if(session('status'))
            <div class="bg-green-500 text-white p-2 mb-4 rounded">
                {{ session('status') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-2 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="username" class="block mb-1">Username</label>
                <input type="text" name="username" id="username" placeholder="Masukkan username"
                       class="w-full px-3 py-2 rounded text-black focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('username') }}" required>
            </div>

            <div>
                <label for="password" class="block mb-1">Password</label>
                <input type="password" name="password" id="password" placeholder="Masukkan password"
                       class="w-full px-3 py-2 rounded text-black focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded font-semibold">
                Login
            </button>

            <div class="text-center mt-4">
                <a href="{{ route('forgot.form') }}" class="text-blue-400 hover:text-blue-300 text-sm">
                    Lupa password?
                </a>
            </div>
        </form>
    </div>

</body>
</html>
