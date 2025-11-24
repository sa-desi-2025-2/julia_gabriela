function copiarLink() {
    const botao = event.target; 
    const link = botao.getAttribute("data-link");

    navigator.clipboard.writeText(link)
        .then(() => {
            alert("Link copiado!");
        })
        .catch(err => {
            console.error("Erro ao copiar:", err);
        });
}