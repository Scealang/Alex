# Лабораторная работа №4
# Импорт библиотек
import math
from itertools import permutations
from random import randint, random, seed, shuffle
from tkinter import Tk, Canvas, Button
# Установка глобальных переменных размера экрана и радиуса одной вершины графа
CANVAS_W, CANVAS_H = 1000, 1000
NODE_R = CANVAS_H * 0.005
# Класс, отвечающий за графическую визуализацию графа
class GUI:
    # Инициализация
    def __init__(self, root):
        self.canvas = Canvas(root, width=CANVAS_W, height=CANVAS_H, 
        bg="white")
        self.canvas.pack()
        self.nodes = None
        self.friends = []
    # Метод отрисовки графа
    def draw(self):
        self.canvas.delete("all")
        for i in range(len(self.nodes)):            
            x1, y1 = self.nodes[i] # Установка координат верхнего 
            левого угла фигуры
            x2, y2 = self.nodes[(i + 1) % len(self.nodes)] # 
            Установка координат нижнего правого угла фигуры
            r = NODE_R
            self.canvas.create_oval(x1 - r, y1 - r, x1 + r, y1 + r, 
            fill="red") # Отрисовка вершины
            self.canvas.create_text(x1  + 10, y1 - 10, text = i + 1) 
            # Добавление номера участника к вершине
        for i in range(len(self.nodes)):
            for j in range(len(self.nodes)):
                # Если у человека только один друг - проводим между   
                ними линию
                if self.friends[i][j] == 1:
                    x1, y1 = self.nodes[i]
                    x2, y2 = self.nodes[j]
                    self.canvas.create_line(x1, y1, x2, y2)               
# Функция создания положения вершин случайного графа
def make_random_graph(size):
    nodes = []
    for i in range(size):
        nodes.append((
            randint(NODE_R, CANVAS_W - NODE_R),
            randint(NODE_R, CANVAS_H - NODE_R),
        ))
    return nodes
# Функция генерирования дружеских отношений в случайном графе
def random_friends(size):
    friendslist = []
    while len(friendslist) < size:
        templist = []
        while len(templist) < size:
            templist.append(0)
        friendslist.append(templist)
    for i in range(0,size):
        friendslist[i][i] = 2
    for i in range (0,size):
        temp = randint(0,4)
        tempfriend = i
        for j in range(temp):
            for t in range(1):
                tempfriend = randint(0,size-1)
                if tempfriend == i or friendslist[i][tempfriend] == 
                1:
                    t -= 1
                else:
                    friendslist[i][tempfriend] = 
                    friendslist[tempfriend][i] = 1               
    return friendslist 
# Функция печати матрицы смежности случайного графа
def printMatrix (matrix): 
   for row in matrix: 
      for x in row: 
          print ( "{:2d}".format(x), end = "" )
      print ()
# Функция поиска всех людей имеющего только 1 общего друга с i-тым участником
def find_semifriend(friendslist):
    listofsets = []
    for i in range(len(friendslist)):
        frset = set([])
        for j in range(len(friendslist)):
            if friendslist[i][j] == 1:
                frset.add(j)
        listofsets.append(frset)
    for i in range(len(friendslist)):
        tmplst = []
        for j in range(len(friendslist)):
            if len(listofsets[i].intersection(listofsets[j])) == 1:
                if i!=j:
                    tmplst.append(j+1)
        print("Люди, имеющие только одного общего знакомого с 
        ",i+1,": ", tmplst)           
friendslist = random_friends(100) # Создание матрицы смежности для случайного графа из 100 человек
#printMatrix (friendslist)
find_semifriend(friendslist) # Поиск общих знакомых
g = make_random_graph(100) # Генерация координат вершин графа
root = Tk() # Начало визуальной отрисовки
w = GUI(root) # Создание графической переменной
w.friends = friendslist # Заносим в нее полученную ранее матрицу смежности
w.nodes = g # Заносим полученные ранее координаты
w.draw() # Отрисовываем
root.mainloop()
