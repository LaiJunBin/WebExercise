const readline = require('readline');
const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout,
  terminal: false
});

const lines = []
rl.on('line', function(line){
    lines.push(line)
})

const isOneLetterDiff = (word1, word2) => {
    let diff = 0
    for(let i = 0; i < word1.length; i++) {
        if(word1[i] !== word2[i]) diff++
        if(diff > 1) return false
    }
    return true
}

const findMinimumPath = (start, end, words) => {
    if (start === end) return [0, []]

    const queue = [start]
    const visited = new Set()
    const parent = {}
   
    while(queue.length) {
        const word = queue.shift()
        if (word === end) break

        for (const nextWord of words) {
            if (isOneLetterDiff(word, nextWord) && !visited.has(nextWord) && nextWord !== start) {
                visited.add(nextWord)
                queue.push(nextWord)
                parent[nextWord] = word
            }
        }
    }
    
    if (!parent[end]) return [-1, null]

    const path = []
    let current = end
    while(current) {
        path.push(current)
        current = parent[current]
    }

    return [path.length, path.reverse()]
}

rl.on('close', () => {
    while(lines.length) {
        const [start, end] = lines.shift().split(' ')
        const n = +lines.shift()
        const words = lines.splice(0, n)
        
        const [result, path] = findMinimumPath(start, end, words)
        console.log(result, path)
    }
})
