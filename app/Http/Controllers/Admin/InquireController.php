<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
class InquireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['main_menu'] = 'Inquire';
        $data['sub_menu'] = 'Inquire';
        $data['title_page'] = 'Inquire';
        $data['menus'] = \App\Models\AdminMenu::ActiveMenu()->get();
        
        return view('Admin.v_inquire',$data);
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function Lists(){
        $result = \App\Models\Inquire::select();
        return \Datatables::of($result)
        ->editColumn('show_status',function($rec){
            $str=$rec->show_status=='T' ? '<span class="text-success">Read</span>':'<span class="text-danger">Unread</span>';
            return $str;
        })
        ->addColumn('action',function($rec){
            $str='
                <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-success btn-condensed btn-read btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" data-stat="T" title="Read">
                    <i class="ace-icon ti-export bigger-120"></i>
                </button>
                <button  class="btn btn-xs btn-danger btn-condensed btn-unread btn-tooltip" data-id="'.$rec->id.'" data-stat="F" data-rel="tooltip" title="Unread">
                    <i class="ace-icon ti-email bigger-120"></i>
                </button>
            ';
            return $str;
        })->rawColumns(['show_status', 'action'])->addIndexColumn()->make(true);
    }

    public function inquireOperation(Request $request, $id)
    {
        \DB::beginTransaction();
        try {
            \App\Models\Inquire::where('id', $id)->update(array('show_status' => $request->status));
            \DB::commit();
            $return['status'] = 1;
            $return['content'] = 'Finish';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status'] = 0;
            $return['content'] = 'Fail'.$e->getMessage();;
        }
        return json_encode($return);
    }

}
