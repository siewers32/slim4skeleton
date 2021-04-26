<?php


namespace App\Models;


class User extends Model
{
    public function find($id) {
        $stmt = $this->db->prepare("select * from user where iduser = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }


}