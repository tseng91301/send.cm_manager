###### send.cm_manager

# send.cm_Manager
## 簡介：<br/>　　這是基於send.cm平台的管理程式。send.cm是一款可以匿名並有無限儲存空間的雲端資源，但是上傳到平台的檔案在十天之後會被刪除。這個程式可以自動管理平台上上傳的檔案，被刪除之前重新上傳，只要一條簡單的指令，就可以上傳大型檔案，釋放電腦空間，重點是完全免費!!

## 下載方式
### 目前僅開發出Linux系統專用版本，其他系統的版本正在努力開發中...
### 1. 安裝下列套件：
1. PHP
```shell 
sudo apt install php
```
2. jq
```shell 
sudo apt install jq
```
3. gcc
```shell 
sudo apt install gcc
sudo apt install g++
```
### 2.下載並安裝zip安裝包([下載連結](https://github.com/tseng91301/send.cm_manager/raw/main/install/sendcm_tools.zip))
#### 指令碼：
1. 下載.zip包
```shell=
wget https://github.com/tseng91301/send.cm_manager/raw/main/install/sendcm_tools.zip
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
5. 執行安裝程式
```shell=
./install.sh
```
### 3. 執行程式即可取得使用說明
```shell=
sendcmtools
```
## 附加說明：<br/>　　此程式目前還在開發中，故某些功能無法運行，但單純上傳下載是沒有問題的，如有想要其他功能，可以等候更新或[聯絡我(使用電子郵件)](mailto:tseng7418@gmail.com?subject=blacktechserver-contact)