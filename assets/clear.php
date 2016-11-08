<?php
if ($handle = opendir('./')) {
	while (false !== ($file = readdir($handle))) {
		if (!($file=='.' or $file=='..' or $file=='clear.php'))
		{
			echo dirname(__FILE__).'/'.$file.'<br/>';
			rrmdir(dirname(__FILE__).'/'.$file);
		}
	}
	closedir($handle);
	echo 'done';
}
function rrmdir($dir) { 
	if (is_dir($dir)) { 
		$objects = scandir($dir); 
		foreach ($objects as $object) { 
			if ($object != "." && $object != "..") { 
				if (filetype($dir."/".$object) == "dir") 
					rrmdir($dir."/".$object);
				else
					unlink($dir."/".$object);
			} 
		} 
		reset($objects); 
		rmdir($dir); 
	} 
} 
