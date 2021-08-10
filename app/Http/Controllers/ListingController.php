<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\User;
use App\Models\ListingAttribute;
use App\Models\ImageListing;
use App\Models\Image;
use App\Http\Requests\ListingRequest;
use App\Http\Resources\ListingResource;
use App\Http\Resources\UserResource;
use Auth;
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
               'user_id' => Auth::user()->id
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

               return response()->json($listing->with('attributes','images')->orderBy('id','DESC')->first(), 201);
           }else{
            return response()->json(['message' => 'error'], 500);
           }
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
            return response()->json(
                new ListingResource(Listing::with('attributes','categories','images','user')->findOrFail($id)),200
            );
            
        } catch (NotFoundHttpException $th) {
            return response()->json(['message' => 'not found'], 404);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ListingRequest $request, $id)
    {
        if(Auth::user())
        {
            try {
                $listing = Listing::findOrFail($id);
            $listing->update((array) $request->all());
                return response()->json(['message' => 'updated'], 204);
            } catch (NotFoundHttpException $th) {
                return response()->json(['message' => 'not found'], 404);
            }
        }
        return response()->json(['message' => 'you sould to be authenticated as user to handle the request'], 401);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       if(Auth::user())
       {
        try {
            $listing = Listing::findOrFail($id);
    
            $listing->delete();
            return response()->json(['message' => 'deleted'], 200);
        } catch (NotFoundHttpException $th) {
            return response()->json(['message' => 'not found'], 404);
        }
       }
       return response()->json(['message' => 'you sould to be authenticated as user to handle the request'], 401);
    }


    public function listingsByUser($username)
    {
       $user = User::withCount('listings')->where('username',$username)->first();
       if($user)
       {
        return new UserResource($user);
       }   
       
       return response()->json(['message' => 'not found'], 404);
    }
}
