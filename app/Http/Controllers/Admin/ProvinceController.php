<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['main_menu'] = 'Information';
        $data['sub_menu'] = 'Province';
        $data['title_page'] = 'Province';
        $data['menus'] = \App\Models\AdminMenu::ActiveMenu()->get();
        $data['Countriess'] = \App\Models\Countries::get();
        return view('Admin.v_province',$data);
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
            'country_id' => 'required',
            'name' => 'required|unique:provinces',
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $input_all;
                \App\Models\Province::insert($data_insert);
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
            if(isset($failedRules['name']['Unique'])) {
                $return['status'] = 2;
                $return['content'] = 'Name duplicate';
            } else if(isset($failedRules['name']['Required'])) {
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
        $result = \App\Models\Province::find($id);
        
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
        $result = \App\Models\Province::find($id);
        if ($result->name!=$input_all['name']) {
            $Valid = array('country_id' => 'required', 'name' => 'required|unique:provinces');
        } else {
            $Valid = array('country_id' => 'required', 'name' => 'required');
        }
        $validator = Validator::make($request->all(), $Valid);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $input_all;
                \App\Models\Province::where('id',$id)->update($data_insert);
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
            if(isset($failedRules['name']['Unique'])) {
                $return['status'] = 2;
                $return['content'] = 'Name duplicate';
            } else if(isset($failedRules['name']['Required'])) {
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
            \App\Models\Province::where('id',$id)->delete();
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
        $result = \App\Models\Province::select();
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
