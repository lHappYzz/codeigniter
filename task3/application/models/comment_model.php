<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class comment_model extends CI_Model {
	public $creator_name;
	public $creator_email;
	public $text;

	public function __construct() {
		parent::__construct();
	}

	public function set_comment(array $comment) {
		$this->creator_name = htmlspecialchars($comment['creator_name']);
		$this->creator_email = htmlspecialchars($comment['creator_email']);
		$this->text = htmlspecialchars($comment['text']);

		$this->db->insert('comment', $this);
	}
	public function get_comments() {
		$this->db->order_by('id', 'desc');
		$comments = $this->db->get('comment')->result();

		return $comments;
	}
	public function get_current_page_records($limit, $start) {
		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get("comment");

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return array();
	}
	public function get_total() {
		return $this->db->count_all('comment');
	}
}
