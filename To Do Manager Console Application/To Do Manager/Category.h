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
#ifndef CATEGORY_H_INCLUDED
#define CATEGORY_H_INCLUDED

//Category Class
class Category{
private:
    string categoryName;
public:
    Category();
    Category(string catename);
    string getCategory();
    void setCategory(string cate);
};

Category::Category(){
    categoryName="";
}
Category::Category(string catename){
    this->categoryName=catename;
}
string Category::getCategory(){
    return this->categoryName;
}
void Category::setCategory(string cate){
    this->categoryName=cate;
}

#endif // CATEGORY_H_INCLUDED
