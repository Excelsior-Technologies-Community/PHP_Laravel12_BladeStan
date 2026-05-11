<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-6xl mx-auto p-6">

        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">
                    📚 All Posts
                </h1>

                <p class="text-gray-500">
                    Laravel 12 + BladeStan CRUD
                </p>
            </div>

            <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-5 py-2 rounded-lg hover:bg-blue-600">
                + Create Post
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-5">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" class="mb-6">
            <input type="text" name="search" placeholder="Search posts..." value="{{ request('search') }}"
                class="w-full p-3 rounded-lg border">
        </form>

        <div class="grid md:grid-cols-2 gap-6">

            @forelse($posts as $post)

                <div class="bg-white p-6 rounded-xl shadow-md">

                    <h2 class="text-2xl font-bold mb-3">
                        {{ $post->title }}
                    </h2>

                    <p class="text-gray-600 mb-5">
                        {{ $post->content }}
                    </p>

                    <div class="flex gap-3">

                        <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg">
                            Edit
                        </a>

                        <form action="{{ route('posts.destroy', $post) }}" method="POST">

                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Delete this post?')"
                                class="bg-red-500 text-white px-4 py-2 rounded-lg">

                                Delete
                            </button>
                        </form>

                    </div>

                </div>

            @empty

                <div class="text-red-500">
                    No posts found.
                </div>

            @endforelse

        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>

    </div>

</body>

</html>