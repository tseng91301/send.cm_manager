sudo mkdir /etc/sendcmtools;
sudo mkdir /etc/sendcmtools/info;
sudo cp info/php/* /etc/sendcmtools/info;
mkdir tmpexuf;
mkdir tmpexuf2;
chmod -R 755 tmpexuf;

echo "Warming: The property file in previous version can't be used now. If you want to recover the files, please reinstall the previous version!"
echo ""
echo "PHP Version:"
php --version
echo ""
echo "Curl version:"
curl --version
echo ""
echo "g++ version:"
g++ --version
echo ""

echo "Version 1.2 requires PHP mcrypt extension to encrypt data.";
echo "If this hasn't been installed, you can use command below or other approaches to install.";
echo "\`sudo apt install php-mcrypt\`";
echo ""
echo "Configuring..."

g++ info/cppfile/downloadsendcm.cpp -o tmpexuf/downloadsendcm;
g++ info/cppfile/uploadsendcm.cpp -o tmpexuf/uploadsendcm;
g++ info/cppfile/sendcmtool.cpp -o tmpexuf/sendcmtool;
g++ info/install/check.cpp -o tmpexuf2/check;
sudo cp tmpexuf/* /bin;
tmpexuf2/check;
rm -rf tmpexuf2;
rm -rf tmpexuf;
echo "Finish installation! Type 'sendcmtool' for further information."

