<?php


namespace App\Models;


class UserServiceFactory extends Model
{
    public function __construct() {
        $this->container->set('user', User::class);

        var_dump("Hello from user");
        $stmt = $this->db->query('select first_name from user');
        var_dump($stmt->fetchAll());
    }


}