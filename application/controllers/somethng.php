<?php

class Web extends CI_Controller
{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Frontend_model' , 'my_query');
		$this->load->helper('indodate');
		ini_set('display_errors', 0);
	}

	function index(){

		$check_article = $this->my_query->get_data('*' , 'post' )->num_rows();
		if ($check_article > 0  && $check_article < 8 ) {
			$post_limit = 4 ;
		} else if($check_article >= 8) {
			$post_limit = 8 ;
		}

		$join = [
			'table' => 'user b',
			'where' => 'b.user_id = a.user_id',
			'type' => 'inner',
		];
		
		$isi = [
			'tag'        => $this->my_query->get_data('*' , 'tag' , null , NULL , 'tag_id  DESC' )->result(),
			'ourservice' => $this->my_query->get_data('*' , 'our_service' , null )->result(),
			'post'       => $this->my_query->get_data('*' , 'post', null , null , 'post_date DESC' , $post_limit )->result(),
			'promotion'  => $this->my_query->get_data('*' , 'promotion' )->result(),
			'testimoni'  => $this->my_query->get_data('*' , 'testimony a' , ['a.status_active' => 1] , $join , null , 8)->result(),
			'index'      => $this->my_query->get_data('*' , 'header' , ['type' => 'index'] )->row(),
		];

		$this->load->view('frontend_reborn/page_index', $isi);		
	}


	// ============ Do Login ===============
	function login(){
		
		if ($this->session->userdata('user_level') == 'patient' || $this->session->userdata('google_auth') ==1  ) {
			$this->session->set_flashdata('result' , 'info');
  			$this->session->set_flashdata('result_message' , 'Selamat datang!');
			redirect( base_url('Web/index') );
		}

		$data = [
			'content' => $this->load->view('frontend_reborn/page_ortho_login' ,'' ,true)
		];

		$this->load->view('frontend_reborn/page_template', $data);		
	}

	function logout(){
		
		$this->session->sess_destroy();

		$this->session->set_flashdata('result' , 'info');
  		$this->session->set_flashdata('result_message' , 'Sampai Jumpa!');
		redirect( base_url() );		
	}

	function do_login(){
		$where =[
			'user_email'    => $_POST['email'],
			'user_password' => md5($_POST['pw']),
		];	

		$return = $this->my_query->get_data('*', 'user' , $where );

		if ($return->num_rows() > 0) {

			foreach ($return->result() as $val) {
			
				if ($val->user_status == 'notactive' || $val->user_status == 'blocked') {
					$this->session->set_flashdata('result_error' , 'Akun Tidak dapat dibuka, hubungin Admin');
					redirect( base_url('Web/login') );
				} else if($val->is_verified== 0){
					$this->session->set_flashdata('result_error' , 'Harap verifikasi Email anda terlebih dahulu!');
					redirect( base_url('Web/login') );
				} else {
					$session['user_id']      = $val->user_id;
					$session['user_name']    = $val->user_name;
					$session['user_email']   = $val->user_email;
					$session['user_level']   = $val->level_access;
					$session['user_picture'] = $val->user_picture;
					$session['google_auth']  = 0;

					$this->session->set_userdata($session);

					redirect( base_url()) ;
				}


			}

		} else {
			$this->session->set_flashdata('result_error' , 'ID Password Salah / Tidak ditemukan');
			redirect( base_url('Web/login') );
		}
	}
	// ============ Do Login ===============



	//  ============ Register ===============
	function forgot_password(){
		$data = [
			'content' => $this->load->view('frontend_reborn/page_forgot_password' ,'' ,true)
		];

		$this->load->view('frontend_reborn/page_template', $data);	
	}


	function register(){
		$data = [
			'content' => $this->load->view('frontend_reborn/page_ortho_register' ,'' ,true)
		];

		$this->load->view('frontend_reborn/page_template', $data);		
	}

	function register_process(){
		$mytoken = password_hash(rand(0,100), PASSWORD_DEFAULT);

		$data = [
			'user_name'     => $_POST['user_name'] ,
			'user_email'    => $_POST['user_email'] ,
			'user_password' => md5($_POST['user_password']) ,
			'level_access'  => 'patient',
			'user_picture'  => 'default_picture.png',
			'token_char' =>$mytoken
		];

		$this->my_query->insert_for_id('user' , null ,$data);

		$this->send_mail($_POST['user_email'] , $mytoken);

		// exit();

		$this->session->set_flashdata('result' , 'Email telah terkirim harap verifikasi email anda terlebih dahulu');
		redirect( base_url('Web/login') );

	}

	function process_forgot_password(){

		

		if ($this->input->server('REQUEST_METHOD') == "POST" ) {
			

			$email = $_POST['email'];

			$check = $this->my_query->get_data('*' , 'user' , ['user_email' => $email , 'level_access'=>'patient' ])->num_rows();

			if ($check > 0) {
				# code... when the email exist

				$password = rand(1000,9999);


				$config = [
		           'mailtype'  => 'html',
		           'charset'   => 'utf-8',
		           'protocol'  => 'smtp',
		           'smtp_host' => 'ssl://smtp.gmail.com',
		           'smtp_user' => 'orthodontist.indo@gmail.com',    // Ganti dengan email gmail kamu
		           'smtp_pass' => 'intive123!',      // Password gmail kamu
		           'smtp_port' => 465,
		           'crlf'      => "\r\n",
		           'newline'   => "\r\n"
		       ];
		        $this->load->library('email', $config);
		        $this->email->from('orthodontist.indo@gmail.com', 'Orthodontist Indonesia');
		        $this->email->to($email); // Ganti dengan email tujuan kamu
		        $this->email->cc('mahmudrisna@gmail.com');
		        $this->email->subject('Permintaan Reset Password ');


		        $parsing = [
					'password' => $password,
					'mail' => $email
				];
				$body = $this->load->view('backend/content_reset_password' , $parsing , true  );

		        // Isi email
		        $this->email->message($body);

		        // Tampilkan pesan sukses atau error
		        if ($this->email->send()) {
		          
		        	$update = [
		        		'user_password' => md5($password)
		        	];

		        	$this->my_query->insert_for_id('user' , ['user_email' => $email ] , $update);

		        	$this->session->set_flashdata('result' , 'Email berhasil terkirim , harap cek email anda');
					redirect( base_url('Web/login') );
		           // return "berhasil";
		        } 




			} else {
				$this->session->set_flashdata('result_error' , 'Email Tidak ditemukan');
				redirect( base_url('Web/forgot_password') );
			}

		} else {
			redirect( base_url('Web/forgot_password') );
		}


	}


	function send_mail($email , $mytoken){

		$config = [
           'mailtype'  => 'html',
           'charset'   => 'utf-8',
           'protocol'  => 'smtp',
           'smtp_host' => 'ssl://smtp.gmail.com',
           'smtp_user' => 'orthodontist.indo@gmail.com',    // Ganti dengan email gmail kamu
           'smtp_pass' => 'intive123!',      // Password gmail kamu
           'smtp_port' => 465,
           'crlf'      => "\r\n",
           'newline'   => "\r\n"
       ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        // Email dan nama pengirim
        $this->email->from('orthodontist.indo@gmail.com', 'Orthodontist Indonesia');

        // Email penerima
        $this->email->to($email); // Ganti dengan email tujuan kamu
        $this->email->cc('mahmudrisna@gmail.com');

        // Lampiran email, isi dengan url/path file
       

        // Subject email
        
        $this->email->subject('Verifikasi Akun');

        $parsing = [
			'token' => $mytoken
		];
		$body = $this->load->view('backend/content_body_mail' , $parsing , true  );

        // Isi email
        $this->email->message($body);

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
           return "berhasil";
        } else {
           return "gagal" ;
        }

	}

	function register_verif(){
		$token = $_GET['token'];

		$where= [ 
			'token_char' => $token,
			'is_verified'  => 0
		];

		$hasil = $this->my_query->get_data('*' ,'user' , $where);

		if ($hasil->num_rows() > 0) {
			
			$update = [
				'is_verified'=> 1
			];

			$this->my_query->insert_for_id('user' , $where , $update); 

			$this->session->set_flashdata('result' , 'Akun sudah aktif, silahkan login');
			redirect( base_url('Web/login') );

		} else {
			$this->session->set_flashdata('result_error' , 'Token tidak ditemukan! atau sudah tidak berlaku');
			redirect( base_url('Web/login') );
		}


	}

	function ajax_check_email(){

		$email = $this->input->post('email');

		$result = 	$this->my_query->get_data('*' , 'user' , ['user_email' => $email])->num_rows();

		if ($result > 0) {
			$status = ['status' => 204];
		} else {
			$status = ['status' => 200];
		}

		echo json_encode($status);
	}


	function edit_profile(){

		$current_id = $this->session->userdata('user_id');

		$dataX 		= $this->my_query->get_data('*' , 'user' , ['user_id' => $current_id]);

		if ($dataX->num_rows() < 1 ) {
			$this->session->set_flashdata('result_error' , 'Harap Login terlebih dahulu');
			redirect( base_url('Web/login') );
		}

		$isi = [
			'user' => $dataX->row()
		];



		$data = [
			'content' => $this->load->view('frontend_reborn/page_member_edit' ,$isi,true)
		];

		$this->load->view('frontend_reborn/page_template', $data);

	}

	function progres_update_user(){
		$current_id = $this->session->userdata('user_id');
		$dataX 		= $this->my_query->get_data('*' , 'user' , ['user_id' => $current_id]);
		
		if ($dataX->num_rows() > 0) {

			$resp = $dataX->row();

			$old_pw= $resp->user_password;
			$old_pw_input = md5($_POST['old_password']);

			if ($old_pw  == $old_pw_input) {
				
				$data = [
					'user_name' => $_POST['user_name'],
					'user_password' => md5($_POST['new_password']),
				]; 

				$this->my_query->insert_for_id('user' ,['user_id' => $current_id] , $data );

				$this->session->set_flashdata('result' , 'Akun berhasil di edit. harap login kembali ');
				redirect( base_url('Web/logout') );

			} else {
				$this->session->set_flashdata('result_error' , 'Maaf Password lama anda salah.');
				redirect( base_url('Web/edit_profile') );
			}

		}


		
	}



	function user_picture_edit(){

		$config['upload_path']          = './assets/account_picture/';
	    $config['allowed_types']        = 'jpeg|jpg|png';
	    $config['encrypt_name']         = true;
	    $config['overwrite']			= true;
	    $config['max_size']             = 2048; // 2MB
	    $this->load->library('upload', $config);

		$user_id = $_POST['user_id'];

			if ( ! $this->upload->do_upload('user_picture')){
				$resp_img = ['error' => $this->upload->display_errors()];
			} else {
				$resp_img = ['success' => $this->upload->data() ];
				$current_img = $this->my_query->get_data('*' , 'user' , ['user_id' => $user_id]);

				$old_path = 'assets/account_picture/'.$current_img->row()->user_picture;

				if (strpos($old_path, 'default_') !== false) {
				    // echo 'true';
				} else {
					if ( file_exists( $old_path) ) {
						unlink($old_path);
					}
				}

				$data_edit['user_picture'] = $resp_img['success']['file_name'];
				$this->resize_image($data_edit['user_picture']);

			}	
		
		$this->my_query->insert_for_id('user' , ['user_id' => $user_id] , $data_edit );

		redirect( base_url('web/edit_profile') );


	}


	function resize_image($filename){


		$config['image_library']='gd2';
        $config['source_image']='./assets/account_picture/'.$filename;
        $config['create_thumb']= FALSE;
        $config['maintain_ratio']= FALSE;
        $config['quality']= '50%';
        $config['width']= 300;
        $config['height']= 300;
        $config['new_image']= './assets/account_picture/'.$filename;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();

	    $filepath = './assets/account_picture/'.$filename;
		$exif = @exif_read_data($filepath);
		  
		if (empty($exif['Orientation'])) return FALSE;
		  
			  $CI =& get_instance();
			  $CI->load->library('image_lib');
			  
			  $config['image_library'] = 'gd2';
			  $config['source_image'] = $filepath;
			  
			  $oris = array();
			  
			  switch($exif['Orientation'])
			  {
			   case 1: // no need to perform any changes
			   break;

			   case 2: // horizontal flip
			   $oris[] = 'hor';
			   break;
			                                
			   case 3: // 180 rotate left
			   $oris[] = '180';
			   break;
			                    
			   case 4: // vertical flip
			   $oris[] = 'ver';
			   break;
			                
			   case 5: // vertical flip + 90 rotate right
			   $oris[] = 'ver';
			   $oris[] = '270';
			   break;
			                
			   case 6: // 90 rotate right
			   $oris[] = '270';
			   break;
			                
			   case 7: // horizontal flip + 90 rotate right
			   $oris[] = 'hor';
			   $oris[] = '270';
			   break;
			                
			   case 8: // 90 rotate left
			   $oris[] = '90';
			   break;
			  
			   default: break;
			}
			  
			foreach ($oris as $ori) {
			   $config['rotation_angle'] = $ori;
			   $CI->image_lib->initialize($config);
			   $CI->image_lib->rotate();
			}
	

        return true;


	}


	// ======= END REGISTER =============

	function privasi_polisi(){
			
		/*DO NOT TOUCH IN HERE!*/

		$this->load->view('frontend/privasi_page');
		/*DO NOT TOUCH IN HERE!*/
	}

	// Article==========================================================================

	function article(){
		
		$per_page = 6;
		$page     = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
		$start    = ($page>1) ? ($page * $per_page) - $per_page : 0;
		$total_isi= $this->my_query->get_data('*' , 'post' )->num_rows();
		$pages    = ceil($total_isi/$per_page);

		$isi = [
			'article'          => $this->my_query->query("select *  from post  order by post_date DESC LIMIT $start, $per_page ")->result(),
			'article_headline' => $this->my_query->get_data('*' , 'post', ['is_headline' => 1 ] , null , 'post_date DESC' )->result(),
			'tags'             => $this->my_query->get_data('*' , 'tag' )->result(),
			'pages' 		   => $pages
		];

		$data = [
			'content' => $this->load->view('frontend_reborn/page_article_list' ,$isi,true)
		];

		$this->load->view('frontend_reborn/page_template', $data);		
	}


	function post(){

		$post_id = $this->input->get('post_id');

		$isi = [
			'data_post'  => $this->my_query->query("select * from post where post_id = $post_id ")->row(),
		];

		$join = ['table' => 'tag b' , 'where' => 'b.tag_id = a.tag_id'  , 'type' => 'inner' ];
		$related_tag = $this->my_query->get_data('*' , 'post_tag a' , ['a.post_id' => $post_id] , $join )->result();

		// for related article
		$wh = " ";
		if (count($related_tag) > 0) {
			$i = 1;
			foreach ($related_tag as $tg) {
				$wh  .= " c.tag_title like '%$tg->tag_title%' ";
				$i++;
				if ($i <= count($related_tag)) {
					$wh .= " or ";
				}  else {

				}
			}
		} else {
			$wh = "";
		}
		// for related article

		$per_page = 2;
		$page     = isset($_GET["discuss_page"]) ? (int)$_GET["discuss_page"] : 1;
		$start    = ($page>1) ? ($page * $per_page) - $per_page : 0;
		$resultX  = $this->my_query->query("select * from post_discuss where post_id = $post_id limit $start , $per_page");
		$total_isi= $this->my_query->query("select * from post_discuss where post_id = $post_id")->num_rows();
		$pages    = ceil($total_isi/$per_page);



		$related_q = "select * from post a inner join post_tag b on b.post_id=a.post_id inner join tag c on b.tag_id = c.tag_id where a.post_id != $post_id and ".$wh."group by a.post_id limit 3";

		$isi['account'] =  $this->my_query->get_data("*" , 'user' , ['user_id' => $isi['data_post']->user_id ])->row();
		$isi['related_article'] = $this->my_query->query($related_q)->result();
		$isi['discuss_list'] = $resultX->result();
		$isi['pages'] = $pages;

		// echo "<pre>";
		// print_r($isi['discuss_list']);
		// exit();
		

		$data = [
			'content' => $this->load->view('frontend_reborn/page_article_detail' ,$isi,true)
		];

		$this->load->view('frontend_reborn/page_template', $data);		
	}

	function search(){

		$q = "select * from post a inner join post_tag b on b.post_id=a.post_id inner join tag c on b.tag_id = c.tag_id";

		if (@$_GET['key_search'] != "" && @$_GET['tag_id'] == "") {
			// if search based on keyword
			$q .= ' where a.post_header like "%'.$_GET['key_search'].'%" or c.tag_title like "%'.$_GET['key_search'].'%" ';

		} else if (@$_GET['key_search'] == "" && @$_GET['tag_id'] != "" ){
			// if search based on tags
			$q .= ' where c.tag_id = '.$_GET['tag_id'].' ';
		} else {
			$q = "select * from post a ";
		}
		
		$per_page  = 5;
		$page      = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
		$start     = ($page>1) ? ($page * $per_page) - $per_page : 0;
		$q 			.= "group by a.post_id limit $start , $per_page";
		$qData     = $this->my_query->query($q);
		$total_isi = $qData->num_rows();
		$pages     = ceil($total_isi/$per_page);

		// echo $this->db->last_query();	
		$isi = [
			'pages'   => $pages,
			'tags'    => $this->my_query->get_data('*' , 'tag')->result(),
			'article' => $qData->result(),
		];

		$data = [
			'content' => $this->load->view('frontend_reborn/page_article_search' ,$isi,true)
		];

		$this->load->view('frontend_reborn/page_template', $data);		
	}

	function add_discuss($post_id){

		$xd = $this->my_query->get_data('*' , 'post' ,  ['post_id' => $post_id]);

		if ($this->session->userdata('user_level') != "patient") {
			$this->session->set_flashdata('result_error' , 'Untuk diskusi , harap login terlebih dahulu');
			redirect( base_url('Web/login') );
		} else {

			

			$join = ['table' => 'tag b' , 'where' => 'b.tag_id = a.tag_id'  , 'type' => 'inner' ];
			$related_tag = $this->my_query->get_data('*' , 'post_tag a' , ['a.post_id' => $post_id] , $join )->result();

			// for related article
			$wh = " ";
			if (count($related_tag) > 0) {
				$i = 1;
				foreach ($related_tag as $tg) {
					$wh  .= " c.tag_title like '%$tg->tag_title%' ";
					$i++;
					if ($i <= count($related_tag)) {
						$wh .= " or ";
					}  else {

					}
				}
			} else {
				$wh = "";
			}
			// for related article

			$per_page = 2;
			$page     = isset($_GET["discuss_page"]) ? (int)$_GET["discuss_page"] : 1;
			$start    = ($page>1) ? ($page * $per_page) - $per_page : 0;
			$resultX  = $this->my_query->query("select * from post_discuss where post_id = $post_id  limit $start , $per_page");
			$total_isi= $this->my_query->query("select * from post_discuss where post_id = $post_id ")->num_rows();
			$pages    = ceil($total_isi/$per_page);



			$related_q = "select * from post a inner join post_tag b on b.post_id=a.post_id inner join tag c on b.tag_id = c.tag_id where a.post_id != $post_id and ".$wh."group by a.post_id limit 4";

			// $isi['account'] =  $this->my_query->get_data("*" , 'user' , ['user_id' => $isi['data_post']->user_id ])->row();
			

			if ($xd->num_rows() > 0) {
				$isi = [	
					'post' => $xd->row()
				];
				$isi['data_post'] = $this->my_query->get_data('*' ,'post' , ['post_id' => $post_id])->row();
				$isi['related_article'] = $this->my_query->query($related_q)->result();
				$isi['discuss_list'] = $resultX->result();
				$isi['pages'] = $pages;

				$data = [
					'content' => $this->load->view('frontend_reborn/page_add_discuss' ,$isi,true)
				];

				$this->load->view('frontend_reborn/page_template', $data);
			} else {
				redirect( base_url('Web/article') );
			}

		}

		
	}

	function process_discuss(){

		$notified = ($_POST['is_notified'] == 1 ) ? 1 : 0;

		$data = [
			'post_id'            => $_POST['post_id'],
			'post_title_discuss' => $_POST['post_title_discuss'],
			'text'               => $_POST['text_discuss'],
			'is_notified'        => $notified,
			'user_id'            => $this->session->userdata('user_id')
		];

		$discuss = $this->my_query->insert_for_id('post_discuss' , null , $data);
		$discuss_id = $discuss->output;

		// -- generate notification to the doctor who wrote the article

		$data_notification = [
			'messages'         => $_POST['post_title_discuss'],
			'to_user_id'       => $_POST['user_id'],
			'from_user_id'     => $this->session->userdata('user_id'),
			'discuss_id'       => null ,
			'post_id'          => $_POST['post_id'],
			'type'             => 'discuss_new'
		];

		$discuss = $this->my_query->insert_for_id('announce' , null , $data_notification);
		// -- notification --

		$this->session->set_flashdata('result' , 'info');
  		$this->session->set_flashdata('result_message' , 'Diskusi berhasil di tambahkan.');
		redirect( base_url('Web/discuss_list') );

		
	}


	function discuss_list(){

		$update_read_announce = $this->my_query->insert_for_id('announce' , ['to_user_id' => $this->session->userdata('user_id') ] , ['is_read' => 1] );

		$current_id = $this->session->userdata('user_id');

		//pagination for discuss 
		$grand_query = "SELECT a.* , b.user_id as penulis, b.post_picture, b.post_header, b.post_content FROM post_discuss a INNER JOIN post b ON a.post_id = b.post_id WHERE a.user_id = $current_id";
		$per_page = 4;
		$page     = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
		$start    = ($page>1) ? ($page * $per_page) - $per_page : 0;
		$resultX  =  $this->my_query->query($grand_query);
		$result_data  =  $this->my_query->query("$grand_query limit $start , $per_page"  );
		$total_isi= $resultX->num_rows();
		$pages    = ceil($total_isi/$per_page);	




		$isi = [
			'discuss' => $result_data->result(),
			'profile' => $this->my_query->get_data('*' , 'user' , ['user_id' => $current_id])->row(),
			'pages' => $pages
		];

		// exit($this->db->last_query());
		$data = [
			'content' => $this->load->view('frontend_reborn/page_myprofile' ,$isi,true)
		];

		$this->load->view('frontend_reborn/page_template', $data);
	}

	function discuss_detail($discuss_id){	

		$isi = [
			'discuss'       => $this->my_query->get_data('*' , 'post_discuss',['post_discuss_id' => $discuss_id ] )->row(),
			'discuss_reply' => $this->my_query->get_data('*' , 'post_discuss_reply',['post_discuss_id' => $discuss_id ] , null , 'datetime DESC')->result()
		];


		$post_id = $this->my_query->get_data('*' , 'post_discuss' , ['post_discuss_id' => $discuss_id ])->row()->post_id;
		$isi['data_post'] = $this->my_query->get_data('*' ,'post' , ['post_id' => $post_id])->row();

		$join = ['table' => 'tag b' , 'where' => 'b.tag_id = a.tag_id'  , 'type' => 'inner' ];
		$related_tag = $this->my_query->get_data('*' , 'post_tag a' , ['a.post_id' => $post_id] , $join )->result();

		// for related article
		$wh = " ";
		if (count($related_tag) > 0) {
			$i = 1;
			foreach ($related_tag as $tg) {
				$wh  .= " c.tag_title like '%$tg->tag_title%' ";
				$i++;
				if ($i <= count($related_tag)) {
					$wh .= " or ";
				}  else {

				}
			}
		} else {
			$wh = "";
		}
		// for related article

		$per_page = 2;
		$page     = isset($_GET["discuss_page"]) ? (int)$_GET["discuss_page"] : 1;
		$start    = ($page>1) ? ($page * $per_page) - $per_page : 0;
		$resultX  = $this->my_query->query("select * from post_discuss where post_id = $post_id && post_discuss_id <> $discuss_id limit $start , $per_page");
		$total_isi= $this->my_query->query("select * from post_discuss where post_id = $post_id && post_discuss_id <> $discuss_id")->num_rows();
		$pages    = ceil($total_isi/$per_page);



		$related_q = "select * from post a inner join post_tag b on b.post_id=a.post_id inner join tag c on b.tag_id = c.tag_id where a.post_id != $post_id and ".$wh."group by a.post_id limit 4";

		// $isi['account'] =  $this->my_query->get_data("*" , 'user' , ['user_id' => $isi['data_post']->user_id ])->row();
		$isi['related_article'] = $this->my_query->query($related_q)->result();
		$isi['discuss_list'] = $resultX->result();
		$isi['pages'] = $pages;


		


		$data = [
			'content' => $this->load->view('frontend_reborn/page_discuss_detail' ,$isi,true)
		];

		$this->load->view('frontend_reborn/page_template', $data);

	}



	// Article Ends =====================================================


	// my info page =====================================================

	function myinfo(){
		
		$data = [
			'content' => $this->load->view('frontend/myinfo_page' ,'' ,true)
		];

		$this->load->view('frontend/template_page', $data);		
	}



	// my info page =====================================================

	function about(){
		
		$isi = [
			'about' => $this->my_query->get_data('*' , 'about' , ['about_id' => 1])->row(),
			'about_picture' =>  $this->my_query->get_data('*' , 'about_picture' )->result(),
			'another_proc' => $this->my_query->get_data('*' , 'service' , null , null , null , 3 )->result(),
		];

		$data = [
			'content' => $this->load->view('frontend_reborn/page_about' , $isi ,true)
		];

		$this->load->view('frontend_reborn/page_template', $data);		
	}

	function procedure(){

		$isi = [
			'proc' => $this->my_query->get_data('*' , 'service' )->result(),
			'procedure' => $this->my_query->get_data('*' ,'header' , ['type' => 'procedure'] )->row(),
			'ourservice' => $this->my_query->get_data('*' , 'our_service' , null )->result(),

		];
		
		$data = [
			'content' => $this->load->view('frontend_reborn/page_procedure' ,$isi ,true)
		];

		$this->load->view('frontend_reborn/page_template', $data);		
	}

	function procedure_detail($id ){

		$isi = [
			'proc' => $this->my_query->get_data('*' , 'service' , ['service_id' => $id] )->row(),
			'another_proc' => $this->my_query->get_data('*' , 'service' , ['service_id <>' => $id] , null , null , 3 )->result(),
			'img' => $this->my_query->get_data('*' , 'service_picture'  , ['service_id' => $id]  )->result()
		];
		
		$data = [
			'content' => $this->load->view('frontend_reborn/page_procedure_detail' ,$isi ,true)
		];

		$this->load->view('frontend_reborn/page_template', $data);		
	}


	function contact_us(){
		$isi = [
			'qrcode' => $this->my_query->get_data('*' , 'qrcode' , ['id' => 1] )->row(),
		];

		$data = [
			'content' => $this->load->view('frontend_reborn/page_contact_us' ,$isi,true)
		];

		$this->load->view('frontend_reborn/page_template', $data);		
	}


	function service(){
		$isi = [
			'qrcode' => $this->my_query->get_data('*' , 'qrcode' , ['id' => 1] )->row(),
			'service' => $this->my_query->get_data('*' ,'header' , ['type' => 'service'] )->row(),
		];

		$data = [
			'content' => $this->load->view('frontend_reborn/page_service' ,$isi ,true)
		];

		$this->load->view('frontend_reborn/page_template', $data);		
	}

	function faq(){

		$isi= [
			'faq' => $this->my_query->get_data('*' , 'faq' )->result()
		];
		
		$data = [
			'content' => $this->load->view('frontend_reborn/page_faq' , $isi ,true)
		];

		$this->load->view('frontend_reborn/page_template', $data);		
	}

	//TESTIMONI -==================================

	function testimoni(){	

		$join = [
			'table' => 'user b',
			'where' => 'b.user_id = a.user_id',
			'type' => 'inner',
		];

		$isi= [
			'lastest_testimoni' => $this->my_query->get_data('*' , 'testimony a' , ['a.status_active' => 1] , $join , null , 8 )->result(),
		];
		
		$data = [
			'content' => $this->load->view('frontend_reborn/page_testimoni' , $isi ,true)
		];

		$this->load->view('frontend_reborn/page_template', $data);		
		
	}

	function input_testimoni(){

		if ($_POST['user_id'] != "") {
			
			$user_id      = $_POST['user_id'];
			
			$current_user = $this->my_query->get_data('*' , 'user' , ['user_id' => $user_id])->row();

			if ( $current_user->already_testimoni == 1 ) {
				$this->session->set_flashdata('result' , 'info');
  				$this->session->set_flashdata('result_message' , 'Maaf . anda sudah pernah menulis testimoni. tidak dapat menulis testimoni lagi');

				redirect(base_url('Web/testimoni') );
			}  else {

				$data = [
					'description'   => $_POST['editor-testimoni'] ,
					'status_active' => 0,
					'user_id'       => $_POST['user_id']
				];
				$this->my_query->insert_for_id('testimony' , null , $data);
				$wx = [
					'user_id' => $_POST['user_id'],
				];
				$datax = [
					'already_testimoni' => 1
				];
				$this->my_query->insert_for_id('user' , $wx , $datax);	

				$this->session->set_flashdata('result','info');
  				$this->session->set_flashdata('result_message','Terimakasih , Testimoni terkirim!');

				redirect(base_url('Web/testimoni') );

			}

		} else {

			$this->session->set_flashdata('result_error', 'Harap login terlebih dahulu sebelum testimoni.');
			redirect(base_url('Web/login') );
		}
		
	}


	//TESTIMONI -==================================



	//MESSAGES -==================================


	function input_messages(){

		$data = [
			'sender_description' => $_POST['sender_desc'],
			'sender_name'        => $_POST['sender_name'],
			'sender_phone'       => $_POST['sender_phone'],
			'sender_mail'        => $_POST['sender_mail'],
		];

		$config = [
           'mailtype'  => 'html',
           'charset'   => 'utf-8',
           'protocol'  => 'smtp',
           'smtp_host' => 'ssl://smtp.gmail.com',
           'smtp_user' => 'orthodontist.indonesia@gmail.com',    // Ganti dengan email gmail kamu
           'smtp_pass' => 'orthodontist2004',      // Password gmail kamu
           'smtp_port' => 465,
           'crlf'      => "\r\n",
           'newline'   => "\r\n"
       ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        // Email dan nama pengirim
        $this->email->from( 'orthodontist.indonesia@gmail.com', 'Pertanyaan Member');

        // Email penerima
        $this->email->to( 'orthodontist.indonesia@gmail.com' ); // Ganti dengan email tujuan kamu
        // $this->email->cc('mahmudrisna@gmail.com');

        // Lampiran email, isi dengan url/path file
       

        // Subject email
        
        $this->email->subject('Pesan Dari Member Orthodontist.');

		$body = $this->load->view('backend/content_pesan' , $data , true  );

        // Isi email
        $this->email->message($body);

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
        
   		   $this->session->set_flashdata('result','info');
		   $this->session->set_flashdata('result_message','Terimakasih , Pesan terkirim!');     
			$this->my_query->insert_for_id('messages_member' , null , $data);
        } else {
           $this->session->set_flashdata('result','info');
		   $this->session->set_flashdata('result_message','Gagal terkirim , Email tidak ada');     
        }





		redirect(base_url('Web/service') );

	}


	//MESSAGES -==================================
}