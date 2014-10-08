<?php 
namespace Rystband\Models;

class Settings extends Base 
{
    protected $db = null;
    
    public function __construct($config=array())
    {
        parent::__construct($config);
    
        $this->mapper = new \DB\Jig\Mapper( $this->getDb(), 'settings' );
    }
    
    public function getDb()
    {
        if (empty($this->db))
        {
            $this->db = new \DB\Jig( $this->app->get('db.jig.dir'), \DB\Jig::FORMAT_JSON );
        }
    
        return $this->db;
    }
}