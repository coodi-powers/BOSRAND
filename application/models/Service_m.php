<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Service_m extends MY_Model
{
    protected $_table_name = 'tbl_service';
    protected $_order_by = 'naam';
    protected $_primary_key = 'service_id';
    public $_rules = array();

    public function get_new ()
    {
        $service = new stdClass();
        $service->naam = '';
        $service->titel = '';
        $service->inhoud = '';
        $service->afbeelding_1 = '';
        $service->afbeelding_2 = '';
        $service->afbeelding_3 = '';
        $service->afbeelding_4 = '';
        $service->titel_1 = '';
        $service->titel_2 = '';
        $service->titel_3 = '';
        $service->titel_4 = '';
        $service->inhoud_1 = '';
        $service->inhoud_2 = '';
        $service->inhoud_3 = '';
        $service->inhoud_4 = '';
        $service->link_1 = '';
        $service->link_2 = '';
        $service->link_3 = '';
        $service->link_4 = '';
        return $service;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }

    public function get_all ()
    {
        $this->db->select('service_id, naam');
        $this->db->order_by($this->_order_by);
        $serviceen = parent::get();

        $array = array(
            0 => 'Geen service'
        );
        // Return key => value pair array
        if (count($serviceen)) {
            foreach ($serviceen as $service) {
                $array[$service->service_id] = $service->naam;
            }
        }

        return $array;
    }

    /*
    public function get_max_volgorde()
    {
        $this->db->select_max('volgorde');
        $max = parent::get();

        return $max;
    }

    public function save_order ($service, $volgorde)
    {
        $data = array('volgorde' => $volgorde);
        $this->db->set($data)->where($this->_primary_key, $service)->update($this->_table_name);
    }
    */
}
