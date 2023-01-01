<?php

	$login = $_POST[ "login" ] ;
	$md2 = md5($_POST[ "mdp" ]) ;
	$mdp = substr($md2,0,-2);
	
	require "modeles/ModeleSuivAteliers.php" ;
	$responsable = ModeleSuivAteliers::getResponsable( $login , $mdp ) ;
	
	if( $responsable !== FALSE ){
		session_start() ;

		password_hash( $login , PASSWORD_DEFAULT);
		password_hash( $mdp , PASSWORD_DEFAULT);
		
		$_SESSION[ "numero" ] = $responsable[ "numero" ] ;
		$_SESSION[ "nom" ] = $responsable[ "nom" ] ; 
		$_SESSION[ "prenom" ] = $responsable[ "prenom" ] ; 
		
		header( "Location: /suivateliers/ateliers" ) ;
	}
	else {
		$erreur = 'Identifiant de connexion ou mot de passe incorrect.' ;
		require "vues/vue-connexion.php" ;
	}

?>
