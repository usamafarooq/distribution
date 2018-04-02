<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distribution extends MY_Controller
{
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Distribution_model');
        $this->module     = 'distribution';
        $this->user_type  = $this->session->userdata('user_type');
        $this->id         = $this->session->userdata('user_id');
        $this->permission = $this->get_permission($this->module, $this->user_type);
    }
    
    
    
    public function index()
    {
        if ($this->permission['view'] == '0' && $this->permission['view_all'] == '0') {
            redirect('home');
        }
        $this->data['title'] = 'Distributor';
        if ($this->permission['view_all'] == '1') {
            
            $this->data['distributors'] = $this->Distribution_model->view_data_index();
            
        } elseif ($this->permission['view'] == '1') {
            
            $this->data['distributors'] = $this->Distribution_model->view_data_index(null, $this->id);
            
        }
        $this->data['permission'] = $this->permission;
        $this->load->template('distribution/index', $this->data);
    }
    
    
    
    public function create()
    {
        if ($this->permission['created'] == '0') {
            redirect('home');
        }
        $this->data['title']        = 'Create Products';
        $this->data['distributors'] = $this->Distribution_model->all_rows('distribution');
        $this->load->template('distribution/create', $this->data);
    }
    
    public function insert()
    {
        if ($this->permission['created'] == '0') {
            redirect('home');
        }
        $data = $this->input->post();
        
        $where     = array(
            'name' => 'Distribution'
        );
        $user_type = $this->Distribution_model->get_row_single('user_type', $where);
        
        $user_type_id = $user_type['id'];
        
        $data_user = array(
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => md5($data['password']),
            'role' => $user_type_id
        );
        
        unset($data['name']);
        unset($data['email']);
        unset($data['password']);
        
        
        $insert_user_type        = $this->Distribution_model->insert('users', $data_user);
        $data['distribution_id'] = $insert_user_type;
        
        $data['user_id'] = $this->session->userdata('user_id');
        $id              = $this->Distribution_model->insert('distribution', $data);
        
        if ($id) {
            redirect('distribution');
        }
    }
    
    
    public function edit($id)
    {
        if ($this->permission['edit'] == '0') {
            redirect('home');
        }
        $this->data['title']        = 'Edit Distributor';
        $this->data['distributors'] = $this->Distribution_model->view_data_index($id);
        // echo'<pre>';print_r($this->data['distributors']);die();
        $this->load->template('distribution/edit', $this->data);
    }
    
    public function update()
    {
        if ($this->permission['edit'] == '0') {
            redirect('home');
        }
        $data_save   = $this->input->post();
        $user_updata = array(
            'name' => $data_save['name'],
            'email' => $data_save['email'],
            'role' => $data_save['role']
        );
        if (!empty($data_save['password'])) {
            $user_updata += array(
                'password' => md5($data_save['password'])
            );
        }
        $user_update_record = $this->Distribution_model->update('users', $user_updata, array(
            'id' => $data_save['distribution_id']
        ));
        $id                 = $data_save['id'];
        unset($data_save['name']);
        unset($data_save['email']);
        unset($data_save['password']);
        unset($data_save['role']);
        unset($data_save['id']);
        $update_distributor = $this->Distribution_model->update('distribution', $data_save, array(
            'id' => $id
        ));
        redirect('distribution');
    }
    public function delete($id)
    {
        if ($this->permission['deleted'] == '0') {
            redirect('home');
        }
        
        $distribution_data = $this->Distribution_model->get_row_single('distribution', array(
            'id' => $id
        ));
        $id_data           = $distribution_data['distribution_id'];
        // print_r($id_data);die;
        $this->Distribution_model->delete('users', array(
            'id' => $id_data
        ));
        $this->Distribution_model->delete('distribution', array(
            'id' => $id
        ));
        redirect('distribution');
    }
    public function export_csv_file()
    {
        
        if ($this->permission['view_all'] == '1' || $this->permission['view'] == '1') {
            $delimiter = ",";
            $filename  = "distribution.csv";
            $f         = fopen('php://memory', 'w');
            //$fields = array('Distributor Code SCM','Distributor Name SCM','DSR Code','Distributor Name DSR','Station','Name','Email');
            //fputcsv($f,$fields, $delimiter);
            if ($this->permission['view_all'] == '1') {
                $products_csv_upload = $this->Distribution_model->view_data_index();
            } elseif ($this->permission['view'] == '1') {
                $products_csv_upload = $this->Distribution_model->view_data_index(null, $this->id);
            }
            foreach ($products_csv_upload as $row) {
                //$lineData = array($row['name'],$row['email'],$row['scm_code'],$row['scm_name'],$row['dsr_code'],$row['dsr_name'],$row['station']);
                $lineData = array(
                    $row['scm_code'],
                    $row['scm_name'],
                    $row['dsr_code'],
                    $row['dsr_name'],
                    $row['station'],
                    $row['name'],
                    $row['email']
                );
                fputcsv($f, $lineData, $delimiter);
            }
            fseek($f, 0);
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
            fpassthru($f);
        }
    }
    public function csv_upload()
    {
        $mimes = array(
            'application/vnd.ms-excel',
            'text/csv',
            'text/tsv'
        );
        if (in_array($_FILES['csv_name']['type'], $mimes)) {
            if (!empty($_FILES)) {
                $handle = fopen($_FILES['csv_name']['tmp_name'], "r");
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $products_insert = [];
                    if (!empty($data[0]) && $data[0] != 'Distributor Code SCM') {
                        
                        $username = $this->Distribution_model->get_row_single('users', array(
                            'name' => $data[0]
                        ));
                        if (empty($username)) {
                            $email        = $this->Distribution_model->get_row_single('users', array(
                                'email' => $data[1]
                            ));
                            $user_type_id = $this->Distribution_model->get_row_single('user_type', array(
                                'name' => 'Distribution'
                            ));
                            if (empty($email)) {
                                    $data_value     = $data[2];
                                    $column         = 'dsr_code';
                                    $table_data     = 'distribution';
                                    $dsr_code_ckeck = $this->Distribution_model->view_scm_code_ckeck($column, $data_value, $table_data);
                                    if (empty($dsr_code_ckeck)) {
                                        $products_insert[] = array(
                                            'user_id' => $this->session->userdata('user_id'),
                                            'name' => $data[5],
                                            'email' => $data[6],
                                            'scm_code' => $data[0],
                                            'scm_name' => $data[1],
                                            'dsr_code' => $data[2],
                                            'dsr_name' => $data[3],
                                            'station' => $data[4],
                                            'role' => $user_type_id['id'],
                                            'password' => md5($data[7])
                                        );
                                        
                                        $insert_user        = $this->Distribution_model->insert('users', array(
                                            'name' => $data[5],
                                            'email' => $data[6],
                                            'password' => md5($data[7]),
                                            'role' => $user_type_id['id']
                                        ));
                                        $insert_distributor = $this->Distribution_model->insert('distribution', array(
                                            'scm_code' => $data[0],
                                            'scm_name' => $data[2],
                                            'dsr_code' => $data[1],
                                            'dsr_name' => $data[2],
                                            'station' => $data[3],
                                            'price_type' => $data[4],
                                            'user_id' => $this->session->userdata('user_id'),
                                            'distribution_id' => $insert_user
                                        ));
                                    }
                            }
                            
                        }
                    }
                }
                fclose($handle);
            }
        }
        redirect('distribution');
    }
}