<?php

    namespace DAO;

    use Models\JobPosition as JobPosition;

    interface iJobPositionDAO
    {
        public function getAll();

        public function getJobPosition($id);

        public function getJobPositionsByCareer($career);
    }
