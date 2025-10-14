<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen">
    <div class="bg-gray-800 p-8 rounded-2xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-white mb-6 text-center">Reset Password</h2>

        @if(session('error'))
            <div class="bg-red-600 text-white p-2 rounded mb-4 text-center">{{ session('error') }}</div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-4">
                <label class="block text-gray-300 mb-2">Username</label>
                <input type="text" name="username" class="w-full p-3 rounded bg-gray-700 text-white" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-300 mb-2">Password Baru</label>
                <input type="password" name="password" class="w-full p-3 rounded bg-gray-700 text-white" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-300 mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full p-3 rounded bg-gray-700 text-white" required>
            </div>

            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white p-3 rounded">
                Ubah Password
            </button>
        </form>
    </div>
</body>
</html>
