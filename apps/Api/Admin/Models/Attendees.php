<?php 
namespace Rystband\Models;

class Attendees extends Eventbase 
{
    protected $collection = 'attendees';
    protected $default_ordering_direction = '1';
    protected $default_ordering_field = 'type';

    public function __construct($config=array())
    {
        $config['filter_fields'] = array(
            'name', 'start_date', 'end_date'
        );
        $config['order_directions'] = array('1', '-1');
        
        parent::__construct($config);
    }

    public function getPrefab() {
        $prefab = New Rystband\Models\Prefabs\Tag();
        return $prefab;
    }
    
    protected function fetchFilters()
    {   
       
        $filter_keyword = $this->getState('filter.keyword');
        
        if ($filter_keyword && is_string($filter_keyword))
        {
            $key =  new \MongoRegex('/'. $filter_keyword .'/i');
    
            $where = array();
            $where[] = array('name'=>$key);
            $where[] = array('slug'=>$key);
            $where[] = array('event_id'=>$key);
            $where[] = array('start_date'=>$key);
            $where[] = array('end_date'=>$key);
  
    
            $this->filters['$or'] = $where;
        }
    
        $filter_id = $this->getState('filter.id');

        if (strlen($filter_id))
        {
            $this->filters['_id'] = new \MongoId((string) $filter_id);
        }




        $filter_profile_complete = $this->getState('filter.profile.complete');

        if (strlen($filter_profile_complete))
        {
            $this->filters['first_name'] = array('$ne' => null);
            $this->filters['last_name'] = array('$ne' => null);
            $this->filters['phone'] = array('$ne' => null);
        }

        $filter_yearday = $this->getState('filter.yearday');

        if (strlen($filter_yearday))
        {   
            $this->filters['created.yday'] = $filter_yearday;
        }

        $filter_authkey = $this->getState('filter.authkey');

        if (strlen($filter_authkey))
        {   
            $this->filters['authkey'] = $filter_authkey;
        }

        $filter_eventid = $this->getState('filter.eventid');

        if (strlen($filter_eventid))
        {
            $this->filters['eventid'] = $filter_eventid;
        }

        $filter_ticket_id = $this->getState('filter.ticket_id');

        if (strlen($filter_eventid))
        {
            $this->filters['ticket.id'] = $filter_ticket_id;
        }

        $filter_slug = $this->getState('filter.slug');

        if (strlen($filter_slug))
        {
            $this->filters['slug'] = $filter_slug;
        }

         $filter_first_name = $this->getState('filter.first_name');

        if (strlen($filter_first_name))
        {
            $this->filters['first_name'] = $filter_first_name;
        }

        $filter_last_name = $this->getState('filter.last_name');

        if (strlen($filter_last_name))
        {
            $this->filters['last_name'] = $filter_last_name;
        }

        $filter_phone = $this->getState('filter.phone');

        if (strlen($filter_phone))
        {
            $this->filters['phone'] = $filter_phone;
        }

        $filter_email = $this->getState('filter.email');

        if (strlen($filter_email))
        {
            $this->filters['email'] = $filter_email;
        }

        $filter_offers_sms = $this->getState('filter.offers.sms');
        
        if (strlen($filter_offers_sms))
        {
         $this->filters['offers.sms'] = 'on';
        }

         $filter_offers_email = $this->getState('filter.offers.email');
        
        if (strlen($filter_offers_email))
        {
         $this->filters['offers.email'] = 'on';
        }
        
      /*  $filter_username_contains = $this->getState('filter.username-contains', null, 'username');
        if (strlen($filter_username_contains))
        {
            $key =  new \MongoRegex('/'. $filter_username_contains .'/i');
            $this->filters['username'] = $key;
        }
        
        $filter_email_contains = $this->getState('filter.email-contains');
        if (strlen($filter_email_contains))
        {
            $key =  new \MongoRegex('/'. $filter_email_contains .'/i');
            $this->filters['email'] = $key;
        }
       

        $filter_password = $this->getState('filter.password');
        if (strlen($filter_password))
        {
            $this->filters['password'] = $filter_password;
        }

        $filter_group = $this->getState('filter.group');

        if (strlen($filter_group))
        {
            $this->filters['groups.id'] = new \MongoId((string) $filter_group);
        }*/
        
    
        return $this->filters;
    }

      public function getTotal()
    {
        
        $filters = $this->getFilters();
        $mapper = $this->getMapper();
        $count = $mapper->count($filters);
    
        return $count;
    }

    function getTotalCount() {
        $this->emptyState();
        return $this->getTotal();
    }


        public function prepareItem($item) {
           

            return $item;

        }


      public function getRandomItem( $refresh=false )
    {
        $filters = $this->getFilters();
        $options = $this->getOptions();
        
        $total = (int) $this->getTotal();
        $skip = rand(0,$total);

        $mapper = $this->getMapper();
        $options['limit'] = 1;
        if($skip !=0 || $skip !=1){
           $options['offset'] = $skip; 
        }
        
        $items = $mapper->find($filters, $options);
        if(@$items[0]){
             $item = $items[0];
            $item = $this->prepareItem($item);

        return $item;
        } else {
            return $items ;
        }
       
        
       
    }



    /**
     * An alias for the save command
     * 
     * @param unknown_type $values
     * @param unknown_type $options
     */
    public function create( $values, $options=array() ) 
    { 
        $values['created'] = \Dsc\Mongo\Metastamp::getDate('now');
        $save =  $this->save( $values, $options );
        if($save) {
            $activity = new \Rystband\Models\Activity;
            $activity->create(array('type'=> 'attendee', 'action' => 'created', 'object' => $save->cast()));
        }
        return $save;


    }

      /**
     * An alias for the save command
     * 
     * @param unknown_type $mapper
     * @param unknown_type $values
     * @param unknown_type $options
     */
    public function update( $mapper, $values, $options=array() )
    {   
        $save =  $this->save( $values, $options, $mapper );
     
        if($save) {
            $activity = new \Rystband\Models\Activity;
            $activity->create(array('type'=> 'attendee', 'action' => 'update', 'object' => $save->cast(), 'updated' =>  $values ));
        }

        return $save;
   
    }


}
?>