sudo mkdir /etc/sendcmtools;
sudo mkdir /etc/sendcmtools/info;
sudo cp info/php/* /etc/sendcmtools/info;
mkdir tmpexuf;
mkdir tmpexuf2;
chmod -R 755 tmpexuf;

g++ info/cppfile/downloadsendcm.cpp -o tmpexuf/downloadsendcm;
g++ info/cppfile/uploadsendcm.cpp -o tmpexuf/uploadsendcm;
g++ info/cppfile/sendcmtool.cpp -o tmpexuf/sendcmtool;
g++ info/install/check.cpp -o tmpexuf2/check;
sudo cp tmpexuf/* /bin;
tmpexuf2/check;
rm -rf tmpexuf2;
rm -rf tmpexuf;

