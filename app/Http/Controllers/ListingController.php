<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\ListingAttribute;
use App\Models\ImageListing;
use App\Models\Image;
use App\Http\Requests\ListingRequest;
use App\Http\Resources\ListingResource;
class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return response()->json(
             ListingResource::collection(Listing::with('images')->AvailableAndArrang(0,'DESC')->get())
            , 200
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListingRequest $request)
    {
       if($request->validated())
       {
           $listing = Listing::create([
               'title' => $request->title,
               'price' => $request->price,
               'description' => $request->description,
               'location' => $request->location,
               'category_id' => $request->category_id,
               'available' => 0,
           ]);
           if($listing)
           {
               $attrs = json_decode($request->attributess,true);
               
               foreach ($attrs as $attr) {
                $attributes = new ListingAttribute((array) $attr);
                $listing->attributes()->save($attributes);
               }

                       for ($i=0; $i <$request->numberImages; $i++) {
                        $imageName = 'images' . $i; 
                        $file = $request->$imageName;
                        $path = $file->getClientOriginalName() . '.' . $file->extension();
                        $file->storeAs('public/listing',$path);
                
                       $image = Image::create([
                            'url' => $path,
                        ]);
                        ImageListing::create([
                            'image_id' => $image->id,
                            'listing_id' => $listing->id,
                        ]);
                       }

               return response()->json($listing->with('attributes','images')->orderBy('id','DESC')->first(), 200);
           }else{
            abort(500,['message' => 'error']);
           }
       }else{
           abort(500,['message' => $request]);
       }
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
            $listing = Listing::findOrFail($id)->with('attributes')->get();
            return response()->json($listing, 200);
            
        } catch (NotFoundHttpException $th) {
            return response()->json(['message' => 'not found'], 404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            $listing = Listing::findOrFail($id);
    
        $listing->update([
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
            'location' => $request->location,
            'category_id' => $request->category_id,
            'available' => $request->available
        ]);
            return response()->json($listing, 200);
        } catch (NotFoundHttpException $th) {
            return response()->json(['message' => 'not found'], 404);
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
        try {
            $listing = Listing::findOrFail($id);
    
            $listing->delete();
            return response()->json($listing, 200);
        } catch (NotFoundHttpException $th) {
            return response()->json(['message' => 'not found'], 404);
        }
    }
}
