<?php


class Tags_model extends CI_Model
{
    public function get($id) {
        return $this->db->select('*')
            ->from('tags')
            ->where('id =', $id)
            ->get()
            ->row_array();
    }

    public function find($params = array(), $pagination=array()) {
        return $this->db->select('*')
            ->from('tags')
            ->or_like($params)
            ->limit($pagination['limit'])
            ->offset($pagination['offset'])
            ->get()
            ->result_array();
    }

    public function find_select_opts($params = array(), $pagination=array()) {
        $table = $this->db->select('*')
            ->from('tags')
            ->or_like($params)
            ->limit($pagination['limit'])
            ->offset($pagination['offset'])
            ->get()
            ->result_array();
        $result = array();
        foreach ($table as $key => $val) { $result[$val['id']] = $val['name']; }
        return $result;
    }

    public function update($id, $data) {
        $this->db->where('id=', $id);
        return $this->db->update('tags', $data);
    }

    public function create($data) {
        $this->db->set($data);
        $res = $this->db->insert('tags');
        $new_id = $this->db->insert_id();
        return $res ? $new_id : false;
    }

    public function remove($id) {
        if (!is_numeric($id) || empty($id)) return false;
        $id = (int) $id;
        $this->db->where('id=', $id);
        $res = $this->db->delete('tags');
        return $res ? true : false;
    }

    public function total($params = array()) {
        return $this->db->or_like($params)
            ->count_all_results('tags');
    }

    public function random_tags($limit) {
        return $this->db->select('*')
            ->from('tags')
            ->limit($limit)
            ->order_by('RAND()')
            ->get()
            ->result_array();
    }

}