// Criar um array vazio e adicionar dois números e duas palavras
let array = [];
array.push(10, 20, "JavaScript", "Código");
console.log("Array após adição:", array);

// Criar um array com três strings e imprimir cada uma em uma linha separada
let arrayStrings = ["Maçã", "Banana", "Cereja"];
arrayStrings.forEach(item => console.log(item));

// Adicionar um novo elemento ao final do array, excluir os dois primeiros e imprimir atualizado
array.push("NovoElemento");
array.splice(0, 2); // Remove os dois primeiros elementos
console.log("Array atualizado:", array);

// Criar um array de números inteiros e imprimir o primeiro e o último elemento
let numeros = [100, 200, 300, 400, 500];
console.log("Primeiro elemento:", numeros[0]);
console.log("Último elemento:", numeros[numeros.length - 1]);

// Imprimir o número de elementos do array
console.log("Quantidade de elementos no array de números:", numeros.length);

// Verificar se um determinado elemento existe no array
let elemento = 300;
console.log(`O elemento ${elemento} ${numeros.includes(elemento) ? "existe" : "não existe"} no array.`);

// Criar um array de inteiros e imprimir apenas os números pares
let arrayInteiros = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
let pares = arrayInteiros.filter(num => num % 2 === 0);
console.log("Números pares:", pares);
