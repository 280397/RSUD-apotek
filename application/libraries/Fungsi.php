<?php
class Fungsi
{
    protected $ci;
    function __construct()
    {
        $this->ci = &get_instance();
    }

    function user_login()
    {
        $this->ci->load->model('User_model');
        $user_id = $this->ci->session->userdata('id');
        $user_data = $this->ci->User_model->get($user_id)->row();
        return $user_data;
    }

    function PdfGenerator($html, $filename, $paper, $orientation)
    {
        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $dompdf->stream($filename, array('Attachment' => 0));
    }
}
