<?php

    namespace DAO;

    use Models\Student as Student;

    interface iStudentDAO
    {
        public function getAll();

        public function getStudent($email);
    }
