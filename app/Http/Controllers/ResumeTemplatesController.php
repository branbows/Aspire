<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ResumeTemplate;
use Yajra\Datatables\Datatables;
use DB;
use Auth;
use Image;
use ImageSettings;
use File;


class ResumeTemplatesController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

     /**
     * Course listing method
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }

        $data['active_class']       = 'resumes_templates';
        $data['title']              = getPhrase('resume_templates');
    	// return view('resumes.list', $data);

        $view_name = getTheme().'::resumes.list';
        return view($view_name, $data);
    }


     /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function getDatatable()
    {
        if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }

        $records = ResumeTemplate::select([   
         	'image','title','resume_key','status','is_default','slug','id'])
         ->orderBy('updated_at', 'DESC');

       
        return Datatables::of($records)
        ->addColumn('action', function ($records) {
         

            $link_data =  '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="'.URL_RESUME_TEMPLATES_EDIT.'/'.$records->slug.'"><i class="fa fa-pencil"></i>'.getPhrase("edit").'</a></li>';

              $temp='';          
              if(checkRole(getUserGrade(1)))  {
                  $temp = '<li><a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="fa fa-trash"></i>'. getPhrase("delete").'</a></li>';
               } 

               $temp .= '</ul></div>';

                $link_data = $link_data. $temp;
            return $link_data;       
            
          
            })
        ->editColumn('image', function($records){
            if ($records->image!='')
              return '<a href="'.RESUME_TEMPLATE_IMG_PATH.$records->image.'" target="_blank"><img align="center" src="'.getResumeTemplateImg($records->image).'" class="img-responsive" width="50" alt="'.$records->title.'"/></a>';
            else
              return '';
        })
        ->editColumn('status', function($records) {
          if($records->status=='1')
            return 'Enable';
          else
            return 'Disable';
        })
        ->editColumn('is_default', function($records) {
          if($records->is_default=='1')
            return 'Yes';
          else
            return 'No';
        })      
        ->removeColumn('slug')
        ->removeColumn('id')
        ->make();
    }


     /**
     * This method loads the create view
     * @return void
     */
    public function create()
    {
        if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }

        $data['record']             = FALSE;
        $data['active_class']       = 'resumes_templates';
        $data['title']              = getPhrase('create_template');
        // return view('resumes.add-edit', $data);

          $view_name = getTheme().'::resumes.add-edit';
        return view($view_name, $data);
    }

       /**
     * This method loads the edit view based on unique slug provided by user
     * @param  [string] $slug [unique slug of the record]
     * @return [view with record]       
     */
    public function edit($slug)
    {

      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }

      $record = ResumeTemplate::getRecordWithSlug($slug);
      if($isValid = $this->isValidRecord($record))
        return redirect($isValid);

      $data['record']           = $record;
      $data['active_class']       = 'resumes_templates';
      $data['title']              = getPhrase('edit_template');
      // return view('resumes.add-edit', $data);
        
          $view_name = getTheme().'::resumes.add-edit';
        return view($view_name, $data);
    }

    /**
      * Store a newly created resource in storage.
      *
      * @return Response
      */
    public function store(Request $request )
    {
         if(!checkRole(getUserGrade(2)))
         {
            prepareBlockUserMessage();
            return back();
         }


        $columns = [
         'title'       => 'bail|required|max:30' ,
         'resume_key'  => 'bail|required|unique:resumetemplates,resume_key',
         'image'       => 'bail|mimes:png,jpg,jpeg|max:2048',
            ];


        $this->validate($request,$columns);
          
        $record         = new ResumeTemplate();

        $resume_key   = $request->resume_key;
        $record->slug = $record->makeSlug($resume_key);
      
        $record->title          = $request->title;
        $record->resume_key     = $request->resume_key;
        
        $record->status   = '0';
        if ($request->status=='1')
          $record->status = '1';
        
        $record->is_default   = '0';
        if ($request->is_default=='1')
        {

           ResumeTemplate::where('is_default','1')
           ->update(['is_default' => '0']);

           $record->is_default = '1';
        }

        $record->save();

        if(!env('DEMO_MODE')) {
          $this->processUpload($request, $record);
        }

        flash('success','record_updated_successfully', 'success');
        return redirect(URL_RESUME_TEMPLATES);
       
     }
    


    /**
     * Update record based on slug and reuqest
     * @param  Request $request [Request Object]
     * @param  [type]  $slug    [Unique Slug]
     * @return void
     */
    public function update(Request $request, $slug)
    {
      if(!checkRole(getUserGrade(2)))
      {
        prepareBlockUserMessage();
        return back();
      }
      // dd($request);

      $record = ResumeTemplate::getRecordWithSlug($slug);
      $columns = [
         'title'       => 'bail|required|max:30' ,
         'resume_key'  => 'bail|required|unique:resumetemplates,resume_key,'.$record->id,
         'image'       => 'bail|mimes:png,jpg,jpeg|max:2048',
            ];

         /**
        * Check if the title of the record is changed, 
        * if changed update the slug value based on the new title
        */
       $resume_key = $request->resume_key;
        if($resume_key != $record->resume_key)
            $record->slug = $record->makeSlug($resume_key);
      

       //Validate the overall request
        $this->validate($request, $columns);

        $record->title          = $request->title;
        $record->resume_key     = $request->resume_key;
        
        $record->status  = '0';
        if ($request->status=='1')
          $record->status = '1';
        
        $record->is_default  = '0';
        if ($request->is_default=='1')
        {
          ResumeTemplate::where('is_default','1')
           ->update(['is_default' => '0']);


          $record->is_default = '1';
        }

        $record->save();


         if(!env('DEMO_MODE')) {
          $this->processUpload($request, $record);
        }

        flash('success','record_updated_successfully', 'success');
        return redirect(URL_RESUME_TEMPLATES);
    }



    protected function processUpload(Request $request, $record)
    {

       if(env('DEMO_MODE')) {
        return 'demo';
       }

         if ($request->hasFile('image')) {
          
          $imageObject = new ImageSettings();
          
          $destinationPath      = $imageObject->getResumePicsPath();
          $fileName = $record->id.'-'.$record->slug.'.'.$request->image->guessClientExtension();
          
          $request->file('image')->move($destinationPath, $fileName);
          $record->image = $fileName;
         
          Image::make($destinationPath.$fileName)->fit($imageObject->getProfilePicSize())->save($destinationPath.$fileName);
        
          $record->save();
        }
     }


       /**
      * Remove the specified resource from storage.
      *
      * @param  unique string  $slug
      * @return Response
      */
    /**
     * Delete Record based on the provided slug
     * @param  [string] $slug [unique slug]
     * @return Boolean 
     */
    public function delete($slug)
    {
        if(!checkRole(getUserGrade(2)))
        {
          prepareBlockUserMessage();
          return back();
        }

        // dd($slug);
        
        $record = ResumeTemplate::where('slug', $slug)->first();
       
        /**
         * Check if any exams exists with this category, 
         * If exists we cannot delete the record
         */
         if(!env('DEMO_MODE')) {

            if ($record->image!='')
            {
              $imageObject = new ImageSettings();
              $destinationPath      = $imageObject->getResumePicsPath();
              $this->deleteFile($record->image, $destinationPath);
            }

            $record->delete();
          }

         

          $response['status'] = 1;
          $response['message'] = getPhrase('record_deleted_successfully');
          return json_encode($response);
       
    }

    public function deleteFile($record, $path, $is_array = FALSE)
    {
       if(env('DEMO_MODE')) {
        return ;
       }

        $files = array();
        $files[] = $path.$record;
        File::delete($files);
    }

    public function isValidRecord($record)
    {
      if ($record === null) {
        flash('Ooops...!', getPhrase("page_not_found"), 'error');
        return $this->getRedirectUrl();
      }

      return FALSE;
    }
}
