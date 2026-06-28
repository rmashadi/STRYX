<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    // ── Login ────────────────────────────────────────────────
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
        $data['challenge'] = $this->_generate_challenge();

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('_challenge', 'Security challenge', 'callback_verify_challenge');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login', $data);
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    // ── Silent security challenge (honeypot + time-based nonce) ──
    public function verify_challenge($unused)
    {
        $secret = $this->config->item('encryption_key');

        // 1. Honeypot — must remain empty (invisible to humans)
        $honey = $this->input->post('_contact', true);
        if (!empty($honey)) {
            $this->form_validation->set_message('verify_challenge', '');
            return false;
        }

        // 2. Timestamp nonce — valid between 2s and 3600s
        $payload = $this->input->post('_challenge', true);
        if (empty($payload)) {
            $this->form_validation->set_message('verify_challenge', '');
            return false;
        }

        $decoded = base64_decode($payload);
        $parts   = explode('|', $decoded);
        if (count($parts) !== 2) {
            $this->form_validation->set_message('verify_challenge', '');
            return false;
        }

        [$timestamp, $hash] = $parts;
        $expected = hash_hmac('sha256', $timestamp, $secret);
        if (!hash_equals($expected, $hash)) {
            $this->form_validation->set_message('verify_challenge', '');
            return false;
        }

        $age = time() - (int) $timestamp;
        if ($age < 2 || $age > 3600) {
            $this->form_validation->set_message('verify_challenge', '');
            return false;
        }

        return true;
    }

    private function _generate_challenge()
    {
        $timestamp = time();
        $hash      = hash_hmac('sha256', $timestamp, $this->config->item('encryption_key'));
        return base64_encode($timestamp . '|' . $hash);
    }

    private function _login()
    {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id_user'  => $user['id_user'],
                        'name'     => $user['name'],
                        'username' => $user['username'],
                        'role_id'  => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1 || $user['role_id'] == 12) {
                        redirect('dashboard');
                    } else {
                        redirect('home');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger shadow" role="alert">Cek Kembali Username dan Password</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger shadow" role="alert">Cek Kembali Username dan Password</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger shadow" role="alert">Cek Kembali Username dan Password</div>');
            redirect('auth');
        }
    }

    // ── Registration ─────────────────────────────────────────
    public function register()
    {
        $data['title'] = 'Register';
        $data['challenge'] = $this->_generate_challenge();
        $ip_address = $this->input->ip_address();
        $current_time = time();

        $attempt_data = $this->db->get_where('register_attempts', ['ip_address' => $ip_address])->row_array();

        if ($attempt_data) {
            if ($current_time - strtotime($attempt_data['last_attempt_time']) > 900) {
                $this->db->update('register_attempts', ['attempts' => 1, 'last_attempt_time' => date('Y-m-d H:i:s')], ['ip_address' => $ip_address]);
            } else {
                if ($attempt_data['attempts'] >= 5) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terlalu banyak percobaan registrasi. Coba lagi setelah beberapa saat.</div>');
                    redirect('auth/register');
                    return;
                }
                $this->db->update('register_attempts', [
                    'attempts' => $attempt_data['attempts'] + 1,
                    'last_attempt_time' => date('Y-m-d H:i:s')
                ], ['ip_address' => $ip_address]);
            }
        } else {
            $this->db->insert('register_attempts', [
                'ip_address' => $ip_address,
                'attempts' => 1,
                'last_attempt_time' => date('Y-m-d H:i:s')
            ]);
        }

        $this->form_validation->set_rules('username', 'NIP/Username', 'trim|required|is_unique[user.username]');
        $this->form_validation->set_rules('name', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('_challenge', 'Security challenge', 'callback_verify_challenge');
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|callback_valid_password');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/register', $data);
            $this->load->view('templates/auth_footer');
        } else {
            $this->db->delete('register_attempts', ['ip_address' => $ip_address]);

            $data = [
                'username'      => htmlspecialchars($this->input->post('username', true)),
                'name'          => htmlspecialchars($this->input->post('name', true)),
                'email'         => htmlspecialchars($this->input->post('email', true)),
                'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'image'         => 'default.jpg',
                'role_id'       => 14,
                'is_active'     => 0,
                'date_created'  => date('Y-m-d H:i:s')
            ];

            $this->db->insert('register', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun Anda berhasil dibuat. Silakan login.</div>');
            redirect('auth');
        }
    }

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

    // ── Logout ───────────────────────────────────────────────
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
