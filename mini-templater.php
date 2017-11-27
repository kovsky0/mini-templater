<?php
/**
 * A simple helper class to process variables and alternative strings.
 * Based on Spintax by Jason Davis.
 *
 * @author Daniel Wyrzykowski <daniel@altruisto.com>
 * @link https://github.com/kovsky0/mini-templater
 * @license GPL-3.0
 */
class MiniTemplater
{
    /**
     * Function to process both alternative strings and variables inside given text.
     *
     * @param string $text The text to be processed.
     * @param array $variables The variables to be put inside the text.
     *
     * @return string The text with both alternative strings and variables processed.
     */
    public function process($text, $variables = array())
    {
        $text = $this->process_variables($text, $variables);
        $text = $this->process_alternatives($text);
        return $text;
    }

    /**
     * Function to process the variables inside given text. 
     *
     * It changes all instances of double square brackets [[]] 
     * to the value of array element which key corresponds to the string 
     * in between the brackets. Eg. [[first_name]] will be changed to
     * $variables['first_name'] value. 
     *
     * @param string $text The text to be processed.
     * @param array $variables An array containing elements to be put inside the text.
     *
     * @return string The text with variables put instead of strings inside double square brackets
     */
    public function process_variables($text, $variables = array())
    {
        foreach($variables as $key => $value)
        {
            $text = str_replace("[[$key]]", $value, $text);
        }        
        return $text;
    }

    /**
     * Function to process alternative strings inside given text.
     *
     * It changes all instances of double brace {{}}
     * to one of the values seperated by | for example
     * {{text1|text2}} will output either "text1" or "text2"
     *
     * @param string $text The text to be processed.
     *
     * @return string The text with alternative strings processed.
     */
    public function process_alternatives($text)
    {
        return preg_replace_callback(
            '/\{\{(((?>[^\{\}]+)|(?R))*)\}\}/x',
            array($this, 'replace'),
            $text
        );
    }

    /**
     * Function to process alternative strings recursively. 
     *
     * @param string The text to be processed.
     *
     * @return string Randomly chosen element from provided string alternatives.
     */
    public function replace($text)
    {
        $text = $this->process_alternatives($text[1]);
        $parts = explode('|', $text);
        return $parts[array_rand($parts)];
    }
}
?>