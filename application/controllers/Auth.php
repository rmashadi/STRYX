<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation'); //untuk memanggil library form validasi 

	}

	public function index()
	{
		if ($this->session->userdata('username')) {
			if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 12) {
					redirect('dashboard');
				} else {
					redirect('home');
				}
		}

		$data['title'] = 'LOGIN';

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('captcha', 'Captcha', 'required|callback_check_captcha'); // Tambahkan validasi captcha


		if ($this->form_validation->run() == false) {
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			// Memanggil dashmenu.php di view/auth/
			// $this->load->view('auth/dashmenu');
			$this->load->view('templates/auth_footer');
		} else {
			// validasi success
			$this->_login();
		}
	}

	public function check_captcha($input)
	{
	    $expected_answer = $this->session->userdata('captcha_answer');
	    
	    // Periksa apakah jawaban captcha benar
	    if ($input == $expected_answer) {
	        return true;
	    } else {
	        $this->form_validation->set_message('check_captcha', 'Jawaban captcha salah.');
	        return false;
	    }
	}

	private function _login()
	{
		$username = $this->input->post('username', true);
		$password = $this->input->post('password', true);

		$user = $this->db->get_where('user', ['username' => $username])->row_array();
		//user available
		if ($user) {
			// if user active
			if ($user['is_active'] == 1) {
				//jika password same from database
				if (password_verify($password, $user['password'])) {
					$data = [
						'id_user'   => $user['id_user'],
						'name' 		=> $user['name'],
						'username'  => $user['username'],
						'role_id'   => $user['role_id']
					];
					$this->session->set_userdata($data);
					//check role user apakah superadmin atau user
					if ($user['role_id'] == 1 || $user['role_id'] == 12) {
						//redirect to superadmin menu 
						redirect('dashboard');
					} else {
						//redirect to user menu
						redirect('home');
					}
					// end check user
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger shadow" role="alert">Cek Kembali Username dan Password</div>');
					redirect('auth');
				}
				//end check active
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger shadow" role="alert">Cek Kembali Username dan Password</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger shadow" role="alert">Cek Kembali Username dan Password</div>');
			redirect('auth');
		}
	}


	// Fungsi untuk generate captcha sebagai gambar
    public function generate_captcha()
    {
        // Buat gambar dengan ukuran 100x50
        $image = imagecreatetruecolor(150, 50);

        // Tentukan warna latar belakang dan teks
        $bg_color = imagecolorallocate($image, 255, 255, 255); // Putih
        $text_color = imagecolorallocate($image, 0, 0, 0); // Hitam

        // Isi gambar dengan warna latar belakang
        imagefilledrectangle($image, 0, 0, 150, 50, $bg_color);

        // Ambil angka random dari session
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        $this->session->set_userdata('captcha_answer', $num1 + $num2);

        // Gabungkan angka menjadi string penjumlahan
        $captcha_text = "$num1 + $num2 =";

        // Tambahkan teks penjumlahan ke gambar
        imagestring($image, 5, 40, 15, $captcha_text, $text_color);

        // Set header untuk gambar PNG
        header('Content-type: image/png');

        // Output gambar
        imagepng($image);

        // Hancurkan gambar dari memori
        imagedestroy($image);
    }


	// Fungsi untuk menampilkan form registrasi
    public function register()
    {
	    $data['title'] = 'Register';
	    $ip_address = $this->input->ip_address();
	    $current_time = time();

	    // Ambil data dari tabel register_attempts
	    $attempt_data = $this->db->get_where('register_attempts', ['ip_address' => $ip_address])->row_array();

	    if ($attempt_data) {
	        // Jika lebih dari 15 menit sejak attempt terakhir, reset jumlah attempts
	        if ($current_time - strtotime($attempt_data['last_attempt_time']) > 900) { // 900 detik = 15 menit
	            $this->db->update('register_attempts', ['attempts' => 1, 'last_attempt_time' => date('Y-m-d H:i:s')], ['ip_address' => $ip_address]);
	        } else {
	            // Jika attempts melebihi batas, tampilkan pesan error dan keluar
	            if ($attempt_data['attempts'] >= 5) {
	                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terlalu banyak percobaan registrasi. Coba lagi setelah beberapa saat.</div>');
	                redirect('auth/register');
	                return;
	            }

	            // Jika belum melebihi batas, increment attempts
	            $this->db->update('register_attempts', [
	                'attempts' => $attempt_data['attempts'] + 1,
	                'last_attempt_time' => date('Y-m-d H:i:s')
	            ], ['ip_address' => $ip_address]);
	        }
	    } else {
	        // Jika IP belum terdaftar, buat entri baru
	        $this->db->insert('register_attempts', [
	            'ip_address' => $ip_address,
	            'attempts' => 1,
	            'last_attempt_time' => date('Y-m-d H:i:s')
	        ]);
	    }

        $this->form_validation->set_rules('username', 'NIP/Username', 'trim|required|is_unique[user.username]');
        $this->form_validation->set_rules('name', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('no_hp', 'No Whatapp', 'trim|required');
        $this->form_validation->set_rules('instansi', 'Instansi', 'trim|required');
        $this->form_validation->set_rules('captcha', 'Captcha', 'required|callback_check_captcha');

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|callback_valid_password');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|matches[password1]');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/auth_footer');
        } else {
        	// Reset attempts setelah registrasi berhasil
        	$this->db->delete('register_attempts', ['ip_address' => $ip_address]);


        	$instansi = htmlspecialchars($this->input->post('instansi', true));
	        // Cek apakah instansi sudah ada di tb_instansi
	        $existing_instansi = $this->db->get_where('tb_instansi', ['instansi' => $instansi])->row_array();
	        
	        if (!$existing_instansi) {
	            // Jika belum ada, tambahkan instansi baru ke tb_instansi
	            $this->db->insert('tb_instansi', ['instansi' => $instansi]);
	        }


            $data = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'no_hp' => htmlspecialchars($this->input->post('no_hp', true)),
                'instansi' => $instansi,
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'image' => 'default.jpg',
                'role_id' => 14,
                'is_active' => 0,
                'date_created' => date('d/m/Y H:i:s A')
            ];

            $this->db->insert('register', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun Anda berhasil dibuat. Silakan login.</div>');
            redirect('auth');
        }
    }

    // Fungsi custom validation untuk password
    public function valid_password($password)
    {
        if (!preg_match('/[A-Z]/', $password)) {
            $this->form_validation->set_message('valid_password', 'Password harus mengandung setidaknya satu huruf besar.');
            return false;
        }

        if (!preg_match('/[a-z]/', $password)) {
            $this->form_validation->set_message('valid_password', 'Password harus mengandung setidaknya satu huruf kecil.');
            return false;
        }

        if (!preg_match('/[0-9]/', $password)) {
            $this->form_validation->set_message('valid_password', 'Password harus mengandung setidaknya satu angka.');
            return false;
        }

        return true;
    }

    public function get_instansi()
	{
		// $referer = $this->input->server('HTTP_REFERER');
	    // if (strpos($referer, base_url('auth/register')) === false) {
	    //     redirect('auth/blocked');
	    //     return;
	    // }

	    $keyword = $this->input->post('keyword', true);
	    
	    $this->db->like('instansi', $keyword);
	    $this->db->limit(10);
	    $result = $this->db->get('tb_instansi')->result_array();

	    echo json_encode($result);
	}


	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('nama');

		$this->session->set_flashdata('message', '<div class="alert alert-success shadow" role="alert">Anda Telah Logout!</div>');
		redirect('auth');
	}


	public function blocked()
	{
		$this->load->view('auth/blocked');
	}



}
