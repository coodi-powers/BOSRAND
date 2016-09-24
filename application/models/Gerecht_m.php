<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Gerecht_m extends MY_Model
{
    protected $_table_name = 'tbl_gerechten';
    protected $_order_by = 'naam';
    protected $_primary_key = 'gerecht_id';

    public function get_new ()
    {
        $gerecht = new stdClass();
        $gerecht->naam = '';
        $gerecht->titel_nl = '';
        $gerecht->subtext_nl = '';
        $gerecht->prijs = '0';
        return $gerecht;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }

    public function get_all ()
    {
        $this->db->select('gerecht_id, naam');
        $this->db->order_by($this->_order_by);
        $gerechten = parent::get();

        // Return key => value pair array
        if (count($gerechten)) {
            foreach ($gerechten as $gerecht) {
                $array[$gerecht->gerecht_id] = $gerecht->naam;
            }
        }

        return $array;
    }
    
}
