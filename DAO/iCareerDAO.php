<?php

    namespace DAO;

    use Models\Career as Career;

    interface iCareerDAO
    {
        public function getAll();

        public function getCareer($id);
    }
