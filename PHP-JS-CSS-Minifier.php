<body style="font-family: monospace;">
<?php
	/*
	 * JS and CSS Minifier 
	 * version: 1.1 (2019-08-21)
	 *
	 * This document is licensed as free software under the terms of the
	 * MIT License: http://www.opensource.org/licenses/mit-license.php
	 *
	 * Toni Almeida wrote this plugin, which proclaims:
	 * "NO WARRANTY EXPRESSED OR IMPLIED. USE AT YOUR OWN RISK."
	 * 
     * Reginaldo Izidório (misteregis) edited this plugin
     *
	 * This plugin uses online webservices from javascript-minifier.com and cssminifier.com
	 * This services are property of Andy Chilton, http://chilts.org/
	 *
	 * Copyrighted 2019 by Toni Almeida, Reginaldo Izidório (misteregis).
	 */

    /*
      * The minify() function can use as parameter file (path/to/file.css or .js) or
      * The minify() function can use as parameter a single file (path/to/file.css or .js)
      * or multiple files using array [path/to/file.js, path/to/file.css]
      * or multiple files in array or as comma-separated parameters
      * Ways of use:
      *    minify('path/to/file.js', 'path/to/file.css') [as parameters]
      *    minify(array('path/to/file.css', 'path/to/file.js')) [as array]
      *    minify((object)['path/to/file.css', 'path/to/file.js']) [as object array]
      *    minify((object)['css/file1.css', 'js/file1.js'], ['css/file2.css', 'js/file2.js'], 'js/file3.js','css/file3.css') [or as object, array and parameters]
      *    
      *    
      *    
    */

    // Array
    $array = array(
        "js/application.js",
        "css/application.css"
    );

    // Object Class
    $object = new stdClass();
    $object->file1 = 'js/application.js';
    $object->file2 = 'css/application.css';

    // Object Array
    $arrayObject = (object) array(
        "css/main.css",
        "js/main.js"
    );


    minify($array, $object, $arrayObject, "js/main.js", "css/main.css");

	function minify() {
        $numargs = func_num_args();
        $arg_list = func_get_args();
        $urlArray = array(
            'js'  => 'https://javascript-minifier.com/raw',
            'css' => 'https://cssminifier.com/raw'
        );

        for ($i = 0; $i < $numargs; $i++) {
            $file = $arg_list[$i];
            if (getType($file) === 'string') {
                $path = pathinfo($file);
                $url = $urlArray[$path['extension']];
                $min = str_replace($path['basename'], $path['filename'] . '.min.' . $path['extension'], $file);
                $handler = @fopen($min, 'w') or die("<h3 style=\"font-weight:bold;color:#c10000\">Error creating file '{$min}'! Directory or file does not exist.</h3>");

                if (file_exists($file)) {
                    $postdata = array(
                        'http' => array(
                            'method'  => 'POST',
                            'header'  => 'Content-type: application/x-www-form-urlencoded',
                            'content' => http_build_query(array('input' => file_get_contents($file)))
                        )
                    );
                    fwrite($handler, file_get_contents($url, false, stream_context_create($postdata)));
                    fclose($handler);
                    echo "<div style=\"font-weight:bold;color:#007900\">File <a href='" . $min . "'>" . $min . "</a> done!</div><br />";
                } else {
                    echo "<div style=\"font-weight:bold;color:#c10000\">File {$min} failed! File {$file} does not exist!</div><br />";
                }
            } else {
                foreach($file as $f) {
                    minify($f);
                }
            }
        }
	}
?>
</body>
