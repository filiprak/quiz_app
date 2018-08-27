<?php


class Suggestions_model extends CI_Model
{
    public function get($id) {
        return $this->db->select('*')
            ->from('suggestions')
            ->where('id =', $id)
            ->get()
            ->row_array();
    }

    public function find($params = array(), $pagination=array()) {
        return $this->db->select('*')
            ->from('suggestions')
            ->or_like($params)
            ->limit($pagination['limit'])
            ->offset($pagination['offset'])
            ->get()
            ->result_array();
    }

    public function find_by_rank($params = array(), $pagination=array()) {
        return $this->db->select(' *,
                                    (SELECT count(*) from qa_ratings r WHERE r.suggestion_id = s.id AND `rating` = 1) as likes,
                                    (SELECT count(*) from qa_ratings r WHERE r.suggestion_id = s.id AND `rating` = 0) as dislikes')
            ->or_like($params)
            ->from('suggestions s')
            ->limit($pagination['limit'])
            ->offset($pagination['offset'])
            ->get()
            ->result_array();
    }

    public function update($id, $data) {
        $this->db->where('id=', $id);
        return $this->db->update('suggestions', $data);
    }

    public function create($data) {
        $this->db->set($data);
        $res = $this->db->insert('suggestions');
        $new_id = $this->db->insert_id();
        return $res ? $new_id : false;
    }

    public function remove($id) {
        if (!is_numeric($id) || empty($id)) return false;
        $id = (int) $id;
        $this->db->where('id=', $id);
        $res = $this->db->delete('suggestions');
        return $res ? true : false;
    }

    public function total($params = array()) {
        return $this->db->or_like($params)
            ->count_all_results('suggestions');
    }

}