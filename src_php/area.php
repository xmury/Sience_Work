<?php
class area{
     

    public:
        void pull(int x, int y){                // Показ значения в массиве
            cout << poligon_field[x][y] << endl;
        }

        void push(int x, int y, char sign){     // Изменение значения в массиве
            poligon_field[x][y] = sign;
        }

        void generator(){
            int N = 3;
            
            char pole[N][N];
            for (int x = 0; x < N; x++){
                for (int y = 0; y < N; y++){
                    pole[x][y] = '-';
                }
            }

            poligon_field =  pole;
        }
};
?>