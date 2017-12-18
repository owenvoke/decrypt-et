<?php

namespace pxgamer\DecryptET;

/**
 * Class Decrypt
 * @package pxgamer\DecryptET
 */
class Decrypt extends Implementations
{
    public const MAX_DECRYPT_PASSES = 3;

    /**
     * @var string
     */
    protected $base_url = 'https://extra.to';
    /**
     * @var JSON
     */
    protected $json;
    /**
     * @var string
     */
    protected $decrypted;
    /**
     * @var string
     */
    private $full_page;

    /**
     * Decrypt constructor.
     */
    public function __construct()
    {
        // Create a new JSON class object
        $this->json = new JSON();
    }

    /**
     * @param string $url_path
     * @return string
     */
    public function fetch($url_path = '/')
    {
        // Fetch the page from ET
        $cu = curl_init();
        curl_setopt_array(
            $cu,
            [
                CURLOPT_URL => $this->base_url . $url_path,
                CURLOPT_RETURNTRANSFER => true,
            ]
        );

        // Set the $this->full_page variable (for use later on) to the returned value
        $this->full_page = curl_exec($cu);
        return $this->full_page;
    }

    /**
     * @return string
     */
    public function decrypt()
    {
        // Fetch the password from the 'hidden' JS list
        preg_match('/\|format\|(.*?)\|try\|/i', $this->full_page, $pass_phrase);

        // Create the password by combining the matched password with the salt from the JSON in $this->populate()
        $concatenated_pass = $pass_phrase[1] . hex2bin($this->json->__get('s'));
        $md5 = array();
        $md5[0] = md5($concatenated_pass, true);
        $result = $md5[0];
        for ($i = 1; $i < self::MAX_DECRYPT_PASSES; $i++) {
            $md5[$i] = md5($md5[$i - 1] . $concatenated_pass, true);
            $result .= $md5[$i];
        }
        $key = substr($result, 0, 32);

        // Decrypt the base64 encoded text using the IV value from the JSON in $this->populate()
        $data = openssl_decrypt(
            base64_decode($this->json->__get('ct')),
            'aes-256-cbc',
            $key,
            true,
            hex2bin($this->json->__get('iv'))
        );

        // Replace the redirect JS code function
        $this->decrypted = preg_replace(
            '/<script type\=\"text\/javascript\">eval\(function\(p,a,c,k,e,d\)\{[\s\S]*?<\/script>/i',
            '',
            json_decode($data, true)
        );

        // Return the decoded content, this can then be used to replace the page content
        return $this->decrypted;
    }

    /**
     * @return JSON
     */
    public function populate()
    {
        // Create a new DOMDocument object, and load the full page value into it
        $dom = new \DOMDocument();
        $dom->loadHTML($this->full_page);

        // Get the value of the #e_content element, which contains the JSON required for decryption
        $e_content = $dom->getElementById('e_content')->nodeValue;
        $json = json_decode($e_content);

        // Add the decoded values as keys in the JSON class
        foreach ($json as $key => $value) {
            $this->json->__set($key, $value);
        }

        return $this->json;
    }
}
