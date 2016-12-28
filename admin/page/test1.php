<?php
class page_test1 extends page{
	 public $title='Dashboard';
	 function init(){
	 	parent::init();
//6
	 	    $colors = ['red', 'green', 'blue'];
        	$count = 1;

  			foreach($colors as $cc) {
            	$this->add('Button')
                	 ->addClass('atk-swatch-'.$cc)
                	 ->addStyle("margin-left:10px;")
                	 ->set( "Button " . ($count++). " is ".$cc);

          //      	$cc = $_GET['cc'];
			       //  $label = $colors[$_GET['cc']];
			       //  $this->add("View")->setClass('row atk-push-small');
			      	// $this->add('Button')
			       //      ->addClass('atk-swatch-'.$cc)
			       //      ->set( "Button is ".$label);
            
            }
            
            $colors1 = ['yellow', 'ink', 'gray'];
        	$cnt = 1;
        	$this->add("View")->setClass('row atk-push-small');
      		foreach($colors1 as $key) {
            	$this->add('Button')
                	->addClass('atk-swatch-'.$key)
                	->addStyle("margin-left:10px;")
                	->set( "Button " . ($cnt++). " is ".$key);
            }
	        
//5
	 	// $count = 1;

   //      $this->add('Button')->set( "Button " . ($count++));
   //      $this->add('Button')->set( "Button " . ($count++));
   //      $this->add('Button')->set( "Button " . ($count++));


//4	 	
	 	    // $label = $_GET['123'];
	 	    // 	if($_GET['label'])
	 	    // 		$this->add('H1')->set($_GET['label']);
       //  	if(strlen($label) > 10) {
       //      	$this->add('P')->set('Label length is too long');
       //  }
//3
	 		 	// if ($_GET['text']){
	 		 	// 	$this->add('Button')->set($_GET['text']);
	 		 	// }
//2
	 		 	// $this->add('Button')->set($_GET['text']?: "No Label");
//1      
	 	// $this->myfunc('Some Button')->addClass('atk-swatch-green');
	 //}
	 // function myfunc($txt){
	 // 	$b =$this->add('Button')->set($txt);
	 // 	return $b;
	 }
}