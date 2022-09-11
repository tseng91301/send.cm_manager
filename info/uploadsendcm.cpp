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
string sendcmextpath="/etc/sendcmtools";
string sendcmtmppath="~/.sendcmtools";
int main(int argc,char *argv[]){
    if(argc==1){
        cout<<"No file specified !"<<endl;
        return 0;
    }
    string filepath=argv[1];
    int filesta;
    if(filepath[0]=='/'||filepath[0]=='~'){
        filesta=0;
    }else{
        filesta=1;
    }
    if(filesta==1){
        string tmp1=getcmdresult("pwd");
        if(tmp1!="/"){
            tmp1=tmp1+"/";
        }
        filepath=tmp1+filepath;
    }
    //cout<<filepath<<endl;
    string com="echo '"+filepath+"' > "+sendcmtmppath+"/tmp/uploadingfile";
    const char *comm=com.c_str();
    system(comm);

    string com1="php "+sendcmextpath+"/info/upload.php";
    const char *comm1=com1.c_str();
    system(comm1);

    string finn=getcmdresult("cat "+sendcmtmppath+"/tmp/filelink");
    if(finn=="error1"){
        cout<<"The file is banned by send.cm server"<<endl;
    }else{
        cout<<finn<<endl;
    }
}