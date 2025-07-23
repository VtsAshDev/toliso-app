<div class="min-h-screen flex flex-col w-64 bg-gray-100 px-4 py-8 shadow-lg">
    <!-- User Info -->
    <div class="flex flex-col items-center mb-10">
        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="w-16 h-16 rounded-full border-2 border-orange-200 mb-2" alt="User" />
        <div class="font-semibold text-base text-gray-900">{{ Auth::user()->name }}</div>
        <div class="text-xs text-gray-400">Financial Manager</div>
    </div>
    <!-- Menu Section -->
    <div class="mb-6">
        <div class="text-xs text-gray-400 font-semibold mb-2 tracking-widest">MENU</div>
        <ul class="space-y-1">
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 rounded-full font-medium text-gray-900 bg-white shadow-sm {{ request()->routeIs('dashboard') ? 'bg-white' : 'hover:bg-gray-200' }}">
                    <span class="material-icons mr-2 text-orange-500">dashboard</span> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('categories.index') }}" class="flex items-center px-4 py-2 rounded-full font-medium text-gray-600 hover:bg-gray-200">
                    <span class="material-icons mr-2">label</span> Categorias
                </a>
            </li>
            <li>
                <a href="{{ route('transactions.index') }}" class="flex items-center px-4 py-2 rounded-full font-medium text-gray-600 hover:bg-gray-200">
                    <span class="material-icons mr-2">swap_horiz</span> Transações
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-4 py-2 rounded-full font-medium text-gray-600 hover:bg-gray-200">
                    <span class="material-icons mr-2">map</span> RoadMap
                </a>
            </li>
        </ul>
    </div>
    <!-- Others Section -->
    <div class="mb-6">
        <div class="text-xs text-gray-400 font-semibold mb-2 tracking-widest">OTHERS</div>
        <ul class="space-y-1">
            <li>
                <a href="#" class="flex items-center px-4 py-2 rounded-full font-medium text-gray-600 hover:bg-gray-200">
                    <span class="material-icons mr-2">settings</span> Settings
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-4 py-2 rounded-full font-medium text-gray-600 hover:bg-gray-200">
                    <span class="material-icons mr-2">payment</span> Payment
                </a>
            </li>
            <li>
                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 rounded-full font-medium text-gray-600 hover:bg-gray-200">
                    <span class="material-icons mr-2">person</span> My Profile
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center px-4 py-2 rounded-full font-medium text-gray-600 hover:bg-gray-200">
                    <span class="material-icons mr-2">help</span> Help
                </a>
            </li>
        </ul>
    </div>
    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}" class="mt-auto">
        @csrf
        <button type="submit" class="flex items-center w-full px-4 py-2 rounded-full font-medium text-gray-600 hover:bg-gray-200">
            <span class="material-icons mr-2">logout</span> Log Out
        </button>
    </form>
    <!-- Material Icons CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</div>
