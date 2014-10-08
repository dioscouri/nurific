<?php 
namespace Rystband\Models;


Class Users Extends \Users\Admin\Models\Users {


	protected function createDb()
    {
        $db_name = \Base::instance()->get('event.db');
    
        $this->db = new \DB\Mongo('mongodb://127.0.0.1:27017', $db_name);
        
        return $this;
    }

    /**
     * An alias for the save command
     * 
     * @param unknown_type $values
     * @param unknown_type $options
     */
    public function create( $values, $options=array() ) 
    { 
        $values['email'] = strtolower($values['email']);
        $values['created'] = \Dsc\Mongo\Metastamp::getDate('now');
        $save =  $this->save( $values, $options );
        if($save) {
            $activity = new \Rystband\Models\Activity;
            $activity->create(array('type'=> 'user', 'action' => 'created', 'object' => $save->cast()));
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
        $values['email'] = strtolower($values['email']);
        $save =  $this->save( $values, $options, $mapper );
     
        if($save) {
            $activity = new \Rystband\Models\Activity;
            $activity->create(array('type'=> 'user', 'action' => 'update', 'object' => $save->cast(), 'updated' =>  $values ));
        }

        return $save;
   
    }

	
}



?>