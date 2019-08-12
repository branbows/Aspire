<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;
use App\Http\Requests;
use App\FaqCategory;
use Yajra\Datatables\Datatables;
use DB;
use Auth;

class FaqCategoriesController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

     /**
     * [faqcategories listing method]
     * @return [type] [description]
     */
    public function index()
    {
        if (!checkRole(getUserGrade(2)))
        {
        	prepareBlockUserMessage();
        	return back();
        }

        $data['active_class']     = 'faqs';
        $data['title']            = getPhrase('faq_categories');
    	// return view('faq-categories.list', $data);
        $view_name = getTheme().'::faq-categories.list';
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
 
        $records = FaqCategory::select(['category','status','slug'])
            			->orderBy('updated_at', 'desc');
             

        return Datatables::of($records)
        ->addColumn('action', function ($records) {
         
          $link_data = '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="'.URL_FAQ_CATEGORIES_EDIT.$records->slug.'"><i class="fa fa-pencil"></i>'.getPhrase("edit").'</a></li>';
                            
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
    	$data['active_class']       = 'faqs';
    	$data['title']              = getPhrase('create_faq_category');
    	// return view('faq-categories.add-edit', $data);
         $view_name = getTheme().'::faq-categories.add-edit';
        return view($view_name, $data);
    }


    public function store(Request $request)
    {
    	
	    if (!checkRole(getUserGrade(2)))
	    {
	        prepareBlockUserMessage();
	        return back();
	    }

	    $rules = [
         'category'    => 'bail|required|max:50'
        ];

        $this->validate($request, $rules);

        $record = new FaqCategory();

      	$category  					= $request->category;
		$record->category 			= $category;
       	$record->slug 				= $record->makeSlug($category);
        $record->status				= $request->status;
        $record->save();

        flash('success','record_added_successfully', 'success');
    	return redirect(URL_FAQ_CATEGORIES);
    }


    public function edit($slug)
    {
      	if (!checkRole(getUserGrade(2)))
      	{
        	prepareBlockUserMessage();
        	return back();
      	}

    	$record = FaqCategory::getRecordWithSlug($slug);

    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);


    	$data['record']       		= $record;
    	$data['active_class']     	= 'faqs';
    	$data['settings']       	= FALSE;
      	$data['title']            = getPhrase('edit_faq_category');
    	// return view('faq-categories.add-edit', $data);
         $view_name = getTheme().'::faq-categories.add-edit';
        return view($view_name, $data);
    }


    public function update(Request $request, $slug)
    {
    	
        if (!checkRole(getUserGrade(2)))
        {
        	prepareBlockUserMessage();
        	return back();
        }

    	$record = FaqCategory::getRecordWithSlug($slug);

    	if($isValid = $this->isValidRecord($record))
    		return redirect($isValid);


		$rules = [
         'category'  => 'bail|required|max:50'
        ];

        //Validate the overall request
        $this->validate($request, $rules);


        /**
        * Check if the title of the record is changed, 
        * if changed update the slug value based on the new title
        */
        $category = $request->category;
        if($category != $record->category)
            $record->slug = $record->makeSlug($category);
      
      

        $record->category       = $category;
        $record->status         = $request->status;
        $record->save();

        flash('success','record_updated_successfully', 'success');
    	return redirect(URL_FAQ_CATEGORIES);
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
        $record = FaqCategory::where('slug', $slug)->first();
 		try{
            if(!env('DEMO_MODE')) {
                $record->delete();
            }
            $response['status'] = 1;
            $response['message'] = getPhrase('record_deleted_successfully');
        }
         catch ( \Illuminate\Database\QueryException $e) {
                 $response['status'] = 0;
           if(getSetting('show_foreign_key_constraint','module'))
            $response['message'] =  $e->errorInfo;
           else
            $response['message'] =  getPhrase('this_record_is_in_use_in_other_modules');
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
    	return URL_FAQ_CATEGORIES;
    }
}
