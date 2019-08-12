<?php

namespace App\Http\Controllers;
use \App;
use Illuminate\Http\Request;
use App\Http\Requests;
use Yajra\Datatables\Datatables;
use App\SiteTheme;
use App\ImageSettings;
use DB;
use Auth;
use Input;
use File;

class SiteThemesController extends Controller
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


        $data['active_class']       = 'themes';
        $data['title']              = getPhrase('themes');
    	// return view('lms.lmscategories.list', $data);

           $view_name = getTheme().'::site.themes.list';
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

         $records = SiteTheme::select(['title','description','is_active','slug','id']);
        return Datatables::of($records)
        ->addColumn('action', function ($records) {
         

            return '<div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="'.URL_VIEW_THEME_SETTINGS.$records->slug.'"><i class="fa fa-edit"></i>'.getPhrase("update_settings").'</a></li>
                        </ul>
                    </div>';
            })

          ->editColumn('is_active',function ($records)
        {
        	 if($records->is_active)
                return '<i class="fa fa-check text-success" title="'.getPhrase('enable').'"></i>';
            return '<a href="'.URL_THEME_MAKE_DEFAULT.$records->id.'" class="btn btn-info btn-xs">'.getPhrase('set_default').'</a>';
        })

           ->editColumn('title',function ($records)
        {
        	return '<a href="'.URL_VIEW_THEME_SETTINGS.$records->slug.'">'.$records->title.'</a>';
        })
        ->removeColumn('slug')
        ->removeColumn('id')
        ->make();
    }  


   /**
    * make as default theme
    * @param  [type] $id [description]
    * @return [type]     [description]
    */
    public function makeDefault($id)
    {
       
       $record   = SiteTheme::find($id);
       $other_themes  = SiteTheme::where('id','!=',$id)->get();

       foreach ($other_themes as $theme) {
       	  
       	  $theme->is_active  = 0; 
       	  $theme->save();
        }

	       $record->is_active  = 1;
	       $record->save();	

	    flash('success','theme_changed_successfully','success');
	    return redirect(URL_THEMES_LIST);

	  }

	  public function viewSettings($slug)
    { 

        if(!checkRole(getUserGrade(1)))
        {
            prepareBlockUserMessage();
            return back();
        }

        $record   = SiteTheme::where('slug', $slug)->first();
        
        if($isValid = $this->isValidRecord($record))
            return redirect($isValid);
        // dd($record);
        $data['settings_data']      = getArrayFromJson($record->settings_data);
        $data['record']             = $record;
        $data['active_class']       = 'themes';
        $data['title']              = ucfirst($record->title);
       
        $data['layout']             = getLayout();
        $data['slug']               = $slug;

          $view_name = getTheme().'::site.themes.sub-list';
        return view($view_name, $data);
    }

    /**
     * Update the theme settings
     * @param  Request $request [description]
     * @param  [type]  $slug    [description]
     * @return [type]           [description]
     */
    public function updateSubSettings(Request $request, $slug )
    {
       // dd($request);
       // dd($slug);
	     if(!checkRole(getUserGrade(1)))
	      {
	        prepareBlockUserMessage();
	        return back();
	      }
        
	      $record  = SiteTheme::where('slug', $slug)->first();
        // dd($record);
	    
	      if($isValid = $this->isValidRecord($record))
	        return redirect($isValid);

	    $input_data = Input::all();

      if($request->has('theme_color') && $slug == 'theme_one'){

        $record->theme_color   = $request->theme_color['value'];
        $record->save();

      }

	    
	 
	    $extra = '';
    
      foreach ($input_data as $key => $value) {

            if($key=='_token' || $key=='_method' || $value=='')
                continue;
            $submitted_value = (object)$value;
            $value = 0;
            if(isset($submitted_value->value))
                $value = $submitted_value->value;
            
             $old_values = json_decode($record->settings_data);

              /**
             * For File type of settings, first check if the file is changed or not
             * If not changed just keep the old values as it is
             * If file changed, first upload the new file and delete the old file
             * @var [type]
             */
            if($submitted_value->type=='file')
            {
                if($request->hasFile($key)) {
                    $isNew = false;
                        $value = $this->processUpload($request, $key, $isNew);
                        
                         $this->deleteFile($old_values->$key->value, IMAGE_PATH_SETTINGS);
                }
                else
                {
                    $value = $old_values->$key->value;
                }
            }
            
            
            //*** File Answer type end **//

           if($submitted_value->type == 'select')
           {
                $extra = $old_values->$key->extra;
           }
            
            $data[$key] = array('value'=>$value, 'type'=>$submitted_value->type, 'extra'=>$extra, 'tool_tip'=>$submitted_value->tool_tip);
           
        }	 
       
       
       $record->settings_data = json_encode($data);
      
       $record->save();

		  //   Settings::loadSettingsModule($record->key);
		  // (new App\EmailSettings())->getDbSettings();
      

       flash('success','record_updated_successfully', 'success');
    	return redirect(URL_VIEW_THEME_SETTINGS.$record->slug);	


    }



    public function isValidRecord($record)
    {
      if ($record === null) {

        flash('Ooops...!', getPhrase("page_not_found"), 'error');
        return $this->getRedirectUrl();
      }
  }


       public function processUpload(Request $request, $sfname='value', $isNew = true)
     {
        
         if ($request->hasFile($sfname)) {
          
          $imageObject = new ImageSettings();
          
          $destinationPath      = $imageObject->getSettingsImagePath();
          
          $random_name = str_random(15);
          $fileName = '';
          if($isNew){
              $path = $_FILES[$sfname]['name'];
          $ext = pathinfo($path, PATHINFO_EXTENSION);

       
              $fileName = $random_name.'.'.$ext; 
              $request->file($sfname)->move($destinationPath, $fileName);
          }
          else {
              
              $path = $_FILES[$sfname]['name'];
        
              $ext = pathinfo($path['value'], PATHINFO_EXTENSION);

            $fileName = $random_name.'.'.$ext;//$request->$sfname['value']->guessClientExtension();
            
            move_uploaded_file($_FILES[$sfname]['tmp_name']['value'], $destinationPath.$fileName);
        }
          
          return $fileName;
 
        }
     }


      public function deleteFile($record, $path, $is_array = FALSE)
    {
        $imageObject = new ImageSettings();
        $destinationPath      = $imageObject->getSettingsImagePath();
        $files = array();
        $files[] = $destinationPath.$record;
        File::delete($files);
    }

	   

}