<?php 
namespace Rystband\Models;

class Tickets extends Eventbase 
{
    protected $collection = 'tickets';
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
        $prefab = New \Rystband\Models\Prefabs\Ticket();
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


        $filter_eventid = $this->getState('filter.eventid');

        if (strlen($filter_eventid))
        {
            $this->filters['eventid'] = $filter_eventid;
        }


        $filter_slug = $this->getState('filter.slug');

        if (strlen($filter_slug))
        {
            $this->filters['slug'] = $filter_slug;
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
            $activity->create(array('type'=> 'ticket', 'action' => 'created', 'object' => $save->cast()));
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
            $activity->create(array('type'=> 'ticket', 'action' => 'update', 'object' => $save->cast(), 'updated' =>  $values ));
        }

        return $save;
   
    }

}
?>