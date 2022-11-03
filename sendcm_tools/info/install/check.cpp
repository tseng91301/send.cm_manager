#include<bits/stdc++.h>
using namespace std;
string getcmdresult(string command){
    FILE *dd;
    char buffer[80];
    const char* comm=command.c_str();
    dd=popen(comm,"r");
    fgets(buffer,sizeof(buffer),dd);
    string outp;
    int aa=0;
    while(buffer[aa]!='\n'){
        outp=outp+buffer[aa];
        aa++;
    }
    pclose(dd);
    return(outp);
}
void excush(string com){
    const char *comm=com.c_str();
    system(comm);
}
int main(){
    string homepath=getcmdresult("echo ~");
    string aa=getcmdresult("find /etc/sendcmtools/info/upload.php");
    string bb=getcmdresult("find /etc/sendcmtools/info/download.php");
    string cc=getcmdresult("find /etc/sendcmtools/info/list.php");
    string dd=getcmdresult("find ~/.sendcmtools/tmp/test.txt");
    string ee=getcmdresult("find ~/.sendcmtools/file/test.txt");
    string ff=getcmdresult("find /bin/sendcmtool");
    string gg=getcmdresult("find /bin/downloadsendcm");
    string hh=getcmdresult("find /bin/uploadsendcm");
    


    if(aa!="/etc/sendcmtools/info/upload.php"){
        cout<<"info/php/upload.php not installed to /etc/sendcmtools"<<endl;
        return 0;
    }
    if(bb!="/etc/sendcmtools/info/download.php"){
        cout<<"info/php/download.php not installed to /etc/sendcmtools"<<endl;
        return 0;
    }
    if(cc!="/etc/sendcmtools/info/list.php"){
        cout<<"info/php/list.php not installed to /etc/sendcmtools"<<endl;
        return 0;
    }
    if(dd!=homepath+"/.sendcmtools/tmp/test.txt"){
        cout<<".sendcmtools/tmp not created in ~/"<<endl;
        return 0;
    }
    if(ee!=homepath+"/.sendcmtools/file/test.txt"){
        cout<<".sendcmtools/file not created in ~/"<<endl;
        return 0;
    }
    if(ff!="/bin/sendcmtool"||gg!="/bin/downloadsendcm"||hh!="/bin/uploadsendcm"){
        cout<<"application not installed successfully, please reinstall or open directory info/cppfile and compile again mamually!"<<endl;
        return 0;
    }
    cout<<"installed successfully!!"<<endl;
    
}