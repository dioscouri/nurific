<?php 
namespace Rystband\Models;


Class Events Extends \Dsc\Models\Db\Mongo; {


	protected function createDb()
    {
        $db_name = \Base::instance()->get('db.mongo.name');
        $this->db = new \DB\Mongo('mongodb://127.0.0.1:27017', $db_name);
        
        return $this;
    }

	
}



?>