<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	*************************************************************
	*
	*	Copyright (c) 2012, PG (PG@miko.tw)
	*
	*	PG Tsai @ NCTU SenseLab
	*
	*	All rights reserved.
	*
	*************************************************************
	
	Redistribution and use in source and binary forms, with or without
	modification, are permitted provided that the following conditions are met: 

	1. Redistributions of source code must retain the above copyright notice, this
	   list of conditions and the following disclaimer. 
	2. Redistributions in binary form must reproduce the above copyright notice,
	   this list of conditions and the following disclaimer in the documentation
	   and/or other materials provided with the distribution. 

	THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
	ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
	WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
	DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
	ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
	(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
	LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
	ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
	(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
	SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

	The views and conclusions contained in the software and documentation are those
	of the authors and should not be interpreted as representing official policies, 
	either expressed or implied, of the Mikochan Project.
*/
require_once('recaptchalib.php');
class Mikochan extends CI_Controller {
	private function _PG_Debug($q)
	{
		echo '<pre>';
		print_r($q);
		echo '</pre>';
	}
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->database();
	}
	public function index()
	{

		//$this->output->cache(100);

		//echo "<h1>this is miko!!</h1><br/>";
		//$this->load->view('welcome_message');
		$q_group = $this->db->query('SELECT * FROM mikochan_group ORDER BY date DESC')->result();
		
		foreach ($q_group as $i)
		{
			$this->db->select('gid');
			$this->db->where('gid', $i->id);
			$count = $this->db->count_all_results('mikochan_post');
			$data['post_count'][$i->id] = $count;
		    $data['query2'][$i->id] = $i; // query2 record the id and name of group
			
			//get the posts of a group, limit is 7
			$query_offset = $count - 7;
			if ($query_offset < 0) $query_offset = 0;
			$this->db->select('*');
			$this->db->where('gid', $i->id);
			$this->db->order_by('id', 'asc');
			$this->db->limit(7, $query_offset);
			$q = $this->db->get('mikochan_post');
			$data['query'][] = $q->result();
			
			// get the size of the comments, we need to show the latest 7 comments.
			$this->db->select('gid');
			$this->db->where('gid', $i->id);
			$count = $this->db->count_all_results('mikochan_push');
			$query_shift = $count - 7;
			if ($query_shift < 0) $query_shift = 0;
			
			// get the comments of a group, limit is 7 
			$this->db->select('*');
			$this->db->where('gid', $i->id);
			$this->db->order_by('id', 'asc');
			$this->db->limit(7, $query_shift);
			$data['query3'][$i->id] = $this->db->get('mikochan_push')->result();
			
		}
		if (func_num_args() == 1)
		{
			$tmp = func_get_arg(0);
			if (is_numeric($tmp)) $data['jump_to'] = $tmp;
		}
		$this->load->view('layout', $data);
	}
	public function up_test()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
	}
	private function _add_group_record($_name)
	{
		$tmp_data = array
		(
			'name' => $_name
		);
		
		$this->db->insert('mikochan_group', $tmp_data);
		$this->db->select('id');
		$this->db->where('name', $_name);
		$q = $this->db->get('mikochan_group');
		return $q->row()->id;
		
	}
	private function _update_group_record($_gid)
	{
		date_default_timezone_set('Asia/Taipei');
		echo '<h1> gid is '.$_gid.'</h1>';
		$this->db->select('*');
		$this->db->where('id', $_gid);
		$q = $this->db->get('mikochan_group')->row()->date;
		echo 'Before update time is '.$q.'<br />';
		
		
		
		$tmp_data = array
		(
			'date' => date('Y-m-d H:i:s', time())
		);
		echo 'input date is '.$tmp_data['date'].'<br />';
		$this->db->where('id', $_gid);
		$this->db->update('mikochan_group', $tmp_data);
		
		$this->db->select('*');
		$this->db->where('id', $_gid);
		$q = $this->db->get('mikochan_group')->row()->date;
		echo 'After update time is '.$q.'<br />';
		
	}
	private function _modify_pic($_full_path)
	{

		$config['image_library'] = 'gd2';
		$config['source_image']	= $_full_path;

		$config['create_thumb'] 	= TRUE;
		$config['maintain_ratio']	= TRUE;
		$config['width']			= 200;
		$config['height']			= 200;
		$this->load->library('image_lib', $config); 
		if ( ! $this->image_lib->resize())
		{
			$this->image_lib->display_errors('<p>', '</p>');
			return false;
		}
		return true;
	}
	private function _check_user()
	{
		$VIP_flag = false;
		$rec_flag = false;
		if ($this->input->post('VIP_code') == "rixia")$VIP_flag = true;

		if ($this->input->post('recaptcha_response_field'))
		{
			$resp = recaptcha_check_answer
			(
				null,
				$_SERVER["REMOTE_ADDR"],
				$_POST["recaptcha_challenge_field"],
				$_POST["recaptcha_response_field"]
			);
			if ($resp->is_valid)
			{
				echo "<h1>You got it!<h1>";
				$rec_flag = true;
			}
			else
			{
				# set the error code so that we can display it
				$error = $resp->error;
				echo '<h1>'.$error.'</h1>';
			}
		}
		return $VIP_flag*2 + $rec_flag*1;
	}
	public function add_push()
	{
		$tmp_flag = $this->_check_user();
		if ($tmp_flag == 0)die('驗證碼錯誤');
		$tmp_data = array
		(
			'gid' => $this->input->post('gid'),
			'name' =>$this->input->post('name'),
			'msg' => $this->input->post('msg')
		);
		$this->db->insert('mikochan_push', $tmp_data);
		$this->load->view('push_success');
	}
	public function do_upload()
	{
		
		$tmp_flag = $this->_check_user();
		$VIP_flag = $tmp_flag >= 2 ? true:false;
		$rec_flag = $tmp_flag%2 == 1 ? true:false;
		if (!$VIP_flag && !$rec_flag) die('驗證碼驗證失敗');
		if (!$VIP_flag && $this->input->post('url'))
			die('未通過VIP認證無法使用URL貼圖，請保持URL欄位為空');
		$config['upload_path'] = './pic/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		
		if ($this->input->post('url')) 
		{
			if (!$this->upload->do_url_upload($this->input->post('url')))
				die ('讀取遠端圖片失敗');
			
		}
		else // make sure at least one pic could be processed, or just die.
		{	
			if (!$this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());
				die ('檔案上傳失敗');
			}
		}
		$up_tmp = $this->upload->data();
		if ( !$this->_modify_pic($up_tmp['full_path']))
		{
			die('err in _modify_pic()');
		}
		$gid_tmp = $this->input->post('gid');
		if (!$gid_tmp)
		{
			echo 'Create New record!!!!!!!!!!!!!!!!!<br />';
			$gid_tmp = $this->_add_group_record($this->input->post('title'));
		}
		else
		{
			echo 'Update record!!!!!!!!!!!!!!!!!<br />';
			$this->_update_group_record($gid_tmp);
		}
		$tmp_data = array
		(
			'gid' => $gid_tmp,
			'title' => $this->input->post('title'),
			'name' => $this->input->post('name'),
			'msg' => $this->input->post('msg'),
			'pic' => $up_tmp['file_name']
		);
		print_r($tmp_data);
		echo 'Insert Result'.$this->db->insert('mikochan_post', $tmp_data);

	}
	public function show_all()
	{
		$this->load->view('bm');
		if (func_num_args() != 1)
		{
			die('Error in show_all');
		}
		$_gid = func_get_arg(0);
		
		$this->db->select('*');
		$this->db->where('gid', $_gid);
		$data['query'] = $this->db->get('mikochan_push')->result();
		$this->load->view('full_page', $data);
		
		$this->db->select('gid');
		$this->db->where('gid', $_gid);
		$count = $this->db->count_all_results('mikochan_post');
		
		for ($i = 0; $i < $count; $i+=7)
		{
			$this->db->select('*');
			$this->db->from('mikochan_post');
			$this->db->where('gid', $_gid);
			$this->db->order_by('id', 'asc');
			$this->db->limit(7, $i);
			$q = $this->db->get();
			$tmpdata['k'] = $q->result();
			$this->load->view('show_pic_unit', $tmpdata);
		}
		
	}
	private function cli2($_url = "")
	{
		// check the url and get the extend_file_name
		if ($_url == null || $_url == "") return false;
		if (!preg_match('/(^[\S]+.(jpg|jpeg|gif|png))$/i', $_url)) die('網址不符合格式');
		else $PG_ext = preg_replace('/(^[\S]+.(jpg|jpeg|gif|png))$/i', '${2}', $_url);
		
		// let's fetch the image
		$f = file_get_contents($_url, NULL, NULL, NULL, 10*1024*1024);
		if ($f == false) die('抓取檔案失敗');
		$r = file_put_contents('pic/file_test_PG.'.$PG_ext, $f);

		return true;
	}
	public function cli()
	{
		$this->cli2('http://sharu.eruru.tw/CI/pic/1328874582.jpg');
		
		
	}
	public function upt()
	{
		$config['upload_path'] = './pic/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		if ( !$this->upload->do_url_upload('http://sharu.eruru.tw/CI/pic/1328874582.jpg'))
		{
			echo 'upt failed';
		}
		else echo 'success!!';
	}

}