<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen">
    <div class="bg-gray-800 p-8 rounded-2xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-white mb-6 text-center">Lupa Password</h2>

        @if(session('success'))
            <div class="bg-green-600 text-white p-2 rounded mb-4 text-center">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="bg-red-600 text-white p-2 rounded mb-4 text-center">{{ session('error') }}</div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-300 mb-2">Username</label>
                <input type="text" name="username" class="w-full p-3 rounded bg-gray-700 text-white" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white p-3 rounded">
                Kirim Token Reset
            </button>

            <div class="text-center mt-4">
                <a href="{{ route('login.form') }}" class="text-blue-400 hover:text-blue-300 text-sm">Kembali ke Login</a>
            </div>
        </form>
    </div>
</body>
</html>
