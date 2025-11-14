<!-- dentro da classe criar uma função de criptografia aes não pode ser hash -->
<?php
require_once __DIR__ . '/Conexao.php';

class Senha
{
    private int $id_senha;
    private string $conta;
    private string $usuario_login;
    private string $senha_criptografada;
    private string $observacao;
    private int $id_pasta;
    private string $data_criacao;

   
    public function __construct(
        int $id_senha,
        string $conta,
        string $usuario_login,
        string $senha_criptografada,
        string $observacao,
        int $id_pasta,
        string $data_criacao
    ) {
        //  valores recebidos
        $this->id_senha = $id_senha;
        $this->conta = $conta;
        $this->usuario_login = $usuario_login;
        $this->senha_criptografada = $senha_criptografada;
        $this->observacao = $observacao;
        $this->id_pasta = $id_pasta;
        $this->data_criacao = $data_criacao;
    }

    // retorna os valores dos usuarios
    public function getIdSenha(): int { return $this->id_senha; }
    public function getConta(): string { return $this->conta; }
    public function getUsuarioLogin(): string { return $this->usuario_login; }
    public function getSenhaCriptografada(): string { return $this->senha_criptografada; }
    public function getObservacao(): string { return $this->observacao; }
    public function getIdPasta(): int { return $this->id_pasta; }
    public function getDataCriacao(): string { return $this->data_criacao; }

    // oq pode ser editado 
    public function setConta(string $conta): void { $this->conta = $conta; }
    public function setUsuarioLogin(?string $usuario_login): void { $this->usuario_login = $usuario_login; }

    // Substitui a senha criptografada por outra
    //public function setSenhaCriptografada(string $senha): void { $this->senha_criptografada = $senha; }
    public function setObservacao(?string $observacao): void { $this->observacao = $observacao; }
    public function setIdPasta(int $id_pasta): void { $this->id_pasta = $id_pasta; }
}
?>