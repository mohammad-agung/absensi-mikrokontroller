<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sub_menu_model extends CI_Model
{
    public function getMenuTitle($id)
    {
        $query = "SELECT `tbl_sub_menu`.* , `tbl_menu`.`menu`
                FROM `tbl_sub_menu` JOIN `tbl_menu`
                ON `tbl_sub_menu`.`menu_id` = `tbl_menu`.`id`
                WHERE `tbl_sub_menu`.`id` = $id
                ";
        return $this->db->query($query)->result_array();
    }

    public function editSubMenu($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function updateSubMenu($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function deleteSubMenu($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
