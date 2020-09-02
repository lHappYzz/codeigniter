<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class commentsController extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('comment_model', 'comment', true);
		$this->load->helper('url');
	}
	public function index() {
		$this->load->library('pagination');
		$limit_per_page = 5;
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->comment->get_total();

		$config['base_url'] = base_url() . 'comments/page';
		$config['total_rows'] = $total_records;
		$config['per_page'] = $limit_per_page;
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);


		$this->load->view('comments', array(
			'comments' => $this->comment->get_current_page_records($limit_per_page, $start_index),
			'links' => 	$this->pagination->create_links(),
		));
	}
	public function create() {
		$config = array(
			array(
				'field' => 'creator_email',
				'label' => 'email',
				'rules' => array(
					'required',
					'trim',
					'valid_email',
					'max_length[190]',
				)
			),
			array(
				'field' => 'creator_name',
				'label' => 'name',
				'rules' => array(
					'max_length[190]',
					'trim',
				)
			),
			array(
				'field' => 'text',
				'label' => 'text',
				'rules' => array(
					'trim',
					'required',
				)
			),
		);
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run()) {
			if (empty($_POST['creator_name'])) {
				$creator_name = self::parse_string($_POST['creator_email'], '@');
			} else {
				$creator_name = $_POST['creator_name'];
			}

			$comment = array(
				'creator_name' => $creator_name,
				'creator_email' => $_POST['creator_email'],
				'text' => $_POST['text'],
			);
			$this->comment->set_comment($comment);
		}
		redirect('/');
	}
	public function parse_string($string, $symbol) {
		$name_from_email = '';
		if ($string){
			$name_from_email = substr($string, 0, strpos($string, $symbol));
		}
		return $name_from_email;
	}
}
