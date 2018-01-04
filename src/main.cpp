#include <iostream>

using namespace std;

void show_mass(int m[][2]){
	cout << m[1][1];
}

int main(){

	int m[2][2] = {
		{1,1},
		{1,2}
	};

	show_mass(m);
	
	return 0;

}
