<?php

namespace App\Http\Controllers;

use App\FacebookAdsCampaign;
use App\SocialAccount;
use App\UserSelectedAccount;
use App\RoasReport;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Mail\ConfirmEmail;
use App\Mail\CreateNewUser;
use Illuminate\Support\Facades\Mail;
use DB;

class UserManagementController extends Controller
{

    protected function validateCreateUser($credentials)
    {
        return Validator::make($credentials, [
            'email' => ['required', 'regex:/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i', 'unique:users'],
            'name' => ['required'],
            'phone_number' => ['required', 'regex:/([0-9])\b/', 'unique:users']
        ], [
            'email.required' => 'Email là trường bắt buộc!',
            'email.regex' => 'Email không hợp lệ!',
            'email.unique' => 'Email đã tồn tại',
            'name.required' => 'Tên là trường bắt buộc!',
            'name.regex' => 'Tên không hợp lệ!',
            'phone_number.required' => 'Số điện thoại là trường bắt buộc!',
            'phone_number.regex' => 'Số điện thoại không hợp lệ!',
            'phone_number.unique' => 'Số điện thoại đã tồn tại!'
        ]);
    }

    protected function validateEditUser($credentials, $id)
    {
        return Validator::make($credentials, [
            'email' => ['required', 'regex:/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i', 'unique:users,email,' . $id],
            'name' => ['required'],
            'phone_number' => ['nullable', 'regex:/([0-9])\b/', 'unique:users,phone_number,' . $id]
        ], [
            'email.required' => 'Email là trường bắt buộc!',
            'email.regex' => 'Email không hợp lệ!',
            'email.unique' => 'Email đã tồn tại',
            'name.required' => 'Tên là trường bắt buộc!',
            'name.regex' => 'Tên không hợp lệ!',
            'phone_number.required' => 'Số điện thoại là trường bắt buộc!',
            'phone_number.regex' => 'Số điện thoại không hợp lệ!',
            'phone_number.unique' => 'Số điện thoại đã tồn tại!'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('pages.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $this->validateCreateUser($request->all());
        if ($validated->fails()) {
            toastr()->error($validated->messages()->first());
            return redirect('/users')->withErrors($validated);
        }
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'is_active' => '1'
        ]);
        $user->save();
        Mail::to($user->email)->send(new CreateNewUser($user));
        if (count(Mail::failures()) > 0) {
            toastr()->error('Có lỗi xảy ra khi gửi mail. Hãy thử lại sau!');
            return redirect(route('authenticate.register'))->with('danger', 'Có lỗi xảy ra khi gửi mail. Hãy thử lại sau!');
        } else {
            toastr()->success('User saved!');
            return redirect('/users')->with('success', 'User saved!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::findOrFail($id);
        return view('pages.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        return view('pages.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $validated = $this->validateEditUser($request->all(), $user->id);

        if ($validated->fails()) {
            toastr()->error($validated->messages()->first());
            return redirect('/users')->withErrors($validated);
        }

        if (isset($request->is_active)) {
            $user->is_active = 1;
        } else {
            $user->is_active = 0;
        }

        $user->update($request->all());
        if (isset($request->permission)) {
            $data = implode(',', $request->permission);
        } else {
            $data = "";
        }
        $user->update(['permission' => $data]);


        toastr()->success('User updated successfully!');
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            FacebookAdsCampaign::where('user_id', $user->id)->delete();
            SocialAccount::where('user_id', $user->id)->delete();
            UserSelectedAccount::where('user_id', $user->id)->delete();
            RoasReport::where('user_id', $user->id)->delete();
            \App\FacebookAdsDataMonthly::where('user_id', $user->id)->delete();
            \App\FacebookAdsCampaign::where('user_id', $user->id)->delete();
            $user->delete();
            toastr()->success('User deleted successfully!');
            DB::commit();
        } catch (\Exception $e) {
            toastr()->error('Something went wrong.' . $e->getMessage());
            DB::rollback();
        }

        return redirect()->route('users.index');
    }
}
