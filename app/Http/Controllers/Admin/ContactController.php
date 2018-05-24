<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['main_menu'] = 'Contact';
        $data['sub_menu'] = 'Contact';
        $data['title_page'] = 'Contact';
        $data['contact'] = $result = \App\Models\Contact::get();
        $data['menus'] = \App\Models\AdminMenu::ActiveMenu()->get();
        // if(isset($result)){
        //     if(!empty($result->photo)){
        //         if(Storage::disk("uploads")->exists("Contact/".$result->photo)){
        //             if(Storage::disk("uploads")->exists("temp/".$result->photo)){
        //                 Storage::disk("uploads")->delete("temp/".$result->photo);
        //             }
        //             Storage::disk("uploads")->copy("Contact/".$result->photo,"temp/".$result->photo);
        //         }
        //     }
        // }
        
        return view('Admin.v_contact',$data);
    }

    public function operation(Request $request, $id)
    {
        $input_all = $request->all();
        // if (isset($input_all['photo'])) {
        //     if (Storage::disk("uploads")->exists("temp/" . $input_all['photo'])) {
        //         Storage::disk("uploads")->copy("temp/" . $input_all['photo'], "Contact/" . $input_all['photo']);
        //         Storage::disk("uploads")->delete("temp/" . $input_all['photo']);
        //     }
        // }
        $validator = Validator::make($request->all(), [
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data = $array('address' => $input_all['address'],
                               'phone' => $input_all['phone'],
                               'email' => $input_all['email'],
                               'latitude' => $input_all['latitude'],
                               'longitude' => $input_all['longitude'],
                            );
                // if (!empty($input_all['photo'])) {
                //     $data['photo'] = $input_all['photo'];
                // } else {
                //     $data['photo'] = NULL;
                // }
                if (!empty($id)) {
                    $data['updated_at'] = date('Y-m-d H:i:s');
                    \App\Models\Contact::where('id', $id)->update($data);
                } else {
                    $data['created_at'] = date('Y-m-d H:i:s');
                    \App\Models\Contact::insert($data);
                }
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Finish';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Fail'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'Create data';
        return json_encode($return);
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

    }

}
