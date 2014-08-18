<?php
	//演示作为服务端    同时也演示file_get_contents

	include '../init.php';
	
	$input = @file_get_contents('php://input');
	$data = @json_decode($input);
	
	Factory::getLogger()->debug(">>>id = $data->id");
	
	$userService = Factory::getInstance("UserService");
	$user = $userService->findUserById($data->id);

	resp($user);
