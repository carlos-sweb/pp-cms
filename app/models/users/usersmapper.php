<?php 

namespace Users;


class Usersmapper extends \DB\SQL\Mapper{
	
	public function __construct(){

		parent::__construct( \Base::instance()->get("DB"),"users","id,email,password" );
	}

	public function login( $e , $pwd  ){

		// Esta es la consulta hacia la base de datos
		// Siempre verificando que el usuario tenga el fiueld active en valor 1
		// lo que significa que esta activo
		$query = $this->find( 
			array('email=? and active=1', $e ), array('limit','1')
		);

		if( count($query) > 0 ){
			$user = $query[0];
			// Aqui se puede crear un log , que hacereferencia 
			// que se puede entregar un email que este en la 
			// base de datos y se pueda registrar en el caso que 
			// que la contraseña sea incorrecta registrar un intento fallido 
			// y realizar algunas reglas como suspender al tercer intento ,
			// ahora esto tendria un posible uso maliciozo para dejar bloqueados los email por eso lo importante de detctar el dispositivo he individualizarlo 



			 return password_verify( $pwd , $user->password ) ? true : false ;
		}
		// en el caso que no se encuentre el usario con el email solicitado 
		// se retorna falso
		return false;

	}
}

