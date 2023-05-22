import random
import string

def generate_test_data():
    length = random.randint(1, 10)
    start_word = generate_random_word(length)
    end_word = generate_random_word(length)
    while len(start_word) != len(end_word):
        end_word = generate_random_word(length)

    word_list_size = random.randint(1, 5000)
    word_list = [generate_random_word(length) for _ in range(word_list_size)]

    return start_word, end_word, word_list

def generate_random_word(length):
    letters = string.ascii_lowercase
    return ''.join(random.choice(letters) for _ in range(length))

# 生成 10 組測試資料
test_data = [generate_test_data() for _ in range(10)]

for data in test_data:
    start_word, end_word, word_list = data
    print(start_word, end_word)
    word_list = list(set(word_list))
    print(len(word_list))
    for word in word_list:
        print(word)
