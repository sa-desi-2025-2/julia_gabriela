<?php
require_once __DIR__ . '/Conexao.php';

class Senha
{
    private int $id_senha;
    private string $conta;
    private string $usuario_login;
    private string $senha_criptografada;
    private int $id_pasta;
    private string $data_criacao;

    // chave AES (32 caracteres)
    private string $chave = "Q2x4#9fP91!as82LxM1pZq7Cm4eW8tD3";

    public function __construct(
        int $id_senha,
        string $conta,
        string $usuario_login,
        string $senha_criptografada,
        int $id_pasta,
        string $data_criacao
    ) {
        $this->id_senha = $id_senha;
        $this->conta = $conta;
        $this->usuario_login = $usuario_login;
        $this->senha_criptografada = $senha_criptografada;
        $this->id_pasta = $id_pasta;
        $this->data_criacao = $data_criacao;
    }

    // retorna os valores dos usuarios
    public function getIdSenha(): int { return $this->id_senha; }
    public function getConta(): string { return $this->conta; }
    public function getUsuarioLogin(): string { return $this->usuario_login; }
    public function getSenhaCriptografada(): string { return $this->senha_criptografada; }
    public function getIdPasta(): int { return $this->id_pasta; }
    public function getDataCriacao(): string { return $this->data_criacao; }

    // edição
    public function setConta(string $conta): void { $this->conta = $conta; }
    public function setUsuarioLogin(?string $usuario_login): void { $this->usuario_login = $usuario_login; }
    public function setIdPasta(int $id_pasta): void { $this->id_pasta = $id_pasta; }

    // Criptografar com AES-256-CBC
    private function criptografarSenha(string $senha): string
    {
        $iv = openssl_random_pseudo_bytes(16);

        $criptografado = openssl_encrypt(
            $senha,
            'AES-256-CBC',
            $this->chave,
            0,
            $iv
        );

        return base64_encode($iv . $criptografado);
    }

    // Descriptografar AES-256-CBC
    public function descriptografarSenha(string $dadoCriptografado): string
    {
        $data = base64_decode($dadoCriptografado);

        $iv = substr($data, 0, 16);
        $textoCriptografado = substr($data, 16);

        return openssl_decrypt(
            $textoCriptografado,
            'AES-256-CBC',
            $this->chave,
            0,
            $iv
        );
    }

    // criptografa automaticamente
    public function setSenhaCriptografada(string $senhaNormal): void
    {
        $this->senha_criptografada = $this->criptografarSenha($senhaNormal);
    }
}
?>