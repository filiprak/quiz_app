<?php


class Questions_model extends CI_Model
{
    public function get($id) {
        return $this->db->select('*')
            ->from('questions')
            ->where('id =', $id)
            ->get()
            ->row_array();
    }

    public function find($params = array(), $pagination=array()) {
        return $this->db->select('*')
            ->from('questions')
            ->or_like($params)
            ->limit($pagination['limit'])
            ->offset($pagination['offset'])
            ->get()
            ->result_array();
    }

    public function update($id, $data) {
        $this->db->where('id=', $id);
        return $this->db->update('questions', $data);
    }

    public function create($data) {
        $this->db->set($data);
        $res = $this->db->insert('questions');
        $new_id = $this->db->insert_id();
        return $res ? $new_id : false;
    }

    public function remove($id) {
        if (!is_numeric($id) || empty($id)) return false;
        $id = (int) $id;
        $this->db->where('id=', $id);
        $res = $this->db->delete('questions');
        return $res ? true : false;
    }

    public function total($params = array()) {
        return $this->db->or_like($params)
            ->count_all_results('questions');
    }

    public function create_with_answers($question, $answers) {
        $this->db->trans_start();

        $this->db->set($question);
        $this->db->insert('questions');
        $q_id = $this->db->insert_id();

        foreach ($answers as $position => $answer) {
            if (!$answer) continue;

            $answer['position'] = $position;
            $answer['question_id'] = $q_id;

            $this->db->set($answer);
            $this->db->insert('answers');
        }

        $this->db->trans_complete();
        return $this->db->trans_status() === FALSE ? false : true;
    }

    public function get_with_answers($question_id) {
        $question = $this->db->select('*')
            ->from('questions')
            ->where('id=', $question_id)
            ->get()
            ->row_array();

        $answers = $this->db->select('*')
            ->from('answers')
            ->where('question_id=', $question_id)
            ->order_by('position', 'ASC')
            ->get()
            ->result_array();

        $answers_filtered = array();
        foreach (array(1,2,3,4) as $position) {
            $answers_filtered[$position] = array();
            foreach ($answers as $ans) {
                if ($ans['position'] == $position) {
                    $answers_filtered[$position] = $ans;
                    break;
                }
            }
        }

        return array('question' => $question, 'answers' => $answers_filtered);
    }

    public function update_with_answers($question, $answers) {
        $this->db->trans_start();

        $this->db->set($question);
        $this->db->where('id=', $question['id']);
        $this->db->update('questions', $question);

        foreach ($answers as $position => $answer) {
            if (!$answer) continue;

            $answer['position'] = $position;
            $answer['question_id'] = $question['id'];

            $this->db->set($answer);

            if(!is_string($answer['answer']) || !is_string($answer['next_question_group_id'])
                    || strlen($answer['answer']) < 1 || strlen($answer['next_question_group_id']) < 1 ) {
                if (is_numeric($answer['id'])) {
                    $this->db->where('id=', $answer['id']);
                    $this->db->delete('answers');
                }

            } else if (!is_numeric($answer['id'])) {
                $this->db->insert('answers');
            } else {
                $this->db->where('id=', $answer['id']);
                $this->db->set($answer);
                $this->db->update('answers');
            }
        }

        $this->db->trans_complete();
        return $this->db->trans_status() === FALSE ? false : true;
    }

    public function remove_with_answers($question_id) {
        if (!is_numeric($question_id)) return false;

        $this->db->trans_start();

        // delete all question answers
        $this->db->where('question_id=', $question_id);
        $this->db->delete('answers');

        // delete question
        $this->db->where('id=', $question_id);
        $this->db->delete('questions');

        $this->db->trans_complete();
        return $this->db->trans_status() === FALSE ? false : true;
    }

    public function get_all_groups() {
        return $this->db->query('SELECT DISTINCT group_id FROM qa_questions')
            ->result_array();
    }
}