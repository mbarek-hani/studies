// Exercice 4

// let Tab = [5, 2, 8, 1, 4, 7, 3, 6, 9, 0];

// min = {
//     pos: 0,
//     val: Tab[0],
// };
// max = {
//     pos: 0,
//     val: Tab[0],
// };

// for (let i = 0; i < 10; i++) {
//     if (Tab[i] < min.val) {
//         min.pos = i;
//         min.val = Tab[i];
//     }
//     if (Tab[i] > max.val) {
//         max.pos = i;
//         max.val = Tab[i];
//     }
// }

// console.log("Minimum: ", min);
// console.log("Maximum: ", max);

//Exercice 5
// let T1 = [];
// let T2 = [];

// for (let i = 0; i < 5; i++) {
//     T1.push(parseInt(prompt(`Enter value ${i + 1} for T1:`)));
//     T2.push(parseInt(prompt(`Enter value ${i + 1} for T2:`)));
// }

// let T3 = Array.from(new Set([...T1, ...T2])).sort((a, b) => a - b);

// console.log("fusionnés et trié sans répétition (T3):", T3);

// Exerciece 6
// function countVowels(str) {
//     const vowels = 'aeiouAEIOU';
//     let count = 0;

//     for (let char of str) {
//         if (vowels.includes(char)) {
//             count++;
//         }
//     }

//     return count;
// }

// let inputString = prompt("Enter a string:");
// console.log(`Number of vowels in the string: ${countVowels(inputString)}`);

// Exercice 7

 function areAnagrams(word1, word2) {
     if (word1.length !== word2.length) {
         return false;
     }

     const sortedWord1 = word1.toLowerCase().split('').sort().join('');
     const sortedWord2 = word2.toLowerCase().split('').sort().join('');

     return sortedWord1 === sortedWord2;
 }

 let word1 = prompt("Enter the first word:");
 let word2 = prompt("Enter the second word:");

 if (areAnagrams(word1, word2)) {
     console.log(`${word1} and ${word2} are anagrams.`);
 } else {
     console.log(`${word1} and ${word2} are not anagrams.`);
 }


// Exercice 8
// function countVowels(str) {
//     let pattern = /[aeiouAEIOU]/g;
//     let occurences = str.match(pattern);
//     return occurences.length;
// }
//
//
// console.log(countVowels("Mbarek Hani"));


// Exercice 9
// function isValidPhoneNumber(phoneNumber) {
//     const phoneRegex =
//         /^\+?[0-9]{1,4}?[-.\s]?(\(?\d{1,3}?\)?[-.\s]?)?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9}$/;
//     return phoneRegex.test(phoneNumber);
// }

// let phoneNumber = "+212601026152";
// if (isValidPhoneNumber(phoneNumber)) {
//     console.log(`${phoneNumber} is a valid phone number.`);
// } else {
//     console.log(`${phoneNumber} is not a valid phone number.`);
// }


