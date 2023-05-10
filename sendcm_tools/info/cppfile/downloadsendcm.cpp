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
string sendcmtmppath="/tmp/sendcmtool";
string sendcmextpath="/etc/sendcmtools";
int main(int argc,char *argv[]){
    if(argc<=1){
        cout<<"No file specified !"<<endl;
        return 0;
    }
    string filename=argv[1];
    excush("echo '"+filename+"' > "+sendcmtmppath+"/dlinfo");
    excush("php "+sendcmextpath+"/info/download.php");
}