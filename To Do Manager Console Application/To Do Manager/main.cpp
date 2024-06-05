#include <iostream>
#include <fstream>
#include <vector>
#include <string>
#include <cctype>
#include <iomanip>
#include<stdlib.h>
#include<conio.h>
#include <chrono>
#include <ctime>
#define nline "\n"
#include"ToDoManager.h"
#include"user.h"
using namespace std;

int main()
{

    User user("user.txt");
    bool session=true;
    cout<<"\t\t\t\t\tTo Do Manager Application!!\t\t"<<nline<<nline;
    while(session){
        if(user.check()){
            system("CLS");
            cout<<nline<<"\t\t\t\tWellcome "<<user.getName()<<" Here is Your To Do Manager!!!!"<<nline;
            ToDoManager todo("todolist.txt","category.txt");
            while(session){
                todo.readfileToObjectTask();
                todo.readfileToObjectCate();
                system("CLS");
                if(todo.getCountTask()>0 && todo.getCountCategory()>0){
                    todo.Display();
                    cout<<nline<<nline;
                    cout<<"\t\t\t\t\t-CONTROL PANEL-"<<nline;
                    cout<<"\tTASK RELATED OPTION:"<<nline;
                    cout << "\t1) ADD TASK" << nline;
                    cout << "\t2) CLEAR ALL TASK " << nline;
                    cout << "\t3) DONE TASK" << nline;
                    cout << "\t4) DELETE TASK" << nline;
                    cout<<"\tCATEGORY RELATED OPTION:"<<nline;
                    cout << "\t5) ADD CATEGORY" << nline;
                    cout << "\t6) DELETE CATEGORY" << nline;
                    cout << "\t7) CLEAN CATEGORY" << nline;
                    cout << "\t8) SHOW CATEGORY" << nline;
                    cout << "\t9) CLEAN TASK & CATEGORY" << nline;

                    cout << "\tEnter your Choice(For Exit enter option without any number): ";
                    int choice;
                    cin>>choice;
                    if (choice ==1)
                    {
                        todo.addTask();
                    }
                    else if (choice == 2) {
                        todo.cleanTask();
                    }
                    else if (choice == 3) {
                        todo.completeTask();
                    }
                    else if(choice==4){
                        todo.deleteTask();
                    }
                    else if(choice==5){
                        todo.addCate();
                    }
                    else if(choice==6){
                        todo.deleteCate();
                    }
                    else if(choice==7){
                        todo.cleanCate();
                    }
                    else if(choice ==8){
                        todo.DisplayCate();
                        cout<<"\tPLEASE ENTER TO BACK MAIN WINDOW ";
                        getch();

                    }
                    else if(choice ==9){
                        todo.cleanTaskCate();
                    }
                    else {
                        session=false;
                        break;
                    }
                }
                else{
                    if(todo.getCountCategory()<=0){
                        todo.createCate();
                        todo.saveCateToFile();
                    }
                    if(todo.getCountTask()<=0){
                        todo.createTask();
                        todo.saveTaskToFile();
                    }
                }
                //cin.ignore();
            }
        }
        else{
            cout<<"\tAt first Create an Account->>"<<nline;
            user.addUser();
        }





    }
    return 0;
}
