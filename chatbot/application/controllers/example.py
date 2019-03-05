import sys
import numpy as np
import csv
#print('karna')

def sentences_to_indices(X, word_to_index, max_len):
    m = X.shape[0]                                   
    X_indices = np.zeros((m,max_len))
    for i in range(m):                              
        sentence_words =X[i].lower().split()
        j = 0
        for w in sentence_words:
            # Set the (i,j)th entry of X_indices to the index of the correct word.
            X_indices[i, j] = word_to_index[w]
            # Increment j to j + 1
            j = j+1
    return X_indices



def read_glove_vecs(glove_file):
    with open(glove_file, 'r') as f:
        words = set()
        word_to_vec_map = {}
        for line in f:
            line = line.strip().split()
            curr_word = line[0]
            words.add(curr_word)
            word_to_vec_map[curr_word] = np.array(line[1:], dtype=np.float64)
        
        i = 1
        words_to_index = {}
        index_to_words = {}
        for w in sorted(words):
            words_to_index[w] = i
            index_to_words[i] = w
            i = i + 1
    return words_to_index, index_to_words, word_to_vec_map

word_to_index, index_to_word, word_to_vec_map = read_glove_vecs('/var/www/html/chatbot/application/controllers/glove.6B.200d.txt')
from keras.models import load_model
model = load_model('/var/www/html/chatbot/application/controllers/my_model2.h5')	
s = sys.argv[1]
#s = "undergraduate+electrical"
s = s.replace('+',' ')
s = [s]
s = np.array(s)
s = sentences_to_indices(s,word_to_index,10)
out = model.predict(s)
#print(out)
cs = csv.reader(open('/var/www/html/chatbot/application/controllers/dictionary2.csv'))
dictt = {}
for row in cs :
	dictt[int(row[0])] = row[1]
#print(dictt)
print(dictt[np.argmax(out)])
