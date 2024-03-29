<div class="sticky top-0 z-10 shadow-sm">
    <nav class="relative flex items-center justify-between p-1 px-3 bg-gray-50">
        <a class="text-3xl font-bold leading-none">
            <x-application-logo />
        </a>
        <div class="lg:hidden">
            <button class="flex items-center p-3 text-blue-600 navbar-burger">
                <svg class="block w-4 h-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <title>Mobile menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                </svg>
            </button>
        </div>
        <ul
            class="absolute hidden transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 lg:flex lg:mx-auto lg:items-center lg:w-auto lg:space-x-6">
            <li><a href="#" class="text-sm text-gray-400 hover:text-gray-500">Home</a></li>
            <li class="text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                    class="w-4 h-4 current-fill" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 5v0m0 7v0m0 7v0m0-13a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                    </path>
                </svg>
            </li>
            <li><a class="text-sm text-gray-400 hover:text-gray-500" href="#pricing">Pricing</a></li>
        </ul>
        <a class="hidden px-6 py-2 text-sm font-bold text-gray-900 transition duration-200 lg:inline-block lg:ml-auto lg:mr-3 bg-gray-50 hover:bg-gray-100 rounded-xl"
            href="{{ route('login') }}">Sign In</a>
        <a class="hidden px-6 py-2 text-sm font-bold text-white transition duration-200 bg-blue-500 lg:inline-block hover:bg-blue-600 rounded-xl"
            href="{{ route('register') }}">Sign up</a>
    </nav>
</div>
