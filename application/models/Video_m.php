<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 14/05/15
 * Time: 22:03
 */

class Video_m extends MY_Model
{
    protected $_table_name = 'tbl_videos';
    protected $_order_by = 'volgorde';
    protected $_primary_key = 'video_id';
    public $_rules = array();

    public function get_new ()
    {
        $video = new stdClass();
        $video->naam = '';
        $video->titel_nl = '';
        $video->link = '';
        $video->volgorde = '';
        return $video;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);
    }

    public function get_all ()
    {
        $this->db->select('video_id, naam');
        $this->db->order_by($this->_order_by);
        $videoen = parent::get();

        $array = array(
            0 => 'Geen video'
        );
        // Return key => value pair array
        if (count($videoen)) {
            foreach ($videoen as $video) {
                $array[$video->video_id] = $video->naam;
            }
        }

        return $array;
    }


    public function get_max_volgorde()
    {
        $this->db->select_max('volgorde');
        $max = parent::get();

        return $max;
    }

    public function save_order ($video, $volgorde)
    {
        $data = array('volgorde' => $volgorde);
        $this->db->set($data)->where($this->_primary_key, $video)->update($this->_table_name);
    }
    
}
