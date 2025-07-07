<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Profile Header -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-8">
                    <div class="relative">
                        <div class="w-32 h-32 rounded-full bg-white p-2">
                            <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&color=7F9CF5&background=EBF4FF' }}" 
                                alt="{{ Auth::user()->name }}" 
                                class="w-full h-full rounded-full object-cover">
                        </div>
                        <button class="absolute bottom-0 right-0 bg-white rounded-full p-2 shadow-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-camera text-gray-600"></i>
                        </button>
                    </div>
                    <div class="text-center md:text-left">
                        <h1 class="text-3xl font-bold">{{ Auth::user()->name }}</h1>
                        <p class="text-blue-100">{{ Auth::user()->email }}</p>
                        <div class="mt-4 flex flex-wrap justify-center md:justify-start gap-2">
                            <span class="px-4 py-1 bg-blue-400 bg-opacity-50 rounded-full text-sm">
                                {{ ucfirst(Auth::user()->user_type ?? 'User') }}
                            </span>
                            <span class="px-4 py-1 bg-blue-400 bg-opacity-50 rounded-full text-sm">
                                Joined {{ Auth::user()->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Sidebar -->
                <div class="md:col-span-1 space-y-6">
                    <!-- Quick Stats -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold mb-4">Quick Stats</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                <div class="text-2xl font-bold text-blue-600">{{ $ideas->count() }}</div>
                                <div class="text-sm text-gray-600">Ideas</div>
                            </div>
                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                <div class="text-2xl font-bold text-blue-600">0</div>
                                <div class="text-sm text-gray-600">Schemes</div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Status -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold mb-4">Account Status</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Email Verification</span>
                                @if(Auth::user()->hasVerifiedEmail())
                                    <span class="text-green-500"><i class="fas fa-check-circle"></i> Verified</span>
                                @else
                                    <span class="text-yellow-500"><i class="fas fa-exclamation-circle"></i> Pending</span>
                                @endif
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Profile Completion</span>
                                <span class="text-blue-500">80%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="md:col-span-2 space-y-6">
                    <!-- My Innovations -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold">My Innovations</h3>
                            <a href="{{ route('ideas.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                <i class="fas fa-plus mr-2"></i> Submit New Idea
                            </a>
                        </div>

                        @if($ideas->count() > 0)
                            <div class="space-y-4">
                                @foreach($ideas as $idea)
                                    <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition-colors">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-medium text-gray-900">{{ $idea->title }}</h4>
                                                <p class="text-sm text-gray-500 mt-1">{{ Str::limit($idea->description, 150) }}</p>
                                                <div class="mt-2 text-sm text-gray-500">
                                                    <span class="mr-4">
                                                        <i class="fas fa-calendar mr-1"></i>
                                                        {{ $idea->created_at->format('M d, Y') }}
                                                    </span>
                                                    <span class="mr-4">
                                                        <i class="fas fa-tag mr-1"></i>
                                                        {{ $idea->category }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex space-x-3">
                                                <a href="{{ route('ideas.edit', $idea) }}" class="text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('ideas.destroy', $idea) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800" 
                                                        onclick="return confirm('Are you sure you want to delete this idea?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="mt-3 flex items-center space-x-4 text-sm">
                                            <span class="flex items-center text-gray-500">
                                                <i class="fas fa-eye mr-1"></i> {{ $idea->views ?? 0 }} views
                                            </span>
                                            <span class="flex items-center text-gray-500">
                                                <i class="fas fa-heart mr-1"></i> {{ $idea->likes_count ?? 0 }} likes
                                            </span>
                                            <span class="flex items-center text-gray-500">
                                                <i class="fas fa-comments mr-1"></i> {{ $idea->comments_count ?? 0 }} comments
                                            </span>
                                            <a href="{{ route('ideas.show', $idea) }}" class="text-blue-600 hover:text-blue-800">
                                                View Details <i class="fas fa-arrow-right ml-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="text-gray-400 mb-4">
                                    <i class="fas fa-lightbulb text-6xl"></i>
                                </div>
                                <h4 class="text-xl font-medium text-gray-900">No ideas submitted yet</h4>
                                <p class="text-gray-500 mt-2">Share your innovative ideas with the community!</p>
                                <a href="{{ route('ideas.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                    <i class="fas fa-plus mr-2"></i> Submit Your First Idea
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Profile Information -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold">Profile Information</h3>
                        </div>
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <!-- Security Settings -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold">Security Settings</h3>
                        </div>
                        @include('profile.partials.update-password-form')
                    </div>

                    <!-- Danger Zone -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-red-100">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-red-600">Danger Zone</h3>
                            <span class="text-red-500 text-sm"><i class="fas fa-exclamation-triangle"></i></span>
                        </div>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .form-input {
            @apply mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50;
        }

        .btn-primary {
            @apply inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150;
        }

        .btn-danger {
            @apply inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150;
        }
    </style>
</x-app-layout>
