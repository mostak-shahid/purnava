<?php 
global $purnava_options;
$from_theme_option = $purnava_options['general-page-sections'];
$from_page_option = get_post_meta( get_the_ID(), '_purnava_page_section_layout', true );
$sections = (@$from_page_option['Enabled'])?$from_page_option['Enabled']:$from_theme_option['Enabled'];
?><?php get_header() ?>

<?php 
$user = "purnava";
$pass = "purnava@123";
$sid = "ePurnava"; 
$url="http://sms.sslwireless.com/pushapi/dynamic/server.php";
$param="user=$user&pass=$pass&sms[0][0]= 880XXXXXXXXXX &sms[0][1]=".urlencode("Test SMS 1")."&sms[0][2]=123456789&sms[1][0]= 8801670058131 &sms[1][1]=".urlencode("Your submitted order (ID#100006552) is now in Pending status. Thank You. @PURNAVA")."&sms[1][2]=123456790&sid=$sid";
$crl = curl_init();
curl_setopt($crl,CURLOPT_SSL_VERIFYPEER,FALSE);
curl_setopt($crl,CURLOPT_SSL_VERIFYHOST,2);
curl_setopt($crl,CURLOPT_URL,$url);
curl_setopt($crl,CURLOPT_HEADER,0);
curl_setopt($crl,CURLOPT_RETURNTRANSFER,1);
curl_setopt($crl,CURLOPT_POST,1);
curl_setopt($crl,CURLOPT_POSTFIELDS,$param);
$response = curl_exec($crl);
curl_close($crl);
echo 'SMS Send';
?>

<?php if($sections ) { foreach ($sections as $key => $value) { get_template_part( 'template-parts/section', $key );}}?>
<?php get_footer() ?>