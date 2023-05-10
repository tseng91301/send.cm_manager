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
string sendcmextpath="/etc/sendcmtools";
string sendcmtmppath="/tmp/sendcmtool";
int main(int argc,char *argv[]){
    if(argc<=1){
        cout<<"No file specified !"<<endl;
        return 0;
    }
    string a1=argv[1];
    //cout<<a1<<endl;
    if(a1=="-t"){
        if(argc<=2){
            cout<<"No file specified !"<<endl;
            return 0;
        }
        string filepath=argv[2];
        excush("echo '{\"filepath\":\""+filepath+"\",\"t\":1}' >"+sendcmtmppath+"/ulinfo");
    }else{
        string filepath=argv[1];
        excush("echo '{\"filepath\":\""+filepath+"\",\"t\":0}' >"+sendcmtmppath+"/ulinfo");
    }
    
    excush("php "+sendcmextpath+"/info/upload.php");
    return 0;
}