<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Ilsyaa;
use App\Helpers\Metavis;
use App\Http\Controllers\Controller;
use App\Models\License;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProductLibrary;
use App\Models\Product;
use App\Models\WebMaster;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class FProfileController extends Controller
{
    public function index(User $user)
    {
        $meta = [
            'meta_title' => $user->name,
            'meta_description' => 'username@' . $user->username,
            'meta_image' => $user->avatar(),
        ];
        return Metavis::view('profile.index', [
            'me' => $user,
            'about_md' => Metavis::parse_md($user->about),
            'meta' => $meta,
        ]);
    }

    public function settings(Request $request)
    {
        $route = $request->route()->getName();
        if ($route == 'front.profile.settings.security') {
            $view = 'profile.settings_security';
            $meta_title = 'Security';
        } else if ($route == 'front.profile.settings.whatsapp') {
            $view = 'profile.settings_whatsapp';
            $meta_title = 'WhatsApp';
        } else {
            $view = 'profile.settings_account';
            $meta_title = 'Info';
        }
        return Metavis::view($view, [
            'me' => auth()->user(),
            'webmaster' => WebMaster::first(),
            'meta' => [
                'meta_title' => 'Settings - ' . $meta_title,
                'meta_description' => 'Settings - ' . $meta_title,
                'robots' => 'noindex, nofollow',
            ],
        ]);
    }

    public function settings_update(Request $request, $type)
    {
        $user = auth()->user();
        if ($type == 'info') {
            $request->validate([
                'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
                'username' => ['required', Rule::unique('users')->ignore($user->id)],
                'name' => 'required|string|max:100',
                'about' => 'nullable|string',
            ]);
            $user->name = $request->name;
            $user->username = $request->username;
            if ($user->email != $request->email) {
                $user->email = $request->email;
                $user->email_verified_at = null;
                $user->sendEmailVerificationNotification();
                $tot = '<i class="bi bi-check2-all"></i> <small>We have sent a verification code to your new email.<br> check in inbox. if there is no check the spam section.</small>';
            } else {
                $tot = '<i class="bi bi-check2-all"></i> Profile updated!';
            }
            $user->about = $request->about;
            $user->save();
            return redirect()->back()->with('success', $tot);
        } else if ($type == 'security') {
            if (!password_verify($request->current_password, $user->password)) {
                return redirect()->back()->with('error', 'Password is incorrect!');
            }
            $request->validate([
                'new_password' => ['required', 'min:8'],
                'new_password_confirmation' => ['required', 'same:new_password']
            ], ['new_password_confirmation.same' => 'The new password confirmation does not match.']);

            $user->password = bcrypt($request->new_password);
            $user->save();
            return redirect()->back()->with('success', '<i class="bi bi-check2-all"></i> Password updated!');
        } else if ($type == 'whatsapp') {
            $user->whatsapp = null;
            $user->save();
            return redirect()->back()->with('success', '<i class="bi bi-check2-all"></i> Whatsapp number has been removed.');
        } else if ($type == 'avatar') {
            $request->validate([
                'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1048'],
            ]);
            if ($request->hasFile('avatar')) {
                if ($user->avatar) {
                    if (Storage::exists($user->avatar)) {
                        Storage::delete($user->avatar);
                    }
                }
                $user->avatar = $request->file('avatar')->store('avatar');
            }
            $user->save();
            return redirect()->back()->with('success', '<i class="bi bi-check2-all"></i> Avatar updated!');
        }
    }

    public function library()
    {
        $data['library'] = ProductLibrary::where('user_id', auth()->user()->id);
        $data['me'] = auth()->user();
        $data['meta'] = [
            'meta_title' => 'Library',
            'meta_description' => 'This is your purchased item which will be stored here.',
        ];
        return Metavis::view('profile.library.index', $data);
    }

    public function download()
    {
        $query = ProductLibrary::where([
            'id' => request()->query('id'),
            'user_id' => auth()->user()->id
        ]);
        if ($query->count()) {
            $data['row'] = $query->first();
        } else {
            abort(404);
        }
        return view('frontend.profile.library.download', $data);
    }

    public function library_store($id)
    {
        $query = Product::where([
            'id' => $id,
            'product_type' => 'free'
        ]);
        if ($query->count() == 0) {
            return Metavis::abort('LOL', 'This item is for sale idiot.', [
                'title' => 'GO BACK KIDS',
                'url' => route('front.product.category')
            ]);
        }
        $query = ProductLibrary::where([
            'user_id' => auth()->user()->id,
            'product_id' => $id
        ]);
        if ($query->count() == 0) {
            $license_unique = Ilsyaa::license_unique();
            $slug_unique = Ilsyaa::slug_unique();

            ProductLibrary::create([
                'user_id' => auth()->user()->id,
                'product_id' => $id,
                'payment_id' => 'free',
                'license' => $license_unique
            ]);

            License::create([
                'item_id' => $id,
                'license' => $license_unique,
                'slug' => $slug_unique,
                'used' => 'yes',
                'type' => 'product'
            ]);
            return redirect()->route('front.library.index')->with('success', 'Item added to library.');
        } else {
            return redirect()->route('front.library.index')->with('success', 'You already have this item in your library.');
        }
    }
}
