<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Customdev_m extends MY_Model
{
    protected $_table_name = 'tbl_customdevs';
    protected $_order_by = 'naam';
    protected $_primary_key = 'custom_id';
    public $_rules = array();

    public function get_new ()
    {
        $custom = new stdClass();
        $custom->naam = '';
        return $custom;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }
}
