<?php

namespace App\Model;

use Lib\Model;

class Like extends Model
{

    protected $table = 'likes';
    public function __construct()
    {
        parent::__construct();
    }

    public function like($post_id, $user_id)
    {
        $data = $this->query("SELECT * FROM likes WHERE user_id = $user_id AND post_id = $post_id")->first();
        if ($data) {
            return $this->delete($data['id']);
        } else {
            return $this->insert([
                'post_id' => $post_id,
                'user_id' => $user_id
            ]);
        }
    }

}
