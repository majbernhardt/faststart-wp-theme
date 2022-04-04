<?php
//Email Start
add_action( 'wp_ajax_sendemail', 'send_email' );
add_action( 'wp_ajax_nopriv_sendemail', 'send_email' );

add_filter('style_loader_tag', 'remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'remove_type_attr', 10, 2);
function remove_type_attr($tag, $handle) {
return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}


function send_email(){
    
    $method = $_SERVER['REQUEST_METHOD'];

    $c = true;
    if ( $method === 'POST' ) {
    	$project_name = 'Название сайта'; // Указать название сайта
    	$admin_email  = 'info@domain.ru'; // Указать почту на которую нужно отправлять письма 
    	$form_subject = 'Заявка с сайта';
    	$message = '';
    	$mess="Заявка:\n";
        
        $ar = [
            'name' =>'Имя',
            'phone' =>'Телефон',
            'email' =>'Почта',
            'message' =>'Сообщение',
            'form-id' =>'Идентификатор формы',
        ];
    	foreach ( $_POST as $key => $value ) {
    		if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject" ) {
    			if ($key === 'g-recaptcha-response' || $key === 'action') {
    				continue;
    			}
                if($ar[$key]){
    			$mess = $mess.$key.": ".$value."\n";
    			$message .= "
    			" . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
    				<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$ar[$key]</b></td>
    				<td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
    			</tr>
    			";
                }
    		}
    	}
    }
    
    $message = "<table style='width: 100%;'>$message</table>";
    
    function adopt($text) {
    	return '=?UTF-8?B?'.Base64_encode($text).'?=';
    }
    
    $headers = "MIME-Version: 1.0" . PHP_EOL .
    "Content-Type: text/html; charset=utf-8" . PHP_EOL .
    'From: '.adopt($project_name).'<web@domain.ru>' . PHP_EOL . // Указать почту у "From"
    'Reply-To: '.$admin_email.'' . PHP_EOL;
    
    
    if(isset($_FILES['files']['name']) && ($_FILES['files']['name'] != '')) {
           $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
            $detectedType = exif_imagetype($_FILES['files']['tmp_name']);
            $error = !in_array($detectedType, $allowedTypes);
       
        $EOL = "\r\n"; // ограничитель строк, некоторые почтовые сервера требуют \n - подобрать опытным путём
        $boundary     = "--".md5(uniqid(time()));  // любая строка, которой не будет ниже в потоке данных. 

        $subject= '=?utf-8?B?' . base64_encode($subject_text) . '?=';

        $headers    = "MIME-Version: 1.0;$EOL";   
        $headers   .= "Content-Type: multipart/mixed; boundary=\"$boundary\"$EOL";  
        $headers   .=  'From: '.$project_name.' <'.$admin_email.'>' . PHP_EOL;
        $headers .=  'Reply-To: '.$admin_email.'' . PHP_EOL;
        $multipart  = "--$boundary$EOL";   
        $multipart .= "Content-Type: text/html; charset=utf-8$EOL";   
        $multipart .= "Content-Transfer-Encoding: base64$EOL";   
        $multipart .= $EOL; // раздел между заголовками и телом html-части 
        $multipart .= chunk_split(base64_encode($message));   

        #начало вставки файлов

        foreach($_FILES["files"]["name"] as $key => $value){
            $filename = $_FILES["files"]["tmp_name"][$key];
            $file = fopen($filename, "rb");
            $data = fread($file,  filesize( $filename ) );
            fclose($file);
            $NameFile = $_FILES["files"]["name"][$key]; // в этой переменной надо сформировать имя файла (без всякого пути);
            $File = $data;
            $multipart .=  "$EOL--$boundary$EOL";   
            $multipart .= "Content-Type: application/octet-stream; name=\"$NameFile\"$EOL";   
            $multipart .= "Content-Transfer-Encoding: base64$EOL";   
            $multipart .= "Content-Disposition: attachment; filename=\"$NameFile\"$EOL";   
            $multipart .= $EOL; // раздел между заголовками и телом прикрепленного файла 
            $multipart .= chunk_split(base64_encode($File));   

        }

        #>>конец вставки файлов

        $multipart .= "$EOL--$boundary--$EOL";

        if(!mail($admin_email,  adopt($form_subject), $multipart, $headers)){
            return false;
            wp_die();
        } //Отправляем письмо
        else{
             return true;
            wp_die();
        }
    } else {
         
         $success_send = mail($admin_email, adopt($form_subject), $message, $headers );
    
        // echo $message;
        
        if (!$success_send) {
        // 	echo 'error';
            return false;
            wp_die();
        } else {
        // 	echo 'success';
            return true;
            wp_die();
        }     
    }
   
    
}
//email End