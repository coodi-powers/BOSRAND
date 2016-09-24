<?php
class Menucat_m extends MY_Model
{
    protected $_table_name = 'tbl_menu_cat';
    protected $_order_by = 'volgorde';
    protected $_primary_key = 'cat_id';

    public function get_new ()
    {
        $menucat = new stdClass();
        $menucat->naam = '';
        $menucat->titel_nl = '';
        $menucat->afbeelding = '';
        $menucat->parent_id = 0;
        $menucat->volgorde = 0;
        $menucat->intro_nl = '';
        $menucat->inhoud_nl = '';
        $menucat->type = 0;
        return $menucat;
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);

        // Reset parent ID for its children
        $this->db->set(array(
            'parent_id' => 0
        ))->where('parent_id', $id)->update($this->_table_name);
    }

    public function save_order ($cat_id, $volgorde)
    {
        $data = array('volgorde' => $volgorde);
        $this->db->set($data)->where($this->_primary_key, $cat_id)->update($this->_table_name);
    }

    public function save_parent ($cat_id, $parent)
    {
        $data = array('parent_id' => (int) $parent);
        $this->db->set($data)->where($this->_primary_key, $cat_id)->update($this->_table_name);
    }

    public function get_categories($cat_id)
    {
        $this->db->where('parent_id', $cat_id);
        $this->db->order_by($this->_order_by);
        return $this->db->get('tbl_menu_cat')->result_array();
    }


    public function get_nested ($parent)
    {
        $arr_return = array();
        $this->db->where('parent_id', $parent);
        $this->db->order_by($this->_order_by);

        $pages = $this->db->get('tbl_menu_cat')->result_array();

        foreach ($categories as $categorie)
        {
            $arr_temp = array();
            $arr_temp['cat_idid'] = $categorie['cat_id'];
            $arr_temp['naam'] = $categorie['naam'];
            $arr_temp['children'] = '';

            $children = $this->get_categories($categorie['cat_id']);
            if(!empty($children))
            {
                $arr_temp['children'] = $this->get_nested($categorie['cat_id']);
            }

            array_push($arr_return, $arr_temp);
        }

        return $arr_return;
    }


    public function get_with_parent ($id = NULL, $single = FALSE)
    {
        $this->db->select('tbl_menu_cat.*, p.naam as parent_title');
        $this->db->join('tbl_menu_cat as p', 'tbl_menu_cat.parent_id=p.cat_id', 'left');
        return parent::get($id, $single);
    }


    public function get_no_parents ()
    {
        // Fetch pages without parents
        $this->db->select('id, title');
        $this->db->where('parent_id', 0);
        $pages = parent::get();

        // Return key => value pair array
        $array = array(
            0 => 'No parent'
        );
        if (count($pages)) {
            foreach ($pages as $page) {
                $array[$page->id] = $page->title;
            }
        }

        return $array;
    }

    public function get_children ($parent_id)
    {
        // Fetch pages without parents
        $this->db->select('cat_id, naam');
        $this->db->where('parent_id', $parent_id);
        $pages = parent::get();

        // Return key => value pair array
        if (count($pages)) {
            foreach ($pages as $page) {
                $array[$page->cat_id] = $page->naam;
            }
            return $array;
        }
        else
        {
            return 'no-children';
        }
    }





    public function get_all ()
    {
        // Fetch pages without parents
        $this->db->select('cat_id, naam');
        $pages = parent::get();

        // Return key => value pair array
        $array = array(
            0 => 'No parent'
        );
        if (count($pages)) {
            foreach ($pages as $page) {
                $array[$page->cat_id] = $page->naam;
            }
        }

        return $array;
    }

    public function get_types()
    {
        $arr_types = array(
            1 => 'Dranken',
            2 => 'Gerechten'
        );

        return $arr_types;
    }
}