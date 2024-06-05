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
#include"Category.h"
#include"Task.h"
using namespace std;

#ifndef TODOMANAGER_H_INCLUDED
#define TODOMANAGER_H_INCLUDED

//TodoManager Class
class ToDoManager{
private:
    const char* filename;
    const char* categoryfilename;
    vector<Category> cate;
    vector<Task> task;
public:
    ToDoManager();
    ToDoManager(const char* filename,const char* catefilename);
    //for Task object
    void createTask();
    void addTask();
    void startTask();
    void completeTask();
    void readfileToObjectTask();
    void cleanTask();
    void deleteTask();
    void saveTaskToFile();
    void Display();
    int getCountTask();
    //for Category object
    void createCate();
    void addCate();
    void fileCate();
    void cleanCate();
    void deleteCate();
    void saveCateToFile();
    int getCountCategory();
    void readfileToObjectCate();
    void DisplayCate();
    void cleanTaskCate();
};

ToDoManager::ToDoManager(){
    filename=NULL;
}
ToDoManager::ToDoManager(const char* filename,const char* catefilename){
    this->filename=filename;
    this->categoryfilename=catefilename;
}
void ToDoManager::createTask(){
    system("CLS");
    cout<<"\n\t\t\t\t\t\t-CREATE NEW TASK LIST-"<<nline<<nline;
    cout<<"\tENTER SOME TASK(Just enter for end input) : "<<nline;
    task.clear();

    string tname,cname;
    int tnum=1;
    bool start=true;
    while(start){
        cout<<"\t"<<tnum<<" :) "<<nline;

        cout<<"\t"<<"ENTER TASK NAME: ";
        //cin.ignore();
        getline(cin,tname);
        if(tname==""){
            start=false;
            break;
        }
        DisplayCate();
        cout<<"\t"<<"ENTER CATEGORY NUMBER: ";
        getline(cin,cname);
        if(tname=="" || cname=="") {
            start=false;
            break;
        }
        Task temp(tname);
        int cnum=stoi(cname)-1;
        temp.setCategory(cate[cnum].getCategory());
        task.push_back(temp);
        tnum++;
    }
    system("CLS");
}
void ToDoManager::addTask(){
    system("CLS");
    cout<<"\n\t\t\t\t\t\t-ADD NEW TASK-"<<nline<<nline;
    cout<<"\tENTER SOME NEW TASK(Just enter for end input) : "<<nline;
    string tname,cname;
    int tnum=task.size();
    bool start=true;

    while(start){
        cout<<"\t"<<++tnum<<" :) "<<nline;

        cout<<"\t"<<"ENTER TASK NAME: ";
        cin.ignore();
        getline(cin,tname);
        if(tname==""){
            start=false;
            break;
        }
        DisplayCate();
        cout<<"\t"<<"ENTER CATEGORY NUMBER: ";
        getline(cin,cname);
        if(tname=="" || cname=="") {
            start=false;
            break;
        }
        Task temp(tname);
        int cnum=stoi(cname)-1;
        temp.setCategory(cate[cnum].getCategory());
        task.push_back(temp);
    }
    saveTaskToFile();
    system("CLS");
}
void ToDoManager::startTask(){
    system("CLS");
    readfileToObjectTask();
    Display();
    cout<<"\n\t\t\t\t\t\t-START TASK-"<<nline<<nline;
    cout<<"\tENTER TASK NUMBER : ";
    int index;
    cin>>index;
    index--;
    if(index>=task.size()) return;
    saveTaskToFile();
    system("CLS");
}
void ToDoManager::completeTask(){
    system("CLS");
    readfileToObjectTask();
    Display();
    cout<<"\n\t\t\t\t\t\t-SET TASK COMPLETE-"<<nline<<nline;
    cout<<"\tENTER TASK NUMBER : ";
    int index;
    cin>>index;
    index--;
    if(index>=task.size()) return;
    task[index].setDone();
    saveTaskToFile();
    system("CLS");
}
void ToDoManager::readfileToObjectTask(){
    fstream ts(filename,fstream::in);
    task.clear();

    string tname;
    while(getline(ts,tname)){
        if(tname=="") continue;
        Task temp(tname);
        task.push_back(temp);
    }
    ts.close();
}
void ToDoManager::cleanTask(){
    task.clear();
    remove(filename);
    cout<<"\tSuccessfully Deleted all task!!"<<nline;
}
void ToDoManager::deleteTask(){
    system("CLS");
    readfileToObjectTask();
    Display();
    cout<<"\n\t\t\t\t\t\t-DELETE TASK-"<<nline<<nline;
    cout<<"\tENTER TASK NUMBER : ";
    int index;
    cin>>index;
    index--;
    if(index>=task.size()) return;
    vector<Task>::iterator itr;
    itr=task.begin();
    itr+=index;
    task.erase(itr);
    saveTaskToFile();
    system("CLS");
}
void ToDoManager::saveTaskToFile(){
    fstream ts(filename,fstream::out);

    for(Task temp:task){
        if(temp.getTask().empty()) continue;
        ts<<temp.getTask()<<" "<<(temp.getDone()?"true":"false")<<" "<<temp.getCategory()<<nline;
    }
}
void ToDoManager::Display(){
    cout<<"\n\t\t\t\t\t-YOUR TO DO LIST-"<<nline;
    const int w=30;
    cout<<"\t   "<<setw(w)<<left<<"TASK"<<"CATEGORY"<<setw(w)<<right<<"DONE"<<nline;
    cout<<"\t   "<<setw(w)<<left<<"----"<<"----"<<setw(w)<<right<<"\t   ----"<<nline;
    for(int i=0;i<task.size();++i){
        cout<<"\t"<<i+1<<") "<<setw(w)<<left<<task[i].getTask()<<task[i].getCategory()<<setw(w)<<right<<(task[i].getDone()?"DONE":"")<<nline;
    }

}
int ToDoManager::getCountTask(){
    return task.size();
}

//category definition

void ToDoManager::createCate(){
    system("CLS");
    cout<<"\n\t\t\t\t\t\t-CREATE CATEGORY LIST-"<<nline<<nline;
    cout<<"\tENTER SOME CATEGORY(Just enter for end input) : "<<nline;
    cate.clear();
    categoryfilename="category.txt";
    fstream ct(categoryfilename,fstream::out);
    string catename;
    int cnum=1;
    bool start=true;

    while(start){
        cout<<"\t"<<cnum<<" :) ";
        getline(cin,catename);
        if(catename=="") {
            start=false;
            break;
        }
        Category temp(catename);
        cate.push_back(temp);
        cnum++;
    }
    //saveCateToFile();
    system("CLS");
}
void ToDoManager::addCate(){
    system("CLS");
    cout<<"\n\t\t\t\t\t\t-ADD NEW CATEGORY-"<<nline<<nline;
    cout<<"\tENTER SOME NEW CATEGORY(Just enter for end input) : "<<nline;
    string catename;
    int cnum=cate.size();
    bool start=true;
    cin.ignore();
    while(start){
        cout<<"\t"<<++cnum<<" :) ";
        cout<<"\tEnter Category name: ";

        getline(cin,catename);
        if(catename=="") {
            start=false;
            break;
        }
        Category temp(catename);
        cate.push_back(temp);
    }
    saveCateToFile();
    system("CLS");
}

void ToDoManager::readfileToObjectCate(){
    fstream ct(categoryfilename,fstream::in);
    cate.clear();

    string catename;
    while(getline(ct,catename)){
        if(catename=="") continue;
        Category temp(catename);
        cate.push_back(temp);
    }
    ct.close();
}
void ToDoManager::cleanCate(){
    cate.clear();
    remove(categoryfilename);
    int len=getCountTask();
    for(int i=0;i<len;i++)
        task[i].setCategory("");
    saveTaskToFile();
    cout<<"\tSuccessfully Deleted all Category!!"<<nline;
}
void ToDoManager::deleteCate(){
    system("CLS");
    readfileToObjectCate();

    cout<<"\n\t\t\t\t\t\t-DELETE CATEGORY-"<<nline<<nline;
    DisplayCate();
    cout<<"\tENTER CATEGORY NUMBER : ";
    int index;
    cin>>index;
    index--;
    cout<<cate.size()<<" ";
    if(index>=cate.size()) return;
    vector<Category>::iterator itr;
    itr=cate.begin();
    itr+=index;
    ///task category delete
    string catename=cate[index].getCategory();
    int len=getCountTask();
    for(int i=0;i<len;i++){
        if(task[i].getCategory()==catename)
            task[i].setCategory("");
    }
    cate.erase(itr); ///Problem here category not deleted
    saveCateToFile();///Challenge if one category deleted then task allow category will be
    saveTaskToFile();///Challenge if one category deleted then task allow category will be
    system("CLS");///deleted
}
void ToDoManager::saveCateToFile(){
    fstream ts(categoryfilename,fstream::out);

    for(Category temp:cate){
        if(temp.getCategory().empty()) continue;
        ts<<temp.getCategory()<<nline;
    }
    ts.close();
}
void ToDoManager::DisplayCate(){
    cout<<"\tCATEGORY LIST-> ";
    for(int i=0;i<cate.size();i++)
        cout<<i+1<<":) "<<cate[i].getCategory()<<"  ";
    cout<<nline;
    //char ch=getchar();
}
int ToDoManager::getCountCategory(){
    return cate.size();
}

void ToDoManager::cleanTaskCate(){
    cleanCate();
    cleanTask();
}

#endif // TODOMANAGER_H_INCLUDED
