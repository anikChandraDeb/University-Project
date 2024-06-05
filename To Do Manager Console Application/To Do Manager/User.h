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
using namespace std;

#ifndef USER_H_INCLUDED
#define USER_H_INCLUDED

//user class
class User{
private:
    string name;
    string password;
    const char* filename;
public:
    User();
    User(const char* filename);
    bool check();
    void addUser();
    string getName();
    void setName(string name);
    string getPassword();
    void setPassowrd(string password);
};
//User class member funciton definition
//default construct
User::User(){
    name="";
    password="";
    filename=NULL;
}
User::User(const char* filename){
    this->filename=filename;
}
bool User::check(){
    fstream login(filename,fstream::in);
    string info,name,password,inputinfo;
    getline(login,info);
    if(info=="") return 0;
    cout<<"\t\t\t\t\t------Login Info------"<<nline;
    cout<<"\tEnter user Name: ";
    getline(cin,name);
    cout<<"\tEnter user Password: ";
    getline(cin,password);
    setName(name);
    setPassowrd(password);
    inputinfo=name+" "+password;
    if(info==inputinfo) return 1;
    else return 0;
    login.close();
}

void User::addUser(){
    fstream user(filename,fstream::out);
    string name,password;

    cout<<"\tEnter user Name: ";
    getline(cin,name);
    cout<<"\tEnter user Password: ";
    getline(cin,password);
    setName(name);
    setPassowrd(password);
    user<<name<<" "<<password<<endl;
    user.close();
}
string User::getName(){return this->name;}
void User::setName(string name){
    this->name=name;
}
string User::getPassword(){return this->password;}
void User::setPassowrd(string password){
    this->password=password;
}

#endif // USER_H_INCLUDED
