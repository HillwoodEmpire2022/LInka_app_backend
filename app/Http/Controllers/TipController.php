<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use Illuminate\Http\Request;
use App\Http\Resources\TipResource;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreTipRequest;
use App\Http\Requests\UpdateTipRequest;
use App\Http\Resources\ProfileResource;

class TipController extends Controller
{
    //
 
        /**
     * Display a listing of the resource.
     * @return  \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * 
     * @return \Illuminate\Http\Response
     */


     /**
     * @OA\Get(
     *     path="/api/tips",
     *     summary="Get All Tips",
     *   tags={"Tips"},
     *  @OA\Response(response=200, description="Successful operation"),
    *   @OA\Response(response=400, description="Invalid request")
     * )
     */


    public function index()
    {
        //
        $tips = Tip::all();
        return TipResource::collection($tips);
        
    
    }

 /**
     * @OA\Post(
     *     path="/api/tip/create",
     *     summary="Create new tips",
     *   tags={"Tips"},
     *     @OA\Parameter(
     *         name="tip_title",
     *         in="query",
     *         description="Tip title",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="description about tips",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     * @OA\Parameter(
     *         name="image",
     *         in="query",
     *         description="Image",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="201", description="updated"),
     *     @OA\Response(response="401", description="unAuthorized")
     * )
     */


    public function store(StoreTipRequest $request){
        $user = $request->user(); 
        $data = $request->validated();
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('tips_img','public');
           }
           Tip::create(
            // 'user_id'=> $user->id,
            $data);
           return response()->json([
            'message'=>'tips created successfully',
            'data'=>$data,
           ]);
    }
     /**
     * @OA\Put(
     *     path="/api/tip/{tip}/update",
     *     summary="Update tips new tips",
     *   tags={"Tips"},
     *     @OA\Parameter(
     *         name="tip_title",
     *         in="query",
     *         description="Tip title",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="update tips tips",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     * @OA\Parameter(
     *         name="image",
     *         in="query",
     *         description="description about tips",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="updated"),
     *     @OA\Response(response="402", description="unAuthorized")
     * )
     */

  
    public function update(UpdateTipRequest $request, Tip $tip)
    {
       $data = $request->validated();
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('updated_img','public');
           }
           $tip->update($data);
           return new TipResource($tip);
    }
     /**
     * @OA\Get(
     *     path="/api/tip/{tip}/get",
     *     summary="Get Tip details",
     *   tags={"Tips"},
     *  @OA\Response(response=200, description="Successful operation"),
    *   @OA\Response(response=400, description="Invalid request")
     * )
     */

    public function show(Tip $tip){
        return new TipResource($tip);
    }
  /**
     * @OA\Delete(
     *     path="/api/tip/{tip}/delete",
     *     summary="Delete",
     *   tags={"Tips"},
     *  @OA\Response(response=200, description="deleted"),
    *   @OA\Response(response=401, description="UnAuthorized")
     * )
     */

    public function destroy(Tip $tip){
        $tip->delete();
        return response()->json([
            'message'=>'tip deleted successfully'
        ]);
    }
}
