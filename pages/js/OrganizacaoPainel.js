function copiarLink() {
    navigator.clipboard.writeText(link.trim())
        .then(() => {
            alert("Link copiado:\n" + link.trim());
        })
        .catch(() => {
            alert("Erro ao copiar o link.");
        });
}