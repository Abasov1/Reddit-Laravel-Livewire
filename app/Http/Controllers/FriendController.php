<?php

namespace App\Http\Controllers;

use App\Models\Subreddit;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule as ValidationRule;
use Intervention\Image\Facades\Image;

class FriendController extends Controller
{
    public function index(User $user){
        $userId = $user->id;
        $quzers = DB::table('user_user')->where('user_id', $userId)->get()->pluck('friend_id');
        $friends = User::whereIn('id',$quzers)->get();
        $uqar = $user;
        if(DB::table('friendrequest')->where('friend_id',auth()->user()->id)->exists()){
            $requests = DB::table('friendrequest')->where('friend_id',auth()->user()->id)->get();
            $userIds = collect($requests)->pluck('user_id');
            $rusers = User::whereIn('id',$userIds)->get();
        }
        return view('friends',get_defined_vars());
    }
    public function settings(User $user){
        if($user->id === auth()->user()->id){
            return view('other.settings',get_defined_vars());
        }
        return back();
    }
    public function settingsedit(User $user){
        if($user->id === auth()->user()->id){
            $editselected = "";
            return view('other.settings',get_defined_vars());
        }
        return back();
    }
    public function subsettings(Subreddit $subreddit){
        if($subreddit->creator_id === auth()->user()->id){
            if(DB::table('notifications')->where('subreddit_id',$subreddit->id)->exists()){
                $requests = DB::table('notifications')->where('subreddit_id',$subreddit->id)->get();
                $userIds = collect($requests)->pluck('duduk_id');
                $requestedmodss = User::whereIn('id',$userIds)->get();
            }
            return view('other.subsettings',get_defined_vars());
        }
        return back();
    }
    public function add(User $user){
        $auser = auth()->user();
        if(!$user->isFriend()){
        if($auser->isRequested($user)){
            $friendrequest = DB::table('notifications')->where(['user_id'=>$user->id,'duduk_id'=>$auser->id]);
            $friendrequest->delete();
            $auser->sendNotification($user->id,null,null,null,null,'friendrequestaccepted');
            $user->friends()->attach($auser, ['created_at' => now(), 'updated_at' => now()]);
            $auser->friends()->attach($user, ['created_at' => now(), 'updated_at' => now()]);
        }elseif(!$user->isRequested($auser)){
            auth()->user()->sendNotification($user->id,null,null,null,null,'friendrequest');
        }

        // if(DB::table('friendrequest')->where('user_id',$user->id)->where('friend_id',$auser->id)->exists()){
        //     $user->friendRequest()->detach($auser);
        //     $user->friends()->attach($auser, ['created_at' => now(), 'updated_at' => now()]);
        //     $auser->friends()->attach($user, ['created_at' => now(), 'updated_at' => now()]);
        //     return back();
        // }
        // if(!DB::table('friendrequest')->where('user_id',$auser->id)->where('friend_id',$user->id)->exists()){
        //     $auser->friendRequest()->attach($user);
        //     return back();
        // }
    }
        return back();
    }
    public function unadd(User $user){
        $auser = auth()->user();
        $friendrequest = DB::table('notifications')->where(['user_id'=>$user->id,'duduk_id'=>$auser->id]);
        if($friendrequest->exists()){
            $friendrequest->delete();
            $auser->sendNotification($user->id,null,null,null,null,'friendrequestaccepted');
            $user->friends()->attach($auser, ['created_at' => now(), 'updated_at' => now()]);
            $auser->friends()->attach($user, ['created_at' => now(), 'updated_at' => now()]);
        }
        // if($user->friendRequest()->where('friend_id',$auser->id)->exists()){
        //     $user->friendRequest()->detach($auser);
        //     $user->friends()->attach($auser, ['created_at' => now(), 'updated_at' => now()]);
        //     $auser->friends()->attach($user, ['created_at' => now(), 'updated_at' => now()]);
        //     return back();
        // }
        return back();
    }
    public function ignore(User $user){
        $auser = auth()->user();
        $friendrequest = DB::table('notifications')->where(['user_id'=>$user->id,'duduk_id'=>$auser->id]);
        if($friendrequest->exists()){
            $friendrequest->delete();
            $auser->sendNotification($user->id,null,null,null,null,'friendrequestdenied');
        }
        return back();
    }
    public function leave(User $user){
        $auser = auth()->user();
        if($auser->friends()->where('friend_id',$user->id)->exists()){
            $auser->friends()->detach($user);
            $user->friends()->detach($auser);
            $auser->sendNotification($user->id,null,null,null,null,'friendshipended');
        }
        return back();
    }
    public function ppupdate(User $user,Request $request){
        if($user->id != auth()->user()->id){
            return back();
        }
        if($request->hasFile('image')){
            Storage::disk('public')->delete($user->image);
            $image = Image::make($request->file('image'));

            // crop the image to a square
            $image->fit(300, 300);

            $ex = $request->file('image')->getClientOriginalExtension();
            $file = uniqid() .'.'. $ex;
            $folderPath = "storage/images/";
            $image->save(public_path('storage/' .$file));
            $user->update([
                'image' => $file,
            ]);
            return redirect('/homes/'.$user->id);
        }
    }
    public function userupdate(User $user,Request $request){
        if($user->id != auth()->user()->id){
            return back();
        }
        if($request->hasFile('image')){
            Storage::disk('public')->delete($user->image);
            $image = Image::make($request->file('image'));

            // crop the image to a square
            $image->fit(300, 300);

            $ex = $request->file('image')->getClientOriginalExtension();
            $file = uniqid() .'.'. $ex;
            $folderPath = "storage/images/";
            $image->save(public_path('storage/' .$file));
            $user->update([
                'image' => $file
            ]);
        }
        $request->validate([
            'name' => [
                'required',
                'max:20',
                ValidationRule::unique('users')->ignore($user->id),
        ],
            'password' => 'required|min:6',
            'email' => [
                'required',
                'max:20',
                'email',
                ValidationRule::unique('users')->ignore($user->id),
            ],
        ]);
        $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email,
        ]);

        return redirect('/settingsedit/'.$user->id);
    }
    public function confirmate(Request $request){
        $user = Auth::user();
        $password = $request->input('password');

        if (Hash::check($password, $user->password)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

}
