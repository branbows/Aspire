@if($quiz->has_language) 

         <?php $l = $quiz->language(); ?>
         @if($l)
           <span class="pull-right"><span class="st-white">View in :</span>
            
            <select 
                  id="selected_language" 
                  onchange="languageChanged(this.value)" 
                  class="form-control st-selection">
              <option value="language_l1">{{getPhrase('english')}}</option>
              {{-- <option value="language_l2">{{$l->title}}</option> --}}
              <option value="language_l2">{{$quiz->language_name}}</option>
            </select>
           </span>
          @endif
          
      @endif
     