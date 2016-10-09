<?php


/*
	$requestData = file_get_contents("webrequest.xml");
	$request = new ClientRequest($Settings['Url'],$authCtx);
	$options = array(
		'url' =>  $Settings['Url'] . "/_vti_bin/client.svc/ProcessQuery",
		'data' => $requestData,
		'method' => 'POST',
		'headers' => array(
			'content-type' => 'application/atom+xml',
			'Accept' => 'application/atom+xml'
		)
	);
	$response = $request->executeQueryDirect($options);
	$json = json_decode($response);*/