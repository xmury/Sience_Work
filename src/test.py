from PIL import Image

def load_img(name):
    img = Image.open(name)
    obj = img.load()
    img.close()
    return obj, img.size

def this_is_tut_li( obj, a, color, i ):
    w = 1
    while (w < i):
        if (color == a[w]["color"]):
            return 1, w
        w += 1
    return 0, 0;

a = {};                                                 # a[Index][color, num]
obj, size = load_img("test.jpg")

x = 0; i = 1
while ( x < size[0] ):
    y = 0
    while ( y < size[1] ):
        color = obj[x,y]
        rule, ii = this_is_tut_li( obj, a, color, i )
        if ( rule == 1 ): 
            a[ii]["num"] += 1
        else:
            
            a[i] = {"color":color , "num":1}; i += 1      
        

        y += 1

    x += 1

q = 1
while ( q < i):
    print(q, " |--> " , a[q]["color"] , " | " , a[q]["num"] )
    q += 1

print ( " --- " , a[225]["color"])

e = obj[10,10]


print("I complite")
