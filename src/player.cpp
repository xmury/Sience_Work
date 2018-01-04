#include <cstdlib>
#include <time.h>

void art_in_1(){
    char sign = '0';

    // get field values
    const N = 3;
    char pole[N][N];
    for (x = 0; x < N; x++){
        for (y = 0; y < N; y++){
            acces pull = {x,y}
            pole[x][y] = area('r', pull);
        }
    }
    // get field values

    // algorithm
    // Ищем есть ли линици без одного элемента
    int tire = 0, null = 0, krest = 0; bool f = true;
    for (x = 0; x < N; x++){
        for (y = 0; y < N; y++){
            switch (pole[x][y]){
                case '-': tire++; break;
                case '0': null++; break;
                case 'X': krest++; break;
            }
        // Если линия без одного элемента закрываем её
        if (krest == 2 || null == 2){ 
            for (y = 0; y < N; y++){ 
                if (pole[x][y] == '-'){
                    acces push = {x,y, sign};
                    area('w', push);
                    f = fasle;
                }  
            } 
        }
        }
    }
    // Проверка диагоналей
    if (pole[0][0] == pole[1][1] && pole[1][1] == pole[2][2] ||
        pole[2][0] == pole[1][1] && pole[1][1] == pole[0][2]){
        int x = 0, y = 0;
        if (pole[x][y] == '-'){
            acces push = {x,y, sign};
            area('w', push);
        }
        int x = 1, y = 1;
        if (pole[x][y] == '-'){
            acces push = {x,y, sign};
            area('w', push);
        }
        int x = 2, y = 2;
        if (pole[x][y] == '-'){
            acces push = {x,y, sign};
            area('w', push);
        }   
        int x = 0, y = 2;
        if (pole[x][y] == '-'){
            acces push = {x,y, sign};
            area('w', push);
        }   
        int x = 2, y = 0;
        if (pole[x][y] == '-'){
            acces push = {x,y, sign};
            area('w', push);
        }
        f = false;   
    }
    

    if (f){
        while (true){
            srand(time(NULL));
            int x = rand(0,2);
            int y = rand(0,2);

            if (pole[x][y] == '-'){
                acces push = {x,y, sign};
                area('w', push);
                break;
            }
        }
    }
    // algorithm
}

void art_in_2(){
    char sign = 'X';

    // get field values
    const N = 3;
    char pole[N][N];
    for (x = 0; x < N; x++){
        for (y = 0; y < N; y++){
            acces pull = {x,y}
            pole[x][y] = area('r', pull);
        }
    }
    // get field values

    // algorithm
    // Ищем есть ли линици без одного элемента
    int tire = 0, null = 0, krest = 0; bool f = true;
    for (x = 0; x < N; x++){
        for (y = 0; y < N; y++){
            switch (pole[x][y]){
                case '-': tire++; break;
                case '0': null++; break;
                case 'X': krest++; break;
            }
        // Если линия без одного элемента закрываем её
        if (krest == 2 || null == 2){ 
            for (y = 0; y < N; y++){ 
                if (pole[x][y] == '-'){
                    acces push = {x,y, sign};
                    area('w', push);
                    f = fasle;
                }  
            } 
        }
        }
    }
    // Проверка диагоналей
    if (pole[0][0] == pole[1][1] && pole[1][1] == pole[2][2] ||
        pole[2][0] == pole[1][1] && pole[1][1] == pole[0][2]){
        int x = 0, y = 0;
        if (pole[x][y] == '-'){
            acces push = {x,y, sign};
            area('w', push);
        }
        int x = 1, y = 1;
        if (pole[x][y] == '-'){
            acces push = {x,y, sign};
            area('w', push);
        }
        int x = 2, y = 2;
        if (pole[x][y] == '-'){
            acces push = {x,y, sign};
            area('w', push);
        }   
        int x = 0, y = 2;
        if (pole[x][y] == '-'){
            acces push = {x,y, sign};
            area('w', push);
        }   
        int x = 2, y = 0;
        if (pole[x][y] == '-'){
            acces push = {x,y, sign};
            area('w', push);
        }
        f = false;   
    }
    

    if (f){
        while (true){
            srand(time(NULL));
            int x = rand(0,2);
            int y = rand(0,2);

            if (pole[x][y] == '-'){
                acces push = {x,y, sign};
                area('w', push);
                break;
            }
        }
    }
    // algorithm
}

