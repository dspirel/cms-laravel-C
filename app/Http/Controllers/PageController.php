<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use App\Helpers\Image;
use App\Models\Page;
use App\Models\PageCategories;
use Illuminate\Support\Facades\Gate;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index', Page::class);

        if (Gate::allows('all', Page::class)){
            $pages = Page::all();

            return view('dashboard.pages.index', compact('pages'));
        };

        $pages = Page::where('created_by', auth()->user()?->id)->get();

        return view('dashboard.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Page::class);

        $categories = PageCategories::all();
        return view('dashboard.pages.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        Gate::authorize('create', Page::class);

        $validatedData = $request->validated();
        $validatedData['created_by'] = auth()->id();

        if ($request->hasFile('image')){
            $validatedData['image'] = Image::upload($request->file('image'), 'pages');
        }

        Page::create($validatedData);

        return redirect('dashboard/pages');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        Gate::authorize('actionOwn', $page);

        return view('dashboard.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        Gate::authorize('actionOwn', $page);

        $categories = PageCategories::all();
        return view('dashboard.pages.edit', compact('categories','page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, Page $page)
    {
        Gate::authorize('actionOwn', $page);

        $validateData = $request->validated();

        if ($request->hasFile('image')){
            $validateData['image'] = Image::upload($request->file('image'), 'pages', $page->image);
        }

        $page->update($validateData);

        return redirect()->route('dashboard.pages.show', $page->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        Gate::authorize('actionOwn', $page);

        Image::delete($page->image);
        $page->delete();

        return redirect('/dashboard/pages');
    }
}
