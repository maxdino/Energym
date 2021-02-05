<?php
session_start();
require_once 'classphp/PasswordLib/PasswordLib.php';
/**
 * Genera Números Aleatorios
 * y con uno de las operaciones
 * aritméticas
 */
function NumerAletorios(){
  $operacion =array('+','-',
  	               '*','/');
  $mostrar   =null;
  $num1      =rand(0,50);
  $num2      =rand(0,20);
  $op        =rand(0,count($operacion)-1);
  $optiom    =$operacion[$op];
  $mostrar   =$num1.$optiom.$num2;
  return $mostrar;
}

/**
 * Parsea para la operación
 * aritmética.
 * @param string $string [string con la operación aritmética]
 */
function Operacion($string){
	$resutado=0;
	//Operadores aritmeticos
    $valor=array('+','-',
  	         '*','/');
	foreach ($valor as $key => $value) {
		//Realizamos la búsqueda de dígitos y operadores
		//con funcion preg_match, al cumplirse realiza la operación matemática
		if(preg_match("/(\d+)\\".$value."(\d+)/",$string, $results)!=0){
			switch ($value) {
				case '+':
			        $resutado=($results[1])+($results[2]);
					break;
				case '-':
			        $resutado=($results[1])-($results[2]);
					break;
				case '*':
			        $resutado=($results[1])*($results[2]);
					break;
				case '/':
			        $resutado=round(($results[1])/($results[2]),2);
					break;	
				default:
					break;
			}
	}
	}
 //Se devuelve el resultado de la operacion	
return $resutado;	
}

if(!empty($_POST['capt'])){
	$_SESSION["valor"]=rand(0,50);
}
//Se verifica la variable global
//si contiene datos, se generara las claves
if(!empty($_SESSION["valor"])){
	if(strlen($_SESSION["valor"])>0){
	//Instancia de la clase
    $PasswordLib = new PasswordLib\PasswordLib();
    //Se guarda en la variable la operacion matimatica
    $numaleatorio=NumerAletorios();
    //Se incripta el resultado devuelto
    //de la operacion matematica
    $hash = $PasswordLib->createPasswordHash(Operacion($numaleatorio));
     //Enviamos enformacion para que se almacene 
     //en el navegador del usuario
	setcookie('captcha',$hash,time()+60*3);
	if(NumerAletorios()!=""){
		echo '{"retornar":"'.$numaleatorio.'"}';
	}else{
		echo '{"retornar":false}';
	}
	}
}
?>