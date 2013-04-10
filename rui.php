<?php
	require_once("core.php");
	TapdLog::instance()->write_log('1234569999');
	TapdLog::instance()->write_log('ddddddddddddd');

	var_dump(DB::instance());
?>