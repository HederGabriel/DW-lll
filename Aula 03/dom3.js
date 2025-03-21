function mudar() {
    const cor = document.getElementById('cor').value;
    const tamanho = document.getElementById('tam').value;
    const circulo = document.getElementById('circulo');
    
    circulo.style.backgroundColor = cor;
    circulo.style.width = `${tamanho}px`;
    circulo.style.height = `${tamanho}px`;
}