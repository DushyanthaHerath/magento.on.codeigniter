<?php

if (!defined('BASEPATH'))
    exit("No direct script access allowed");

Class Magento {

    /**
     * @name		Magento Codeigniter Integration Library
     * @author		Dushyantha Herath
     * @link		http://www.Dushyantha.me
     * @license		MIT License Copyright (c) 2016 Dushyantha Herath
     * 
     * Permission is hereby granted, free of charge, to any person obtaining a copy
     * of this software and associated documentation files (the "Software"), to deal
     * in the Software without restriction, including without limitation the rights
     * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
     * copies of the Software, and to permit persons to whom the Software is
     * furnished to do so, subject to the following conditions:
     * 
     * The above copyright notice and this permission notice shall be included in
     * all copies or substantial portions of the Software.
     * 
     * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
     * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
     * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
     * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
     * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
     * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
     * THE SOFTWARE.
     */
    
    private $magento_path; 
    
    function __construct($params) {
        $this->magento_path = $_SERVER['DOCUMENT_ROOT'] . '/app/Mage.php';
        $name = $params['name'];
        // Include Magento application
        require_once ($this->magento_path);
        umask(0);
        // Initialize Magento and hide sensitive config data below site root
        // Uncomment next line if you have moved app/etc
        // $options = array('etc_dir' => realpath('../magento-etc'));
        Mage::app('default', 'store', $options = null);
        return Mage::getSingleton("core/session", array("name" => $name));
    }

    /*
     * Get front end session of the magento
     */

    public function getSession() {
        return Mage::getSingleton("core/session", array("name" => 'frontend'));
    }

    /*
     * @param $id
     */

    public function getProductById($id = null) {
        if (isset($id)) {
            Mage::getModel('catalog/product');
            return $obj->load($product_id);
        }
    }

}
