<?php


class Users_model extends CI_Model
{
    public function get($id) {
        return $this->db->select('*')
            ->from('users')
            ->where('id =', $id)
            ->get()
            ->row_array();
    }

    public function find($params = array(), $pagination=array()) {
        return $this->db->select('*')
            ->from('users')
            ->or_like($params)
            ->limit($pagination['limit'])
            ->offset($pagination['offset'])
            ->get()
            ->result_array();
    }

    public function update($id, $data) {
        $this->db->where('id=', $id);
        return $this->db->update('users', $data);
    }

    public function create($data) {
        $this->db->set($data);
        $res = $this->db->insert('users');
        $new_id = $this->db->insert_id();
        return $res ? $new_id : false;
    }

    public function remove($id) {
        if (!is_numeric($id) || empty($id)) return false;
        $id = (int) $id;
        $this->db->where('id=', $id);
        $res = $this->db->delete('users');
        return $res ? true : false;
    }

    public function total($params = array()) {
        return $this->db->or_like($params)
            ->count_all_results('users');
    }

}