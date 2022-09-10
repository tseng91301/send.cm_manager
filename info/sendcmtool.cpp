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
void modestarter(){
    cout<<"send.cm Manager tool"<<endl;
    cout<<"Version 1.0"<<endl;
    cout<<"********************************"<<endl;
    cout<<"To use this tool,please use the argument listed below."<<endl;
    cout<<"-U (--upload) FILE_PATH (upload a file to send.cm and leave file information at local side)"<<endl;
    cout<<"-L (--list) (List all files which were uploaded to send.cm)"<<endl;
    cout<<"-D (--download) FILE_NAME [PATH_TO_SAVE(save in /tmp if not definded)] (Download files which are in send.cm server)"<<endl;
    cout<<"-S (--share) FILE_NAME (get a download link for the file to share with others)"<<endl;
    cout<<"-I (--information) FILE_NAME (get the file's information)"<<endl;
}
int main(int argc,char *argv[]){
    if(argc==1){
        modestarter();
    }
}