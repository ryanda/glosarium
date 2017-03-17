<?php

namespace App\Http\Controllers\Api\Glosarium;

use App\Glosarium\Word;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WordController extends Controller
{
    private $cacheTime;

    public function __construct()
    {
        abort_if(!request()->ajax(), 403);

        $this->cacheTime = Carbon::now()->addDays(7);
    }

    /**
     * Filter word by category
     * @param  integer $categoryId
     * @return string  json
     */
    public function category($categorySlug)
    {
        $words = Word::whereHas('category', function ($category) use ($categorySlug) {
            return $category->whereSlug($categorySlug);
        })
            ->with('category')
            ->whereIsPublished(true)
            ->filter()
            ->sort()
            ->paginate();

        if (!empty(request())) {
            $words->appends(request()->all());
        }

        return response()->json($words);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $words = Word::filter()
            ->sort()
            ->with('category')
            ->paginate(20);

        if (!empty(request())) {
            $words->appends(request()->all());
        }

        return response()->json($words);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request    $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request    $request
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
