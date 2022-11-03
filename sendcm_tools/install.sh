sudo mkdir /etc/sendcmtools
sudo mkdir /etc/sendcmtools/info
sudo cp info/php/* /etc/sendcmtools/info
mkdir tmpexuf
chmod -R 755 tmpexuf

g++ info/cppfile/downloadsendcm.cpp -o tmpexuf/downloadsendcm
g++ info/cppfile/uploadsendcm.cpp -o tmpexuf/uploadsendcm
g++ info/cppfile/sendcmtool.cpp -o tmpexuf/sendcmtool
g++ info/install/check.cpp -o tmpexuf/check
sudo cp tmpexuf/* /bin

mkdir ~/.sendcmtools
mkdir ~/.sendcmtools/tmp
touch ~/.sendcmtools/tmp/test.txt
mkdir ~/.sendcmtools/file
touch ~/.sendcmtools/file/test.txt
tmpexuf/check
rm -rf tmpexuf

