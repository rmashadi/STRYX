<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserAset_model extends CI_Model
{
    public function getAvailableAset($user_id)
    {
        $this->db->select('tb_aset.*');
        $this->db->from('tb_aset');
        $this->db->where("tb_aset.id_aset NOT IN (SELECT id_aset FROM user_has_aset WHERE user_id = $user_id)");
        return $this->db->get()->result_array();
    }

    public function getSelectedAset($user_id)
    {
        $this->db->select('tb_aset.*');
        $this->db->from('tb_aset');
        $this->db->join('user_has_aset', 'tb_aset.id_aset = user_has_aset.id_aset');
        $this->db->where('user_has_aset.user_id', $user_id);
        return $this->db->get()->result_array();
    }

    public function updateUserAset($user_id, $selected_aset)
    {
        // Hapus semua otoritas aset untuk user ini terlebih dahulu
        $this->db->delete('user_has_aset', ['user_id' => $user_id]);

        // Tambahkan otoritas aset yang baru
        foreach ($selected_aset as $aset_id) {
            $this->db->insert('user_has_aset', [
                'user_id' => $user_id,
                'id_aset' => $aset_id,
            ]);
        }
    }
}



?>