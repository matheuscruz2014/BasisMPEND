<?php

    class objeto_produto{
        public $produto_id;
        public $codigo_fabrica;
        public $descricao;
        public $aplicacao;
        
        function getProduto_id() {
            return $this->produto_id;
        }

        function getCodigo_fabrica() {
            return $this->codigo_fabrica;
        }

        function getDescricao() {
            return $this->descricao;
        }

        function getAplicacao() {
            return $this->aplicacao;
        }

        function setProduto_id($produto_id) {
            $this->produto_id = $produto_id;
        }

        function setCodigo_fabrica($codigo_fabrica) {
            $this->codigo_fabrica = $codigo_fabrica;
        }

        function setDescricao($descricao) {
            $this->descricao = $descricao;
        }

        function setAplicacao($aplicacao) {
            $this->aplicacao = $aplicacao;
        }
    }