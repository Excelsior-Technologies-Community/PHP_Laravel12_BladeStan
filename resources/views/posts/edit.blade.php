<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">

        <h1 class="text-3xl font-bold mb-6">
            Edit Post
        </h1>

        <form action="{{ route('posts.update', $post) }}" method="POST">

            @csrf
            @method('PUT')

            <input type="text" name="title" value="{{ $post->title }}" class="w-full border p-3 rounded-lg mb-4">

            <textarea name="content" rows="5" class="w-full border p-3 rounded-lg mb-4">{{ $post->content }}</textarea>

            <button class="bg-yellow-500 text-white px-5 py-2 rounded-lg">
                Update Post
            </button>

        </form>

    </div>

</body>

</html>