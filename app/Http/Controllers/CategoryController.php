<?php

namespace App\Http\Controllers;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Services\CategoryService;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected $CategoryService;

     public function __construct(CategoryService $CategoryService)
     {
         $this->CategoryService = $CategoryService;
     }


    public function index()
    {
        return response()->json(Category::whereNull('parent_id')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        return $this->CategoryService->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return response()->json(Category::findOrFail($id), 200);
        } catch (Throwable $th) {
            return response()->json(['message' => 'not found'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
           $category->update([
            'name_fr' => $request->name_fr,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'icon' => $request->icon
           ]);
            return response()->json($category, 200);
        } catch (Throwable $th) {
            return response()->json(['message' => 'not found'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->CategoryService->destroy($id);
        
    }

    public function restore($id)
    {
        return $this->CategoryService->restore($id); 
    }

    public function forceDestroy($id)
    {
        return $this->CategoryService->forceDestroy($id);  
    }

    public function SubCategoriesByCategorie($id)
    {
        try {
            $category = Category::findOrFail($id);
            return response()->json($category->children, 200);
        } catch (Throwable $th) {
            return response()->json(['message' => 'nont found'], 404);
        }
    }
}
