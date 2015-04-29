<?php
namespace week2\cprince;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 */
interface IModel {
    /**
     * 
     * A method used to reset all values.
     * 
     * @return SELF
     */
   
    public function reset();
    
    /**
     * A method to set all values based on an associative array.
     * 
     * @param {Array} [$values] - must be a valid associative array
     *
     * @return SELF
     * 
     */
    public function map(array $values);
}
