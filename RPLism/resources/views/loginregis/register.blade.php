<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MINACCI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:300,400,500,600,600i,700,700i|montserrat:200,300,400,500,600,700,800" rel="stylesheet" />
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #7F1D1D 0%, #B91C1C 50%, #ffb545 100%);
        }
        /* Font untuk logo dan heading */
        .font-logo {
            font-family: 'Cormorant Garamond', serif;
        }
        /* Font untuk teks body */
        .font-body {
            font-family: 'Montserrat', sans-serif;
        }
        /* Set default font untuk seluruh body */
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen gradient-bg px-20">
    
    <!-- Header -->
    <header class="flex justify-between items-center px-8 py-6">
        <div class="flex items-center">
            <div class="w-20 h-15">
                <img src="{{ asset('img/logo-miinacci.png') }}" alt="MINACCI Logo" class="w-full h-full object-contain">
            </div>
        </div>
        <a href="{{ route('login') }}">
            <button class="bg-yellow-600 hover:bg-yellow-700 text-white px-8 py-2 rounded-lg font-body font-medium transition duration-300">
                Login
            </button>
        </a>
    </header>

    <!-- Main Content -->
    <div class="flex justify-center items-center min-h-[calc(100vh-120px)]">
        <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-md mx-4">
            <!-- Register Title -->
            <h2 class="font-logo text-3xl font-bold text-yellow-600 text-center mb-2">Sign Up</h2>
            
            <!-- Subtitle -->
            <p class="font-body text-gray-600 text-center mb-8">
                Already have an account? 
                <a href="{{ route('login') }}">
                    <span class="font-body text-red-800 font-medium">Login</span>
                </a>
            </p>

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li class="font-body text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Name Field -->
                <div>
                    <input 
                        type="text" 
                        name="username" 
                        placeholder="Username" 
                        value="{{ old('username') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition duration-300 font-body"
                        required
                    >
                </div>

                <!-- Email Field -->
                <div>
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Email" 
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition duration-300 font-body"
                        required
                    >
                </div>

                <!-- Password Field -->
                <div>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Password" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition duration-300 font-body"
                        required
                    >
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        placeholder="Confirm Password" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition duration-300 font-body"
                        required
                    >
                </div>

                <!-- Register Button -->
                <button 
                    type="submit" 
                    class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-3 rounded-lg font-body font-medium text-lg transition duration-300 transform hover:scale-[1.02]"
                >
                    Create Account
                </button>
            </form>
        </div>
    </div>
</body>
</html>
