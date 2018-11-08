<?php
return [
	"basicAcount" => "Actualmente estas trabajando con una cuenta básica",
	"descriptionBasicAcount" => "Limite de Mesas: ".\Auth::user()->acount->tables.", Limite de Elementos en inventario: ".\Auth::user()->acount->products,
	"canUpBasic"=>"Para actualizar las características de tu cuenta o añador nuevos servicios, no dudes en comunicarte con el administrador al correo electronico: ".env('MAIL_USERNAME'),
   
];
