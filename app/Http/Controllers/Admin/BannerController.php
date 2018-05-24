<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
class BannerController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $data['main_menu']   = 'Banner';
        $data['sub_menu']    = 'Banner';
        $data['title_page']  = 'Banner';
        $data['menus']       = \App\Models\AdminMenu::ActiveMenu()->get();
        $data['Articles']    = \App\Models\Article::get();
        $data['Users']       = \App\Models\User::get();
        $data['Countriess']  = \App\Models\Countries::get();
        $data['Provinces']   = \App\Models\Province::get();
        $data['Users']       = \App\Models\User::get();
        $data['Categoriess'] = \App\Models\Categories::get();
        return view('Admin.banner',$data);
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

        if(isset($input_all['photo'])&&isset($input_all['photo'][0])){
            $input_all['photo'] = $input_all['photo'][0];
            if(Storage::disk("uploads")->exists("temp/".$input_all['photo'])&&!Storage::disk("uploads")->exists("Banner/".$input_all['photo'])){
                Storage::disk("uploads")->copy("temp/".$input_all['photo'],"Banner/".$input_all['photo']);
                Storage::disk("uploads")->delete("temp/".$input_all['photo']);
            }
        }
        $input_all['show_status'] = $request->input('show_status','F');
        $input_all['ban'] = $request->input('ban','F');
        $input_all['view'] = $request->input('view',0);
        $input_all['created_at'] = date('Y-m-d H:i:s');
        $input_all['updated_at'] = date('Y-m-d H:i:s');

        $validator = Validator::make($request->all(), [
            'article_id'  => 'required',
            'user_id'     => 'required',
            'country_id'  => 'required',
            'province_id' => 'required',
            'writer_id'   => 'required',
            'category_id' => 'required',
            'name'        => 'required',
            'photo'       => 'required',

        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $input_all;
                \App\Models\Banner::insert($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Sucessfully';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Unsuccessfully'.$e->getMessage();;
            }
        }else{
            if(isset($failedRules['article_id']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Article not required';
            } elseif(isset($failedRules['user_id']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Customer not required';
            } elseif(isset($failedRules['country_id']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Country not required';
            } elseif(isset($failedRules['province_id']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Province not required';
            } elseif(isset($failedRules['writer_id']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Writer not required';
            } elseif(isset($failedRules['category_id']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Category not required';
            } elseif(isset($failedRules['name']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Title not required';
            } elseif(isset($failedRules['photo']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Image not required';
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
        $result = \App\Models\Banner::find($id);

        if($result){
            if($result->photo){
                if(Storage::disk("uploads")->exists("Banner/".$result->photo)){
                    if(Storage::disk("uploads")->exists("temp/".$result->photo)){
                        Storage::disk("uploads")->delete("temp/".$result->photo);
                    }
                    Storage::disk("uploads")->copy("Banner/".$result->photo,"temp/".$result->photo);
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

        if (!empty($input_all['photo'])) {
            if (Storage::disk("uploads")->exists("temp/" . $input_all['photo'][0])) {
                if (Storage::disk("uploads")->exists("Banner/" . $input_all['photo'][0])) {
                    Storage::disk("uploads")->delete("temp/" . $input_all['photo'][0]);
                } else {
                    Storage::disk("uploads")->copy("temp/" . $input_all['photo'][0], "Banner/" . $input_all['photo'][0]);
                    Storage::disk("uploads")->delete("temp/" . $input_all['photo'][0]);
                }
            }
        }
        if (!empty($input_all['org_photo'])) {
            if (!empty($input_all['photo'])) {
                if ($input_all['org_photo']!=$input_all['photo'][0]) {
                    Storage::disk("uploads")->delete("temp/".$input_all['org_photo']);
                    Storage::disk("uploads")->delete("Banner/" . $input_all['org_photo']);
                }else {
                    Storage::disk("uploads")->delete("temp/" . $input_all['org_photo']);
                    Storage::disk("uploads")->delete("Banner/" . $input_all['org_photo']);
                }
            }
        }
        unset($input_all['org_photo']);
        $input_all['show_status'] = $request->input('show_status','F');
        $input_all['ban'] = $request->input('ban','F');
        $input_all['updated_at'] = date('Y-m-d H:i:s');

        $validator = Validator::make($request->all(), [
             'article_id'  => 'required',
             'user_id'     => 'required',
             'country_id'  => 'required',
             'province_id' => 'required',
             'writer_id'   => 'required',
             'category_id' => 'required',
             'name'        => 'required',

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
                \App\Models\Banner::where('id',$id)->update($data_update);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Sucessfully';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Unsuccessfully'.$e->getMessage();;
            }
        }else{
            if(isset($failedRules['article_id']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Article not required';
            } elseif(isset($failedRules['user_id']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Customer not required';
            } elseif(isset($failedRules['country_id']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Country not required';
            } elseif(isset($failedRules['province_id']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Province not required';
            } elseif(isset($failedRules['writer_id']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Writer not required';
            } elseif(isset($failedRules['category_id']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Category not required';
            } elseif(isset($failedRules['name']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Title not required';
            } elseif(isset($failedRules['photo']['Required'])) {
                $return['status'] = 2;
                $return['content'] = 'Image not required';
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
            \App\Models\Banner::where('id',$id)->delete();
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
        $result = \App\Models\Banner::leftjoin('articles','banners.article_id','=','articles.id')
        ->leftjoin('users','banners.user_id','=','users.id')
        ->leftjoin('countries','banners.country_id','=','countries.id')
        ->leftjoin('provinces','banners.province_id','=','provinces.id')
        ->leftjoin('categories','banners.category_id','=','categories.id')
        ->leftjoin('banner_view_histories','banners.id','=','banner_view_histories.banner_id')
        ->select('articles.title','users.firstname','users.lastname','countries.name as c_name','provinces.name as p_name','categories.name as cat_name','banners.*')
        ->withCount(['BannerViewHistory'=>function($q) {
            $q->whereBetween('banner_view_histories.created_at',[date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')]);
        }]);
        return \Datatables::of($result)
        ->addIndexColumn()
        ->editColumn('article_id', function($rec){
            $str = $rec->title;
            return $str;
        })
        ->editColumn('user_id', function($rec){
            $str = $rec->firstname .' '.$rec->lastname;
            return $str;
        })
        ->editColumn('country_id', function($rec){
            $str = $rec->c_name;
            return $str;
        })
        ->editColumn('category_id', function($rec){
            $str = $rec->cat_name;
            return $str;
        })

        ->addColumn('action',function($rec){
            $str='
            <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="แก้ไข">
            <i class="ace-icon fa fa-edit bigger-120"></i>
            </button>
            <button  class="btn btn-xs btn-danger btn-condensed btn-delete btn-tooltip" data-id="'.$rec->id.'" data-rel="tooltip" title="ลบ">
            <i class="ace-icon fa fa-trash bigger-120"></i>
            </button>
            ';
            return $str;
        })->make(true);
    }

}
