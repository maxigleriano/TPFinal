<?php 

    namespace DAO;

    use Models\User as User;

    interface iUserDAO
    {
        public function add(User $user);

        public function modify(User $user);

        public function getUser($email);

        public function getUserById($id);

        public function getAll();
    }
