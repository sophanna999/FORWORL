<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['main_menu'] = 'Withdraw';
        $data['sub_menu'] = 'Withdraw';
        $data['title_page'] = 'Withdraw';
        $data['menus'] = \App\Models\AdminMenu::ActiveMenu()->get();

        return view('Admin.withdraw',$data);
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
        $input_all['created_at'] = date('Y-m-d H:i:s');
        $input_all['updated_at'] = date('Y-m-d H:i:s');
        // dd($input_all);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:withdraws',
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $input_all;
                \App\Models\Withdraw::insert($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Success';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Unsuccess'.$e->getMessage();
            }
        }else {
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
        $result = \App\Models\Withdraw::find($id);

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:withdraws',
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $input_all;
                \App\Models\Withdraw::where('id',$id)->update($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Success';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Unsuccess'.$e->getMessage();
            }
        } else {
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
            \App\Models\Withdraw::where('id',$id)->delete();
            \DB::commit();
            $return['status'] = 1;
            $return['content'] = 'Success';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status'] = 0;
            $return['content'] = 'Unsuccess'.$e->getMessage();;
        }
        $return['title'] = 'Deleted';
        return $return;
    }

    public function Lists(){
        $result = \App\Models\Withdraw::select();
        return \Datatables::of($result)
        ->addIndexColumn()
        ->editColumn('show_status',function($rec) {
            return ($rec->show_status=='T')?'<span class="text-success">Use.</span>':'<span class="text-danger">Do not use.</span>';
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
        })
        ->rawColumns(['show_status', 'action'])
        ->make(true);
    }

}
