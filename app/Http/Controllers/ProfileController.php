<?php

namespace App\Http\Controllers;

use App\Enums\ProfileReactionEnum;
use App\Enums\ProfileReactions;
use App\Models\Profile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\ProfileAttachment;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\ProfileReaction;

class ProfileController extends Controller
{
    //
 
       /**
     * @OA\Get(
     *     path="/api/profiles",
     *     summary="Get all  User Profiles",
     *   tags={"Profile"},
     *  @OA\Response(response=200, description="Successful"),
    *   @OA\Response(response=400, description="Invalid request")
     * )
     */


    public function index(){

        $data = Profile::query()->orderBy('id','desc');
        return ProfileResource::collection($data);
    }

    /**
     * @OA\Post(
     *     path="/api/profile/create",
     *     summary="Create new Profile",
     *   tags={"Profile"},
     *     @OA\Parameter(
     *         name="firstName",
     *         in="query",
     *         description="firstname",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="lastName",
     *         in="query",
     *         description="lastname",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="nickName",
     *         in="query",
     *         description="nickname",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="age",
     *         in="query",
     *         description="age",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="gender",
     *         in="query",
     *         description="gender",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="country",
     *         in="query",
     *         description="country",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
    *      @OA\Parameter(
     *         name="weight",
     *         in="query",
     *         description="weight",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
        *      @OA\Parameter(
     *         name="height",
     *         in="query",
     *         description="height",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
        *      @OA\Parameter(
     *         name="personalInfo",
     *         in="query",
     *         description="personalInfo",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="sexualOrientation",
     *         in="query",
     *         description="sexualOrientation",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
    *      @OA\Parameter(
     *         name="lookingFor",
     *         in="query",
     *         description="lookingFor",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
       *      @OA\Parameter(
     *         name="lookingDescription",
     *         in="query",
     *         description="lookingDescription",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     * @OA\Parameter(
     *         name="profileImagePath",
     *         in="query",
     *         description="user Profile Image",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="201", description="updated"),
     *     @OA\Response(response="401", description="unAuthorized")
     * )
     */


    public function store(StoreProfileRequest $request){
        $data = $request->validated();
       $user =  $request->user();
         $image = $data['profileImagePath'] ?? null;
          // Check if image was given and save on local file system

          if($image){
            $relativepath = $this->saveImage($image);
            $data['profileImagePath'] = URL::to((Storage::url($relativepath)));
            $data['image_mime'] = $image->getClientMimeType();
            $data['image_size'] = $image->getSize();
          }
        $profile = Profile::create($data);
        //  if($request->hasFile('profileAttachments')){
        //     foreach($request->file('profileAttachments') as $image){
        //         $imageName = $image->getClientOriginalName();
        //         $image->move(public_path('attachments'),$imageName);
        //         $profileAttachment = new ProfileAttachment(['image'=>$imageName]);
        //         $profile->attachments()->save($profileAttachment);
        //      }

        //  }
            return new ProfileResource($profile);
        
    }

    public function update(UpdateProfileRequest $request,Profile $profile){

        $data = $request->validated();
          $image = $data['profileImagePath'] ?? null;
           // Check if image was given and save on local file system
           if($image){
             $relativepath = $this->saveImage($image);
             $data['profileImagePath'] = URL::to((Storage::url($relativepath)));
             $data['image_mime'] = $image->getClientMimeType();
             $data['image_size'] = $image->getSize();
           }

           $profile->update($data);
           return new ProfileResource($profile);
    }
    public function show(Profile $profile){
        return new ProfileResource($profile);
    }
//  // Method to get all reactions made on a single profile
//     public function getReactions(Profile $profile)
//     {
//         // Eager load the reactions with the profile
//         $profileWithReactions = Profile::with('reactions')->find($profile->id);

//         return response()->json(['success' => true, 'profile' => $profileWithReactions]);
//     }

       public function getReactions(Profile $profile)
    {
        // Eager load the reactions with the user details
        $profileWithReactions = Profile::with(['reactions' => function ($query) {
            $query->with('user:id,name,email'); // Load user details (you can customize what you want to load)
        }])->find($profile->id);

        return response()->json(['success' => true, 'profile' => $profileWithReactions]);
    }
    


    public function profileReaction(Request $request,Profile $profile){
    $user = $request->user(); 
    $data = $request->validate([
        'type'=>[Rule::enum(ProfileReactionEnum::class)],
    ]);

    $userId = Auth::id();
    $reaction =  ProfileReaction::where('user_id',$userId)->where('profile_id',$profile->id)->first();
    
    if($reaction){
$reaction->delete();
    }
    
    else{
        ProfileReaction::create([
            'profile_id'=>$profile->id,
             'user_id'=> $user->id,
            'type'=>$data['type']
        ]);
    }
    $reactions = ProfileReaction::where('profile_id',$profile->id)->count();
    return response(['success'=>true,
     'reactions'=>$reactions
]);



}



  public function destroy(Profile $profile){
    $id = Auth::id();
    $profile->delete();
    return response()->json([
    'message'=>'profile deleted successfully'
    ]);
  }
    private function saveImage(UploadedFile $image)
    {
        $path = 'images/' . Str::random();
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path, 0755, true);
        }
        if (!Storage::putFileAS('public/' . $path, $image, $image->getClientOriginalName())) {
            throw new \Exception("Unable to save file \"{$image->getClientOriginalName()}\"");
        }
        return $path . '/' . $image->getClientOriginalName();
    }


    private function saveProfileAttachment(UploadedFile $profileAttachment)
    {
        $path = 'images/' . Str::random();
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path, 0755, true);
        }
        if (!Storage::putFileAS('public/' . $path, $profileAttachment, $profileAttachment->getClientOriginalName())) {
            throw new \Exception("Unable to save file \"{$profileAttachment->getClientOriginalName()}\"");
        }
        return $path . '/' . $profileAttachment->getClientOriginalName();
    }
}
