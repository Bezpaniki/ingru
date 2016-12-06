<?php
#������ � �����������, ������� ����� �������� ������� POST � API �������
$user=array(
	'USER_LOGIN'=>'ololo', #��� ����� (����������� �����)
	'USER_HASH'=>'olokol' #��� ��� ������� � API (�������� � ������� ������������)
); 
require_once 'prepare.php';
$subdomain='olololo'; #��� ������� - ��������
#��������� ������ ��� �������
$link='https://'.$subdomain.'.amocrm.ru/private/api/auth.php?type=json';
$curl=curl_init(); #��������� ���������� ������ cURL
#������������� ����������� ����� ��� ������ cURL
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
curl_setopt($curl,CURLOPT_URL,$link);
curl_setopt($curl,CURLOPT_POST,true);
curl_setopt($curl,CURLOPT_POSTFIELDS,http_build_query($user));
curl_setopt($curl,CURLOPT_HEADER,false);
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

$out=curl_exec($curl); #���������� ������ � API � ��������� ����� � ����������
$code=curl_getinfo($curl,CURLINFO_HTTP_CODE); #������� HTTP-��� ������ �������
curl_close($curl); #��������� ����� cURL

CheckCurlResponse($code);

$Response=json_decode($out,true);
/*echo "<pre>";
var_dump($Response);
echo "</pre>";
*/
$Response=$Response['response'];


if(isset($Response['auth'])) #���� ����������� �������� � �������� "auth"
{
   
    require_once 'account_current.php';
    require_once 'fields_info.php';
    require_once 'contacts_list.php';
    require_once 'contact_add.php';
	return  'заебали';
}
else{
return 'нет';
}


?>