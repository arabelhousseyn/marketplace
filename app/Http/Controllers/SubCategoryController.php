<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Services\subCategoryService;
use App\Http\Requests\SubCategoryRequest;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected $subCategoryService;

     public function __construct()
     {
         return $this->subCategoryService = new subCategoryService();
     }

    public function index()
    {
      return $this->subCategoryService->index();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request)
    {
        return $this->subCategoryService->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        try {
            return response()->json($subCategory, 200);
        } catch (Throwable $th) {
            return response()->json(['message' => 'not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        try {
           $subCategory->update([
            'name_fr' => $request->name_fr,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'category_id' => $request->category_id
           ]);
            return response()->json($subCategory, 200);
        } catch (Throwable $th) {
            return response()->json(['message' => 'not found'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        return $this->subCategoryService->destroy($subCategory);
    }

    public function restore($id)
    {
        return $this->subCategoryService->restore($id);
    }

    public function forceDestroy($id)
    {
        return $this->subCategoryService->forceDestroy($id);
    }

    public function SubCategoriesByCategorie($id)
    {
        try {
            $subCategory = SubCategory::findOrFail($id);
            return response()->json($subCategory->categories, 200);
        } catch (Throwable $th) {
            return response()->json(['message' => 'nont found'], 500);
        }
    }
}
