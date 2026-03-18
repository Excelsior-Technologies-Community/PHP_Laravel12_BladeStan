<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-5xl mx-auto p-6">

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800">📚 All Posts</h1>
            <p class="text-gray-500 mt-2">A simple Laravel + Blade UI</p>
        </div>

        <!-- Posts Grid -->
        <div class="grid md:grid-cols-2 gap-6">
            @foreach($posts as $post)
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300">

                <h2 class="text-xl font-semibold text-gray-800 mb-2">
                    {{ $post['title'] }}
                </h2>

                <p class="text-gray-600">
                    {{ $post['content'] }}
                </p>

            
                <div class="mt-4 text-right">
                    <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                        Read More
                    </button>
                </div>

            </div>
            @endforeach
        </div>

    </div>

</body>

</html>