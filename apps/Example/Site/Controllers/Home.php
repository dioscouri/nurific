<?php
namespace Example\Site\Controllers;

class Home extends \Dsc\Controller
{

    public function index()
    {
        echo $this->theme->render('Example/Site/Views::home/index.php');
    }
    
    public function payload() {
    	
    	 $data = json_decode(file_get_contents('php://input')); //php
    	
    }
    
    public function alert() {
    	 
    	$command = (new \Example\Site\Models\Commands)->setState('filter.id', $this->app->get('PARAMS.id'))->getItem();
    	
    	if(empty($command)) {
    		$this->app->reroute('/');
    	}
    	
    	$this->app->set('alert', $command);
    	
    	echo $this->theme->render('Example/Site/Views::alert/view.php');
       
    }
    
    
    
    public function demo1() {
    	 
    	$command = (new \Example\Site\Models\Commands);
    	$command->title = "Traffic ALERT";
    	$command->copy = "<b>Construction:</b></br>between UT-204/N Wall Ave/Larsen Ln and 22nd St, maintenance work";
    	$command->hex1 = "7e00b5";
    	$command->hex2 = "c29b00";
    	$command->phone = "8017084970";
    	$command->save();
    	
    	//OK SEND THE SMS
    	$sid = "AC987e6946d5276512f023e5f2c959c918"; // Your Account SID from www.twilio.com/user/account
    	$token = "cb27cc45ca033b6bc5b0b87f143b955c"; // Your Auth Token from www.twilio.com/user/account
    	 
    	$client = new \Services_Twilio($sid, $token);
    	 
    	$message = $client->account->messages->sendMessage(
    			'8014365344', // From a valid Twilio number
    			$command->phone, // Text this number
    			'ALERT: http://hack.ryst.cc/alert/'.$command->id
    	);
    	 
    	
    	$this->app->reroute('/alert/'.$command->id);
    
    }
    
    public function demo2() {
    
    	
    	$bitcoin = json_decode(file_get_contents('http://api.bitcoincharts.com/v1/weighted_prices.json'));
    	$array = (array) $bitcoin->USD;
    	$value = 'pos';
    	
    	if( $array['24h'] <  $array['7d'])  {
    		$value = 'neg';
    	}
    	$absolute_difference = abs( $array['24h'] - $array['7d'] );
    	

    	
    	$command = (new \Example\Site\Models\Commands);
    	$command->title = "Bitcoin Current Value";
    	$command->copy = "The current value of Bitcoin is <span class='current ".$value."'>". $array['24h'] . "</span> ";
    	$command->hex1 = "0dfff1";
    	if($value == 'pos') {
    		$command->hex2 = "00FF00";
    	} else {
    		$command->hex2 = "FF0000";
    	}
    	
    	$command->phone = "8017084970";
    	$command->save(); 
    	 
    	//OK SEND THE SMS
    	$sid = "AC987e6946d5276512f023e5f2c959c918"; // Your Account SID from www.twilio.com/user/account
    	$token = "cb27cc45ca033b6bc5b0b87f143b955c"; // Your Auth Token from www.twilio.com/user/account
    
    	$client = new \Services_Twilio($sid, $token);
    
    	$message = $client->account->messages->sendMessage(
    			'8014365344', // From a valid Twilio number
    			$command->phone, // Text this number
    			'ALERT: http://hack.ryst.cc/alert/'.$command->id
    	);
    
    	$this->app->reroute('/alert/'.$command->id);
    }
    
    
    public function remove() {
    
    	$command = (new \Example\Site\Models\Commands)->setState('filter.id', $this->app->get('PARAMS.id'))->getItem();
    	
    	$commands =  (new \Example\Site\Models\Commands)->getItems();
    	foreach($commands as $del ) {
    		$del->remove();
    	}
    	
    	
    		\Dsc\System::instance()->addMessage( 'Alert is cleared', 'message' );
    		$this->app->reroute('/');
    	
    	
   	
    }
    
    public function pi() {
    	
    	$command = (new \Example\Site\Models\Commands)->setState('active', 'now')->getItem();
    	
    	if(!empty($command->id)) {
    		$array = $command->cast();
    	
    		echo json_encode($array);
    	} else {
    		echo json_encode(array());
    	}
    	
    }
}
