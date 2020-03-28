<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('my_query');

			/*
				$select = ''
				
				$table = "nama table a

		"		$join['data'][] = array(
					'table' => 'namatable b ',
					'join' =>  'b.id = a.id' ,
					'type' =>  'inner' (inner / left / right)
				);

				$this->my_query->get_data_complex($select , $table , null , null , null , $join)->result();
				// output : select * from namatable a inner join nama table b on b.id=a.id 
			*/
			
		}

	public function search(){


		$s = $_GET['s'];


		$get_video   = $this->my_query->query("select *  from video where judul like '%".$s."%' order by created_at DESC ")->result();
		$get_catalog = $this->my_query->query("select *  from buku where judul like '%".$s."%' order by judul ASC ")->result();

		$result = [
			'video'   => $get_video,
			'catalog' => $get_catalog,
		];

		$this->load->view('padma/search-result' , $result);
	}


	public function index(){
		if (isset($_GET['isu_id'])) {
			// $isu_id = $_GET['isu_id'];
		} else {
			$last_id = $this->my_query->query("select *  from isu order by id LIMIT 1")->row();
			$_GET['isu_id'] = $last_id->id;
		}
		$isu_id = $_GET['isu_id'] ;
		$join = [
			'table' => 'buku b', 
			'where' => 'a.buku_id=b.id', 
			'type' => 'inner', 
		];
		$join_headline = [
			'table' => 'video b', 
			'where' => 'a.value=b.id', 
			'type' => 'inner', 
		];

		$q = "  SELECT `b`.`judul`, `b`.`url`, `b`.`slug`, `b`.`deskripsi`, `b`.`banner_desktop`, `b`.`banner_mobile`
				FROM `headline` `a`
				INNER JOIN `video` `b` ON `a`.`value`=`b`.`id`
				WHERE `a`.`var` = 'home' group by b.judul";

		$data = [
			'headline' => $this->my_query->query($q)->result(),
			'q' 	=>	$this->db->last_query(),
			'isu'      => $this->my_query->get_data('*' , 'isu')->result(),
			'isu_id'   => $isu_id ,
			'video'    => $this->my_query->get_data('*' , 'video' , ['isu_id' => $isu_id ])->result(),
			'book'     => $this->my_query->get_data('*' , 'book_issue a' , ['a.isu_id' => $isu_id ] , $join)->result()
		];
		// echo $this->db->last_query();
		$this->load->view('padma/dashboard-index' , $data);

	}

	public function video(){

		if (isset($_GET['program_id'])) {
			// $program_id = $_GET['program_id'];
		} else {
			$last_id = $this->my_query->query("select *  from program order by id LIMIT 1")->row();
			$_GET['program_id'] = $last_id->id;
		}

		$program_id = $_GET['program_id'] ;

		if (isset($_GET['s'])) {
			$q_where = " where judul like '%".$_GET['s']."%' ";
			$q_pg = " ";
			$pages = 0;
		} else { 

			$per_page  = 8;
			$page      = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$start     = ($page>1) ? ($page * $per_page) - $per_page : 0;
			$total_isi = $this->my_query->get_data('*' , 'video' , ['program_id' => $program_id ] )->num_rows();
			$pages     = ceil($total_isi/$per_page);

			$q_where   =	"  where program_id = $program_id ";
			$q_pg      =	"  LIMIT $start, $per_page ";
		}


		$join = [
			'table' => 'buku b', 
			'where' => 'a.buku_id=b.id', 
			'type' =>  'inner', 
		];
		$join_headline = [
			'table' => 'video b', 	
			'where' => 'a.value=b.id', 
			'type' => 'inner', 
		];

		$data = [
			'headline'   => $this->my_query->query("SELECT `b`.`judul`, `b`.`url`, `b`.`slug`, `b`.`deskripsi`, `b`.`banner_desktop`, `b`.`banner_mobile` , a.id 
			FROM `headline` `a` INNER JOIN `video` `b` ON `a`.`value`=`b`.`id` 
			WHERE `a`.`var` = 'video' group by b.judul order by a.id desc limit 1")->row(),
			'program'    => $this->my_query->get_data('*' , 'program')->result(),
			'program_id' => $program_id ,
			'video'      => $this->my_query->query("select *  from video ".$q_where." order by judul ASC ".$q_pg)->result(),
			'pages'      => $pages
		];


		
		$this->load->view('padma/dashboard-video' , $data);

	}

	public function katalog(){
		if (isset($_GET['penulis_id'])) {
			// $isu_id = $_GET['isu_id'];
		} else {
			$last_id = $this->my_query->query("select *  from penulis order by id LIMIT 1")->row();
			$_GET['penulis_id'] = $last_id->id;
		}

		$penulis_id = $_GET['penulis_id'] ;

		$join = [
			'table' => 'buku b', 
			'where' => 'a.buku_id=b.id', 
			'type' => 'inner', 
		];

		if (isset($_GET['s'])) {
			$q_where = " where judul like '%".$_GET['s']."%' ";
			$q_pg = " ";
			$pages = 0;
		} else {

			$q_where = " where penulis_id = $penulis_id ";

			$per_page = 8;
			$page     = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$start    = ($page>1) ? ($page * $per_page) - $per_page : 0;
			$total_isi= $this->my_query->get_data('*' , 'buku' , ['penulis_id' => $penulis_id ] )->num_rows();
			$pages    = ceil($total_isi/$per_page);
			$q_pg 	=	" LIMIT $start, $per_page ";

		}
		

		$join_headline = [
			'table' => 'buku b', 
			'where' => 'a.value=b.id', 
			'type' => 'inner', 
		];

		$data = [
			'headline'   =>$this->my_query->get_data('b.judul,b.slug,b.deskripsi,b.banner_desktop,b.banner_mobile' , 'headline a' , ['a.var' => 'katalog' ] , $join_headline)->result(),
			'penulis'    => $this->my_query->get_data('*' , 'penulis')->result(),
			'penulis_id' => $penulis_id ,
			'book'       => $this->my_query->query("select *  from buku ".$q_where." order by judul DESC ".$q_pg)->result(),
			// 'book'    => $this->my_query->get_data('*' , 'book_issue a' , ['a.isu_id' => $isu_id ] , $join)->result(),
			'pages'      => $pages
		];


		
		$this->load->view('padma/dashboard-katalog' , $data );

	}



	public function audio(){

		if (isset($_GET['isu_id'])) {
			// $isu_id = $_GET['isu_id'];
		} else {
			$last_id = $this->my_query->query("select *  from isu order by id LIMIT 1")->row();
			$_GET['isu_id'] = $last_id->id;
		}

		$isu_id = $_GET['isu_id'] ;

		$join = [
			'table' => 'buku b', 
			'where' => 'a.buku_id=b.id', 
			'type' => 'inner', 
		];
		$join1 = [
			'table' => 'audios c', 
			'where' => 'c.buku_id=b.id', 
			'type' => 'inner', 
		];
		$per_page = 8;
		$page     = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
		$start    = ($page>1) ? ($page * $per_page) - $per_page : 0;
		$total_isi= $this->my_query->get_data_3('c.judul,c.url,c.slug,c.id,c.banner_mobile,c.banner_desktop' , 'book_issue a' , ['a.isu_id' => $isu_id ] , $join, $join1)->num_rows();
		$pages    = ceil($total_isi/$per_page);

		$join_headline = [
			'table' => 'audios b', 
			'where' => 'a.value=b.id', 
			'type' => 'inner', 
		];

		$data = [
			'headline' => $this->my_query->get_data('b.judul,b.url,b.slug,b.deskripsi,b.banner_desktop,b.banner_mobile' , 'headline a' , ['a.var' => 'audio' ] , $join_headline)->result(),
			'isu'      => $this->my_query->get_data('*' , 'isu')->result(),
			'isu_id'   => $isu_id ,
			'audio'    => $this->my_query->query("SELECT `c`.`judul`, `c`.`url`, `c`.`slug`, `c`.`id`, `c`.`banner_mobile`, `c`.`banner_desktop` FROM `book_issue` `a` INNER JOIN `buku` `b` ON `a`.`buku_id`=`b`.`id` INNER JOIN `audios` `c` ON `c`.`buku_id`=`b`.`id` WHERE `a`.`isu_id` = $isu_id order by c.created_at DESC LIMIT $start, $per_page")->result(),
			'pages'	   => $pages
		];

		if(count($data['audio'])>0)
		$this->load->view('padma/dashboard-audio',$data);
		else
		$this->load->view('padma/dashboard-audio-kosong',$data);

	}

	

	public function detail_katalog($slug){

		$data =  [
			'detail' => $this->my_query->get_data('*' , 'buku' , ['slug' => $slug] )->row()

		];

		$join_b = [
			'table' => 'video b', 
			'where' => 'a.isu_id=b.isu_id', 
			'type'  => 'inner', 
		];


		// echo $this->db->last_query();
		$data['related_videos'] = $this->my_query->get_data('*' , 'book_issue a' ,['a.buku_id' => $data['detail']->id ],$join_b)->result();
		$data['related_audios'] = $this->my_query->get_data('*' , 'audios' , ['buku_id' => $data['detail']->id ])->result();
		

		$this->load->view('padma/detail-katalog' , $data);

	}

	public function detail_video($slug){
		

		$data=  [
			'detail' => $this->my_query->get_data('*' , 'video' , ['slug' => $slug] )->row()
		];

		$join = [
			'table' => 'buku b', 
			'where' => 'a.buku_id=b.id', 
			'type'  => 'inner', 
		];

		$join_b = [
			'table' => 'audios b', 
			'where' => 'a.buku_id=b.buku_id', 
			'type'  => 'inner', 
		];

		$isu_id = 	$data['detail']->isu_id;
		$data['related_book']   = $this->my_query->get_data('*' , 'book_issue a' , ['a.isu_id' => $isu_id ] , $join)->result();
		$data['related_audios'] = $this->my_query->get_data('*' , 'book_issue a' , ['a.isu_id' => $isu_id ] , $join_b)->result();
		

		$this->load->view('padma/detail-video' , $data);

	}

	public function detail_audio($slug){

		$data =  [
			'detail' => $this->my_query->get_data('*' , 'audios' , ['slug' => $slug] )->row()

		];

		$join_b = [
			'table' => 'video b', 
			'where' => 'a.isu_id=b.isu_id', 
			'type'  => 'inner', 
		];


		// echo $this->db->last_query();
		$data['related_books'] = $this->my_query->get_data('*' , 'buku' ,['id'=>$data['detail']->buku_id])->row();
		$data['related_audios'] = $this->my_query->get_data('*' , 'audios' , ['buku_id' => $data['detail']->buku_id ])->result();
		
		$this->load->view('padma/detail-audio',$data);

	}

	public function tentang(){

		$data=  [
			'tentang' => $this->my_query->get_data('*' , 'tentang' )->row()
		];
		$this->load->view('padma/dashboard-tentang',$data);
	}

}
