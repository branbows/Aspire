<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use App\Blog;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use Input;
use Image;
use ImageSettings;
use File;
use Exception;

class BlogsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
     * [blogs listing method]
     * @return [type] [description]
     */
    public function index()
    {
        if (!checkRole(getUserGrade(2)))
        {
        	prepareBlockUserMessage();
        	return back();
        }

        $data['active_class']     = 'blogs';
        $data['title']            = getPhrase('blogs');
    	// return view('blogs.list', $data);
        $view_name = getTheme().'::blogs.list';
        return view($view_name, $data);
    }


    /**
     * This method returns the datatables data to view
     * @return [type] [description]
     */
    public function getDatatable($slug = '')
    {
        if (!checkRole(getUserGrade(2)))
        {
        	prepareBlockUserMessage();
        	return back();
        }

        $records = array();
 
        $records = Blog::select(['title','status','slug'])
            			->orderBy('updated_at', 'desc');
             

        return Datatables::of($records)
        ->addColumn('action', function ($records) {
         
          $link_data = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="'.URL_BLOGS_EDIT.$records->slug.'"><i class="fa fa-pencil"></i>'.getPhrase("edit").'</a></li>';
                            
                           $temp = '';
                           if(checkRole(getUserGrade(1))) {
                    $temp .= ' <li><a href="javascript:void(0);" onclick="deleteRecord(\''.$records->slug.'\');"><i class="fa fa-trash"></i>'. getPhrase("delete").'</a></li>';
                      }
                    
                    $temp .='</ul></div>';

                    $link_data .=$temp;
            return $link_data;
            })
        ->editColumn('status', function($records)
        {
            return ($records->status == 1) ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
        })
        ->removeColumn('slug')
        ->make();
    }


    /**
     * This method loads the create view
     * @return void
     */
    public function create()
    {
        if (!checkRole(getUserGrade(2)))
        {
        	prepareBlockUserMessage();
        	return back();
        }

    	$data['record']         	= FALSE;
    	$data['active_class']       = 'blogs';
    	$data['title']              = getPhrase('create_blog');
    	// return view('blogs.add-edit', $data);
         $view_name = getTheme().'::blogs.add-edit';
        return view($view_name, $data);
    }


    public function store(Request $request)
    {
    	// dd($request);
    	
	    if (!checkRole(getUserGrade(2)))
	    {
	        prepareBlockUserMessage();
	        return back();
	    }

	    $rules = [
         'title'        => 'bail|required|max:100',
         'content'     	=> 'bail|required',
         'tags' 		=> 'bail|max:50',
         'image'		=> 'bail|mimes:png,jpg,jpeg|max:10000' //10kb
        ];

        $this->validate($request, $rules);

        $record = new Blog();

      	$title  				= $request->title;
		$record->title 			= $title;
       	$record->slug 			= $record->makeSlug($title);
        $record->content		= $request->content;
        $record->tags 			= $request->tags;
        $record->status			= $request->status;
        $record->save();


        if (!env('DEMO_MODE') && $request->hasFile('image')) 
        	$this->processUpload($request, $record);
        

        flash('success','record_added_successfully', 'success');
    	return redirect(URL_BLOGS);
    }

    public function edit($slug)
    {
      	if (!checkRole(getUserGrade(2)))
      	{
        	prepareBlockUserMessage();
        	return back();
      	}

    	$record = Blog::getRecordWithSlug($slug);

    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);


    	$data['record']       		= $record;
    	$data['active_class']     	= 'blogs';
    	$data['settings']       	= FALSE;
      	$data['title']            = getPhrase('edit_blog');
    	// return view('blogs.add-edit', $data);
         $view_name = getTheme().'::blogs.add-edit';
        return view($view_name, $data);
    }


    public function update(Request $request, $slug)
    {
    	//dd($request);

        if (!checkRole(getUserGrade(2)))
        {
        	prepareBlockUserMessage();
        	return back();
        }

    	$record = Blog::getRecordWithSlug($slug);

    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);

    	$previous_image = $record->image;

		$rules = [
         'title'        => 'bail|required|max:100',
         'content'    	=> 'bail|required',
         'tags'			=> 'bail|max:50',
         'image'		=> 'bail|mimes:png,jpg,jpeg|max:10000' //10kb
        ];

        //Validate the overall request
        $this->validate($request, $rules);


        /**
        * Check if the title of the record is changed, 
        * if changed update the slug value based on the new title
        */
        $title = $request->title;
        if($title != $record->title)
            $record->slug = $record->makeSlug($title);
      
      

        $record->title          = $title;
        $record->content   		= $request->content;
        $record->tags 			= $request->tags;
        $record->status         = $request->status;
        $record->save();


        if (!env('DEMO_MODE')) {
        	if ($request->hasFile('image')) {

             	$this->processUpload($request, $record);

              	if ($request->hasFile('image') && $previous_image!='') {

              		$imageObject = new ImageSettings();
          
          			$destinationPath      = $imageObject->getBlogImgPath();
          			$destinationPathThumb = $imageObject->getBlogImgThumbnailpath();

                    $this->deleteFile($previous_image, $destinationPath);
                    $this->deleteFile($previous_image, $destinationPathThumb);
              	}
          	}
        }

        flash('success','record_updated_successfully', 'success');
    	return redirect(URL_BLOGS);
    }


     /**
     * [deleteFile description]
     * @param  [type]  $record   [description]
     * @param  [type]  $path     [description]
     * @param  boolean $is_array [description]
     * @return [type]            [description]
     */
    public function deleteFile($record, $path, $is_array = FALSE)
    {
       
        $destinationPath      = $path;
      
        $files = array();
        $files[] = $destinationPath.$record;

        File::delete($files);
    }

    public function delete($slug)
    {
        if (!checkRole(getUserGrade(2)))
        {
        	prepareBlockUserMessage();
        	return back();
        }

       /**
       * Delete the page 
       * @var [type]
       */
        $record = Blog::where('slug', $slug)->first();

        try {
            if (!env('DEMO_MODE')) {

            	$imageObject = new ImageSettings();
          
         	 	$destinationPath      = $imageObject->getBlogImgPath();
          		$destinationPathThumb = $imageObject->getBlogImgThumbnailpath();

                $this->deleteFile($record->image, $destinationPath);
                $this->deleteFile($record->image, $destinationPathThumb);

                $record->delete();
            }

            $response['status'] = 1;
            $response['message'] = getPhrase('record_deleted_successfully');
        }
        catch ( \Illuminate\Database\QueryException $e) {

            $response['status']  = 0;
	        $response['message'] =  getPhrase('record_not_deleted');
        }
        return json_encode($response);
    }

    public function isValidRecord($record)
    {
    	if ($record === null) {

    		flash('Ooops...!', getPhrase("page_not_found"), 'error');
   			return $this->getRedirectUrl();
		}

		return FALSE;
    }

    public function getReturnUrl()
    {
    	return URL_BLOGS;
    }


    protected function processUpload(Request $request, $record)
    {

        if (env('DEMO_MODE')) {
        	return 'demo';
        }

        if ($request->hasFile('image')) {
          
          $imageObject = new ImageSettings();
          
          $destinationPath      = $imageObject->getBlogImgPath();
          $destinationPathThumb = $imageObject->getBlogImgThumbnailpath();
          
          $random_str = rand(0,9999999);

          $fileName = $record->id.'_'.$random_str.'.'.$request->image->guessClientExtension();
          
          $request->file('image')->move($destinationPath, $fileName);
          $record->image = $fileName;
         
          Image::make($destinationPath.$fileName)->resize(1024, 600)->save($destinationPath.$fileName);
         
          Image::make($destinationPath.$fileName)->resize(200, 200)->save($destinationPathThumb.$fileName);
          $record->save();
        }
    }
}
