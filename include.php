<?php
/** include
	* Copyright (c) 2020. . https://github.com/mrBannyJo
	*/
CModule::AddAutoloadClasses("shape.answer", array(
	'Shape\Answer\HLTable' => 'lib/hltable.php',
	'Shape\Answer\EntityTable' => 'lib/entity.php',

	'Shape\Answer\Json' => 'lib/json.php',
));