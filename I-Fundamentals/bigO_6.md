Determine the memory complexity of counting the occurrences of words in a book.

$ocurrences = array()
for each word in the book
  if isset $ocurrence[word]
    $ocurrence[word]++
  else
    $ocurrence[word] = 1


**Runtime:** O(num words in the book) = O(n)
**Memory (extra):** O(nº diferent words in the book) = O(n)