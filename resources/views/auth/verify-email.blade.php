<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <title>Document</title>
    @vite(include: ['resources/css/app.css'])
</head>
<body>
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-md w-full bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-center text-green-700 mb-4">Подтверждение Email</h1>
        <p class="text-gray-700 text-center mb-6">На ваш адрес электронной почты было отправлено письмо с подтверждением.</p>
        <p class="text-gray-600 text-center mb-4">Если вы не получили письмо, вы можете запросить новое.</p>

        @if (session('message'))
            <div class="alert alert-success mb-4 text-white bg-green-500 p-3 rounded-md">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('verification.resend') }}" method="POST">
            @csrf
            <div class="flex justify-center">
                <button type="submit" class="w-full px-6 py-3 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 transition duration-200">
                    Повторно отправить письмо
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>


