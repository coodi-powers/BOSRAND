<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Banner_m extends MY_Model
{
    protected $_table_name = 'tbl_banners';
    protected $_table_box_name = 'tbl_banner_box';
    protected $_order_by = 'naam';
    protected $_primary_key = 'banner_id';

    public function get_new ()
    {
        $banner = new stdClass();
        $banner->naam = '';
        $banner->titel_nl = '';
        $banner->afbeelding = '';
        return $banner;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }

    public function get_all ()
    {
        $this->db->select('banner_id, naam');
        $this->db->order_by($this->_order_by);
        $banners = parent::get();

        // Return key => value pair array
        if (count($banners)) {
            foreach ($banners as $banner) {
                $array[$banner->banner_id] = $banner->naam;
            }
        }

        return $array;
    }
    
}
