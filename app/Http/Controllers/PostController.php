<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->toString();
        $categoryId = $request->input('category_id');

        $posts = Post::with(['category', 'tags'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            })
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->orderBy('id', 'desc')
            ->paginate(4);

        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        /** @var array<string, mixed> $data */
        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'] ?? null,
        ];

        $imageFile = $request->file('image');
        if ($imageFile instanceof UploadedFile) {
            $path = $imageFile->store('posts', 'public');
            if (is_string($path)) {
                $data['image'] = $path;
            }
        }

        $post = new Post();
        $post->fill($data);
        $post->save();

        if ($request->has('tags')) {
            /** @var array<int, int> $tagIds */
            $tagIds = $request->input('tags', []);
            $post->tags()->sync($tagIds);
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    public function edit(Post $post): View
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        /** @var array<string, mixed> $data */
        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'] ?? null,
        ];

        $imageFile = $request->file('image');
        if ($imageFile instanceof UploadedFile) {
            if (is_string($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            $path = $imageFile->store('posts', 'public');
            if (is_string($path)) {
                $data['image'] = $path;
            }
        }

        $post->update($data);

        /** @var array<int, int> $tagIds */
        $tagIds = $request->has('tags') ? $request->input('tags', []) : [];
        $post->tags()->sync($tagIds);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post): RedirectResponse
    {
        if (is_string($post->image)) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }

    public function storeComment(Request $request, Post $post): RedirectResponse
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $post->comments()->create([
            'body' => $validated['body'],
        ]);

        return redirect()->back()->with('success', 'Comment added successfully');
    }
}