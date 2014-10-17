<?php

    class objeto_conexao{
        public $on;
        public $detalhe;
        public $bagagem;
        
        public function getBagagem() {
            return $this->bagagem;
        }

        public function setBagagem($bagagem) {
            $this->bagagem = $bagagem;
        }

                public function getOn() {
            return $this->on;
        }

        public function getDetalhe() {
            return $this->detalhe;
        }

        public function setOn($on) {
            $this->on = $on;
        }

        public function setDetalhe($detalhe) {
            $this->detalhe = $detalhe;
        }


}