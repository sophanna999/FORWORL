<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['main_menu'] = 'Member';
        $data['sub_menu'] = 'Member';
        $data['title_page'] = 'Member';
        $data['menus'] = \App\Models\AdminMenu::ActiveMenu()->get();
        $data['Provinces'] = \App\Models\Province::get();
        $data['Withdraws'] = \App\Models\Withdraw::where('show_status','T')->get();
        $data['Countriess'] = \App\Models\Countries::get();
        return view('Admin.member',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input_all = $request->all();
        $input_all['show_status'] = $request->input('show_status','F');
        $input_all['password'] = \Hash::make($input_all['password']);
        $input_all['created_at'] = date('Y-m-d H:i:s');
        $input_all['money'] = 0;
        $input_all['updated_at'] = date('Y-m-d H:i:s');

        $validator = Validator::make($request->all(), [
             'firstname' => 'required',
             'lastname' => 'required',
             'password' => 'required|min:4|max:16',
             'username' => 'unique:users',
             'mobile' => 'numeric|min:10|max:10',
             'email' => 'email|unique:admin_users',

        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $input_all;
                \App\Models\User::insert($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Success';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Unsuccess '.$e->getMessage();
            }
        }else{
            $failedRules = $validator->failed();
            if(isset($failedRules['username']['Unique'])) {
                $return['status'] = 2;
                $return['content'] = 'Username duplicate';
            } elseif(isset($failedRules['firstname']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Firstname not required';
            } elseif(isset($failedRules['lastname']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Lastname not required';
            } elseif(isset($failedRules['mobile']['Numeric'])) {
                $return['status'] = 2;
                $return['content'] = 'Number only';
            } elseif(isset($failedRules['mobile']['Max'])) {
                $return['status'] = 2;
                $return['content'] = '10 charecter only';
            } elseif(isset($failedRules['email']['Unique'])) {
                $return['status'] = 2;
                $return['content'] = 'Email duplicate';
            } elseif(isset($failedRules['email']['Email'])) {
                $return['status'] = 2;
                $return['content'] = 'Email format only';
            } elseif(isset($failedRules['password']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Password not required';
            }elseif(isset($failedRules['password']['Max'])) {
                $return['status'] = 2;
                $return['content'] = 'Password and max length 16';
            }elseif(isset($failedRules['password']['Min'])) {
                $return['status'] = 2;
                $return['content'] = 'Password min length 4';
            } else {
                $return['status'] = 0;
            }
        }
        $return['title'] = 'Created';
        return json_encode($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = \App\Models\User::find($id);

        return json_encode($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $input_all = $request->all();
        $input_all['show_status'] = $request->input('show_status','F');
        $input_all['ban'] = $request->input('ban','F');
        $input_all['updated_at'] = date('Y-m-d H:i:s');

        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            // 'password' => 'required|min:4|max:16',
            'username' => 'unique:users',
            'mobile' => 'numeric|min:10|max:10',
            'email' => 'email|unique:admin_users',
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $input_all;
                \App\Models\User::where('id',$id)->update($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Success';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Unsuccess '.$e->getMessage();
            }
        }else{
            $failedRules = $validator->failed();
            if(isset($failedRules['username']['Unique'])) {
                $return['status'] = 2;
                $return['content'] = 'Username duplicate';
            } elseif(isset($failedRules['firstname']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Firstname not required';
            } elseif(isset($failedRules['lastname']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Lastname not required';
            } elseif(isset($failedRules['mobile']['Numeric'])) {
                $return['status'] = 2;
                $return['content'] = 'Moblie required number only';
            } elseif(isset($failedRules['mobile']['Max'])) {
                $return['status'] = 2;
                $return['content'] = 'Moblie required 10 charecter only';
            } elseif(isset($failedRules['mobile']['min'])) {
                $return['status'] = 2;
                $return['content'] = 'Moblie required 10 charecter only';
            } elseif(isset($failedRules['email']['Unique'])) {
                $return['status'] = 2;
                $return['content'] = 'Email duplicate';
            } elseif(isset($failedRules['email']['Email'])) {
                $return['status'] = 2;
                $return['content'] = 'Email format only';
            } elseif(isset($failedRules['password']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Password not required';
            }elseif(isset($failedRules['password']['Max'])) {
                $return['status'] = 2;
                $return['content'] = 'Password and max length 16';
            }elseif(isset($failedRules['password']['Min'])) {
                $return['status'] = 2;
                $return['content'] = 'Password min length 4';
            } else {
                $return['status'] = 0;
            }
        }
        $return['title'] = 'Updated';
        return json_encode($return);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::beginTransaction();
        try {
            \App\Models\User::where('id',$id)->delete();
            \DB::commit();
            $return['status'] = 1;
            $return['content'] = 'Success';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status'] = 0;
            $return['content'] = 'Unsuccess '.$e->getMessage();
        }
        $return['title'] = 'Deleted';
        return $return;
    }

    public function Lists(){
        $result = \App\Models\User::leftjoin('provinces','users.province_id','=','provinces.id')->leftjoin('countries','users.country_id','=','countries.id')->select('users.*', 'provinces.name as province_name','countries.name as country_name');
        return \Datatables::of($result)
        ->addIndexColumn()
        ->addColumn('name',function($rec) {
            return $rec->firstname.' '.$rec->lastname.' ('.$rec->nickname.')';
        })
        ->addColumn('action',function($rec){
            $str='
                <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="Edit">
                    <i class="ace-icon fa fa-edit bigger-120"></i>
                </button>
                <button  data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-info btn-condensed btn-change-password btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="Change password">
                    <i class="ace-icon fa fa-key bigger-120"></i>
                </button>
                <button  class="btn btn-xs btn-danger btn-condensed btn-delete btn-tooltip" data-id="'.$rec->id.'" data-rel="tooltip" title="Delete">
                    <i class="ace-icon fa fa-trash bigger-120"></i>
                </button>
            ';
            return $str;
        })->make(true);
    }
    public function Changepassword(Request $request) {
        $input_all = $request->all();
        $input_all['password'] = \Hash::make($input_all['password']);
        $input_all['updated_at'] = date('Y-m-d H:i:s');
        unset($input_all['id']);
        $validator = Validator::make($request->all(), [
             'password' => 'required|min:4|max:16',
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $input_all;
                \App\Models\User::where('id',$request->id)->update($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Success';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Unsuccess '.$e->getMessage();
            }
        }else{
            $failedRules = $validator->failed();
            if(isset($failedRules['password']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Password not required';
            }
            elseif(isset($failedRules['password']['Min'])) {
                $return['status'] = 2;
                $return['content'] = 'Password min length 4';
            }elseif(isset($failedRules['password']['Max'])) {
                $return['status'] = 2;
                $return['content'] = 'Password max length 16';
            } else {
                $return['status'] = 0;
            }
        }
        $return['title'] = 'Change password';
        return json_encode($return);
    }
}
