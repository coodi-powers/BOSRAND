<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Drank_m extends MY_Model
{
    protected $_table_name = 'tbl_dranken';
    protected $_order_by = 'naam';
    protected $_primary_key = 'drank_id';

    public function get_new ()
    {
        $drank = new stdClass();
        $drank->naam = '';
        $drank->titel_nl = '';
        $drank->subtext_nl = '';
        $drank->prijs = '0';
        $drank->prijs_2 = '0';
        $drank->prijs_3 = '0';
        return $drank;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }

    public function get_all ()
    {
        $this->db->select('drank_id, naam');
        $this->db->order_by($this->_order_by);
        $dranken = parent::get();

        // Return key => value pair array
        if (count($dranken)) {
            foreach ($dranken as $drank) {
                $array[$drank->drank_id] = $drank->naam;
            }
        }

        return $array;
    }
    
}
