// error_log( print_r( $formdata, true ) );
// die();


//Send attachment based on select
add_action('wpcf7_before_send_mail', 'before_send_mail', 100);
function before_send_mail($cf7) {
    $id = $cf7->id();
    
    //Set the form id
    if ($id == 15) {
        $submission = WPCF7_Submission::get_instance();
		$formdata = $submission->get_posted_data();
		$path1 = ' ';
		
        //Set attachment per option
        if ($formdata['your-select'] == "select1") { //Change select1 with your chosen value
            $path1 = WP_CONTENT_DIR . '/uploads/2019/12/this-pdf.pdf'; //Change the upload url to your desired attachment
        }

        if ($formdata['your-select'] == "select2") {//Change select2 with your chosen value
            $path1 = WP_CONTENT_DIR . '/uploads/2019/12/the-other-pdf.pdf'; //Change the upload url to your desired attachment
        }
        
		//Give attachment to mails
        $mail = $cf7->prop('mail');
        $mail['attachments'] = $path1;

        $cf7->set_properties(array(
            "mail" => $mail
        ));

        $mail_2 = $cf7->prop('mail_2');
        $mail_2['attachments'] = $path1;

        $cf7->set_properties(array(
            "mail_2" => $mail_2
        ));
    }
}