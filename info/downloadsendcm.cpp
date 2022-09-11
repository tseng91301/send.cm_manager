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
string sendcmtmppath="~/.sendcmtools";
string sendcmextpath="/etc/sendcmtools";
int main(int argc,char *argv[]){
    if(argc==1){
        cout<<"No file specified !"<<endl;
        return 0;
    }
    excush("echo '' > "+sendcmtmppath+"/tmp/downloadedfilepath");
    string filename=argv[1];
    excush("echo '"+filename+"' > "+sendcmtmppath+"/tmp/downloadingfile");
    if(argc==3){
        string localpath=argv[3];
        excush("echo '"+localpath+"' > "+sendcmtmppath+"/tmp/downloadedfilepath");
    }
    
    excush("php "+sendcmextpath+"/download.php");
}