<?php


class Suggestions_model extends CI_Model
{
    public function get($id)
    {
        return $this->db->select('*')
            ->from('suggestions')
            ->where('id =', $id)
            ->get()
            ->row_array();
    }

    public function find($params = array(), $pagination = array())
    {
        return $this->db->select('*')
            ->from('suggestions')
            ->or_like($params)
            ->limit($pagination['limit'])
            ->offset($pagination['offset'])
            ->get()
            ->result_array();
    }

    public function find_by_rank($params = array(), $pagination = array())
    {
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

    public function update($id, $data)
    {
        $this->db->where('id=', $id);
        return $this->db->update('suggestions', $data);
    }

    public function create($data)
    {
        $this->db->set($data);
        $res = $this->db->insert('suggestions');
        $new_id = $this->db->insert_id();
        return $res ? $new_id : false;
    }

    public function remove($id)
    {
        if (!is_numeric($id) || empty($id)) return false;

        $this->db->trans_start();

        $id = (int)$id;
        $this->db->where('id=', $id);
        $this->db->delete('suggestions');

        // delete ranks
        $this->db->where('suggestion_id=', $id);
        $this->db->delete('ratings');

        $this->db->trans_complete();
        return $this->db->trans_status() === FALSE ? false : true;
    }

    public function total($params = array())
    {
        return $this->db->or_like($params)
            ->count_all_results('suggestions');
    }

    public function get_matched_score($scores_table)
    {
        arsort($scores_table);

        $result = array();

        $excluded = array();
        $p = 10.0;
        foreach ($scores_table as $key => $val) {

            $this->db->select('*')
                ->from('suggestions');
            if (count($excluded) > 0) {
                $this->db->where_not_in('id', $excluded);
            }
            $res = $this->db->limit(round($p))
                ->order_by($key, 'DESC')
                ->get()
                ->result_array();

            foreach ($res as $r) {
                $excluded[] = $r['id'];
                $result[] = $r;
            }

            $p = 0.6 * $p;
        }
        return $result;
    }

    public function rate($suggestion_id, $score_id, $rating)
    {
        $this->db->set(array(
            'suggestion_id' => $suggestion_id,
            'score_id' => $score_id,
            'rating' => $rating,
        ));
        $res = $this->db->insert('ratings');
        $new_id = $this->db->insert_id();
        return $res ? $new_id : false;
    }

}