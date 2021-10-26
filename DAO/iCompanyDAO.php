<?php 

    namespace DAO;

    use Models\Company as Company;

    interface iCompanyDAO 
    {
        public function add(Company $company);

        public function modify(Company $company);

        public function delete(Company $company);

        public function getCompany($id);

        public function getAll();
    }
