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
interface IDAO {
   
    public function getById($id);
    /*
     * A method to get a single row based on the id. 
     * 
     * @param string [id] - must be a valid ID
     * 
     * return IModel 
     * 
     */
    
    
    public function delete($id);
    /*
     * A method to delete a single row based on the id.
     * 
     * param string [id] - must be a valid ID.
     * 
     * return Boolean
     * 
     */
    
    
    public function save(IModel $model);
    /*
     * A method to update/insert a single row based on the id.
     * 
     * param string [id] - must be a valid ID.
     * 
     * return Boolean
     * 
     */
    
    
    public function getAllRows();
    /*
     * A method to return all rows from the table.
     * 
     * return Array
     * 
     * 
     */
}
