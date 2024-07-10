<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\PageCategories;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;

class NavigationController extends Controller
{
    public function customIndex(string $navName)
    {
        $nav = Navigation::where('name', $navName)->get()->first();
        // if users and category empty
        if (empty($nav->from_user) && empty($nav->from_category)) {
            $pages = Page::all();
        }
        //if users empty and has category
        if (empty($nav->from_user) && !empty($nav->from_category)) {
            $category_ids = explode(',', $nav->from_category);
            $pages = Page::where('category_id', $category_ids[0])->get();

            for ($i=1; $i < count($category_ids); $i++) {
                $collection = Page::where('category_id', $category_ids[$i])->get();
                foreach ($collection as $item) {
                    $pages->push($item);
                }
            }
        }
        //if category empty and has users
        if (empty($nav->from_category) && !empty($nav->from_user)) {
            $users = explode(',', $nav->from_user);
            $users_ids = $this->getUserIDs($users);
            $pages = Page::where('created_by', $users_ids[0])->get();

            for ($i=1; $i < count($users_ids); $i++) {
                $collection = Page::where('created_by', $users_ids[$i])->get();
                foreach ($collection as $item) {
                    $pages->push($item);
                }
            }
        }
        //if has category and has users
        if (!empty($nav->from_category) && !empty($nav->from_user)) {
            //get all pages from users
            $users = explode(',', $nav->from_user);
            $users_ids = $this->getUserIDs($users);
            $users_pages = Page::where('created_by', $users_ids[0])->get();

            for ($i=1; $i < count($users_ids); $i++) {
                $collection = Page::where('created_by', $users_ids[$i])->get();
                foreach ($collection as $item) {
                    $users_pages->push($item);
                }
            }
            //get all pages from categories
            $category_ids = explode(',', $nav->from_category);
            $category_pages = Page::where('category_id', $category_ids[0])->get();

            for ($i=1; $i < count($category_ids); $i++) {
                $collection = Page::where('category_id', $category_ids[$i])->get();
                foreach ($collection as $item) {
                    $category_pages->push($item);
                }
            }

            $pages = collect($users_pages)->merge($category_pages);
        }

        $pages = $pages->unique()->values();
        return view('pages', compact('pages'));
    }

    private function getUserIDs(array $users)
    {
        $users_ids = User::where('name', $users[0])->get('id');

        for ($i=1; $i < count($users); $i++) {
            $users_ids[] = User::where('name', $users[$i])->get('id');
        }

        return $users_ids->toArray();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Policy
        Gate::authorize('all', Navigation::class);

        $navigations = Navigation::all();
        return view('dashboard.navigation.index', compact('navigations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Policy
        Gate::authorize('all', Navigation::class);

        $categories = PageCategories::all();
        return view('dashboard.navigation.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Policy
        Gate::authorize('all', Navigation::class);

        $request->validate([
            'name' => 'required|unique:navigations'
        ]);
        if ($request->except('_token','name','from_user'))
        {
            $categories = implode(',',array_values($request->except('_token','name','from_user')));
            $request['from_category'] = $categories;
        }
        //dd($request);
        Navigation::create($request->all());

        return redirect('/dashboard/navigation');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Navigation $navigation)
    {
        //Policy
        Gate::authorize('all', Navigation::class);

        $categories = PageCategories::all();
        $current_categories = explode(',', $navigation->from_category);
        return view('dashboard.navigation.edit', compact('categories', 'navigation', 'current_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Navigation $navigation)
    {
        //Policy
        Gate::authorize('all', Navigation::class);

        $request->validate([
            'name' => ['required', Rule::unique('roles')->ignore($navigation->id)]
        ]);

        if ($request->except('_token','name','from_user'))
        {
            $categories = implode(',',array_values($request->except('_token','_method','name','from_user')));
            if ($categories) $request['from_category'] = $categories;
        }

        $navigation->update($request->all());

        return redirect('/dashboard/navigation');
    }

    /**
     * Display the specified resource.
     */
    public function show(Navigation $navigation)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Navigation $navigation)
    {
        //Policy
        Gate::authorize('all', Navigation::class);

        $navigation->delete();

        return redirect('/dashboard/navigation');
    }
}
