<?php
namespace App\Services;
use App\Models\Category;
class CategoryService{
    

    public function store($request)
    {
        if($request->validated())
        {
            $category = Category::create([
                'name_fr' => $request->name_fr,
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'icon' => $request->icon
            ]);
            if($category)
            {
             return response()->json($category, 200);   
            }
            return response()->json($category, 500);
        }
        return response()->json($request, 500);
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id)->delete();
        if($category)
        {
            return response()->json(['message' => 'deleted'], 200);
        }
        return response()->json(['message' => 'not found'], 500);
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->where('id',$id)->restore();
        if($category)
        {
            return response()->json(['message' => 'restored'], 200);
        }
        return response()->json(['message' => 'not found'], 500);
    }

    public function forceDestroy($id)
    {
        $category = Category::findOrFail($id)->forceDelete();
        if($category)
        {
            return response()->json(['message' => 'deleted'], 200);
        }
        return response()->json(['message' => 'not found'], 500);
    }

}