<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_welcome extends CI_Model
{
	private $nama_tabel1="tb_kode1";
	private $nama_tabel2="tb_kode2";
	private $nama_tabel3="tb_kode3";
	private $nama_tabel4="tb_kode4";
	private $nama_tabel5="tb_kode5";
	
	function __construct()
	{
		parent::__construct();
	}
	function get_kode1()
	{
		$result=$this->db->get($this->nama_tabel1);
		if ($result->num_rows() > 0) {
			return $result->result();
		}else{
			return array();
		}
	}
	function get_kode2($id_kode12)
	{
		$this->db->where('id_kode12',$id_kode12);
		$result=$this->db->get($this->nama_tabel2);
		if ($result->num_rows() > 0 ) {
			return $result->result();
		}
		else{
			return array();
		}
	}
	function get_kode3($id_kode23)
	{
		$this->db->where('id_kode23',$id_kode23);
		$result=$this->db->get($this->nama_tabel3);
		if ($result->num_rows() > 0 ) {
			return $result->result();
		}
		else{
			return array();
		}
	}
	function get_kode4($id_kode34)
	{
		$this->db->where('id_kode34',$id_kode34);
		$result=$this->db->get($this->nama_tabel4);
		if ($result->num_rows() > 0 ) {
			return $result->result();
		}
		else{
			return array();
		}
	}
	function get_kode5($id_kode45)
	{
		$this->db->where('id_kode45',$id_kode45);
		$result=$this->db->get($this->nama_tabel5);
		if ($result->num_rows() > 0 ) {
			return $result->result();
		}
		else{
			return array();
		}
	}
	function get_hasil($id_kode12)
	{
		$this->db->where('id_kode11',$id_kode12);
		$result=$this->db->get($this->nama_tabel1);
		return $result->result();
	}
	function get_hasil2($id_kode22)
	{
		$this->db->where('id_kode22',$id_kode22);
		$result=$this->db->get($this->nama_tabel2);
		return $result->result();

	}
	function get_hasil3($id_kode33)
	{
		$this->db->where('id_kode33',$id_kode33);
		$result=$this->db->get($this->nama_tabel3);
		return $result->result();

	}
	function get_hasil4($id_kode44)
	{
		$this->db->where('id_kode44',$id_kode44);
		$result=$this->db->get($this->nama_tabel4);
		return $result->result();

	}
	function get_hasil5($id_kode55)
	{
		$this->db->where('id_kode55',$id_kode55);
		$result=$this->db->get($this->nama_tabel5);
		return $result->result();

	}
}