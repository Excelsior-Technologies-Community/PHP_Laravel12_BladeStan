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
                <h1 class="text-4xl font-bold text-gray-800">📚 All Posts</h1>
                <p class="text-gray-500">Laravel 12 + BladeStan Complex CRUD</p>
            </div>
            <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-5 py-2 rounded-lg hover:bg-blue-600">+ Create Post</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-5">{{ session('success') }}</div>
        @endif

        <form method="GET" class="mb-6 grid md:grid-cols-2 gap-4">
            <input type="text" name="search" placeholder="Search posts..." value="{{ request()->string('search') }}" class="p-3 rounded-lg border w-full">
            <select name="category_id" onchange="this.form.submit()" class="p-3 rounded-lg border w-full">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request()->input('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </form>

        <div class="grid md:grid-cols-2 gap-6">
            @forelse($posts as $post)
                <div class="bg-white p-6 rounded-xl shadow-md flex flex-col justify-between">
                    <div>
                        <!-- @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-48 object-cover rounded-lg mb-4" alt="Post Image">
                        @endif -->
                        
    @if($post->image)
    <img src="{{ str_starts_with($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}" class="w-full h-48 object-cover rounded-lg mb-4" alt="Post Image">
@endif

                        <div class="flex justify-between items-center mb-2">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $post->category ? $post->category->name : 'Uncategorized' }}</span>
                        </div>

                        <h2 class="text-2xl font-bold mb-3">{{ $post->title }}</h2>
                        <p class="text-gray-600 mb-4">{{ $post->content }}</p>

                        <div class="mb-4">
                            @foreach($post->tags as $tag)
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{{ $tag->name }}</span>
                            @endforeach
                        </div>

                        <div class="border-t pt-4 mt-4">
                            <h4 class="font-bold text-gray-700 mb-2">Comments ({{ $post->comments->count() }})</h4>
                            <div class="space-y-2 max-h-32 overflow-y-auto mb-3">
                                @foreach($post->comments as $comment)
                                    <p class="bg-gray-50 p-2 rounded text-sm text-gray-600">{{ $comment->body }}</p>
                                @endforeach
                            </div>
                            <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="flex gap-2">
                                @csrf
                                <input type="text" name="body" placeholder="Write a comment..." class="border p-2 rounded text-sm w-full" required>
                                <button class="bg-gray-800 text-white px-3 py-1 rounded text-sm">Add</button>
                            </form>
                        </div>
                    </div>

                    <div class="flex gap-3 mt-6 border-t pt-4">
                        <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this post?')" class="bg-red-500 text-white px-4 py-2 rounded-lg">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-red-500">No posts found.</div>
            @endforelse
        </div>

        <div class="mt-8">{{ $posts->links() }}</div>
    </div>
</body>
</html>