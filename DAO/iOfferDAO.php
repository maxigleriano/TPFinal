<?php

    namespace DAO;

    use Models\Offer as Offer;

    interface iOfferDAO
    {
        public function add(Offer $offer);

        public function modify(Offer $offer);

        public function delete(Offer $offer);

        public function getOffer($id);

        public function getByCareer($careerId);

        public function getByCompany($companyId);

        public function getAll();
    }
