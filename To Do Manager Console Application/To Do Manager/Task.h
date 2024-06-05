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
using namespace std;

#ifndef TASK_H_INCLUDED
#define TASK_H_INCLUDED

//Task Class inherit Category
class Task:public Category{
private:
    string taskName;
    bool done;
//    time_t starttime,endtime;
    //next update with start and end time variable here
public:
    Task();
    Task(string task);
    string getTask();
    void setDone();
    bool getDone();
    string stringLower(string str);
    bool operator==(Task obj);
    //start time function next update
//    void setStartTime();
//    void setEndTime();
//    auto getStartTime();
//    auto getEndTime();
};

Task::Task(){
    taskName="";
    done=false;
}
Task::Task(string task){
    int isfalse=task.find("false");
    int istrue=task.find("true");
    string subs1,subs2="";
    int len=task.length();
    if(isfalse==-1 && istrue==-1){
        subs1=task;
        done=false;
    }
    else if(isfalse>-1 && istrue==-1){
        subs1=task.substr(0,isfalse-1);
        done=false;
        for(int i=isfalse+6;i<len;i++) subs2+=task[i];
        setCategory(subs2);

    }
    else if(isfalse==-1 && istrue>-1){
        subs1=task.substr(0,istrue-1);
        setDone();
        for(int i=istrue+5;i<len;i++) subs2+=task[i];
        setCategory(subs2);
    }
    taskName=subs1;
}
string Task::getTask(){
    return taskName;
}
void Task::setDone(){
done=true;
}
bool Task::getDone(){
    return done;
}
string Task::stringLower(string str){
    string temp=str;
    int len=temp.length();
    for(int i=0;i<len;i++){
        temp[i]=tolower(temp[i]);
    }
    return temp;
}
bool Task::operator==(Task obj){
    bool text=stringLower(taskName) == stringLower(obj.getTask());
    bool done= done == obj.getDone();

    return text && done;
}

#endif // TASK_H_INCLUDED
