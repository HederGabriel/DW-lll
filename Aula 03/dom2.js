function imc(){
    let peso = document.getElementById("peso").value;
    let altura = document.getElementById("altura").value;

    console.log("Peso input value:", peso);
    console.log("Altura input value:", altura);

    peso = parseFloat(peso);
    altura = parseFloat(altura);

    console.log("Parsed Peso:", peso);
    console.log("Parsed Altura:", altura);

    let res = document.getElementById("res");
    
    let imc = peso / (altura * altura);
    let msg = "";

    if(imc < 18.5){
        msg = "Abaixo do peso";
    } else if(imc >= 18.5 && imc < 24.9){
        msg = "Peso normal";
    } else if(imc >= 24.9 && imc < 29.9){
        msg = "Sobrepeso";
    } else if(imc >= 29.9 && imc < 34.9){
        msg = "Obesidade grau 1";
    } else if(imc >= 34.9 && imc < 39.9){
        msg = "Obesidade grau 2";
    } else if(imc >= 39.9){
        msg = "Obesidade grau 3";
    }
    res.innerHTML = "IMC: " + imc.toFixed(2) + "<br>Classificação: " + msg;
}
