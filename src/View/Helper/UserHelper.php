<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\ORM\TableRegistry;

class UserHelper extends Helper {

    function profilePicture($user_id = null) {
        $user_details = TableRegistry::getTableLocator()->get('UserDetails'); // Updated line
        $query = $user_details->find('all')->where(['user_id' => $user_id]);
        $src = HTTP_ROOT.'img/cake.icon.png';
        if ($query->count() >= 1) {
            $query = $query->first();
            $src = HTTP_ROOT.$query->path.$query->photo;
        }
        return $src;
    }

    function userData($user_id = null) {
        $user = TableRegistry::getTableLocator()->get('Users'); // Updated line
        $user->hasOne('UserDetails', ['className' => 'UserDetails', 'foreignKey' => 'user_id']);
        $query = $user->find('all')->contain(['UserDetails'])->where(['Users.id' => $user_id])->first();
        return $query;
    }

}
