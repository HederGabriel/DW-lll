let array = [10, -5, 3, -8, 0];
for (let i = 0; i < array.length; i++) {
  if (array[i] < 0) {
    array[i] = 0;
  }
}
console.log(array); // [10, 0, 3, 0, 0]
