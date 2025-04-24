function imc() {
    const altura = parseFloat(document.getElementById('a').value);
    const peso = parseFloat(document.getElementById('p').value);
    const res = document.getElementById('res');

    if (isNaN(altura) || isNaN(peso) || altura <= 0 || peso <= 0) {
        res.innerText = "Por favor, insira valores válidos.";
        return;
    }

    const imc = peso / (altura * altura);
    let classificacao = "";

    if (imc < 18.5) {
        classificacao = "Abaixo do peso";
    } else if (imc < 24.9) {
        classificacao = "Peso normal";
    } else if (imc < 29.9) {
        classificacao = "Sobrepeso";
    } else if (imc < 34.9) {
        classificacao = "Obesidade grau 1";
    } else if (imc < 39.9) {
        classificacao = "Obesidade grau 2";
    } else {
        classificacao = "Obesidade grau 3";
    }

    res.innerText = `Seu IMC é ${imc.toFixed(2)} (${classificacao})`;
}
