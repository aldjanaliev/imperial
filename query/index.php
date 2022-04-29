<?
	require_once (__DIR__.'/config.php');
	require_once (__DIR__.'/crest.php');
	$utm_source    = $_SESSION['utm_source'];
    $utm_medium    = $_SESSION['utm_medium'];
    $utm_campaign  = $_SESSION['utm_campaign'];
    $utm_content   = $_SESSION['utm_content'];
    $utm_term      = $_SESSION['utm_term'];

	$message_crm = '';
	foreach ( $_POST as $key => $value ) {
		if ( $value != ""  && $key != "admin_email" && $key != "form_subject" ) {
			if (is_array($value)) {
				$val_text = '';
				foreach ($value as $val) {
					if ($val && $val != '') {
						$val_text .= ($val_text==''?'':', ').$val;
					}
				}
				$value = $val_text;
			}

			$message_crm .= "<b>$key:</b> $value<br>";

		}
	}

	$result = CRest::call(
		'crm.lead.add',
		['FIELDS' => ['TITLE' => 'Заявка с сайта https://quiz-atlas-spb.ru', 'NAME' => 'Уточнить имя!', 'COMMENTS' => $message_crm, 'PHONE' => ['0' => ['VALUE' => $phone, 'VALUE_TYPE' => 'WORK', ], ], 'UTM_SOURCE' => $utm_source, 'UTM_MEDIUM' => $utm_medium, 'UTM_CAMPAIGN' => $utm_campaign, 'UTM_CONTENT' => $utm_content, 'UTM_TERM' => $utm_term, ], ]
	);

	if(!empty($result['result'])){
        echo 'Lead add';
    }elseif(!empty($result['error_description'])){
        echo 'Lead not added: '.$result['error_description'];
    }else{
        echo 'Lead not added';
    }