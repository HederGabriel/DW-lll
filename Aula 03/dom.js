function mostrarNome(){
    nome = document.getElementById("nome");
    res = document.getElementById("res");
    res.innerHTML = `Olá, ${nome.value}!`;
}
