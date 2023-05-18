#include<bits/stdc++.h>
using namespace std;

vector<string> arguments;
int argsize;

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
string sendcmextpath="/etc/sendcmtools";
string sendcmtmppath="/tmp/sendcmtool";

void modestarter(){
    cout<<"send.cm Manager tool"<<endl;
    cout<<"Version 1.2.1"<<endl;
    cout<<"********************************"<<endl;
    cout<<"To use this tool,please use the argument listed below."<<endl;
    cout<<"-U (--upload) [-t (--directory)] FILE_PATH (upload a file [or Folder] to send.cm and leave file information at local side)"<<endl;
    cout<<"-D (--download) <-r FILE_NAME>/<FILE_NAME.sendcmdl> (Download(Restore) files which are in send.cm server)"<<endl;
    cout<<"-V (--version) display version of this tool"<<endl;
}
int s_upload(string filep,int t){
    char t2=(t+48);
    string com="echo '{\"filepath\":\""+filep+"\",\"t\":"+t2+"}' >"+sendcmtmppath+"/ulinfo";
    excush(com);
    excush("php "+sendcmextpath+"/info/upload.php");
    return 0;
}
int s_download(string filep,int r){
    if(!r){
        int fileplen=filep.length();
        string filep2="";
        for(int a=0;a<fileplen-9;a++){
            filep2+=filep[a];
        }
        filep=filep2;
    }
    excush("echo '"+filep+"' > "+sendcmtmppath+"/dlinfo");
    excush("php "+sendcmextpath+"/info/download.php");
    return 0;
}
int isinfo(string in,int onnum=0){
    if(in[0]=='-'){
        return 0;
    }else{
        return 1;
    }
}
int handlespecial(int tmp,string inarg){
    //upload(directory)
    if(inarg=="-U"||inarg=="--upload"){
        string upf;
        int t=0;
        if(tmp+1>=argsize){
            modestarter();
            return -1;
        }
        if(isinfo(arguments[tmp+1],tmp+1)){
            upf=arguments[tmp+1];
            tmp++;    
        }else{
            if(tmp+2>=argsize){
                modestarter();
                return -1;
            }
            if(arguments[tmp+1]=="-t"&&isinfo(arguments[tmp+2])){
                t=1;
                upf=arguments[tmp+2];
                tmp+=2;
            }else{
                modestarter();
                return -1;
            }
            
        }
        s_upload(upf,t);
        return tmp;

    }
    //download(directory)
    if(inarg=="-D"||inarg=="--download"){
        string dlf;
        int r=0;
        if(tmp+1>=argsize){
            modestarter();
            return -1;
        }
        if(isinfo(arguments[tmp+1],tmp+1)){
            dlf=arguments[tmp+1];
            tmp++;
        }else{
            if(tmp+2>=argsize){
                modestarter();
                return -1;
            }
            //input raw file name(default is <file.sendcmdl>)
            if(arguments[tmp+1]=="-r"&&isinfo(arguments[tmp+2])){
                r=1;
                dlf=arguments[tmp+2];
                tmp+=2;
            }else{
                modestarter();
                return -1;
            }
            
        }
        s_download(dlf,r);
        return tmp;
    }
    //version
    if(inarg=="-V"||inarg=="--version"){
        cout<<"send.cm Manager tool"<<endl;
        cout<<"Version 1.2.1"<<endl;
        return tmp;
    }
    //else
    modestarter();
    return tmp;

}
int initdev(){
    cout<<"init..."<<endl;
    excush("php "+sendcmextpath+"/info/tools.php");
    return 1;
}
int main(int argc, char* argv[]){
    initdev();
    for(int a=1;a<argc;a++){
        arguments.push_back(argv[a]);
    }
    argsize=arguments.size();
    for(int a=0;a<argsize;a++){
        //cout<<arguments[a]<<endl;
    }
    for(int a=0;a<argsize;a++){
        if(!isinfo(arguments[a])){
            int cont=handlespecial(a,arguments[a]);
            if(cont==-1){
                return 0;
            }
            a=cont;
        }
    }
}
