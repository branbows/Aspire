<script src="{{JS}}bootstrap-toggle.min.js">

</script>

<script src="{{JS}}jquery.flexslider.js"></script>



<script src="{{JS}}angular.js"></script>

<script src="{{JS}}angular-messages.js"></script>

<script src="{{JS}}mousetrap.js"></script>



<script>



var app = angular.module('academia', []);

app.controller('angExamScript', function($scope, $http) {

    $scope.initAngData = function(data) {
         if(data=='')
        {
          return;
        }

    $scope.hints = 0;    
    $scope.saved_bookmarks = [];
    $scope.intilizeBookmarks('questions');
    $scope.bookmarks = [];
    angular.forEach(data, function(value, index) {
       $scope.bookmarks[value] = 0;
     });
    }

    $scope.getToken = function(){
      return  $('[name="_token"]').val();
    }



    $scope.intilizeBookmarks = function(item_type)

    {

        route = '{{URL_BOOKMARK_SAVED_BOOKMARKS}}';  



        data= {_method: 'post', '_token':$scope.getToken(), 'item_type':item_type };

        $http.post(route, data).success(function(result) {

            $scope.saved_bookmarks = result;        

             

            angular.forEach($scope.bookmarks, function(value, index) {

                  $scope.bookmarks[index] = $scope.isBookmarked(index);

              });

        });  



    }



    $scope.isBookmarked = function(item_id) {

         res = $scope.findIndexInData($scope.saved_bookmarks, 'item_id', item_id)

         return res;

    }



    /**

     * This method searches for the particular element in the sent array and returns 

     * -1 if not found

     * 0>= if item is found

     * @param  {[type]} Array    [description]

     * @param  {[type]} property [description]

     * @param  {[type]} action   [description]

     * @return {[type]}          [description]

     */

    $scope.findIndexInData =function (Array, property, action) {

          var result = -1;

          angular.forEach(Array, function(value, index) {

             if(value[property]==action){

                result=index;

             }

          });

          return result;

        }



    /**

     * This method bookmarks or unbookmarks the given item id

     * If the operation is delete, it removes the bookmark

     * if the operation is add, It adds the bookmark

     * @param  {[type]} item_id   [description]

     * @param  {[type]} operation [description]

     * @param  {[type]} item_type [description]

     * @return {[type]}           [description]

     */

    $scope.bookmark = function(item_id, operation, item_type)

    {

        bookmark_value=0;

        route = '{{URL_BOOKMARK_ADD}}';  

        data= {_method: 'post', '_token':$scope.getToken(), 'item_id': item_id, 'item_type':item_type };

        

        if(operation=='delete') {

          route = '{{URL_BOOKMARK_DELETE}}'+item_id;  

          bookmark_value = -1;

           data= {_method: 'delete', '_token':$scope.getToken()};

        }

       

        $http.post(route, data).success(function(result, status) {

            

            if(result.status==0){

             alertify.error(result.message);

            }

            else {

                if(operation=='delete') {

                    var index = $scope.saved_bookmarks.indexOf(item_id);

                    $scope.saved_bookmarks.splice(index, 1); 

                }

                else {

                    var obj = {

                                  id: $scope.saved_bookmarks.length,

                                  item_id: item_id

                                };

                    $scope.saved_bookmarks.push(obj);

                }



                $scope.bookmarks[item_id] = bookmark_value;

                alertify.success(result.message);



            }

        });

    }



    

});





/**

 * General Exam Scripts

 * Variables used in the below script

 */

var EFFECT                          = 'bounceInDown';

var DURATION                        = 500;

var DIV_REFERENCE                   = $("#questions_list .question_div");

var MAXIMUM_QUESTIONS               = $("#questions_list .question_div").size();

var VISIBLE_ELEMENT                 = "#questions_list .question_div:visible";


PARA_DIV_REFERENCE                  = $("#para_questions_1 .question_para");

PARA_MAXIMUM_QUESTIONS              = $("#para_questions_1 .question_para").size();

PARA_VISIBLE_ELEMENT                = "#para_questions_1 .question_para:visible";


var HINTS                           = 0;

var ANSWERED                        = ' answered';

var NOT_ANSWERED                    = ' not-answered';

var ANSWER_MARKED                   = ' marked';

var NOT_VISITED                     = ' not-visited';

var TOTAL_ANSWERED                  = 0;

var TOTAL_MARKED                    = 0;

var TOTAL_NOT_VISITED               = MAXIMUM_QUESTIONS;

var TOTAL_NOT_ANSWERED              = MAXIMUM_QUESTIONS;

var HOURS                           = 0;

var MINUTES                         = 0;

var SECONDS                         = 0;

var SPENT_TIME                      = [];

var CURRENT_SUBJECT_ID              = 0;

var CURRENT_SECTION                 = 0;

var SECTIONS = $.parseJSON('<?php print_r(json_encode($section_timings)); ?>');

SECTIONS_LENGTH = '<?php echo count($section_timings);?>'-1;









DIV_REFERENCE.first().show();


var QUESTION_TYPE  = $("#questions_list .question_div").attr('data-questiontype');


showParaQues(QUESTION_TYPE);

showNextButton(QUESTION_TYPE);

checkButtonStatus();

processNext(0);

updatePallet();


if(QUESTION_TYPE == 'para'){
   
   PARA_DIV_REFERENCE.first().show();
   
   paraButtonStatus();
}

 function showNextButton(question_type)
    {
      if(question_type=='para')
      {
        $('.next').hide();
        $('.paranext').show();
        $('.paraprev').hide();
      }
      else {
        $('.paranext').hide();
        $('.next').show(); 
        $('.paraprev').hide(); 
      }
      
    }




function showParaQues(question_type){

  if(question_type == 'para')
  {
    
     $('.parashow').show();
  }
  else{


     $('.parashow').hide();
     
  }

}    


updateCount();

 

// onlclick of next button

$('.next').click(function() { 

  nextClick($(this).attr('id'));

  $('.next #markbtn').show();

  goTop();

});   


$('.paranext').click(function() { 
  
  // console.log(PARA_VISIBLE_ELEMENT);
   
  doParaNext();
  
});  

function doParaNext(){
    
    $(PARA_VISIBLE_ELEMENT).next('div').fadeIn(DURATION).prev().hide();

     paraButtonStatus();

     goTop();

     return false;

} 


$('.paraprev').click(function() { 
  
   doParaPrev();

}); 

function doParaPrev(){

  $(PARA_VISIBLE_ELEMENT).prev('div').fadeIn(DURATION).next().hide();
 
  paraButtonStatus();

  goTop();

  return false;
}
 



// onlclick of prev button

$('.prev').click(function() { 

   prevClick($(this).attr('id'));

   goTop();

});



$('.clear-answer').click(function() {

  clearAnswer();    

});



function nextClick(argument) {

 current_section_key = SECTIONS[CURRENT_SECTION].section_key;

    is_marked = 0;

    if(argument == 'markbtn') {

        is_marked = 1;

      }
   processNext(is_marked);

    next_div = $(VISIBLE_ELEMENT).next('div');
    if(!next_div.hasClass('subject_'+current_section_key)) {
      return;
    }
     
     //After reach the last question
     var pre_index   = $(VISIBLE_ELEMENT).index()+2;
    
     if(pre_index > MAXIMUM_QUESTIONS){
        
         $('.next').hide();
         // $('.myfinish-1').hide();
         // $('.myfinish-2').show();

         return false;
     }
     

     $(VISIBLE_ELEMENT).next('div').fadeIn(DURATION).prev().hide();

      var question_type = $(VISIBLE_ELEMENT).attr('data-questiontype');

      showParaQues(question_type);

      doGeneralOperations();

      if(question_type == 'para'){

           viewParaQuestion(getCurrentPara());

           paraButtonStatus();
       }


   var myactive = $(VISIBLE_ELEMENT).attr('data-acid');
   $('.question-sections a.active').removeClass('active');
   $('#'+myactive).addClass('active');

    return false;

}


function prevClick(argument) {

    is_marked = 0;

    if(argument == 'markbtn') {

        is_marked = 1;

      }

   processNext(is_marked);



   $(VISIBLE_ELEMENT).prev('div').fadeIn(DURATION).next().hide();

    var question_type = $(VISIBLE_ELEMENT).attr('data-questiontype');
    // console.log(question_type);
     
    doGeneralOperations();

    if(question_type == 'para'){
// console.log('herere');
           viewPrevParaQuestion(getCurrentPara());

           paraButtonStatus();
     }

     // showParaQues(question_type);

     // if(question_type == 'para'){
     //    // console.log(PARA_DIV_REFERENCE);
     //    $(PARA_DIV_REFERENCE).prev('div').fadeIn(DURATION).next().hide();
     //  }


  var myactive = $(VISIBLE_ELEMENT).attr('data-acid');
   $('.question-sections a.active').removeClass('active');
   $('#'+myactive).addClass('active');

    return false;

}



function getCurrentPara(){

    // console.log(VISIBLE_ELEMENT);

     return $(VISIBLE_ELEMENT).children('div .border-gray').children('div .row').children('div .para-ques-get').children('.questions-container').children('.para-vis').attr('id');
}



function goTop(){

     $('html, body').animate({
            scrollTop: $("body").offset().top
        }, 500);
}


function viewParaQuestion(current_para){
        
        // console.log(current_para);
  
        PARA_DIV_REFERENCE      = $("#"+current_para+" .question_para");
 
        PARA_MAXIMUM_QUESTIONS  = $("#"+current_para+" .question_para").size();

        PARA_VISIBLE_ELEMENT    = "#"+current_para+" .question_para:visible";

        PARA_DIV_REFERENCE.first('div').fadeIn(DURATION).prev().hide();
}

function viewPrevParaQuestion(current_para){
        
        // console.log(current_para);
  
        PARA_DIV_REFERENCE      = $("#"+current_para+" .question_para");
 
        PARA_MAXIMUM_QUESTIONS  = $("#"+current_para+" .question_para").size();

        PARA_VISIBLE_ELEMENT    = "#"+current_para+" .question_para:visible";

        // PARA_DIV_REFERENCE.prev('div').fadeIn(DURATION).next().hide();
}




function clearAnswer() {

     list = $(VISIBLE_ELEMENT + ' input ');

    $.each( list, function() {

        elementType = $(this).attr('type');

        switch(elementType) {

            case 'radio': $(this).prop('checked', false); break;

            case 'checkbox': $(this).attr('checked', false); break;

            case 'text': $(this).val(''); break;

        }

         

    });

}



function bookmark(operation) {

  item_id = $(VISIBLE_ELEMENT).attr('id');

  item_type = 'questions';

  angular.element('.examform').scope().bookmark(item_id, operation, item_type);

  angular.element('.examform').scope().$apply();



}







/**

 * The below method will determine the input elements and accordingly

 * update the status of palete and count of palete based on the event generated

 * @param  {Boolean} is_marked [is true if user clicks for mark for review button]

 * @return {[type]}            [description]

 */

function processNext(is_marked) {

    

    /**

     * Get all the elements of type input

     */

    list = $(VISIBLE_ELEMENT + ' input ');

    

    /**

     * Get all the elements of type text area

     */

    textarea_list =  $(VISIBLE_ELEMENT + ' textarea ');

    

    // This is the global flag to determine wether the user is answered or skipped this question

    answer_status = 0;

    

    //Process input type of elements in foreach loop

    if(list!=0) {

        list.each(function(index, value){



            element_type = $(value).attr('type');

            

            switch(element_type)

            {

                case 'radio': if($(value).prop('checked')) answer_status = 1; break;

                case 'checkbox': if($(value).prop('checked')) answer_status = 1; break;

                case 'text': if($(value).val().length != 0) answer_status = 1; break;

            }

        });

    }

    

    //Process textarea type of elements in foreach loop

    if(textarea_list.length)

    {

       textarea_list.each(function(index, value){

         if($(value).val().length!=0)

                answer_status = 1;

        });

    }



    //Assign the appropriate clase based on the answer type

    class_name = NOT_ANSWERED;

     if(answer_status) {

        if(is_marked){

            class_name = ANSWER_MARKED;
            alertify.set({ delay: 1000 })
          alertify.log('Question is added for review') 
        }

      else{
       class_name = ANSWERED;
      }

    }
    else if(is_marked){

         class_name = ANSWER_MARKED;
         alertify.set({ delay: 1000 })
          alertify.log('Question is added for review') 
    }

    

    //Update the palette with status

    $(".question-palette .pallete-elements:eq("+getCurrentIndex()+")")

    .removeClass(NOT_VISITED + NOT_ANSWERED + ANSWER_MARKED)

    .addClass(class_name);

    return false;

}






/**

 * The below method keeps eye on the index of questions and hides/shows the next and previous buttons

 * @return {[void]} [description]

 */

function checkButtonStatus() {

    CURR_INDEX = getCurrentIndex()+1;
    // console.log(CURR_INDEX);

    if(CURR_INDEX == MAXIMUM_QUESTIONS)

    {  
        var question_type = $(VISIBLE_ELEMENT).attr('data-questiontype');
        
        if(question_type != 'para'){
           // console.log('haoi');
                 $('.next').hide();
                 $('.paranext').hide();
                 $('.prev').show();
                 $('.paraprev').hide();
                 $('.myfinish-1').hide();
                 $('.myfinish-2').show();
        }

         processNext(0);
       
         // $('.next').fadeIn();

        // $('.prev').fadeIn();

   }
   else if(CURR_INDEX == 1)

    {

        $('.prev').hide();

        $('.next').show();

         var question_type = $(VISIBLE_ELEMENT).attr('data-questiontype');
        if(question_type != 'para'){
        $('.paraprev').hide();
        $('.paranext').hide();

        }
        $('.myfinish-1').show();
       $('.myfinish-2').hide();

    }

    else 

    {
        // console.log('herere');
        $('.next').show();

        $('.prev').show();

        var question_type = $(VISIBLE_ELEMENT).attr('data-questiontype');
        if(question_type != 'para'){
        $('.paraprev').hide();
        $('.paranext').hide();

        }

         $('.myfinish-1').show();
       $('.myfinish-2').hide();

    }



}


function paraCurrentIndex() {
    
        return $(PARA_VISIBLE_ELEMENT).index();
}





function paraButtonStatus() {
  

    PARA_CURR_INDEX = paraCurrentIndex()+1;
    CURR_INDEX = getCurrentIndex()+1;

    // console.log(CURR_INDEX);
    // console.log(MAXIMUM_QUESTIONS);
    // console.log(PARA_CURR_INDEX);
    // console.log(PARA_MAXIMUM_QUESTIONS);
    
    if(PARA_CURR_INDEX == 0)
        PARA_CURR_INDEX = 1;
     
    if(CURR_INDEX == MAXIMUM_QUESTIONS)
    {
       
        if( PARA_MAXIMUM_QUESTIONS == 1 ){
// console.log('here1');
            $('.prev').show();
            $('.next').hide();
            $('.paranext').hide();
            $('.paraprev').hide();
            $('.myfinish-1').hide();
            $('.myfinish-2').show();
        }

        else if(PARA_CURR_INDEX == 1)
        {
// console.log('here2');
            $('.next').hide();
            $('.paranext').show();
            $('.paraprev').hide();
            $('.prev').show();
              $('.myfinish-1').show();
       $('.myfinish-2').hide();

        }

        else if(PARA_CURR_INDEX < PARA_MAXIMUM_QUESTIONS) 
        {
// console.log('here3');
          $('.paranext').show();
          $('.next').hide();
          $('.paraprev').show();
          $('.prev').hide();
            $('.myfinish-1').show();
       $('.myfinish-2').hide();

        }

        else if(PARA_CURR_INDEX == PARA_MAXIMUM_QUESTIONS ){
// console.log('here4');
                 $('.next').hide();
                 $('.paranext').hide();
                 $('.paraprev').show();
                 $('.prev').hide();
                  $('.myfinish-1').hide();
                 $('.myfinish-2').show();
         }

    }
     else if( PARA_MAXIMUM_QUESTIONS == 1 )

    {   

             $('.paranext').hide();
             $('.next').show(); 
             $('.paraprev').hide();
              $('.myfinish-1').show();
       $('.myfinish-2').hide();
        
        
   } 

    else if(PARA_CURR_INDEX == PARA_MAXIMUM_QUESTIONS )

    {   

             $('.paranext').hide();
             $('.next').show(); 
             $('.paraprev').show();
             $('.prev').hide(); 
               $('.myfinish-1').show();
       $('.myfinish-2').hide();
        
        
   }

    else if(PARA_CURR_INDEX == 1)

    {
        $('.next').hide();
        $('.paranext').show();
        $('.paraprev').hide();
        if(CURR_INDEX != 1){

        $('.prev').show();
        }
         $('.myfinish-1').show();
       $('.myfinish-2').hide();

    }

    else if(PARA_CURR_INDEX < PARA_MAXIMUM_QUESTIONS) 

    {
        $('.paranext').show();
        $('.paraprev').show();
        $('.next').hide();
        $('.prev').hide();
        
         $('.myfinish-1').show();
       $('.myfinish-2').hide();
    }



}



/**

 * The below method contains all common operations to perform after an event has generated

 * @return {[type]} [description]

 */

function doGeneralOperations() {

    updatePallet();

    setQuestionNumber();

    checkButtonStatus();

    updateCount();

    return false;

}



/**

 * This method returns the current visible div index;

 * @return {[type]} [description]

 */

function getCurrentIndex() {

    return $(VISIBLE_ELEMENT).index();

}



/**

 * This method is used to show the specific based on the provided index value

 * @param  {[type]} index [description]

 * @return {[type]}       [description]

 */

function showSpecificQuestion(index) {

   
    $(PARA_VISIBLE_ELEMENT).hide();

    $(VISIBLE_ELEMENT).hide();

    $("#questions_list .question_div:eq("+index+")").fadeIn();

     var question_type = $(VISIBLE_ELEMENT).attr('data-questiontype');

     if(question_type == 'para'){
           

           viewParaQuestion(getCurrentPara());

           paraButtonStatus();
       }

   
     doGeneralOperations();

      processNext(0);

      $('#myModal').modal('hide');

      var myactive = $(VISIBLE_ELEMENT).attr('data-acid');
   $('.question-sections a.active').removeClass('active');
   $('#'+myactive).addClass('active');

    return false;

}


function viewSpecificeParaQuestion(current_para){
        
        // console.log(current_para);
  
        PARA_DIV_REFERENCE      = $("#"+current_para+" .question_para");
 
        PARA_MAXIMUM_QUESTIONS  = $("#"+current_para+" .question_para").size();

        PARA_VISIBLE_ELEMENT    = "#"+current_para+" .question_para:visible";

        PARA_DIV_REFERENCE.first('div').show().next('div').hide();
}




function isEligibleToShow(index) {

    question = $("#questions_list .question_div:eq("+index+")");
  question_id = $(question[0]).attr('id');
  section_key = SECTIONS[CURRENT_SECTION].section_key;
  class_name = 'pallet_subject_'+section_key;
  
      if($('#pallet_'+question_id).hasClass(class_name))
      {
        return 1

      }
      else
      {
        
        return 0
      }

}



/**

 * This method is used to update the overall summary of the palletes.

 * @return {[type]} [description]

 */

function updateCount() {

  cid = $(VISIBLE_ELEMENT).attr('id');
    setAsCurrentQuestion('#pallet_'+cid);


    TOTAL_NOT_ANSWERED  = $(".not-answered").length - 1;

    TOTAL_NOT_VISITED   = $(".not-visited").length - 1;

    TOTAL_MARKED        = $(".marked").length - 1;

    TOTAL_ANSWERED      = $(".answered").length - 1;

    $('#palette_total_answered').html(TOTAL_ANSWERED);

    $('#palette_total_marked').html(TOTAL_MARKED);

    $('#palette_total_not_visited').html(TOTAL_NOT_VISITED);

    $('#palette_total_not_answered').html(TOTAL_NOT_ANSWERED);

}


function setAsCurrentQuestion(id) {
   $(id).removeClass(NOT_VISITED);
     $(id).removeClass(ANSWERED);
     $(id).removeClass(ANSWER_MARKED);
     
     $(id).addClass(NOT_ANSWERED);
}

function showSubjectQuestion(subject_id, subject_name) {
  
  // console.log(subject_id);
  // console.log(subject_name);
  question_number = $($("."+subject_id).first()).attr('id');
  // console.log(question_number);
   $(VISIBLE_ELEMENT).hide();

   if(CURRENT_SUBJECT_ID==0){
    CURRENT_SUBJECT_ID = 'subject_'+subject_id;
   }

   if(CURRENT_SUBJECT_ID!=subject_id)
    CURRENT_SUBJECT_ID = subject_id;


    $("#"+question_number).slideDown();
    pallet_id = '#pallet_'+question_number;
    pallet_div = '.question-palette';
    pallet_subjects_class = '.pallet_'+subject_id;
    category_title = subject_name;
  
    $('.pallete-elements-item').hide();
    $(pallet_subjects_class).fadeIn(300);
    
    // $(pallet_div).scrollTo(pallet_id,500);
    CURRENT_SUBJECT_ID =  '.pallet_'+subject_id;
    doGeneralOperations();
    CURRENT_SUBJECT_ID =  '.pallet_'+subject_id;
    $('#subject_title').html(category_title);
    pallet_subjects_class = CURRENT_SUBJECT_ID;
    $('.pallete-elements-item').hide();
    $(pallet_subjects_class).fadeIn(300);

     
     var myactive = $(VISIBLE_ELEMENT).attr('data-acid');
   $('.question-sections a.active').removeClass('active');
   $('#'+myactive).addClass('active');

   

    return false;
}



function updatePallet() {

// console.log('heere');

    var question_div_class = $(VISIBLE_ELEMENT).next('div').attr('class');

    if(question_div_class=='undefined')
        return;
  

    vid = $(VISIBLE_ELEMENT).attr('data-reviewid');

    CURRENT_SUBJECT_ID = '.pallet_subject_'+vid;

    subject_name = $('#subject_section_'+vid).attr('data-psubject_title');
    
    pallet_subjects_class = CURRENT_SUBJECT_ID;
    $('#subject_title').text(subject_name);
    $('.pallete-elements-item').hide();


    $(CURRENT_SUBJECT_ID).show();
     
     $(".question-sections a").first().addClass("active");



}




/**

 * This method is used to track the question no to show it on serial no.

 */

function setQuestionNumber() {

    $('#question_number').html(getCurrentQuestionNumber());

}



/**

 * This method is used to fetch the current question no.

 * @return {[type]} [description]

 */

function getCurrentQuestionNumber() {

    return $(VISIBLE_ELEMENT).index()+1;

}



 


 function intilizetimer(hrs, mins, sec)

     {

        HOURS       = hrs;

        MINUTES     = mins;

        SECONDS     = sec;

        $("#timerdiv").addClass('text-success');
       
        startInterval();

     } 

     function startInterval()

     {



        timer= setInterval("tictac()", 1000);

     }

    

    function stopInterval()

    {

        clearInterval(timer);

    } 



     function tictac(){

            SECONDS--;

            visible_div_id = $(VISIBLE_ELEMENT).attr('id');

            if(isNaN(SPENT_TIME[visible_div_id]))

                SPENT_TIME[visible_div_id] = 0;

            else

                SPENT_TIME[visible_div_id] = SPENT_TIME[visible_div_id]+1;

            

            $('#time_spent_'+visible_div_id).val(SPENT_TIME[visible_div_id]);

            

            if(SECONDS<=0)

            {

                MINUTES--;
                
                if(MINUTES < 10){

                  $("#mins").text('0'+MINUTES);
                }

                else{
                  $("#mins").text(MINUTES);

                }

                if(MINUTES<1)

                {

                    if(HOURS==0) {
                      $("#timerdiv").removeClass('text-success');
                      $("#timerdiv").addClass("text-red");
                     }
                    

                }

                if(MINUTES<0)

                {
                  if(HOURS!=0) {
                   
                    MINUTES = 59;

                    HOURS =  HOURS-1;

                    SECONDS = 59;

                    $("#mins").text(MINUTES);
                       $("#hours").text(HOURS);
                    return;
                  }
                    stopInterval();

                    $("#mins").text('0');


                     if(CURRENT_SECTION==SECTIONS_LENGTH) {
                    alert('You are exceeded the time to finish the exam.');
                    $('#onlineexamform').submit();
                  }
                  else{

                    CURRENT_SECTION++;
                    current_section = SECTIONS[CURRENT_SECTION];
                  
                    showSubjectQuestion('subject_'+current_section.section_key,current_section.section_name);
                      HOURS = current_section.hrs; 
                      MINUTES = current_section.minutes-1;
                      SECONDS = 59;
                      
                       $("#hours").text(HOURS);
                       
                         if(MINUTES < 10){

                            $("#mins").text('0'+MINUTES);
                          }

                          else{
                            $("#mins").text(MINUTES);

                          }

                       $("#seconds").text(SECONDS);



                      intilizetimer(HOURS, MINUTES,SECONDS); 
                  }


                }

                SECONDS=60;

            }

            if(MINUTES>=0){
               
                if(SECONDS < 10){

                  $("#seconds").text('0'+SECONDS);
                }

                else{
                  $("#seconds").text(SECONDS);

                }

               
            }
            else
            $("#seconds").text('00');

        }



Mousetrap.bind('left', function() { 

  prevClick();

});



Mousetrap.bind('right', function() { 

  nextClick();

});



Mousetrap.bind('escape', function() { 

  clearAnswer();

});



Mousetrap.bind(['shift+up'], function(e) {

   bookmark('add');

});

Mousetrap.bind(['shift+down'], function(e) {

   bookmark('delete');

});

</script>