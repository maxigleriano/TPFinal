<?php

    namespace DAO;

    use Models\Postulation as Postulation;

    interface iPostulationDAO
    {
        public function add(Postulation $postulation);

        public function getPostulation($id);

        public function getPostulationByUser($userId);

        public function getPostulationByOffer($offerId);

        public function getAll();
    }
