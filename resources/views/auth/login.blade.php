<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Login - Bimadaya Procurement Management</title>
</head>

<body class="min-h-screen bg-[#F2F2F2]">

    <div class="min-h-screen flex items-center justify-center px-6">

        <div class="w-full max-w-md">

            <div class="text-center mb-8">

                <div class="flex justify-center mb-4">
                    <div class="w-14 h-14 rounded-xl bg-[#027333] flex items-center justify-center">
                        <span class="text-white text-xl font-bold">
                            BMD
                        </span>
                    </div>
                </div>

                <h1 class="text-2xl font-bold text-[#252525]">
                    Bimadaya Procurement Management
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Sign in to continue
                </p>

            </div>


            <div class="bg-white rounded-2xl shadow-sm p-8">

                <form method="POST" action="{{ route('login') }}">

                    @csrf

                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium text-[#252525] mb-2"
                        >
                            Email
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="Enter your email"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3
                                   text-sm outline-none transition
                                   focus:border-[#027333]
                                   focus:ring-2 focus:ring-[#027333]/20"
                        >

                        @error('email')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    <div class="mt-5">

                        <label
                            for="password"
                            class="block text-sm font-medium text-[#252525] mb-2"
                        >
                            Password
                        </label>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3
                                   text-sm outline-none transition
                                   focus:border-[#027333]
                                   focus:ring-2 focus:ring-[#027333]/20"
                        >

                        @error('password')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <div class="flex items-center justify-between mt-5">

                        <label class="flex items-center gap-2">

                            <input
                                type="checkbox"
                                name="remember"
                                class="rounded border-gray-300
                                       text-[#027333]
                                       focus:ring-[#027333]"
                            >

                            <span class="text-sm text-gray-600">
                                Remember me
                            </span>

                        </label>

                    </div>


                    <button
                        type="submit"
                        class="w-full mt-6
                               bg-[#027333]
                               hover:bg-[#025928]
                               text-white
                               font-medium
                               py-3
                               rounded-lg
                               transition duration-200"
                    >
                        Login
                    </button>

                </form>

            </div>

            <p class="text-center text-xs text-gray-400 mt-6">
                Bimadaya Procurement Management System
            </p>

        </div>

    </div>

</body>
</html>