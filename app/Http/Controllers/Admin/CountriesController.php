<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['main_menu'] = 'Information';
        $data['sub_menu'] = 'Countries';
        $data['title_page'] = 'Countries';
        $data['menus'] = \App\Models\AdminMenu::ActiveMenu()->get();
        
        return view('Admin.v_countries',$data);
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
        
        $input_all['created_at'] = date('Y-m-d H:i:s');
        $input_all['updated_at'] = date('Y-m-d H:i:s');

        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:countries',
            'name' => 'required|unique:countries',
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $input_all;
                \App\Models\Countries::insert($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Finish';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Fail'.$e->getMessage();;
            }
        }else{
            $failedRules = $validator->failed();
            if(isset($failedRules['code']['Unique'])) {
                $return['status'] = 2;
                $return['content'] = 'Code duplicate';
            } else if(isset($failedRules['name']['Unique'])) {
                $return['status'] = 2;
                $return['content'] = 'Name duplicate';
            }  else if(isset($failedRules['code']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Name not required';
            }  else if(isset($failedRules['name']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Name not required';
            } else {
                $return['status'] = 0;
            }
        }
        $return['title'] = 'Create data';
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
        $result = \App\Models\Countries::find($id);
        
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
        
        $input_all['updated_at'] = date('Y-m-d H:i:s');

        $Valid = [];
        $result = \App\Models\Countries::find($id);
        if ($result->name!=$input_all['code']) {
            $Valid = array('code' => 'required|unique:countries', 'name' => 'required');
        } else if ($result->name!=$input_all['name']) {
            $Valid = array('code' => 'required', 'name' => 'required|unique:countries');
        } else {
            $Valid = array('code' => 'required', 'name' => 'required');
        }
        
        $validator = Validator::make($request->all(), $Valid);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $input_all;
                \App\Models\Countries::where('id',$id)->update($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Finish';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Fail'.$e->getMessage();;
            }
        }else{
            $failedRules = $validator->failed();
            if(isset($failedRules['code']['Unique'])) {
                $return['status'] = 2;
                $return['content'] = 'Code duplicate';
            } else if(isset($failedRules['name']['Unique'])) {
                $return['status'] = 2;
                $return['content'] = 'Name duplicate';
            }  else if(isset($failedRules['code']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Name not required';
            }  else if(isset($failedRules['name']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Name not required';
            } else {
                $return['status'] = 0;
            }
        }
        $return['title'] = 'Edit data';
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
            \App\Models\Countries::where('id',$id)->delete();
            \DB::commit();
            $return['status'] = 1;
            $return['content'] = 'Finish';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status'] = 0;
            $return['content'] = 'Fail'.$e->getMessage();;
        }
        $return['title'] = 'Delete data';
        return $return;
    }

    public function Lists(){
        $result = \App\Models\Countries::select();
        return \Datatables::of($result)
        
        ->addColumn('action',function($rec){
            $str='
                <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="Edit">
                    <i class="ace-icon fa fa-edit bigger-120"></i>
                </button>
                <button  class="btn btn-xs btn-danger btn-condensed btn-delete btn-tooltip" data-id="'.$rec->id.'" data-rel="tooltip" title="Delete">
                    <i class="ace-icon fa fa-trash bigger-120"></i>
                </button>
            ';
            return $str;
        })->rawColumns(['action'])->addIndexColumn()->make(true);
    }

}
