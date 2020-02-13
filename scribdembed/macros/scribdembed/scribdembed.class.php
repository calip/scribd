<?php
namespace Macro;
/**
 * Scribd Embed - macro class
 * 
 * Scribd documents or documents supported by Scribd (e.g. PDF, MS Office, ePub, and many others) can be embedded into schlix using the Scribd Docs Reader
 * 
 * @copyright 2020 Beplas Studio
 *
 * @license MIT
 *
 * @package scribdembed
 * @version 1.0
 * @author  Beplas Studio <alip@beplasstudio.com>
 * @link    https://beplasstudio.com/
 */

class ScribdEmbed extends \SCHLIX\cmsMacro {

    
    protected static $has_this_macro_been_called;
    
    private function processText($text) {
        $regex = '/<[a-zA-Z][^>]*>(https?:\/\/(?:www\.)?scribd\.com\/(?:.*doc|document|presentation)\/([^\/]+).*?)<\/[a-zA-Z]>/';
        preg_match_all($regex, $text, $matches);
        
        $match_count = count($matches[0]);
        if ($match_count > 0) {
            for ($i = 0; $i < $match_count; $i++) {
                $tag = $matches[0][$i];
                $url = $matches[1][$i];
                $id = $matches[2][$i];
                
                if ($url != null && $id != null){
                    
                    start_output_buffer();
                    $this->loadTemplateFile('view.macro', array('id' => $id), false);
                    $replacement_tag = end_output_buffer();
                    $text = str_replace($tag, $replacement_tag, $text);
                }
            }
        }
        static::$has_this_macro_been_called = 'yes';
        return $text;
    }
    
    /*
     * Run the macro
     * @global \SCHLIX\cmsHTMLPageHeader $HTMLHeader
     * @param array|string $data
     * @param object $caller_object
     * @param string $caller_function
     * @param array $extra_info
     * @return bool
     */
    public function Run(&$data, $caller_object, $caller_function, $extra_info = NULL) {
        global $HTMLHeader;
        if (static::$has_this_macro_been_called != 'yes'){

            if (is_array($data)) { // don't enable it for block (string)
                if (array_key_exists('summary', $data))
                    $data['summary'] = $this->processText($data['summary']);
                if (array_key_exists('description', $data))
                    $data['description'] = $this->processText($data['description']);
            } else{
                $data = $this->processText($data);
            }

            return true;
        }
    }

}
            