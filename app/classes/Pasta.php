<?php
require_once __DIR__ . '/Conexao.php';

class Pasta
{
    private int $id_pasta;
    private string $nome;
    private int $id_cofre;
    private string $data_criacao;

    public function __construct(
        int $id_pasta,
        string $nome,
        int $id_cofre,
        string $data_criacao
    ) {
        $this->id_pasta = $id_pasta;
        $this->nome = $nome;
        $this->id_cofre = $id_cofre;
        $this->data_criacao = $data_criacao;
    }
    // retorna os valores dos usuarios
    public function getIdPasta(): int { return $this->id_pasta; }
    public function getNome(): string { return $this->nome; }
    public function getIdCofre(): int { return $this->id_cofre; }
    public function getDataCriacao(): string { return $this->data_criacao; }

    // oq pode ser editado 
    public function setNome(string $nome): void { $this->nome = $nome; }
    public function setIdCofre(int $id_cofre): void { $this->id_cofre = $id_cofre; }
}
?>