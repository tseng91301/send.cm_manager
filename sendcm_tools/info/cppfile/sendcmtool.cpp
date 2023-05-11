#include<bits/stdc++.h>
using namespace std;

string sendcmextpath="/etc/sendcmtools";
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
void modestarter(){
    cout<<"send.cm Manager tool"<<endl;
    cout<<"Version 1.2"<<endl;
    cout<<"********************************"<<endl;
    cout<<"To use this tool,please use the argument listed below."<<endl;
    cout<<"-U (--upload) [-t (--directory)] FILE_PATH (upload a file [or Folder] to send.cm and leave file information at local side)"<<endl;
    cout<<"-D (--download) FILE_NAME (Download(Restore) files which are in send.cm server)"<<endl;
}
int initdev(){
    cout<<"init..."<<endl;
    excush("php "+sendcmextpath+"/info/tools.php");
    return 1;
}

int main(int argc,char *argv[]){
    initdev();
    if(argc<=1){
        modestarter();
    }else{
        string meth=argv[1];
        if(meth=="-U"||meth=="--upload"){
            if(argc<3){
                cout<<"Please input file name or path !"<<endl;
                return 0;
            }
            string a1=argv[2];
            if(a1=="-t"||a1=="--directory"){
                if(argc<4){
                    cout<<"Please input file name or path !"<<endl;
                    return 0;
                }
                string filename=argv[3];
                //cout<<"uploadsendcm -t '"+filename+"'"<<endl;
                excush("uploadsendcm -t '"+filename+"'");
                return 0;
            }
            string filename=argv[2];
            excush("uploadsendcm '"+filename+"'");
            return 0;
        }
        if(meth=="-D"||meth=="--download"){
            if(argc<3){
                cout<<"Please input file path !"<<endl;
                return 0;
            }
            string filename=argv[2];
            string localpath="";
            excush("downloadsendcm '"+filename+"'");
            return 0;
        }
        if(meth=="-L"||meth=="--list"){
            excush("php "+sendcmextpath+"/info/list.php");
        }
    }
}