<?php

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                logueado();
        }

        public function carga()
        {
            $data['dir'] = $this->input->get('dir');
            $data['campo'] = $this->input->get('campo');
            $this->slice->view('admin.filemanager.cargar',$data);
        }

        public function do_upload()
        {
            $dir = $this->input->post('dir');
            $campo = $this->input->post('campo');
                $config['upload_path']          = './assets/common/uploads/'.$dir.'/';
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = '3072';

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('imagen'))
                {
                        $error = array('error' => $this->upload->display_errors(),'dir'=>$dir);

                        $this->slice->view('admin.filemanager.cargar', $error);
                }
                else {
                    redirect('upload/dir?dir='.$dir.'&campo='.$campo,'refresh');
                }
        }

    public function dir(){
        $dir = $this->input->get('dir');
        $campo = $this->input->get('campo');
        $path = './assets/common/uploads/'.$dir;
        $url_path = '/assets/common/uploads/'.$dir;
        $files = scandir($path);

        $data = [];
        $i = 0;

        foreach ($files as $file) {
            if(is_file($path.'/'.$file)){
                $url = base_url($url_path.'/'.$file);
                $filezie = filesize($path.'/'.$file);
                if ($filezie < 900000) {
                    $filezie = round($filezie/1024,2) ." Kb";
                }
                else{
                    $filezie = round(($filezie/1024)/1024,2) ." Mb";
                }
                $filetime = filemtime($path.'/'.$file);
                $data += [
                    $i=> (object)[
                        'url_completa'=>$url,
                        'imagen' => $file,
                        'file_size' => $filezie,
                        'file_time' => $filetime,
                    ]
                ];
                $i++;
            }
        }
        $datos['files'] = (object) $data;
        $datos['dir'] = $dir;
        $datos['campo'] = $campo;
        $this->slice->view('admin.filemanager.index',$datos);
    }

    public function borrar(){
        $file = $this->input->get('file');
        $dir = $this->input->get('dir');
        $campo = $this->input->get('campo');
        $path = './assets/common/uploads/'.$dir.'/'.$file;

        unlink($path);

        redirect('upload/dir?dir='.$dir.'&campo='.$campo);
    }

    public function get_csrf_fields(){
        $data = [
            'csrf' => [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
                ]
            ];
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}
?>
