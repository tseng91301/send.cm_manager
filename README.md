###### tags: `send.cm_manager`

# send.cm_Manager v1.2
## 簡介：<br/>　　這是基於send.cm平台的管理程式。send.cm是一款可以匿名並有無限儲存空間的雲端資源，但是上傳到平台的檔案在十天之後會被刪除。透過此程式，只要一條簡單的指令，就可以上傳大型檔案，釋放電腦空間！<br/>　　此版本加入了文件加密及分割的功能，不需要更多設定，程式會自動分割檔案並使用AES加密技術加密檔案，這樣就不用害怕檔案被竊取了！

### P.S 之後會推出伺服器用的自動備份版本，可以在檔案刪除前自動更新。

## 下載方式
### 目前僅開發出Linux系統專用版本，其他系統的版本正在努力開發中...
### 1. 安裝下列套件：
1. PHP
```shell 
sudo apt install php
```
2. gcc
```shell 
sudo apt install gcc
sudo apt install g++
```
2. curl
```shell 
sudo apt install curl
```
3. PHP mcrypt extension
```shell 
sudo apt install php-mcrypt
```
#### 註：在安裝過程中也會檢查這些套件的版本
### 2.下載並安裝zip安裝包([下載連結](https://github.com/tseng91301/send.cm_manager/raw/gen1.2/install/sendcm_tools.zip))
#### 指令碼：
1. 下載.zip包
```shell=
wget https://github.com/tseng91301/send.cm_manager/raw/gen1.2/install/sendcm_tools.zip
```
2. 解壓縮.zip包
```shell=
unzip sendcm_tools.zip
```
3. 進入安裝包資料夾(目錄內有install.sh)
```shell=
cd sendcm_tools
```
4. 更改檔案權限
```shell=
chmod -R 755 ./*
```
5. 執行安裝或更新程式
```shell=
./install.sh
```
```shell=
./update.sh
```
### 3. 執行程式即可取得使用說明
```shell=
sendcmtool
```
## 附加說明：<br/>　　此程式目前還在開發中，故某些功能無法運行，但單純上傳下載是沒有問題的，如有想要其他功能，可以等候更新或[聯絡我(使用電子郵件)](mailto:tseng7418@gmail.com?subject=blacktechserver-contact)

## 使用方式
### 1. sendcmtool -U (--upload) \[-t\] &lt;file_path&gt;<br/>　　上傳指定檔案(加上 -t 參數可上傳資料夾)到send.cm伺服器，上傳完畢會在該檔案目錄下新增一個文件為\[檔案名稱\].sendcmul。該檔案包含原檔案在伺服器中的所有資料(下載連結等)，因此請不要遺失它，否則將無法找回檔案！
### 2. sendcmtool -D (--download) &lt;file_path&gt;<br/>　　下載send.cm伺服器中的檔案或資料夾。會偵測該檔案所在的目錄是否有\[檔案或資料夾名稱\].sendcmul資料，並使用此資料將伺服器上的檔案或資料夾還原到原來的位置。