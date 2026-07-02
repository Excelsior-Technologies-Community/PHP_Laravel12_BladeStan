<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">
        <h1 class="text-3xl font-bold mb-6">Edit Post</h1>
        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <input type="text" name="title" value="{{ $post->title }}" class="w-full border p-3 rounded-lg mb-4" required>
            <textarea name="content" rows="5" class="w-full border p-3 rounded-lg mb-4" required>{{ $post->content }}</textarea>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Category</label>
                <select name="category_id" class="w-full border p-3 rounded-lg">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Tags</label>
                <div class="flex flex-wrap gap-3">
                    @foreach($tags as $tag)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="rounded border-gray-300 text-blue-600 shadow-sm" {{ $post->tags->contains($tag->id) ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700">{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Featured Image</label>
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="w-32 h-32 object-cover rounded mb-2">
                @endif
                <input type="file" name="image" class="w-full border p-2 rounded-lg">
            </div> -->

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Featured Image</label>
                @if($post->image)
                    <img src="{{ str_starts_with($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}" class="w-32 h-32 object-cover rounded mb-2" alt="Post Image">
                @endif
                <input type="file" name="image" class="w-full border p-2 rounded-lg">
            </div>

            <button class="bg-yellow-500 text-white px-5 py-2 rounded-lg">Update Post</button>
        </form>
    </div>
</body>
</html>