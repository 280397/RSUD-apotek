<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 * 
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_rekam_medik', 'rm');
	}

	public function index()
	{
		$this->ambilDataKeminfo();

		$rmData = 	$this->rm->getRmdata();
		$rmSelesai = $this->rm->getRmdataKeluar();
		$data = array(
			'rm_data' => $rmData,
			'rm_selesai' => $rmSelesai
		);

		return $this->load->view('welcome_message', $data);
	}

	function updateStatus($nopen, $status)
	{
		$this->rm->update_status($nopen, $status);
		redirect('/');
	}

	function ambilDataKeminfo()
	{

		$url = "http://192.168.253.11/api/bridging/mr";

		// persiapkan curl
		$ch = curl_init();
		// set url 
		curl_setopt($ch, CURLOPT_URL, $url);
		// return the transfer as a string 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// $output contains the output string 
		$output = curl_exec($ch);
		// tutup curl 
		curl_close($ch);

		$json = json_decode($output);

		$this->rm->insertRmData($json->payload);
	}
}
