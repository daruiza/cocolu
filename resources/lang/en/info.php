<?php
return [
	"basicAcount" => "You are currently working with a basic account",
	"descriptionBasicAcount" => "Limit of Tables: ".\Auth::user()->acount->tables.", Limit of Elements in inventory : ".\Auth::user()->acount->products,
	"canUpBasic"=>"To update the features of your account or add new services, do not hesitate to contact the administrator to the email: ".env('MAIL_USERNAME'),
];
