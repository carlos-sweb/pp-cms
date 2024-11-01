<?php 

class ppAll{
	protected $db;
	private $query = "";
	function __construct( $db , $query ){
		$this->db = $db;
		$this->query = $query;
	}
	public function all(){
		return $this->db->exec( $this->query );
	}
}


class ppDatabase{
	
	protected $db;
	private $query = "";

	function  __construct( $db ){
		$this->db = $db;
	}

	public function select( $table ){
				
		return new ppAll( $this->db , "SELECT * FROM `".$table."`" );
	} 
	
}

// $ppdb = new ppDatabase( $f3->get("DB") );
// print_r( $ppdb->select("users")->all() );