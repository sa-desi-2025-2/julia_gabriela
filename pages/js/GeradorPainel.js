const range = document.querySelector('.range-tamanho'); // controle para definir o tamanho da senha
const valorTamanho = document.querySelector('.valor-tamanho'); // mostra o número selecionado 
const campoSenha = document.querySelector('.campo-senha'); // senha gerada será exibida
const btnGerar = document.querySelector('.btn-gerar'); // botão gera nova senha
const btnCopiar = document.querySelector('.btn-copiar'); // botão para copiar a senha

//seleciona os tipos de caracteres da senha
const checks = {
    maiusculas: document.querySelector('.check-maiusculas'), //  letras maiúsculas (A–Z)
    minusculas: document.querySelector('.check-minusculas'), // letras minúsculas (a–z)
    numeros: document.querySelector('.check-numeros'),       // números (0–9)
    simbolos: document.querySelector('.check-simbolos')      // símbolos (!@#$…)
};

// atualiza o valor numérico do tamanho
function atualizarTamanho() {
    valorTamanho.textContent = range.value; // mostra o valor atual do controle deslizante
}

//gera a senha com base nas opções escolhidas
function gerarSenha() {
    let chars = ''; // contem os caracteres possíveis

    // tipos de caracteres escolhidos 
    if (checks.maiusculas.checked) chars += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if (checks.minusculas.checked) chars += 'abcdefghijklmnopqrstuvwxyz';
    if (checks.numeros.checked) chars += '0123456789';
    if (checks.simbolos.checked) chars += '!@#$%^&*()_+[]{}<>?';

    // mostra um alerta, se o usuário não marcou nenhuma opção
    if (!chars) {
        alert('Selecione pelo menos uma opção!');
        return; // sai da função sem gerar nada
    }

    // gera a senha aleatória de acordo com o tamanho definido
    let senha = '';
    for (let i = 0; i < range.value; i++) {
        // Escolhe um caractere aleatório 
        senha += chars[Math.floor(Math.random() * chars.length)];
    }

    // Mostra a senha gerada
    campoSenha.value = senha;
}

function copiarSenha() {
    const campoSenha = document.querySelector('.campo-senha');
    campoSenha.select(campoSenha.value); // seleciona o texto
    document.execCommand('copy');
    //alert('Senha copiada!'); //mostra mensagem de confirmação
}

range.addEventListener('input', atualizarTamanho); //atualiza o valor mostrado
btnGerar.addEventListener('click', gerarSenha);   //botão “gerar”, cria uma nova senha
btnCopiar.addEventListener('click', copiarSenha); //botão “copiar”, copia a senha

// Gera senha automaticamente quando a página é aberta
gerarSenha();