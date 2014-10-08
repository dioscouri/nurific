<?php 
namespace Rystband\Models;

class Roles extends Eventbase 
{
    protected $collection = 'users.roles';
    protected $default_ordering_direction = '1';
    protected $default_ordering_field = 'name';
    
    public function __construct($config=array())
    {
        $config['filter_fields'] = array(
            'name', 'type'
        );
        $config['order_directions'] = array('1', '-1');
        
        parent::__construct($config);
    }
    
    protected function fetchFilters()
    {
        $this->filters = array();
    
        $filter_keyword = $this->getState('filter.keyword');
        if ($filter_keyword && is_string($filter_keyword))
        {
            $key =  new \MongoRegex('/'. $filter_keyword .'/i');
    
            $where = array();
            $where[] = array('name'=>$key);
           // $where[] = array('email'=>$key);
           // $where[] = array('first_name'=>$key);
           // $where[] = array('last_name'=>$key);
    
            $this->filters['$or'] = $where;
        }
    
        $filter_id = $this->getState('filter.id');
        if (strlen($filter_id))
        {
            $this->filters['_id'] = new \MongoId((string) $filter_id);
        }
        $filter_type = $this->getState('filter.type'); 

        if (strlen($filter_type))
        {
            $this->filters['type'] =  $filter_type;
        }
        $filter_group = $this->getState('filter.group');     
        if (strlen($filter_group))
        {
            $this->filters['group'] =  $filter_group;
        }      

        $filter_name_contains = $this->getState('filter.name-contains', null, 'name');
        if (strlen($filter_name_contains))
        {
            $key =  new \MongoRegex('/'. $filter_name_contains .'/i');
            $this->filters['name'] = $key;
        }
        
    
        return $this->filters;
    }
    
    protected function buildOrderClause()
    {
        $order = null;
    
        if ($this->getState('order_clause')) {
            return $this->getState('order_clause');
        }
    
        if ($this->getState('list.order') && in_array($this->getState('list.order'), $this->filter_fields)) {
    
            $direction = '1';
            if ($this->getState('list.direction') && in_array($this->getState('list.direction'), $this->order_directions)) {
                $direction = (int) $this->getState('list.direction');
            }
    
            $order = array( $this->getState('list.order') => $direction);
        }
    
        return $order;
    }

    /**
     * An alias for the save command
     * 
     * @param unknown_type $values
     * @param unknown_type $options
     */
    public function create( $values, $options=array() ) 
    { 
        
        $save =  $this->save( $values, $options );
        if($save) {
            $activity = new \Rystband\Models\Activity;
            $activity->create(array('type'=> 'role', 'action' => 'activated', 'object' => $save->cast()));
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
            $activity->create(array('type'=> 'role', 'action' => 'update', 'object' => $save->cast(), 'updated' =>  $values ));
        }

        return $save;
   
    }
}