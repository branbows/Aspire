  
                        <div class="row">
                            <div class="col-md-12">
                                <form class="match-questions">
                                <?php 
                                        $options            = json_decode($question->answers); 
                                        $correct_answers    = json_decode($question->correct_answers);
                                        $left               = $options->left;
                                        $right              = $options->right;
                                        $left_options       = (array)$left->options;
                                        $right_options      = (array)$right->options;
                                        
                                        $leftl2 = null;
                                        $rightl2  = null; 
                                        
                                        if(isset($left->optionsl2) && isset($right->optionsl2)){
                                        $leftl2             =  $left->optionsl2;
                                        $rightl2            =  $right->optionsl2;
                                    }


                                ?>
                                    <div class="row answersheet">
                                        <div class="col-md-4"><h4><span class="language_l1">{{$left->title}}</span> </h4></div>
                                        @if(isset($left->titlel2))
                                        <div class="col-md-4"><h4><span class="language_l2" style="display: none;">{{$left->titlel2}}</span> </h4></div>
                                        @else

                                          <div class="col-md-4"><h4><span class="language_l2" style="display: none;">{{$left->title}}</span> </h4></div>

                                        @endif
                                        <div class="col-md-4"><h4><span class="language_l1">{{$right->title}}</span></h4></div>
                                        @if(isset($right->titlel2))
                                        <div class="col-md-4"><h4><span class="language_l2" style="display: none;">{{$right->titlel2}}</span></h4></div>
                                         @else

                                          <div class="col-md-4"><h4><span class="language_l2" style="display: none;">{{$right->title}}</span> </h4></div>
                                        @endif
                                        <div class="col-md-2"><h4>Your answer</h4></div>
                                        <div class="col-md-2"><h4>Correct</h4></div>
                                    </div>
                                    <?php for($index=0; $index<count($left_options); $index++) { ?>
                                    <div class="row answersheet">

                            <div class="col-md-4"><span class="numbers-count">{{$index+1}}</span>
                            <span class="language_l1"> {{$left_options[$index]}}</span>
                            @if($leftl2)
                            <span class="language_l2" style="display: none;"> {{$leftl2[$index]}}</span>
                            @else
                            <span class="language_l2" style="display: none;"> {{$left_options[$index]}}</span>
                            @endif
                           </div>
                            <div class="col-md-4"> 
                           <span class="language_l1"> {{$right_options[$index]}} </span>
                            @if($rightl2)
                           <span class="language_l2" style="display: none;"> {{$rightl2[$index]}} </span>
                           @else
                           <span class="language_l2" style="display: none;"> {{$right_options[$index]}} </span>
                           @endif
                          </div>

                            <div class="col-md-2">
                                <span class="numbers-count bg-primary">{{$user_answers[$index]}}</span>
                            </div>
                            <div class="col-md-2">
                                <span class="numbers-count bg-success">{{$correct_answers[$index]->answer}}</span>
                            </div>
                                    </div>
                                   <?php } ?>
                                 
                                </form>
                            </div>
                        </div>
                    