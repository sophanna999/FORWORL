<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['main_menu'] = 'Information';
        $data['sub_menu'] = 'Categories';
        $data['title_page'] = 'Categories';
        $data['menus'] = \App\Models\AdminMenu::ActiveMenu()->get();

        return view('Admin.v_categories',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $input_all['created_at'] = date('Y-m-d H:i:s');

        if (isset($input_all['photo'])) {
            if (Storage::disk("uploads")->exists("temp/" . $input_all['photo'][0])) {
                Storage::disk("uploads")->copy("temp/" . $input_all['photo'][0], "Categories/" . $input_all['photo'][0]);
                Storage::disk("uploads")->delete("temp/" . $input_all['photo'][0]);
            }
        }
        $validator = Validator::make($request->all(), [
            'name' => 'unique:categories',
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = array('name' => $input_all['name'],
                                     'detail' => $input_all['detail'],
                                     'show_status' => $input_all['show_status'],
                                     'created_at' => $input_all['created_at'],
                                    );
                if (!empty($input_all['photo'])) {
                    $data_insert['photo'] = $input_all['photo'][0];
                } else {
                    $data_insert['photo'] = NULL;
                }
                \App\Models\Categories::insert($data_insert);
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
        $result = \App\Models\Categories::find($id);
        if(isset($result)){
            if(!empty($result->photo)){
                if(Storage::disk("uploads")->exists("Categories/".$result->photo)){
                    if(Storage::disk("uploads")->exists("temp/".$result->photo)){
                        Storage::disk("uploads")->delete("temp/".$result->photo);
                    }
                    Storage::disk("uploads")->copy("Categories/".$result->photo,"temp/".$result->photo);
                }
            }
        }
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
        $input_all['updated_at'] = date('Y-m-d H:i:s');

        if (!empty($input_all['photo'])) {
            if (Storage::disk("uploads")->exists("temp/" . $input_all['photo'][0])) {
                if (Storage::disk("uploads")->exists("Categories/" . $input_all['photo'][0])) {
                    Storage::disk("uploads")->delete("temp/" . $input_all['photo'][0]);
                } else {
                    Storage::disk("uploads")->copy("temp/" . $input_all['photo'][0], "Categories/" . $input_all['photo'][0]);
                    Storage::disk("uploads")->delete("temp/" . $input_all['photo'][0]);
                }
            }
        }
        if (!empty($input_all['org_photo'])) {
            if (!empty($input_all['photo'])) {
                if ($input_all['org_photo']!=$input_all['photo'][0]) {
                    Storage::disk("uploads")->delete("temp/" . $input_all['org_photo']);
                    Storage::disk("uploads")->delete("Categories/" . $input_all['org_photo']);
                }
            } else {
                Storage::disk("uploads")->delete("temp/" . $input_all['org_photo']);
                Storage::disk("uploads")->delete("Categories/" . $input_all['org_photo']);
            }
        }
        unset($input_all['org_photo']);

        $Valid = [];
        $result = \App\Models\Categories::find($id);
        if ($result->name!=$input_all['name']) {
            $Valid = array('name' => 'required|unique:categories');
        } else {
            $Valid = array('name' => 'required');
        }
        $validator = Validator::make($request->all(), $Valid);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_update = array('name' => $input_all['name'],
                                     'detail' => $input_all['detail'],
                                     'show_status' => $input_all['show_status'],
                                     'updated_at' => $input_all['updated_at'],
                                    );
                if (!empty($input_all['photo'])) {
                    $data_update['photo'] = $input_all['photo'][0];
                } else {
                    $data_update['photo'] = NULL;
                }
                \App\Models\Categories::where('id',$id)->update($data_update);
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
        $result = \App\Models\Categories::where('id',$id)->first();
        if(isset($result)){
            if(!empty($result->photo)){
                if(Storage::disk("uploads")->exists("Categories/".$result->photo)){
                    Storage::disk("uploads")->delete("Categories/".$result->photo);
                    if(Storage::disk("uploads")->exists("temp/".$result->photo)){
                        Storage::disk("uploads")->delete("temp/".$result->photo);
                    }
                }
            }
        }
        \DB::beginTransaction();
        try {
            \App\Models\Categories::where('id',$id)->delete();
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
        $result = \App\Models\Categories::select();
        return \Datatables::of($result)
        ->editColumn('show_status',function($rec){
            $str=$rec->show_status=='T' ? '<span class="text-success">Use.</span>':'<span class="text-danger">Do not use.</span>';
            return $str;
        })
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
        })->rawColumns(['show_status', 'action'])->addIndexColumn()->make(true);
    }

}
