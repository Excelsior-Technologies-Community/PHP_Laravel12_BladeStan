<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">

        <h1 class="text-3xl font-bold mb-6">
            Create Post
        </h1>

        <form action="{{ route('posts.store') }}" method="POST">

            @csrf

            <input type="text" name="title" placeholder="Title" class="w-full border p-3 rounded-lg mb-4">

            <textarea name="content" placeholder="Content" rows="5"
                class="w-full border p-3 rounded-lg mb-4"></textarea>

            <button class="bg-blue-500 text-white px-5 py-2 rounded-lg">
                Save Post
            </button>

        </form>

    </div>

</body>

</html>