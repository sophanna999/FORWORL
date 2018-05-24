<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use DB;
class ArticleController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $data['main_menu'] = 'Article';
        $data['sub_menu'] = 'Article';
        $data['title_page'] = 'Article';
        $data['menus'] = \App\Models\AdminMenu::ActiveMenu()->get();
        $data['Users'] = \App\Models\User::get();
        $data['Categoriess'] = \App\Models\Categories::where('show_status','T')->get();
        return view('Admin.article',$data);
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
        if(isset($input_all['photo'])&&isset($input_all['photo'][0])){
            $input_all['photo'] = $input_all['photo'][0];
            if(Storage::disk("uploads")->exists("temp/".$input_all['photo'])&&!Storage::disk("uploads")->exists("Article/".$input_all['photo'])){
                Storage::disk("uploads")->copy("temp/".$input_all['photo'],"Article/".$input_all['photo']);
                Storage::disk("uploads")->delete("temp/".$input_all['photo']);
            }
        }
        $input_all['ban'] = $request->input('ban','F');
        $input_all['view'] = $request->input('view', 0);
        $input_all['created_at'] = date('Y-m-d H:i:s');
        $input_all['updated_at'] = date('Y-m-d H:i:s');

        $validator = Validator::make($request->all(), [
            'user_id'     => 'required',
            'category_id' => 'required',
            'title'       => 'required',
            'detail'      => 'required',
            // 'show_status' => 'required',
            // 'photo'       => 'required',

        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $input_all;
                \App\Models\Article::insert($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Successfully';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'UnSuccessfully'.$e->getMessage();;
            }
        }else{
            if(isset($failedRules['article_id']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Article not required';
            } elseif(isset($failedRules['user_id']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Customer not required';
            } elseif(isset($failedRules['title']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Title not required';
            } elseif(isset($failedRules['detail']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Detail not required';
            } else {
                $return['status'] = 0;
            }
        }
        $return['title'] = 'Insert Data';
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
        $result = \App\Models\Article::find($id);
        if($result){
            if($result->photo){
                if(Storage::disk("uploads")->exists("Article/".$result->photo)){
                    if(Storage::disk("uploads")->exists("temp/".$result->photo)){
                        Storage::disk("uploads")->delete("temp/".$result->photo);
                    }
                    Storage::disk("uploads")->copy("Article/".$result->photo,"temp/".$result->photo);
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

        if (!empty($input_all['photo'])) {
            if (Storage::disk("uploads")->exists("temp/" . $input_all['photo'][0])) {
                if (Storage::disk("uploads")->exists("Article/" . $input_all['photo'][0])) {
                    Storage::disk("uploads")->delete("temp/" . $input_all['photo'][0]);
                } else {
                    Storage::disk("uploads")->copy("temp/" . $input_all['photo'][0], "Article/" . $input_all['photo'][0]);
                    Storage::disk("uploads")->delete("temp/" . $input_all['photo'][0]);
                }
            }
        } else {
            if (!empty($input_all['org_photo'])) {
                Storage::disk("uploads")->delete("Article/" . $input_all['org_photo']);
            }
        }

        if (!empty($input_all['org_photo'])) {
            if (!empty($input_all['photo'])) {
                if ($input_all['org_photo']!=$input_all['photo'][0]) {
                    Storage::disk("uploads")->delete("temp/".$input_all['org_photo']);
                    Storage::disk("uploads")->delete("Article/" . $input_all['org_photo']);
                }else {
                    Storage::disk("uploads")->delete("temp/" . $input_all['org_photo']);
                    Storage::disk("uploads")->delete("Article/" . $input_all['org_photo']);
                }

            }
        }

        unset($input_all['org_photo']);
        $input_all['ban'] = $request->input('ban','F');
        $input_all['updated_at'] = date('Y-m-d H:i:s');

        $validator = Validator::make($request->all(), [
            'user_id'     => 'required',
            'article_id'  => 'required',
            'category_id' => 'required',
            'title'       => 'required',
            'detail'      => 'required',
            // 'photo'       => 'required',
            // 'show_status' => 'required',
            // 'ban'         => 'required',

        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_update = $input_all;
                if (!empty($input_all['photo'])) {
                    $data_update['photo'] = $input_all['photo'][0];
                }else{
                    $data_update['photo'] = NULL;
                }
                \App\Models\Article::where('id',$id)->update($data_update);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Sucessfully';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Unsuccessfully'.$e->getMessage();
            }
        }else{
            if(isset($failedRules['article_id']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Article not required';
            } elseif(isset($failedRules['user_id']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Customer not required';
            } elseif(isset($failedRules['title']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Title not required';
            } elseif(isset($failedRules['detail']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Detail not required';
            } else {
                $return['status'] = 0;
            }
        }
        $return['title'] = 'Updated Data';
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
            \App\Models\Article::where('id',$id)->delete();
            \DB::commit();
            $return['status'] = 1;
            $return['content'] = 'Sucessfully';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status'] = 0;
            $return['content'] = 'Unsuccessfully'.$e->getMessage();;
        }
        $return['title'] = 'Delete Data';
        return $return;
    }

    public function Lists(){
        $result = \App\Models\Article::leftjoin ('users','articles.user_id','=','users.id')
        ->leftjoin ('countries','users.country_id','=','countries.id')
        ->leftjoin ('categories','articles.category_id','=','categories.id')
        ->select('users.firstname','users.lastname','countries.code','categories.name as cate_name','articles.*')
        ->withCount(['ArticleViewHistory'=>function($q) {
            $q->whereBetween('article_view_histories.created_at',[date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')]);
        }])
        ->orderBy('articles.created_at','DESC');
        return \Datatables::of($result)
        ->addIndexColumn()
        ->editColumn('user_id', function($rec){
            $str = $rec->firstname.' '.$rec->lastname;
            return $str;
        })
        ->editColumn('country_code', function($rec){
            return $rec->code;
        })
        ->editColumn('category_id', function($rec){
            return $rec->name;
        })
        ->editColumn('ban', function($rec){
            return ($rec->ban=='T')?'<span class="text-success">Band.</span>':'<span class="text-danger">Do not band.</span>';
        })
        ->editColumn('show_status', function($rec){
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
        ->rawColumns(['show_status', 'ban','action'])
        ->make(true);
    }

}
