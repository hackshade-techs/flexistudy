<?php

namespace App\Http\Controllers\Frontend\User;

use Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use App\Models\Access\User\User;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;
use App\Repositories\Frontend\Access\User\UserRepository;

/**
 * Class ProfileController.
 */
class ProfileController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;
    protected $imageManager;

    /**
     * ProfileController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user, ImageManager $imageManager)
    {
        $this->user = $user;
        $this->imageManager = $imageManager;
    }

    /**
     * @param UpdateProfileRequest $request
     *
     * @return mixed
     */
    public function update(UpdateProfileRequest $request)
    {
        
        $output = $this->user->updateProfile(access()->id(), $request->only('username', 'first_name', 'last_name', 'bio', 'tagline', 'facebook', 'youtube', 'twitter', 'linkedin', 'web', 'github',  'email'));

        // E-mail address was updated, user has to reconfirm
        if (is_array($output) && $output['email_changed']) {
            access()->logout();

            return redirect()->route('frontend.auth.login')->withFlashInfo(trans('strings.frontend.user.email_changed_notice'));
        }

        return redirect()->route('frontend.user.account')->withFlashSuccess(trans('strings.frontend.user.profile_updated'));
    }
    
    public function updateAvatar(Request $request, $user)
    {
        
        $user = User::where('username', $user)->first();
        
        $oldImage = $user->avatar; // delete the old image from the file system after new one is uploaded
        
        $processedImage = $this->imageManager->make($request->file('files')->getPathName())
            ->fit(70, 70, function ($c) {
                $c->aspectRatio();
            })
            ->encode('png')
            ->save(public_path('uploads/avatars/' . $filename = uniqid() . '.png'));
        
        $user->avatar = $filename;
        $user->save();
        
        if(!is_null($oldImage)){
            if(Storage::disk('server')->exists('avatars/'.$oldImage)){
                Storage::disk('server')->delete('avatars/'.$oldImage);
            }
        }
        $path = '/uploads/avatars/'.$user->avatar; 
        
        return response()->json($path, 200);
    }
}
