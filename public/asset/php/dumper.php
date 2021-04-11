<?php

// Combined of the highlight_string and var_export
function Dumper()
{
    try {
        ini_set("highlight.comment", "#008000");
        ini_set("highlight.default", "#FFFFFF");
        ini_set("highlight.helper", "#808080");
        ini_set("highlight.keyword", "#0099FF; font-weight: bold");
        ini_set("highlight.string", "#99FF99");

        $vars = func_get_args();

        foreach ( $vars as $var ) {
            $output = var_export($var, true);
            $output = trim($output);
            $output = highlight_string("<?php " . $output, true);  // highlight_string() requires opening PHP tag or otherwise it will not colorize the text
            $output = preg_replace("|\\<code\\>|", "<code style='background-color: #000000; padding: 10px; margin: 10px; display: block; font: 12px Consolas;'>", $output, 1);  // edit prefix
            $output = preg_replace("|(\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>)(&lt;\\?php&nbsp;)(.*?)(\\</span\\>)|", "\$1\$3\$4", $output);  // remove custom added "<?php "
            echo $output;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
