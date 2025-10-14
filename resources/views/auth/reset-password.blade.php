<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen">

    <div class="bg-gray-800 text-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Reset Password</h1>

        @if(session('status'))
            <div class="bg-green-500 text-white p-2 mb-4 rounded">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-500 text-white p-2 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reset.password') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="username" value="{{ $username }}">

            <div>
                <label for="password" class="block mb-1">Password Baru</label>
                <input type="password" name="password" id="password" placeholder="Masukkan password baru"
                       class="w-full px-3 py-2 rounded text-black focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label for="password_confirmation" class="block mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi password"
                       class="w-full px-3 py-2 rounded text-black focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded font-semibold">
                Reset Password
            </button>

            <div class="text-center mt-4">
                <a href="{{ route('login.form') }}" class="text-blue-400 hover:text-blue-300 text-sm">
                    Kembali ke Login
                </a>
            </div>
        </form>
    </div>

</body>
</html>
